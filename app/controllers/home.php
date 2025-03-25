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

    function index($args = []) 
    { 
        $this->view('home/index');   
    }

    public function getDetails()
    {
        $model = $this->model('Subscription_Model');

        if (!isset($this->request['mid']) ||  (!isset($this->request['cid']) && !isset($this->request['email']) && !isset($this->request['last4']) && !isset($this->request['first6'])))
        {
            
            Response::output("400", ["message"=>"Missing required parameters."]);
        }
    
        $data = $model->getDetails($this->request);
        
        if (!is_array($data) || empty($data['merchant'])) 
        {   
            Response::output("504", ["message"=>"Merchant not found"]);
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
                $_SESSION['last4'] = $this->request['last4'] ?? null;
                $_SESSION['first6'] = $this->request['first6'] ?? null;
                $_SESSION['email'] = $this->request['email'] ?? null;
                $_SESSION['merchant_name'] = $merchant['website_address'] ?? NULL;

                $this->request["action"] = "get_transaction";
                $subscriptions = $this->process_nmi($this->request);
               
                break;
            case 'authnet': 
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
  
        Response::output("200",$data['subscriptions']);
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
            $result = $this->nmi_cancel_subscription($this->request);
            $result['data'] = isset($result['data']) ? $result['data'] : ($result['data'] ?? 'No data available');
           
        }
        else
        {
            $model = $this->model('Subscription_Model');
            $subscriptionId = $_SESSION['recent_subscriptionId'] = $this->request['subscriptionId'];
            $result = $model->set_authnet_cancel_subscription($subscriptionId);
        }

        $code = $result['response_code'] ?? 500;
        $data = $result['data'];

        Response::output($code, $data);
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
        return $response;
     }


}