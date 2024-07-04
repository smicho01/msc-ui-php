<?php
include_once 'fns_curl.php';

class Question
{

    private $id;
    private $title;
    private $content;
    private $userId;
    private $collegeId;
    private $moduleId;
    private $tags = [];

    // Properties that allowed to be accessed [sort of 'private']
    private static $allowedProperties = ['id', 'title', 'content', 'userId', 'collegeId', 'moduleId', 'tags'];

    /* Properties that will be serialized to json */
    private static $serializableProperties = ['id', 'title', 'content', 'userId', 'collegeId', 'moduleId', 'tags'];


    public function __construct() { }

    public function __get($property) {
        // Allow to set just existing properties via Magic Methods
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $this->sanitizeInput($value, $property);
        }
    }

    /* Set $_POST data as Questions properties */
    public function fromPostData($postData) {
        $this->title = $postData['form_question_title'];
        $this->content = $postData['form_question_problem'];
        $this->moduleId = $postData['sel_mod'];
        $this->tags = $postData['tags'];
        $this->userId = $_SESSION['user']['id'];
        $this->collegeId = $_SESSION['user']['collegeId'];
    }

    /* Create hash of class field. Will be used to compare if same question has been asked already */
    public function getHash() {
        $allowed = [];
        foreach (self::$allowedProperties as $property) {
            if (property_exists($this, $property)) {
                $allowed[$property] = $this->$property;
            }
        }
        return hash('sha256', json_encode($allowed));
    }

    /* Sanitize data to avoid malicious inputs */
    private function sanitizeInput($data, $property) {
        $type = 'string';
        if ($property == 'tags') {
            // Assuming tags are an array of strings
            if (is_array($data)) {
                return array_map([$this, 'sanitizeInput'], $data);
            }
            return [];
        }
        return sanitizeInput($data, $type);
    }


    public function toArray()
    {
        $serializable = [];
        foreach (self::$serializableProperties as $property) {
            if (property_exists($this, $property)) {
                $serializable[$property] = $this->$property;
            }
        }
        return $serializable;
    }

    public function toJson() {
        return json_encode($this->toArray());
    }

}


class QuestionService {

    public function insertQuestion($question) {
        $data = [
            'title' => $question->title,
            'content' => $question->content,
            'userId' => $question->userId,
            'userName' => $_SESSION['user']['visibleUsername'],
            'collegeId' => $question->collegeId,
            'moduleId' => $question->moduleId,
            'tags' => $question->tags
        ];

        return curl_post(ITEM_SERVICE_URI . "/question", $data, "Bearer " . $_SESSION['token']);
    }

    public static function getLatestQuestions($status, $limit = 20) {
        $url = ITEM_SERVICE_URI . "/question/short?status={$status}&limit={$limit}";
        $result = apiGetRequest($url, true); // get without token; allowed for all
        if($result){
            if($result['status'] == 200) {
                return $result['data'];
            }
        }
        return null;
    }

    public static function getQuestionById($questionId) {
        $url = ITEM_SERVICE_URI . '/question/'. $questionId;
        $result = apiGetRequest($url, true); // get without token; allowed for all
        if($result){
            if($result['status'] == 200) {
                return $result['data'];
            }
        }
        return null;
    }

    public function isUserQuestion($userId, $question) {
        return $question['userId'] == $userId;
    }

    public static function isQuestionAuthorLoggedInUser($question) {
        return $question['userId'] == $_SESSION['user']['id'];
    }
}

