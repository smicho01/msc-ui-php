<?php
include_once('fns_curl.php');

$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {

	case 'clientcode':
		echo 'logowanie';
        break;
	
	default:
		// code...
	break;
}