<?php
include_once('../init.php');
//include_once('fns_curl.php');

if(isset($_POST['urlcommand'])) {

	$UrlCommand = $_POST['urlcommand'];

	switch($UrlCommand){
		case 'getallitems':

			// $token = "Bearer eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiNjIyM2IyNTQ1MTQwOWNiZWNkN2QwMjQyIiwidXNlcl9yb2xlcyI6WyJ1c2VyIl0sInVzZXJfdXNlcm5hbWUiOiJNYXJ5IiwiaWF0IjoxNjQ2NTg2MTQzLCJleHAiOjE2NDc0NTAxNDN9.rlOVUzzPGHV9ZHp_NBlXjghEHMctEJg9XmOqwt62ZlcClrGGaWM0_oR9jaO4HmsTseXcpIlBo9_KpmNJ73Cjfg";

			// $url = 'http://localhost:3000/api/items';
			// $jsonResponse = rest_call("GET",$url, false, 'application/json', $token);
			// $items = json_decode($jsonResponse);

			// echo json_encode(['items'=> $items]);
		break;

		case 'setSessionToken':
            // GET USER DATA FROM THE DATABASE
            // MAP USER EMAIL TO USERNAME SET BY THE USER
            // SO THAT REAL DETAILS OF THE USER WON'T BE SEEN BY OTHER PORTAL USERS
			$_SESSION['academichain'] = array();
			$_SESSION['academichain']['user'] = array();

			$_SESSION['academichain']['token'] = $_POST['token'];
			$decodedToken = decodeJwtToken($_POST['token']);

			$_SESSION['academichain']['user']['name'] = $decodedToken->given_name . " " . $decodedToken->family_name;
			$_SESSION['academichain']['user']['username'] = $decodedToken->preferred_username;
			$_SESSION['academichain']['user']['email'] = $decodedToken->email;
			$_SESSION['academichain']['user']['roles'] = $decodedToken->realm_access->roles;

			$_SESSION['academichain']['tokenexpiry'] = $decodedToken->exp;

			//echo $_SESSION['academichain']['token'];
			//print_r($_SESSION);

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