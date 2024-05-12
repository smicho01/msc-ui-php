<?php
include_once('init.php');

// Pickup controller and view name from URL
$CONTROLLER = isset($_GET['c']) ? $_GET['c'] : 'index';
$VIEW = isset($_GET['v']) ? $_GET['v'] : 'index';

// Check services health status
$USER_SERVICE = new Service('User Service', USER_SERVICE_URI);
if($USER_SERVICE->getServiceStatusCode() != 200) {
    $CONTROLLER = 'error';
    $VIEW = 'service';
    $_SESSION['errorMessage'] = 'Service User not Found';
}

// Create Controller file name
$ControllerName = ucfirst($CONTROLLER) . "Controller";

// Include controller file
include_once(CTRL_DIR . DS . $ControllerName . ".php");

// Select different layouts for selected controllers
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
