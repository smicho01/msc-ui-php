<?php


function error_service()
{
    $output = '<div class="servicenotfound">
                    <h3>Service Error</h3>
                    <p>Seems like one of the services is not available at the moment. Please try again later.</p>
                    <p>
                    <a href="/?c=login" class="btn btn-light">Go to login page</a>
</p>
                </div>';
    return $output;
}