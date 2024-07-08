<?php
include_once 'fns_curl.php';

class Answer {

    private $id;
    private $content;
    private $userId;
    private $questionId;

    private $userName;
    private $status;
    private $best = false;
    private $dateCreated;
    private $dateModified;


    public function __construct() { }

    public function createAnswerFromData($data) {
        $this->questionId = $data['questionId'];
        $this->userId = $data['userId'];
        $this->userName = $data['userName'];
        $this->content = $data['content'];
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

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return mixed
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * @param mixed $dateModified
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isBest()
    {
        return $this->best;
    }

    /**
     * @param bool $best
     */
    public function setBest($best)
    {
        $this->best = $best;
    }




}


class AnswerService {

    public static function insertAnswer($input) {
        $data = [
            'questionId' => $input->getQuestionId(),
            'userId' => $input->getUserId(),
            'userName' => $input->getUserName(),
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
        $url = ITEM_SERVICE_URI . "/answer/question/" . $questionId;
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

    public static function isAnswerLoggedInUserAnswer($answer) {
        return $answer['userId'] == $_SESSION['user']['id'];
    }

    public static function setBestAnswer($answerId, $value) {
        $url = ITEM_SERVICE_URI . "/answer/best/" . $answerId . "?best=" . $value;
        $response = curl_put($url, $data = [], "Bearer " . $_SESSION['token']);
        return $response;
    }
}