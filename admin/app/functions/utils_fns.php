<?php
function getViewFile($VIEW) {
    $exploded = explode('-', $VIEW);
    $dir = isset($exploded[0]) ? $exploded[0] : 'index';
    $file = isset($exploded[1]) ? $exploded[1] : 'index';
    return $viewVile = ADMIN_VIEWS_DIR . DS . $dir . DS . $file . ".php";
}