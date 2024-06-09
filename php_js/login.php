<?php
include_once('../init.php');

if(isset($_POST['urlcommand'])) {

	$UrlCommand = $_POST['urlcommand'];

    switch($UrlCommand){

		case 'logout':
            if(isset($_SESSION['token'])) {
                unset($_SESSION['token']);
            }
            if(isset($_SESSION['user']['user_data_rewritten'])) {
                unset($_SESSION['user']['user_data_rewritten']);
            }
			if(isset($_SESSION['user'])) {
				unset($_SESSION['user']);
			}

			session_unset();
			session_destroy();
            // Clear the session cookie as well
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
		break;
	}
}