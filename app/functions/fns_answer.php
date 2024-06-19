<?php
include_once 'fns_curl.php';

class Answer {

    private $id;
    private $questionId;
    private $userId;
    private $content;

    public function __construct() { }

    public function fromPostData($postData) {
        $this->questionId = $postData['questionId'];
        $this->userId = $postData['userId'];
        $this->content = $postData['content'];
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
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * @param mixed $questionId
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


}


class AnswerService {

    public static function insertAnswer($input) {
        $data = [
            'questionId' => $input->questionId,
            'userId' => $input->userId,
            'content' => $input->answerText
        ];

        return curl_post(ITEM_SERVICE_URI . "/answer", $data, "Bearer " . $_SESSION['token']);
    }

    public static function printAnswer($answer) {
        print_r($answer);
    }
}