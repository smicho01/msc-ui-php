<?php
include_once('../init.php');
include_once('fns_curl.php');

if(isset($_POST['urlcommand'])) {
    $UrlCommand = $_POST['urlcommand'];
    switch($UrlCommand){
        case 'generateusernames':
            $userNames = rest_call('GET',
                USER_SERVICE_URI . "/generatenames?count=80", $data = false, 'application/json',
                "Bearer " . $_SESSION['token']);
            echo $userNames['body'];
        break;


    }
}