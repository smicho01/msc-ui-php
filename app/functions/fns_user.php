<?php
include_once 'fns_curl.php';

class User {
    public $id;
    public $name;
    public $username;
    public $visibleUsername;
    public $email;

    public function __construct()
    {
        $this->id = $_SESSION['user']['id'];
        $this->username = $_SESSION['user']['username'];
        $this->name = $_SESSION['user']['name'];
        $this->email = $_SESSION['user']['email'];
        $this->visibleUsername = $_SESSION['user']['visibleUsername'];
    }
}

function user_get($field , $value) {
    // Find user using User API
    $foundUserResponse = rest_call('GET',
        USER_SERVICE_URI . "/user?field=".$field ."&value=" . $value , $data = false, 'application/json',
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
    return $data;
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