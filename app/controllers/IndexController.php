<?php
include_once 'fns_curl.php';

$VIEW = isset($VIEW) ? $VIEW : 'index';
require_login ();
switch ($VIEW) {

	case 'index':
		   	$name = "Adam Kowalski";
		   	$patients = $USERS;

			// Attach js files to the footer
			$jsfiles = [
				'patient_fns',
				'patients'
			];
            $FULL_PAGE = true;
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