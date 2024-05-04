<?php
include_once 'fns_curl.php';

$VIEW = isset($VIEW) ? $VIEW : 'index';
require_login ();
switch ($VIEW) {

	case 'index':
            // Attach js files to the footer
			$jsfiles = ['users'];
            // Use full page layout
            $FULL_PAGE = true;
            // Get logged in user
            $USER = $_SESSION['user'];

            // Log user login by presence of session variable 'justLoggedIn'
            if(isset($_SESSION['justLoggedIn'])) {
                insertDbLogData('INFO', 'IndexController::index', 'user login', 'new user login');
                unset($_SESSION['justLoggedIn']); // unset variable so new log are not created
            }

            // Use curl to get data from API
            $sessionUserName = $_SESSION['user']['username'];

            // Find user using User API
            $foundUserResponse = rest_call('GET',
                USER_SERVICE_URI . "/user?username=" . $sessionUserName , $data = false, 'application/json',
            "Bearer " . $_SESSION['token']);

            $statusCode = $foundUserResponse['status_code'];
            $responseBody = $foundUserResponse['body'];


            if($responseBody) {
                $data = json_decode($responseBody, true);

                // User found in keycloak but not in portal db. User must update his details
                // like visible username etc.
                if (count($data) == 0) {
                    $_SESSION['user']['needProfile'] = true; // Indicate that user must create his profile first
                    header("Location: index.php?c=user&v=updatedata");
                }
                // if more than 1 user is returned then it is an error
                if(count($data) > 1) {
                    insertDbLogData('ERROR', 'IndexController::index', 'multiple users', count($data) . ' users found');
                    header("Location: index.php?v=logout");
                }
                $_SESSION['user']['visibleUsername'] = $data[0]['visibleUsername'];
            }
	break;

	case 'logout':
		session_unset();
		session_destroy();
		header("Location: index.php");
	break;
	
	default:
		// code...
	break;
}