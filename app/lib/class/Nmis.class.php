<?php

class Nmis extends DatabaseObject
{
    
    public static function process(array $postData)
    {
        $response = self::NMICurl($postData);
        $result = self::evaluateTransactionResponse(parseNmiResponse($response));
        return $result;

    }

    private static function evaluateTransactionResponse($parsedResponse) 
    {
        switch ($parsedResponse['response']) 
        {
            case '1':
                return ['response_code' => 200, 'message' => 'Transaction Approved'];
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

    private static function NMICurl(array $postData)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://secure.nmi.com/api/transact.php',
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