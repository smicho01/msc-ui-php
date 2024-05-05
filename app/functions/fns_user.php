<?php
include_once 'fns_curl.php';

function user_checkIfExists($sessionUserName) {
    // Find user using User API
    $foundUserResponse = rest_call('GET',
        USER_SERVICE_URI . "/user?username=" . $sessionUserName , $data = false, 'application/json',
        "Bearer " . $_SESSION['token']);

    $statusCode = $foundUserResponse['status_code'];
    $responseBody = $foundUserResponse['body'];
    if(!$responseBody) {
        return false;
    }
    $data = json_decode($responseBody, true);
    if (count($data) == 0) {
        return false;
    }
    return $data[0];
}

function user_insert_from_session() {
    $sessionUser = $_SESSION['user'];
    $explodeUserName = explode(" ", $sessionUser['name']);

    $data = [
        'username' => $sessionUser['username'],
        'firstName' => $explodeUserName[0],
        'lastName' => $explodeUserName[1],
        'email' => $sessionUser['email']
    ];

    $insertUserResponse = curl_post(USER_SERVICE_URI . "/user", $data, "Bearer " . $_SESSION['token']);

    return $insertUserResponse;
}