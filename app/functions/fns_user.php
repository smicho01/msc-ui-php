<?php
include_once 'fns_curl.php';

class User {
    private $id;
    private $name;
    private $username;
    private $visibleUsername;
    private $email;
    private $tokens;

    public function __construct()
    {

    }

    public function createUserFromSession() {
        $this->id = $_SESSION['user']['id'];
        $this->username = $_SESSION['user']['username'];
        $this->name = $_SESSION['user']['name'];
        $this->email = $_SESSION['user']['email'];
        $this->visibleUsername = $_SESSION['user']['visibleUsername'];
    }

    public function createUserDatabaseData($data) {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->name = $data['firstName'] . " " . $data['lastName'];
        $this->email = $data['email'];
        $this->visibleUsername = $data['visibleUsername'];
        $this->tokens = $data['tokens'];
    }


    public function setTokens($tokens) {
        $this->tokens = $tokens;
    }
    public function getTokens() {
        return $this->tokens;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getVisibleUsername()
    {
        return $this->visibleUsername;
    }

    /**
     * @param mixed $visibleUsername
     */
    public function setVisibleUsername($visibleUsername)
    {
        $this->visibleUsername = $visibleUsername;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}

function user_get($field , $value) {
    // Find user using User API
    $foundUserResponse = rest_call('GET',
        USER_SERVICE_URI . "/user?field=".$field ."&value=" . $value , $data = false, 'application/json',
        "Bearer " . $_SESSION['token']);
    //$statusCode = $foundUserResponse['status_code'];
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

function user_get_keys($userId) {
    // Find user using User API
    $foundUserResponse = rest_call('GET',
        USER_SERVICE_URI . "/user/getkeys/" . $userId , $data = false, 'application/json',
        "Bearer " . $_SESSION['token']);
    //$statusCode = $foundUserResponse['status_code'];
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