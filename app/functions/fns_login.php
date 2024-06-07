<?php


/**
 * Checks if user is logged in by checking the PHP Session vars
 * @return bool
 */
function isUserLoggedIn() {
	if( !isset($_SESSION['token']) || !isset($_SESSION['user'])) {
		return false;
	}
	return true;
}

/**
 * Enforces user login by checking if token and user vars are present in session
 * @return void
 */
function require_login () {
	if( !isset($_SESSION['token']) || !isset($_SESSION['user'])) {
		header("Location: index.php?c=login");
	}
}

/*
 * It gets session['user'] key given as function param
 */
function academichain_user($key) {
	switch($key) {
		case 'name':
			return $_SESSION['user']['name'];
        case 'visibleUsername':
            return $_SESSION['user']['visibleUsername'];
		case 'roles_list':
			$out = "";
			foreach ($_SESSION['user']['roles'] as $role){
				$out .= $role . " ";
			}
			return $out;
		break;
	}
}

/*
 * Get token from keycloak
 */
function getJwtToken($username, $password) {
				$url = KEYCLOAK_AUTH_URL;
				$headers = [
					'Content-Type: application/x-www-form-urlencoded',
					'Cookie: AUTH_SESSION_ID=51311a8f-8277-4617-83d7-3780ad9607e4.3qql',
					"Access-Control-Allow-Origin: *"
				];

				$fields = [
					'username' => trim($username),
					'password' => trim($password),
					'grant_type' => 'password',
					'client_id' => 'academichain_ui'
				];

				$fields_string = http_build_query($fields);

				$curl = curl_init();

				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);

				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				$result = curl_exec($curl);
				curl_close($curl);

				$data = json_decode($result);
				return $data->access_token;
}


function decodeJwtToken($token) {
	return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));
}

function isTokenExpired($token) {
				// Decode token
				$decodedToken = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));
				//print_r($decodedToken);
				// Get token expiration timestamp
				$tokenExp = $decodedToken->exp;
				
				// Get timestamp for now
				$date = date_create();
				$timestampNow =  date_timestamp_get($date);

				if($tokenExp > $timestampNow){
					return false;
				} 

				return true;
}