<?php
include_once "fns_error.php";

$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {
    case 'service':
        $message = error_service($_SESSION['errorMessage'] . ' <br />Please try again later.');
        break;

    default:
        $message = error_service('Service Error. Please try again later.');
        break;
}