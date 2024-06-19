<?php
include_once('../init.php');
include_once ('fns_answer.php');


if(isset($_POST['urlCommand'])) {
    $UrlCommand = $_POST['urlCommand'];

    switch($UrlCommand){

        case 'getAnswerSessionData':
            $data = [
                'userId' => $_SESSION['user']['id'],
                'questionId' => $_SESSION['currentQuestionId']
            ];

            echo json_encode($data);
            break;

        case 'insertAnswer':
            $response =  $_POST;
            $response['content'] = trim($response['content']);

            $Answer = new Answer();
            $Answer->fromPostData($response);

            //$insertResponse = AnswerService::insertAnswer($Answer);

            echo json_encode($response);
            break;

    }
}

