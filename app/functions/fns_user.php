<?php
include_once 'fns_curl.php';

class User {
    private $id;
    private $name;
    private $username;
    private $visibleUsername;
    private $email;
    private $tokens;
    private $college;
    private $collegeId;
    private $questions = [];
    private $answers = [];

    public function __construct()
    {

    }

    public function createUserFromSession() {
        $this->id = $_SESSION['user']['id'];
        $this->username = $_SESSION['user']['username'];
        $this->name = $_SESSION['user']['name'];
        $this->email = $_SESSION['user']['email'];
        $this->visibleUsername = $_SESSION['user']['visibleUsername'];
        $this->college = $_SESSION['user']['college'];
    }

    public function createUserDatabaseData($data) {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->name = $data['firstName'] . " " . $data['lastName'];
        $this->email = $data['email'];
        $this->visibleUsername = $data['visibleUsername'];
        $this->tokens = $data['tokens'];
        $this->college = $data['college'];
        $this->collegeId = $data['collegeid'];
        $this->questions = user_get_questions($data['id']);
        $this->answers = user_get_answers($data['id']);
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

    public function setQuestions($questions) {
        $this->questions = $questions;
    }

    public function getQuestions() {
        return $this->questions;
    }

    public function getQuestionsCount() {
        return count($this->questions);
    }

    public function setAnswers($answers) {
        $this->answers = $answers;
    }

    public function getAnswers() {
        return $this->answers;
    }
    public function getAnswersCount() {
        return count($this->answers);
    }

    /**
     * @return mixed
     */
    public function getCollege()
    {
        return $this->college;
    }

    /**
     * @param mixed $college
     */
    public function setCollege($college)
    {
        $this->college = $college;
    }

    /**
     * @return mixed
     */
    public function getCollegeId()
    {
        return $this->collegeId;
    }

    /**
     * @param mixed $collegeId
     */
    public function setCollegeId($collegeId)
    {
        $this->collegeId = $collegeId;
    }



}

function user_get($field , $value) {
    $uri = USER_SERVICE_URI . "/user?field=".$field ."&value=" . $value;
    return get_data_from_api($uri);
}

function user_insert_from_session() {
    $sessionUser = $_SESSION['user'];
    $explodeUserName = explode(" ", $sessionUser['name']);
    $data = [
        'username' => $sessionUser['username'],
        'firstName' => $explodeUserName[0],
        'lastName' => $explodeUserName[1],
        'email' => $sessionUser['email'],
        'college' => isset($sessionUser['college']) ? $sessionUser['college'] : 'No college yet',
    ];
    $insertUserResponse = curl_post(USER_SERVICE_URI . "/user", $data, "Bearer " . $_SESSION['token']);
    return $insertUserResponse;
}

function user_login($username, $password) {
    $url = 'http://sever3d.synology.me:7080/auth/realms/academichain/protocol/openid-connect/token';
    $data = [
        'grant_type' => 'password',
        'client_id' => 'academichain_ui',
        'username' => $username,
        'password' => $password
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Only use this in a trusted network
    $response = curl_exec($ch);

    if (!$response) {
        die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
    }
    curl_close($ch);
    return json_decode($response, true);
}

/*
 * Get data form API endpoint give in $uri param
 */
function get_data_from_api($uri) {
    $foundUserResponse = rest_call('GET', $uri, $data = false, 'application/json',
        "Bearer " . $_SESSION['token']);
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

function user_get_questions($userId) {
    $uri = ITEM_SERVICE_URI . "/question/user/" . $userId;
    return get_data_from_api($uri);
}

function user_get_answers($userId) {
    $uri = ITEM_SERVICE_URI . "/answer/user/" . $userId;
    return get_data_from_api($uri);
}

function user_get_keys($userId) {
    $uri = USER_SERVICE_URI . "/user/getkeys/" . $userId;
    return  get_data_from_api($uri);
}


/*
Re-write user data to Session so index.php does not need to make api calls with each page reload
$_SESSION['user_data_rewritten'] set to true will indicate that rewrite has been done and all required user data is in the session
*/
function user_data_to_session($user){
    $_SESSION['user']['user_data_rewritten'] = true; // Set to true if user data has been rewritten to Session. So no API call is required next time
}