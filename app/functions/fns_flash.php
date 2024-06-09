<?php

class FlashMessage {

    function __construct($message, $type = "success") {
        $_SESSION['flash']['message'] = $message;
        $_SESSION['flash']['type'] = $type;
    }

    public static function read() {
        if (isset($_SESSION['flash']))
        {
            $flash_message = $_SESSION['flash']['message'];
            $flash_type = $_SESSION['flash']['type'];
            unset ($_SESSION['flash']);
            echo '<div class="alert alert-'.$flash_type.' alert-dismissible fade show" role="alert">';
            echo $flash_message;
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';

        }
    }

}