<?php
Session_start();
class home extends Controller{
    public $request;
    public $activemenu;
    function __construct()
    {
        $this->request = $_REQUEST;
        $this->activemenu = 'home';

    }

    function index($args = []) { 
        $model = $this->model('Subscription_Model');

        if (!isset($this->request['mid']) || (!isset($this->request['cid']) && !isset($this->request['email']))) {
            $this->view('home/index', []); // Skip the process and load the view with an empty array
            return;
        }
    
        $data = $model->getDetails($this->request);

        if (!is_array($data) || empty($data['merchant'])) {
            $this->view('home/index', $data); // Skip the process and load the view with an empty array
            return;
        }

        

        $merchant = $data['merchant'];
        $customer = $data['client'];
        $subscriptions = [];

        $_SESSION['gateway'] = $merchant['gateway'];
        
        switch ($merchant['gateway'])
        {
            case 'nmi':
                $_SESSION["merchant_secret_key"] = $merchant['merchant_secret_key'];
                $_SESSION['subscriptionId'] = $this->request['cid'] ?? null;
                $_SESSION['email'] = $this->request['email'] ?? null;

                $this->request["action"] = "get_transaction";
                $subscriptions = $this->process_nmi($this->request);
                // print_r($subscriptions);
                break;
            case 'authnet': // <-- added colon here
                $_SESSION["authnet_api_login_id"] = $merchant['authnet_api_login_id'];
                $_SESSION["authnet_transaction_key"] = $merchant['authnet_transaction_key'];
                
                $subscriptions = $model->get_authnet_subscription_details(
                    $merchant['authnet_api_login_id'], 
                    $merchant['authnet_transaction_key'], 
                    $this->request['cid']
                );
                break;
            default:
        }

        
        $data['subscriptions'] = $subscriptions;
  
        $this->view('home/index', $data ?? []);
    }

    //NMI
    public function process_nmi($request)
    {
        $response = [];

        switch($request['action']){
            case "refund":
                $request['type'] = 'refund';
                $response = $this->refund($request);
                break;
            case "cancel_subscription":
                $request['recurring'] = 'delete_subscription';
                $response = $this->auth_cancel_subscription($request);
                break;
            case "get_transaction":
                $response = Nmis::get_subscription_transactions($request);
                // print_r($subscriptions);
                break;
            default:
                Response::output("400", "Invalid action");
        }

        // Response::output($response['response_code'], $response['message']);
        return $response;

    }


    //Auth.net

    public function cancel_subscription()
    {

        if($_SESSION['gateway'] == 'nmi')
        {
            
            $response = $this->nmi_cancel_subscription($this->request);

        }
        else
        {
            $model = $this->model('Subscription_Model');
            $subscriptionId = $_SESSION['recent_subscriptionId'] = $this->request['subscriptionId'];
            $result = $model->set_authnet_cancel_subscription($subscriptionId);
        }

        Response::output($result['code'], $result['data']);
    }

    public function refund_request()
    {
        $model = $this->model('Subscription_Model');
        $result = $model->set_authnet_refund_request();
        exit(print_r($result));
    }

    public function nmi_cancel_subscription($request)
     {
        $request['subscription_id'] = $request['subscriptionId'];
        $request['recurring'] = 'delete_subscription';

        $requiredFields = ['subscription_id', 'recurring'];
        $validation = validateParams($request, $requiredFields);

        if (isset($validation['error'])) {
            Response::output("400", $validation);
        }

        $response = Nmis::process($validation);
        exit(print_r($response));
        return $response;
     }


}