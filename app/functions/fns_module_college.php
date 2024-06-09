<?php
include_once 'fns_curl.php';

/**
 * Retrieves all modules from the API.
 *
 * @return false|mixed A boolean value of false on failure, otherwise an array of module data.
 */
function module_get_all() {
    $uri = ITEM_SERVICE_URI . "/module";
    return  get_data_from_api($uri);
}

/**
 * Get modules by college id.
 *
 * @param int $collegeId The id of the college.
 * @return false|mixed Returns the response data from the API, or false if an error occurs.
 */
function modules_get_by_college_id($collegeId) {
    $uri = ITEM_SERVICE_URI . "/module/college/" . $collegeId;
    return  get_data_from_api($uri);
}