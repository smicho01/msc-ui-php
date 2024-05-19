<?php
include_once('init.php');

// Pickup controller and view name from URL
$CONTROLLER = isset($_GET['c']) ? $_GET['c'] : 'index';
$VIEW = isset($_GET['v']) ? $_GET['v'] : 'index';

// Check API services health status
include_once "check_services_health.php";

// Create Controller file name
$ControllerName = ucfirst($CONTROLLER) . "Controller";

if(isUserLoggedIn() && isset($_SESSION['user']['visibleUsername'])) {
    $sessionUserName = $_SESSION['user']['username'];
    $foundLoggedInUser = user_get('username', $sessionUserName);
    //print_r($foundLoggedInUser);

//    /* SET USER DATA */
//    // Key used to decrypt data received from the REST API [services]
//    $ENCRYPTION_KEY_BASE64 = getenv("ENCRYPTION_KEY");
//
//    $encryptedUserPublicKeyAsBase64String = $foundLoggedInUser['pubKey'];
//    $decryptedPubKey =  CryptoUtil::decrypt($encryptedUserPublicKeyAsBase64String, $ENCRYPTION_KEY_BASE64);

    $MAIN_USER = new User();
    $MAIN_USER->createUserDatabaseData($foundLoggedInUser);
}

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
