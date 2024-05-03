<?php
include_once 'fns_curl.php';

$VIEW = isset($VIEW) ? $VIEW : 'index';
require_login ();
switch ($VIEW) {

	case 'index':
            // Attach js files to the footer
			$jsfiles = [
				'users'
			];
            $FULL_PAGE = true;

            // Get logged in user
            $USER = $_SESSION[$SESSION_NAME]['user'];
            //print_r($USER);
            $foundUser = rest_call('GET',
            "http://localhost:9091/api/v1/user?username=johndo01" ,
                $data = false, 'application/json',
            "Bearer " . $_SESSION[$SESSION_NAME]['token']);

            if($foundUser) {
                $data = json_decode($foundUser, true);
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