<?php
include_once('init.php');

$CONTROLLER = isset($_GET['c']) ? $_GET['c'] : 'index';
$VIEW = isset($_GET['v']) ? $_GET['v'] : 'index';

$ControllerName = ucfirst($CONTROLLER) . "Controller";

include_once(CTRL_DIR . DS . $ControllerName . ".php");

switch ($ControllerName) {
    case 'ErrorController':
        include_once(LAYOUT_DIR . DS . "404.php");
        break;
    case 'LoginController':
        include_once(LAYOUT_DIR . DS . "login_layout.php");
        break;
    default:
        include_once(LAYOUT_DIR . DS . "layout.php");
        break;
}

if (ENV == 'dev'):
    //print_r($_SESSION);
endif;