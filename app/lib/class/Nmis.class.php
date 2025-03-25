<?php

class Nmis extends DatabaseObject
{
    
    public static function process(array $postData)
    {
        $response = self::NMICurl($postData);
        
        $result = self::evaluateTransactionResponse(parseNmiResponse($response));
        
        return $result;
    }

    public static function get_subscription_transactions($request)
    {
        
        if (!isset($_SESSION['subscriptionId']) && !isset($_SESSION['email'])) {
            return ['error' => 'Missing required parameter', 'fields' => "Please provide a Subsciption Id [cid] or Email."];
        }

        $postData = [
            'security_key'=> $_SESSION["merchant_secret_key"],
            'report_type'=>'recurring',
        ];

        $response = self::NMICurl($postData, true);

        return filterMappedSubscriptions(xmlToJson($response));

    }

    private static function evaluateTransactionResponse($parsedResponse) 
    {
        
        switch ($parsedResponse['response']) 
        {
            case '1':
                return 
                [
                    'response_code' => '200', 
                    'message' => 'Transaction Approved',
                    'data' =>
                    [
                        'transactionid' => $parsedResponse['transactionid'],
                        'message' =>'Transaction Approved',
                    ]
                ];
            case '2':
                return ['response_code' => 402, 'message' => 'Transaction Declined'];
            case '3':
            default:
                return [
                    'response_code' => 400, 
                    'message' => $parsedResponse['responsetext'] ?? 'Error in transaction data or system error'
                ];
        }
    }

    private static function NMICurl(array $postData, $isTransact = false)
    {

        $url = ($isTransact)?"https://secure.nmi.com/api/query.php":"https://secure.nmi.com/api/transact.php";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url ,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'accept: application/xml',
                'content-type: application/x-www-form-urlencoded'
            ],
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

}