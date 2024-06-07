<?php
$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {

    case 'process':
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        $responseData = $USER_SERVICE->user_login($_POST['username'], $_POST['password']);

        // If user was logged in
        if (isset($responseData['access_token'])) {
            $_SESSION['user'] = array();

            $_SESSION['token'] = $responseData['access_token'];
            $decodedToken = decodeJwtToken($responseData['access_token']);

            $_SESSION['user']['name'] = $decodedToken->given_name . " " . $decodedToken->family_name;
            $_SESSION['user']['username'] = $decodedToken->preferred_username;
            $_SESSION['user']['email'] = $decodedToken->email;
            $_SESSION['user']['roles'] = $decodedToken->realm_access->roles;
            $_SESSION['tokenexpiry'] = $decodedToken->exp;
            $_SESSION['user']['college'] = $decodedToken->college;
            $_SESSION['justLoggedIn'] = 1;
            header("Location: index.php");
        } else {
            header("Location: index.php?c=login&msg=Login failed");
        }
        break;

    default:
		// code...
	break;
}