<?php
include_once('../init.php');
//include_once('fns_curl.php');

if(isset($_POST['urlcommand'])) {

	$UrlCommand = $_POST['urlcommand'];


	switch($UrlCommand){
        case 'setSessionToken':

			$_SESSION['user'] = array();

			$_SESSION['token'] = $_POST['token'];
			$decodedToken = decodeJwtToken($_POST['token']);

			$_SESSION['user']['name'] = $decodedToken->given_name . " " . $decodedToken->family_name;
			$_SESSION['user']['username'] = $decodedToken->preferred_username;
			$_SESSION['user']['email'] = $decodedToken->email;
			$_SESSION['user']['roles'] = $decodedToken->realm_access->roles;

			$_SESSION['tokenexpiry'] = $decodedToken->exp;

            $_SESSION['justLoggedIn'] = 1;

            echo "Session set";
			
		break;

		case 'logout':
			
			if(isset($_SESSION['token'])) {
				unset($_SESSION['token']);
				unset($_SESSION['user']);
			}
			session_unset();
			session_destroy();
		break;
	}
}