<?php
include_once 'fns_curl.php';

class User {
    private $properties = [];
    private $USER_SERVICE;

    public function __construct(){
        // TODO: remove counpling with UserService. Inject via constr. or method
        $this->USER_SERVICE = new UserService();
    }

    /* Using Magic Methods to limit number of setters and getters [lines of code] */
    public function __get($property) {
        if (array_key_exists($property, $this->properties)) {
            return $this->properties[$property];
        }
    }

    public function __set($property, $value) {
        $this->properties[$property] = $value;
    }

    /* Set User field from according PHP SESSION fields */
    public function createUserFromSession() {
        // Assume $_SESSION['user'] is an associative array with keys matching your property names
        foreach ($_SESSION['user'] as $property => $value) {
            $this->$property = $value;
            //$this->properties[$property] = $value;
        }
    }

    /* Set User fields from data retrieved from the DB */
    public function createUserDatabaseData($data) {
        // Assume $data is an associative array with keys matching your property names
        foreach ($data as $property => $value) {
            if (array_key_exists($property, $this->properties)) {
                $this->$property = $value;
                //$this->properties[$property] = $value;
            }
        }

        // Special Cases
        $this->name = $data['firstName'] . " " . $data['lastName'];
        $this->questions = $this->USER_SERVICE->user_get_questions_short($data['id']);
        $this->answers = $this->USER_SERVICE->user_get_answers($data['id']);
    }

    // is identical to getQuestionsCount()
    public function getAnswersCount() {
        return count($this->answers);
    }

    // is identical to getAnswersCount()
    public function getQuestionsCount() {
        return count($this->questions);
    }
}

class UserService {

    static function getUser($field , $value) {
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
        return curl_post(USER_SERVICE_URI . "/user", $data, "Bearer " . $_SESSION['token']);
    }

    function user_login($username, $password) {
        $url = KEYCLOAK_AUTH_URL;
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

    static function user_get_questions($userId) {
        $uri = ITEM_SERVICE_URI . "/question/user/" . $userId;
        return get_data_from_api($uri);
    }

    static function user_get_questions_short($userId) {
        $uri = ITEM_SERVICE_URI . "/question/user/" . $userId . "/short";
        return get_data_from_api($uri);
    }

    static function user_get_answers($userId) {
        $uri = ITEM_SERVICE_URI . "/answer/user/" . $userId . "/short";
        $resposne =  get_data_from_api($uri);
        return $resposne;
    }

    static function user_get_keys($userId) {
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

    static function get_user_transactions($userId) {
        $encryptionKey =  getenv("ENCRYPTION_KEY");
        $userKeys = self::user_get_keys($userId);
        $userPublicEncryptedKey = $userKeys['publicKeyEncrypted'];
        $userDecryptedPublicKey = CryptoUtil::decrypt($userPublicEncryptedKey, $encryptionKey);

        $uri = CORE_SERVICE_URI . "/transaction/wallet/" . $userDecryptedPublicKey;
        $response =  get_data_from_api($uri);
        if($response)
        for ($i=0; $i<count($response); $i++) {
            $type = '';
            if($response[$i]['walletFrom'] == $userDecryptedPublicKey) {
                $type = 'out';
            } else if ($response[$i]['walletTo'] == $userDecryptedPublicKey) {
                $type = 'in';
            }
            $response[$i]['inout'] = $type;
        }

        return $response;
    }

    static function user_get_all_friends($userId) {
        $uri = USER_SERVICE_URI . "/friends/" . $userId;
        return  get_data_from_api($uri);
    }

    static function user_send_friend_request($requestingUserId, $requestedUserId) {
        $url = USER_SERVICE_URI . "/friends/request";
        $data = [
            'requestingUserId' => $requestingUserId,
            'requestedUserId' => $requestedUserId
        ];
        return curl_post($url, $data, "Bearer " . $_SESSION['token']);
    }

    /* Friend requests user get */
    static function user_get_friend_request_received($userId) {
        $uri = USER_SERVICE_URI . "/friends/requests/received/" . $userId;
        return get_data_from_api($uri);
    }

    /* Friend requests user sent */
    static function user_get_friend_request_sent($userId) {
        $uri = USER_SERVICE_URI . "/friends/requests/sent/" . $userId;
        return get_data_from_api($uri);
    }

    public static function user_accept_friend_request($requestingUserId, $requestedUserId) {
        $data = [
            'requestingUserId' => $requestingUserId,
            'requestedUserId' => $requestedUserId
        ];
        $uri = USER_SERVICE_URI . "/friends/request/accept";
        return curl_put($uri, $data, "Bearer " . $_SESSION['token']);
    }

}

