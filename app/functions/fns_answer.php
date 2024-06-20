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
            'questionId' => $input->getQuestionId(),
            'userId' => $input->getUserId(),
            'content' => $input->getContent()
        ];

        return curl_post(ITEM_SERVICE_URI . "/answer", $data, "Bearer " . $_SESSION['token']);
    }


    /**
     * Retrieves all answers for a given question ID.
     * NOTE: Answers with all types of 'status' will be returned !
     * This can be used for admin page or user which is owner of the answer !
     *
     * @param int $questionId The ID of the question to get answers for.
     * @return array An array of answer objects for the given question ID.
     */
    public static function getAllAnswersForQuestionId($questionId) {
        $url = ITEM_SERVICE_URI . "/answer/" . $questionId;
        return get_data_from_api($url);
    }

    public static function getAllAnswersForQuestionIdWithStatus($questionId, $status) {
        $url = ITEM_SERVICE_URI . "/answer/" . $questionId . '/status/' . $status;
        return apiGetRequest($url, true);
    }

    public static function getAllActiveAnswersOrAllStatusesForUserId($questionId, $userId) {
        $url = ITEM_SERVICE_URI . "/answer/" . $questionId . '/user/' . $userId;
        return $response = apiGetRequest($url, false);
    }
}