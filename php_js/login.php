<?php
include_once('../init.php');
//include_once('fns_curl.php');

if(isset($_POST['urlcommand'])) {

	$UrlCommand = $_POST['urlcommand'];

	switch($UrlCommand){
        case 'setSessionToken':
			$_SESSION['academichain'] = array();
			$_SESSION['academichain']['user'] = array();

			$_SESSION['academichain']['token'] = $_POST['token'];
			$decodedToken = decodeJwtToken($_POST['token']);

			$_SESSION['academichain']['user']['name'] = $decodedToken->given_name . " " . $decodedToken->family_name;
			$_SESSION['academichain']['user']['username'] = $decodedToken->preferred_username;
			$_SESSION['academichain']['user']['email'] = $decodedToken->email;
			$_SESSION['academichain']['user']['roles'] = $decodedToken->realm_access->roles;

			$_SESSION['academichain']['tokenexpiry'] = $decodedToken->exp;

            $_SESSION['academichain']['justLoggedIn'] = 1;

            echo "Session set";
			
		break;

		case 'logout':
			
			if(isset($_SESSION['academichain']['token'])) {
				unset($_SESSION['academichain']);
				unset($_SESSION['academichain']['token']);
				unset($_SESSION['academichain']['user']);
			}
			session_unset();
			session_destroy();
		break;
	}
}