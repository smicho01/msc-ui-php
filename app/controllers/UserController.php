<?php
include_once 'fns_curl.php';

$VIEW = isset($VIEW) ? $VIEW : 'index';
require_login ();
switch ($VIEW) {

    case 'index':

        break;


    default:
        // code...
        break;
}