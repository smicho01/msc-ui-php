<?php

/**
 * Send a POST request using cURL.
 *
 * @param string $url The URL to send the request to.
 * @param array $data The data to be sent with the request.
 * @param string $token The authorization token.
 * @return array An associative array containing the response header, body, and status code.
 */

function curl_post($url, $data, $token)
{
    // JSON encode the data
    $jsonData = json_encode($data);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: ' . $token
    ));
    // Set POST method
    curl_setopt($curl, CURLOPT_POST, 1);
    // Set the post data as JSON
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
    // Tell cURL that we want to try to return the resulting payload
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_HEADER, 1);
    // Execute the POST request
    $response = curl_exec($curl);

    $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    $status_line = strtok($response, "\n");    // this extracts the first line

    list($version, $status_code, $status_text) = explode(' ', $status_line, 3);

    curl_close($curl);

    return array('header' => $header, 'body' => $body, 'status_code' => $status_code);
}

/*
* GET data form API endpoint give in $uri param using GET request
*/
function get_data_from_api($uri) {
    $foundUserResponse = rest_call('GET', $uri, $data = false, 'application/json',
        "Bearer " . $_SESSION['token']);
    $responseBody = $foundUserResponse['body'];
    if(!$responseBody) {
        return false;
    }
    $data = json_decode($responseBody, true);
    if (count($data) == 0) {
        return false;
    }
    return $data;
}

function apiGetRequest($uri, $noToken = false) {
    if($noToken) {
        $foundUserResponse = rest_call('GET', $uri, $data = false, 'application/json',
            false);
    } else {
        $foundUserResponse = rest_call('GET', $uri, $data = false, 'application/json',
            "Bearer " . $_SESSION['token']);
    }

    $responseBody = $foundUserResponse['body'];
    if(!$responseBody) {
        return false;
    }
    $data = json_decode($responseBody, true);
    if (count($data) == 0) {
        return false;
    }
    return ["data" => $data, "status" => $foundUserResponse['status_code']];
}


/**
 * Sends HTTP request using cURL.
 *
 * @param string $method The HTTP method to be used (GET, POST, PUT).
 * @param string $url The URL to send the request to.
 * @param mixed $data The data to be sent with the request. Default is false.
 * @param string $contentType The content type of the request. Default is false.
 * @param string $token The authorization token. Default is false.
 * @return array An associative array containing the response header, body, and status code.
 *                If the status line is empty or null, a status code of 400 is returned.
 */
function rest_call($method, $url, $data = false, $contentType = false, $token = false)
{
    $curl = curl_init();

    if ($token) { //Add Bearer Token header in the request
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . $token
        ));
    }

    switch ($method) {
        case "GET":
            curl_setopt($curl, CURLOPT_URL, TRUE);
            break;
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                if ($contentType) {
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: ' . $contentType
                    ));
                }
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_HEADER, 1);
    $response = curl_exec($curl);

    $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    $status_line = strtok($response, "\n");    // this extracts the first line

    if($status_line == "" || $status_line == null) {
        $status_code = 400;
    } else {
        list($version, $status_code, $status_text) = explode(' ', $status_line, 3);
    }


    curl_close($curl);

    return array('header' => $header, 'body' => $body, 'status_code' => $status_code);
}



