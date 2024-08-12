<?php


const ADMIN_DIR = BASEDIR . DS . "admin";
const ADMIN_APP_DIR = ADMIN_DIR . DS . "app";
const ADMIN_PUBLIC_DIR = ADMIN_DIR . DS . "public";
const ADMIN_VIEWS_DIR = ADMIN_DIR . DS . "views";
const ADMIN_FNS_DIR = ADMIN_APP_DIR . DS . "functions";

/* Set include paths */
set_include_path(get_include_path() . PATH_SEPARATOR . ADMIN_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . ADMIN_APP_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . ADMIN_PUBLIC_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . ADMIN_VIEWS_DIR);
set_include_path(get_include_path() . PATH_SEPARATOR . ADMIN_FNS_DIR);


include_once('utils_fns.php');