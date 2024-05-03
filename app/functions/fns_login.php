<?php

function academichain_isUserLoggedIn() {
	if( !isset($_SESSION['academichain']['token']) || !isset($_SESSION['academichain']['user'])) {
		return false;
	}
	return true;
}

function require_login () {
	if( !isset($_SESSION['academichain']['token'])) {
		header("Location: index.php?c=login");
	}
}

function academichain_user($key) {
	switch($key) {
		case 'name':
			return $_SESSION['academichain']['user']['name'];
        case 'visibleUsername':
            return $_SESSION['academichain']['user']['visibleUsername'];
		case 'roles_list':
			$out = "";
			foreach ($_SESSION['academichain']['user']['roles'] as $role){
				$out .= $role . " ";
			}
			return $out;
		break;
	}
}

function getJwtToken($username, $password) {
				$url = "http://sever3d.synology.me:7080/auth/realms/academichain/protocol/openid-connect/token";
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

				print_r($result);

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