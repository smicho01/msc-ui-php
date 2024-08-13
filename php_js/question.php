<?php
include_once('../init.php');
include_once('fns_answer.php');
include_once('fns_nlp.php');

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
            $response['userName'] = $_SESSION['user']['visibleUsername'];

            $Answer = new Answer();
            $Answer->createAnswerFromData($response);

            $insertResponse = AnswerService::insertAnswer($Answer);

            echo json_encode($insertResponse);
            break;

        case 'selectBestAnswer':
            $answerId = $_POST['answerId'];
            $response = AnswerService::setBestAnswer($answerId, true);
            echo json_encode($response);
            break;

        case 'validateQuestionWithNLP':
            $title = $_POST['title'];
            $body = $_POST['body'];
            $response = NlpService::validate_question($title, $body);
            echo json_encode($response);
            break;

        case 'getSimilarQuestions':
            $questionTitle = $_POST['questionTitle'];
            $limit = $_POST['limit'];
            $response = QuestionService::getSimilarQuestionByEmbeddings($questionTitle, $limit);
            echo json_encode($response);
            break;
    }
}

