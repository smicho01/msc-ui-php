<?php

$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {
    case 'index':

        break;

    case 'add':
        require_login ();
        break;

    case 'show':
        $question = [];
        break;

    default:
        // code...
        break;
}