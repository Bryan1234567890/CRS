<?php

function parseNmiResponse($response) {
    $data = [];

    $pairs = explode('&', $response);

    foreach ($pairs as $pair) {
        list($key, $value) = explode('=', $pair, 2);
        $data[urldecode($key)] = urldecode($value);
    }

    return $data;
}

function validateParams(array $request, array $requiredFields)
{
    $missingFields = [];
    $postData = [];

    foreach ($requiredFields as $field) {
        if (empty($request[$field])) {
            $missingFields[] = $field;
        } else {
            $postData[$field] = $request[$field];
        }
    }

    if (!empty($missingFields)) {
        return ['error' => 'Missing required fields', 'fields' => $missingFields];
    }

    if (!isset($_SESSION['merchant_secret_key'])) {
        return ['error' => 'Missing merchant key', 'fields' => "merchant secret key"];
    }

    $postData['security_key'] = $_SESSION['merchant_security_key'] ;

    return $postData;
}

function xmlToJson($xmlString) {
    $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);
    $json = json_encode($xml);
    $array = json_decode($json, TRUE);
    return json_encode($array, JSON_PRETTY_PRINT);
}

function filterMappedSubscriptions($jsonString) {
    if (!isset($_SESSION['email']) && !isset($_SESSION['subscriptionId'])) {
        return [];
    }

    $data = json_decode($jsonString, true);
    $filtered = [];

    if (!isset($data['subscription']) || !is_array($data['subscription'])) {
        return [];
    }

    foreach ($data['subscription'] as $subscription) {
        $matchEmail = isset($_SESSION['email']) && isset($subscription['email']) && $_SESSION['email'] === $subscription['email'];
        $matchSubId = isset($_SESSION['subscriptionId']) && isset($subscription['subscription_id']) && $_SESSION['subscriptionId'] === $subscription['subscription_id'];

        if ($matchEmail || $matchSubId) {
            $filtered[$subscription['subscription_id']] = [
                'subscription' => [
                    'name' => $subscription['plan']['plan_name'],
                    'profile' => [
                        'paymentProfile' => [
                            'payment' => [
                                'creditCard' => [
                                    'cardNumber' => $subscription['cc_number'] ?? '****']]]],
                    'amount' => $subscription['plan']['plan_amount'] ?? '0.00',
                    'paymentSchedule' => [
                        'interval' => [
                            'unit' => 'months',
                            'length' => (isset($subscription['plan']['day_frequency']) && $subscription['plan']['day_frequency'] == '30') ? 1 : 0
                        ]
                    ],
                    'status' => 'active'
                ]
            ];
        }
    }

    return $filtered;
}

?>