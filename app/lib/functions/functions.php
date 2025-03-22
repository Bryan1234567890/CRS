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

    $postData['security_key'] = NMI_SECURITY_KEY;

    return $postData;
}

?>