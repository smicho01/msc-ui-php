<?php
include_once "fns_error.php";

$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {
    case 'service':
        $message = error_service("Service Error", $_SESSION['errorMessage']);
        break;

    case 'reference':
        $message = error_service("Reference Error", $_SESSION['errorMessage']);
        break;

    case '404':

        break;

    default:
        $message = error_service("Service Error",  "Please try again later.");
        break;
}