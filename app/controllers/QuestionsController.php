<?php

$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {
    case 'index':

        break;

    case 'add':
        require_login ();
        $jsfilesExternal = [
            'https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js',
            'https://unpkg.com/compromise@13.11.0/builds/compromise.min.js'
        ];
        $jsfiles = ['question']; // will add corresponding *.js files from `/public/js` dir
        break;

    case 'process':
        require_login ();
        // check from where the request came , it should be 'index.php?c=questions&v=add' ; if not then it may be fraudulent behaviour
        $haystack = $_SERVER['HTTP_REFERER'];
        $needle = "index.php?c=questions&v=add"; // request should come from that address only !
        if (strpos($haystack, $needle) == false) {
            //echo "The string '$needle' was not found in the string '$haystack'.";
            insertDbLogData('ERROR', $CONTROLLER."::".$VIEW, 'incorrect referrer', 'incorrect referrer: ' . $haystack);
            $_SESSION['errorMessage'] = "Incorrect reference";
            header("Location: index.php?c=error"); // bad request ; skip processing
        }

        // TODO: process add question
        print_r($_POST);
        break;

    case 'show':
        $question = [];
        break;

    default:
        // code...
        break;
}