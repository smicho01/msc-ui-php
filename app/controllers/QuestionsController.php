<?php

$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {
    case 'index':

        break;

    case 'add':
        require_login ();
        $jsfiles = ['question']; // will add corresponding *.js files from `/public/js` dir
        break;

    case 'process':
        require_login ();
        // check from where the request came , it should be 'index.php?c=questions&v=add' ; if not then it may be fraudulent behaviour
        $haystack = $_SERVER['HTTP_REFERER'];
        $needle = "index.php?c=questions&v=add";
        if (strpos($haystack, $needle) == false) {
            //echo "The string '$needle' was not found in the string '$haystack'.";
            header("Location: index.php?c=questions&v=add"); // bad request ; skip processing
        }

        // TODO: process add question

        $jsfiles = ['question']; // will add corresponding *.js files from `/public/js` dir
        break;

    case 'show':
        $question = [];
        break;

    default:
        // code...
        break;
}