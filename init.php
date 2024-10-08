<?php
define("ENV", getenv("ACADEMICHAIN_ENV"));
define("USER_SERVICE_URI" , getenv("USER_SERVICE_URI"));
define("ITEM_SERVICE_URI" , getenv("ITEM_SERVICE_URI"));
define("CORE_SERVICE_URI" , getenv("CORE_SERVICE_URI"));
define("NLP_SERVICE_URI" , getenv("NLP_SERVICE_URI"));
define("KEYCLOAK_AUTH_URL" , getenv("KEYCLOAK_AUTH_URL"));
define("REDIS_URL", getenv("REDIS_URL"));
// PHP settings
date_default_timezone_set('Europe/Amsterdam');
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('session.save_handler', 'redis'); // Session handler set to Redis
ini_set('session.save_path', REDIS_URL);

$FLASH = true; // toggle display flash messages

session_start();

$session_id = session_id();

$APPLICATION_NAME = "AcademiChain";

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

const COMPONENTS_DIR = LAYOUT_DIR . DS . "components";
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
set_include_path(get_include_path() . PATH_SEPARATOR . COMPONENTS_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . VIEWS_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . PUBLIC_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . JS_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . FNS_DIR);

/* Include functions files */

include_once('fns_session.php');
include_once('fns_login.php');
include_once('fns_db.php');
include_once('fns_user.php');
include_once('fns_service.php');
include_once('fns_crypto.php');
include_once('fns_flash.php');
include_once('fns_module_college.php');
include_once('fns_nlp.php');
include_once('fns_question.php');
