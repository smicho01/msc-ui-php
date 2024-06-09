<?php
/**
 * Generates an error service HTML output.
 *
 * @param string $header The header text of the error service.
 * @param string $txt The description text of the error service.
 *
 * @return string The generated HTML output for the error service.
 */
function error_service($header, $txt)
{
    $output = '<div class="servicenotfound">
                    <h3>' . $header . '</h3>
                    <p>' . $txt . '</p>
                    <p><a href="/index.php?c=login" class="btn btn-light">Go to login page</a></p>
                </div>';
    return $output;
}