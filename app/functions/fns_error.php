<?php

function error_service($header, $txt)
{
    $output = '<div class="servicenotfound">
                    <h3>' . $header . '</h3>
                    <p>' . $txt . '</p>
                    <p><a href="/index.php?c=login" class="btn btn-light">Go to login page</a></p>
                </div>';
    return $output;
}