<?php
include_once('../init.php');
include_once 'fns_message.php';

if(isset($_POST['urlcommand'])) {

    switch($_POST['urlcommand']){
        case 'sendMessage':

            $toId = $_POST['toId'];
            $fromId = $_POST['fromId'];
            $message = $_POST['message'];

            $response = MessageService::message_send($fromId, $toId, $message);

            echo json_encode($response);
            break;
    }
}