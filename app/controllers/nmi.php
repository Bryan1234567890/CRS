<?php

class Nmi extends Controller
{
     private $request;

     public function __construct()
     {
        $this->request = $_REQUEST;
     } 

     public function index()
     {
        $request = $this->request;
        $response = [];

        switch($request['action']){
            case "refund":
                $request['type'] = 'refund';
                $response = $this->refund($request);
                break;
            case "cancel_subscription":
                $request['recurring'] = 'delete_subscription';
                $response = $this->nmi_cancel_subscription($request);
                break;
            default:
                Response::output("400", "Invalid action");
        }
        // exit(print_r($response));
        Response::output($response['response_code'], $response['message']);
     }

     public function nmi_cancel_subscription($request)
     {
        $requiredFields = ['subscription_id', 'recurring'];
        $validation = validateParams($request, $requiredFields);

        if (isset($validation['error'])) {
            Response::output("400", $validation);
        }

        $response = Nmis::process($validation);

        return $response;
     }

     public function refund($request)
     {
        $requiredFields = ['type', 'transactionId', 'amount', 'payment'];
        $validation = validateParams($request, $requiredFields);

        if (isset($validation['error'])) {
            Response::output("400", $validation);
        }

        $response = Nmis::process($validation);

        return $response;
     }

     public function transactions($request)
     {
        $requiredFields = ['type', 'transactionId', 'amount', 'payment'];
        $validation = validateParams($request, $requiredFields);

        if (isset($validation['error'])) {
            Response::output("400", $validation);
        }

        $response = Nmis::process($validation);

        return $response;
     }
}
?>