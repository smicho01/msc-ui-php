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

QuestionService::loadLatestQuestionsEveryGivenMinutes(3, 6);

if(isUserLoggedIn() && isset($_SESSION['user']['visibleUsername'])) {
    // If user db data hasn't been written to SESSION for fast access, then read user data from DB
    if (!isset($_SESSION['user']['user_data_rewritten']) || $_SESSION['user']['user_data_rewritten'] != true) {
        $foundLoggedInUser = $USER_SERVICE->getUser('username', $_SESSION['user']['username'], "updateTokens"); // Update tokens according to blockchain state
        // Get user from Database and set its properties
        $MAIN_USER->createUserDatabaseData($foundLoggedInUser);
        // Get all user friends
        $allMainUserFriends = UserService::user_get_all_friends($_SESSION['user']['id']);
        $_SESSION['user']['friends'] = $allMainUserFriends;
        $_SESSION['user']['college_modules'] = modules_get_by_college_id($foundLoggedInUser['collegeid']);

        $_SESSION['user']['questions-size'] = 0;
        $_SESSION['user']['questions'] = [];
        $userQuestions = $USER_SERVICE->user_get_questions_short($_SESSION['user']['id']);
        if(!is_null($userQuestions) && !empty($userQuestions) ) {
            $_SESSION['user']['questions-size'] = count($userQuestions);
            $_SESSION['user']['questions'] = $userQuestions;
        }

        $_SESSION['user']['answers-size'] = 0;
        $userAnswers = $USER_SERVICE->user_get_answers($_SESSION['user']['id']);
        if($userAnswers) {
            $_SESSION['user']['answers-size'] = count($userAnswers);
            $_SESSION['user']['answers'] = $userAnswers;
        }
    }
    // Re-write User data to session data to improve speed and avoid calls to API
    $USER_SERVICE->user_data_to_session($MAIN_USER);
    $MAIN_USER->createUserFromSession();
}

/* Include controller file */
include_once(CTRL_DIR . DS . $ControllerName . ".php");

/* Select different layouts for selected controllers */
switch ($ControllerName) {
    case 'ErrorController':
        //include_once(LAYOUT_DIR . DS . "404.php");
        include_once(LAYOUT_DIR . DS . "layout.php");
        break;
    case 'LoginController':
        include_once(LAYOUT_DIR . DS . "login_layout.php");
        break;
    default:
        include_once(LAYOUT_DIR . DS . "layout.php");
        break;
}
