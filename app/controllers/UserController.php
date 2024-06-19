<?php
include_once 'fns_curl.php';
include_once 'fns_flash.php';
include_once 'fns_utils.php';

$VIEW = isset($VIEW) ? $VIEW : 'index';
require_login ();
switch ($VIEW) {
    case 'updatedata':
        // Attach js files to the footer
        //$jsfiles = ['users'];
        $foundUserResponse = rest_call('GET',
            USER_SERVICE_URI . "/generatenames?count=80", $data = false, 'application/json',
            "Bearer " . $_SESSION['token']);
        $generatedUserNames = json_decode($foundUserResponse['body'], true);
    break;

    case 'walletkeys':
        $jsfiles = ['keys'];
    break;

    case 'questions':
        $userQuestions = UserService::user_get_questions_short($_SESSION['user']['id']);

        break;

    default:
        // code...
        break;
}