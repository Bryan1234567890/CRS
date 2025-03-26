<?php
Session_start();

class home extends Controller {
    public $request;
    public $activemenu = 'home';

    function __construct() {
        $this->request = $_REQUEST;
    }

    function index($args = []) {
        $this->view('home/index');
    }

    public function getDetails() {
        $model = $this->model('Subscription_Model');
        $req = $this->request;

        if (!isset($req['mid']) || (!isset($req['cid']) && !isset($req['email']) && !isset($req['last4']) && !isset($req['first6']))) {
            Response::output("400", ["message" => "Missing required parameters."]);
        }

        $data = $model->getDetails($req);

        if (!is_array($data) || empty($data['merchant'])) {
            Response::output("504", ["message" => "Merchant not found"]);
        }

        $_SESSION['gateway'] = $data['merchant']['gateway'];
        $gateway = $_SESSION['gateway'];

        if ($gateway === 'nmi') {
            $_SESSION = array_merge($_SESSION, [
                "merchant_secret_key" => $data['merchant']['merchant_secret_key'],
                "subscriptionId" => $req['cid'] ?? null,
                "last4" => $req['last4'] ?? null,
                "first6" => $req['first6'] ?? null,
                "email" => $req['email'] ?? null,
                "merchant_name" => $data['merchant']['website_address'] ?? null
            ]);

            $req["action"] = "get_transaction";
            $data['subscriptions'] = $this->handleNmi($req);

        } elseif ($gateway === 'authnet') {
            $_SESSION["authnet_api_login_id"] = $data['merchant']['authnet_api_login_id'];
            $_SESSION["authnet_transaction_key"] = $data['merchant']['authnet_transaction_key'];

            $data['subscriptions'] = $model->get_authnet_subscription_details(
                $_SESSION['authnet_api_login_id'],
                $_SESSION['authnet_transaction_key'],
                $req['cid']
            );
        }

        Response::output("200", $data['subscriptions']);
    }

    public function cancel_subscription() {
        $model = $this->model('Subscription_Model');

        if ($_SESSION['gateway'] === 'nmi') {
            $result = $this->handleNmiCancel($this->request);
        } else {
            $subscriptionId = $_SESSION['recent_subscriptionId'] = $this->request['subscriptionId'];
            $result = $model->set_authnet_cancel_subscription($subscriptionId);
        }

        $code = (string) ($result['response_code'] ?? 500);
        $data = $result['data'] ?? 'No data';

        Response::output($code, $data);
    }

    public function refund_request() {
        $model = $this->model('Subscription_Model');
        $result = $model->set_authnet_refund_request();
        exit(print_r($result));
    }

    private function handleNmi($request) {
        switch ($request['action']) {
            case "refund":
                $request['type'] = 'refund';
                return $this->refund($request);
            case "cancel_subscription":
                $request['recurring'] = 'delete_subscription';
                return $this->auth_cancel_subscription($request);
            case "get_transaction":
                return Nmis::get_subscription_transactions($request);
            default:
                Response::output("400", "Invalid action");
        }
    }

    private function handleNmiCancel($request) {
        $request['subscription_id'] = $request['subscriptionId'];
        $request['recurring'] = 'delete_subscription';

        $requiredFields = ['subscription_id', 'recurring'];
        $validation = validateParams($request, $requiredFields);

        if (isset($validation['error'])) {
            Response::output("400", $validation);
        }

        return Nmis::process($validation);
    }
}
