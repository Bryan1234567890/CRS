<?php

class Subscription_Model extends Database {

    function __construct(){
        parent::__construct();
    }

    function getDetails($args = [])
    {

        $client = [];
        $mid = $args['mid'];
        $stmt = $this->prepare('SELECT * FROM merchantid WHERE mid = :mid');
        $stmt->execute(array(
            'mid' => $mid
        ));
        $merchant = $stmt->fetch(PDO::FETCH_ASSOC);

        $mid = $args['mid'];
        $stmt = $this->prepare('SELECT * FROM descriptor WHERE DESCRIPTOR_MID = :mid');
        $stmt->execute(array(
            'mid' => $mid
        ));
        $descriptor = $stmt->fetch(PDO::FETCH_ASSOC);

        if(isset($args['cid']))
        {
            $cid = $args['cid'];
            $stmt = $this->prepare('SELECT * FROM pre_login where PRE_LOGIN_ID = :cid');
            $stmt->execute(array(
                'cid' => $cid
            ));
            $client = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return array(
            'merchant' => $merchant,
            'descriptor' => $descriptor,
            'client' => $client,
        );
    }

    private function auth_curl($payload)
    {
        $ch = curl_init(AUTHNET_ENDPOINT);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ]);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            Response::output(500, "Curl error: " . $error_msg);
            exit();
        }

        curl_close($ch);

        return $result;

    }

    private function get_authnet_customer_pofile($api_login_id, $transaction_key, $customer_profile_id){
        $payload = [
            
                "getCustomerProfileRequest" => [
                    "merchantAuthentication" => [
                        "name" => $api_login_id,
                        "transactionKey" => $transaction_key
                    ],
                    "customerProfileId" => $customer_profile_id,
                    "includeIssuerInfo" => "true"
                ]
            
        ];

        
        $result = $this->auth_curl(json_encode($payload));
        $result = preg_replace('/^\xEF\xBB\xBF/', '', $result);
        $result = json_decode($result, true);

        return $result;
    }

    private function get_authnet_subscription($api_login_id, $transaction_key, $subscription_id){
        $payload = [
            "ARBGetSubscriptionRequest" => [
                "merchantAuthentication" => [
                    "name" => $api_login_id,
                    "transactionKey" => $transaction_key
                ],
                "subscriptionId" => $subscription_id,
                "includeTransactions" => true
            ]
        ];
        $payloadJson = json_encode($payload);

        $result = $this->auth_curl($payloadJson);
        $result = preg_replace('/^\xEF\xBB\xBF/', '', $result);
        $result = json_decode($result, true);
        
        return $result;
    }

    public function get_authnet_subscription_details($api_login_id, $transaction_key, $customer_profile_id)
    {
        $customer_profile = $this->get_authnet_customer_pofile($api_login_id, $transaction_key, $customer_profile_id);

        if($customer_profile['messages']['resultCode'] == 'Error')
        {
            $result = [
                "Status" => $customer_profile['messages']['resultCode'],
                "message" => $customer_profile['messages']['message'][0]['text']
            ];

            return $result;
        }
            
        $subscriptionIds = $customer_profile['subscriptionIds'];

        $subscriptions = [];

        foreach ($subscriptionIds as $key => $value) {
            $sub = $this->get_authnet_subscription($api_login_id, $transaction_key, $value);
            $subscriptions[$value] = $sub;
        }
        

        return $subscriptions;
    }

    public function set_authnet_cancel_subscription($subscriptionId){

        $payload = [
            "ARBCancelSubscriptionRequest" => [
                "merchantAuthentication" => [
                    "name" => $_SESSION['authnet_api_login_id'],
                    "transactionKey" => $_SESSION['authnet_transaction_key']
                ],
                "subscriptionId" => $subscriptionId,
                "includeTransactions"=> true
            ]
        ];

        $payloadJson = json_encode($payload);
        $result = $this->auth_curl($payloadJson);

        $result = preg_replace('/^\xEF\xBB\xBF/', '', $result);
        $decodedResult = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 'JSON decode error: ' . json_last_error_msg();
            exit();
        }

        $status = isset($decodedResult["messages"]["resultCode"]) ? $decodedResult["messages"]["resultCode"] : null;
        $message = isset($decodedResult["messages"]["message"][0]["text"]) ? $decodedResult["messages"]["message"][0]["text"] : null;

        $code = ($status === "Ok")? "200":"204";

        $result = [
            "code"=> $code,
            "data"=>[
            "Status" => $status,
            "message" => $message
            ]
        ];
        
        return $result;

    }

    public function set_authnet_refund_request()
    {
        if (!isset($_SESSION['recent_subscriptionId'])) {
            return [
                "Status" => "Failed",
                "message" => "Subscription ID not found."
            ];
        }
    
        $payload = [
            "ARBGetSubscriptionRequest" => [
                "merchantAuthentication" => [
                    "name" => $_SESSION['authnet_api_login_id'] ?? '',
                    "transactionKey" => $_SESSION['authnet_transaction_key'] ?? ''
                ],
                "subscriptionId" => $_SESSION['recent_subscriptionId'],
                "includeTransactions" => true
            ]
        ];
    
        $payloadJson = json_encode($payload);
        $result = $this->auth_curl($payloadJson);
    
        $result = preg_replace('/^\xEF\xBB\xBF/', '', $result);
        $decodedResult = json_decode($result, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'Status' => 'Failed',
                'message' => 'JSON decode error: ' . json_last_error_msg()
            ];
        }
    
        $status = $decodedResult['subscription']['status'] ?? null;
        $transactionAmount = $decodedResult['subscription']['amount'] ?? null;
    
        $transaction_id = $decodedResult['subscription']['arbTransactions'][0]['transId'] ?? null;
        $cardNumber = $decodedResult['subscription']['profile']['paymentProfile']['payment']['creditCard']['cardNumber'] ?? null;
        $cardExpiration = $decodedResult['subscription']['profile']['paymentProfile']['payment']['creditCard']['expirationDate'] ?? null;
    
        if ($transaction_id === null || $cardNumber === null || $cardExpiration === null || $transactionAmount === null) {
            return [
                "Status" => "Failed",
                "message" => "Essential transaction details missing."
            ];
        }
    
        $lastFour = substr($cardNumber, -4);
    
        $transactionPayload = [
            "createTransactionRequest" => [
                "merchantAuthentication" => [
                    "name" => $_SESSION['authnet_api_login_id'] ?? '',
                    "transactionKey" => $_SESSION['authnet_transaction_key'] ?? ''
                ],
                "transactionRequest" => [
                    "transactionType" => "refundTransaction",
                    "amount" => $transactionAmount,
                    "payment" => [
                        "creditCard" => [
                            "cardNumber" => $lastFour,
                            "expirationDate" => $cardExpiration
                        ]
                    ],
                    "refTransId" => $transaction_id
                ]
            ]
        ];
    
        $transactionPayloadJson = json_encode($transactionPayload);
        $transactionResult = $this->auth_curl($transactionPayloadJson);
    
        $transactionResult = preg_replace('/^\xEF\xBB\xBF/', '', $transactionResult);
        $transactionDecodedResult = json_decode($transactionResult, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'Status' => 'Failed',
                'message' => 'JSON decode error (Transaction): ' . json_last_error_msg()
            ];
        }
    
        $responseCode = $transactionDecodedResult['transactionResponse']['responseCode'] ?? null;
    
        switch ($responseCode) {
            case '1':
                $result = [
                    "Status" => "Success",
                    "message" => "Transaction Approved.",
                    "transactionId" => $transactionDecodedResult['transactionResponse']['transId'],
                    "authCode" => $transactionDecodedResult['transactionResponse']['authCode']
                ];
                break;
    
            case '2':
                $result = [
                    "Status" => "Failed",
                    "message" => "Transaction Declined."
                ];
                break;
    
            case '3':
                $result = [
                    "Status" => "Error",
                    "message" => "Transaction Error."
                ];
                break;
    
            case '4':
                $result = [
                    "Status" => "Review",
                    "message" => "Transaction Held for Review."
                ];
                break;
    
            default:
                $result = [
                    "Status" => "Unknown",
                    "message" => "Unknown transaction response."
                ];
                break;
        }
    
        return $result;
    }
    
}