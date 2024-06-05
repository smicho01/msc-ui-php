<?php
include_once('../init.php');
include_once 'fns_module_college.php';

if(isset($_POST['urlcommand'])) {
    $UrlCommand = $_POST['urlcommand'];

    switch($UrlCommand){

        case 'getUserCollegeModules':
            // Get user college modules saved in the session. They can be ret
            $collegeModuless = isset($_SESSION['user']['college_modules']) ? $_SESSION['user']['college_modules'] : [];
            //print_r($collegeModuless);
            echo json_encode($collegeModuless);
        break;

    }
}

