<?php
include_once('init.php');

/* Intercept controller and view name from the URL */
$CONTROLLER = isset($_GET['c']) ? $_GET['c'] : 'index';
$VIEW = isset($_GET['v']) ? $_GET['v'] : 'index';

/* Check API services health status */
include_once "check_services_health.php";

/* Create Controller file name */
$ControllerName = ucfirst($CONTROLLER) . "Controller";

/* Create global objects */
$MAIN_USER = new User();
$USER_SERVICE = new UserService();

if(isUserLoggedIn() && isset($_SESSION['user']['visibleUsername'])) {
    // Get user from DB by username
    $foundLoggedInUser = $USER_SERVICE->getUser('username', $_SESSION['user']['username']);

    // If user db data hasn't been written to SESSION for fast access, then read user data from DB
    if (!isset($_SESSION['user']['user_data_rewritten']) || $_SESSION['user']['user_data_rewritten'] != true) {
        // Get user from Database and set its properties
        $MAIN_USER->createUserDatabaseData($foundLoggedInUser);
    }
    // Re-write User data to session data to improve speed and avoid calls to API
    $USER_SERVICE->user_data_to_session($MAIN_USER);
}

/* Include controller file */
include_once(CTRL_DIR . DS . $ControllerName . ".php");

/* Select different layouts for selected controllers */
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
