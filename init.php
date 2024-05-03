<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://localhost:6379');
session_start();

date_default_timezone_set('Europe/Amsterdam');

$FULL_PAGE = false;

/* Error reporting (update for prod env) */
//const MODE = 'dev';
const MODE = 'prod';
if(MODE == 'dev'){
	// TODO: move error settings for dev mode
}



$reqScheme = "http://";
if($_SERVER['REQUEST_SCHEME'] == 'https') {
    $reqScheme = "https://";
}
if($_SERVER['SERVER_NAME'] == 'msc-proj'){
	define('BASE_URL', $reqScheme . $_SERVER['SERVER_NAME'] .":80");
} else {
	define('BASE_URL', $reqScheme . $_SERVER['SERVER_NAME']);
}

const DS = DIRECTORY_SEPARATOR;

/* Define basic directories */

define("BASEDIR", dirname(__FILE__));
const APP_DIR = BASEDIR . DS . "app";
const CTRL_DIR = APP_DIR . DS . "controllers";

const LAYOUT_DIR = BASEDIR . DS . "layout";
const VIEWS_DIR = BASEDIR . DS . "views";

const PUBLIC_DIR = BASEDIR . DS . "public";
const IMAGES_DIR = BASE_URL . "/public/img";
const JS_DIR = BASE_URL . "/public/js";
const CSS_DIR = BASE_URL . "/public/css";

const FNS_DIR = APP_DIR . "/functions";



/* Set include paths */

set_include_path(get_include_path() . PATH_SEPARATOR . BASEDIR);
set_include_path(get_include_path() . PATH_SEPARATOR . APP_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . CTRL_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . LAYOUT_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . VIEWS_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . PUBLIC_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . JS_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . FNS_DIR);


/* Settings */

const USER_SERVICE = "http://localhost:9091/api/v1";
const ITEM_SERVICE  = "http://localhost:9092/api/v1";


/* Include basic files */

include_once('fns_session.php');
include_once('fns_login.php');
include_once('fns_db.php');


//print_r($_SESSION);