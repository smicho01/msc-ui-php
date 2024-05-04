<?php
include_once "fns_error.php";

$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {

    case 'service':
        $message = error_service();
        break;

    default:
        $message = error_service();
        break;
}