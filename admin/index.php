<?php
include_once('../init.php');
include_once('admin_init.php');

/* Hardcoded ctrl as this req. only one controller */
$CONTROLLER = 'admin';
/* View should passed as `?v=<directory>-<view_file>` e.g. `?v=users-list` will incl. file /views/users/list.php */
$VIEW = isset($_GET['v']) ? $_GET['v'] : 'index';

/* Include controller file */
include_once("AdminController.php");
include_once(ADMIN_PUBLIC_DIR . DS . "layout" . DS . "admin_layout.php");