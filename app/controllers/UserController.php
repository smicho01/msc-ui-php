<?php
include_once 'fns_curl.php';

$VIEW = isset($VIEW) ? $VIEW : 'index';
require_login ();
switch ($VIEW) {

    case 'index':

        break;

    case 'updatedata':
        // Attach js files to the footer
        //$jsfiles = ['users'];
        $foundUserResponse = rest_call('GET',
            USER_SERVICE_URI . "/generatenames?count=80", $data = false, 'application/json',
            "Bearer " . $_SESSION['token']);
        $generatedUserNames = json_decode($foundUserResponse['body'], true);
        break;

    case 'account':
        // Attach js files to the footer
        //$jsfiles = ['users'];
        $foundUserResponse = rest_call('GET',
            USER_SERVICE_URI . "/generatenames?count=80", $data = false, 'application/json',
            "Bearer " . $_SESSION['token']);
        $generatedUserNames = json_decode($foundUserResponse['body'], true);
        break;

    default:
        // code...
        break;
}