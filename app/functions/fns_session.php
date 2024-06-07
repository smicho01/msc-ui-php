<?php

include_once 'fns_utils.php';

/*
 * Add key and value to SESSION
 * If key already exists and is array, they add.php new element to that array
 */
function session_add_key($key, $value)
{
    if (is_array($_SESSION[$key])) {
        foreach ($value as $k => $v) {
            $_SESSION[$key][$k] = $v;
        }
    } else {
        $_SESSION[$key] = $value;
    }
}

function session_get_key($key) {
    return $_SESSION[$key];
}

function session_delete_ley($key){
    unset($_SESSION[$key]);
}

function my_session_save()
{
    global $sessfile;
    file_put_contents($sessfile, serialize($_SESSION));
}
