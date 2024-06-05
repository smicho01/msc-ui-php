<?php
include_once 'fns_curl.php';

function module_get_all() {
    $uri = ITEM_SERVICE_URI . "/module";
    return  get_data_from_api($uri);
}