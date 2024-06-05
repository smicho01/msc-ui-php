<?php
include_once 'fns_curl.php';

function module_get_all() {
    $uri = ITEM_SERVICE_URI . "/module";
    return  get_data_from_api($uri);
}

function modules_get_by_college_id($collegeId) {
    $uri = ITEM_SERVICE_URI . "/module/college/" . $collegeId;
    return  get_data_from_api($uri);
}