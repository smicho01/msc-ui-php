<?php
include_once('../init.php');


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
            echo json_encode($response);
            break;

    }
}

