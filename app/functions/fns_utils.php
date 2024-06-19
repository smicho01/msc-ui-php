<?php

/**
 * Generates random bytes.
 *
 * @param int $length The desired length of the random bytes.
 * @return string The generated random bytes.
 */
function my_random_bytes($length)
{
    if (function_exists('random_bytes')) {
        return random_bytes($length);
    }
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= chr(rand(0, 255));
    }
    return $randomString;
}

/**
 * Encodes a string into Base32 format.
 *
 * @param string $input The string to be encoded.
 * @return string The Base32 encoded string.
 */
function my_base32_encode($input)
{
    $BASE32_ALPHABET = 'abcdefghijklmnopqrstuvwxyz234567';
    $output = '';
    $v = 0;
    $vbits = 0;
    for ($i = 0, $j = strlen($input); $i < $j; $i++) {
        $v <<= 8;
        $v += ord($input[$i]);
        $vbits += 8;
        while ($vbits >= 5) {
            $vbits -= 5;
            $output .= $BASE32_ALPHABET[$v >> $vbits];
            $v &= ((1 << $vbits) - 1);
        }
    }
    if ($vbits > 0) {
        $v <<= (5 - $vbits);
        $output .= $BASE32_ALPHABET[$v];
    }
    return $output;
}

/**
 * Sanitizes input data according to the specified type.
 *
 * @param mixed $data The input data to be sanitized.
 * @param string $type (optional) The type of data to be sanitized. Defaults to 'string'.
 *                     Possible values are: 'email', 'url', 'int', 'float', 'string'.
 * @return mixed The sanitized input data.
 */
function sanitizeInput($data, $type = 'string') {
    switch ($type) {
        case 'email':
            return filter_var($data, FILTER_SANITIZE_EMAIL);
        case 'url':
            return filter_var($data, FILTER_SANITIZE_URL);
        case 'int':
            return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
        case 'float':
            return filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        case 'string':
        default:
            return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}


/**
 * Trims a string to a specified maximum length and adds ellipsis if necessary.
 *
 * @param string $string The string to be trimmed.
 * @param int $maxLength The maximum length of the trimmed string.
 * @return string The trimmed string with ellipsis if necessary.
 */
function trimString($string, $maxLength) {
    $truncatedString = substr($string, 0, $maxLength);

    if (strlen($string) > $maxLength) {
        $truncatedString .= '...';
    }

    echo $truncatedString;
}

/**
 * Formats a date string from the Java format to the specified format.
 *
 * @param string $source The date string to be formatted.
 * @return string The formatted date string in the specified format.
 */
function format_date_from_java($source, $format = 'Y-m-d') {
    $date = date_create_from_format('Y-m-d\TH:i:s.u', $source);
    return date_format($date, $format);
}