<?php

function error_service($txt)
{
    $output = '<div class="servicenotfound">
                    <h3>Service Error</h3>
                    <p>' . $txt . '</p>
                    <p>
                    <a href="/index.php?c=login" class="btn btn-light">Go to login page</a>
</p>
                </div>';
    return $output;
}