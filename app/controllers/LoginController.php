<?php
$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {

    case 'process':
        $url = 'http://sever3d.synology.me:7080/auth/realms/academichain/protocol/openid-connect/token';
        $data = [
            'grant_type' => 'password',
            'client_id' => 'academichain_ui',
            'username' => $_POST['username'],  // Replace with actual username
            'password' => $_POST['password']   // Replace with actual password
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Only use this in a trusted network
        $response = curl_exec($ch);

        if (!$response) {
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);
        $responseData = json_decode($response, true);
        if (isset($responseData['access_token'])) {
            // User was logged in
            $_SESSION['user'] = array();

            $_SESSION['token'] = $responseData['access_token'];
            $decodedToken = decodeJwtToken($responseData['access_token']);

            $_SESSION['user']['name'] = $decodedToken->given_name . " " . $decodedToken->family_name;
            $_SESSION['user']['username'] = $decodedToken->preferred_username;
            $_SESSION['user']['email'] = $decodedToken->email;
            $_SESSION['user']['roles'] = $decodedToken->realm_access->roles;
            $_SESSION['tokenexpiry'] = $decodedToken->exp;
            $_SESSION['justLoggedIn'] = 1;
            header("Location: index.php");
        } else {
            header("Location: index.php?c=login&msg=Login failed");
        }
        break;

    default:
		// code...
	break;
}