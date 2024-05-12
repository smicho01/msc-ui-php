<?php
include_once 'fns_curl.php';
include_once 'fns_user.php';
include_once 'fns_crypto.php';

$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {

	case 'index':
            // Attach js files to the footer
			$jsfiles = ['users'];
            // Use full page layout

            if(isUserLoggedIn()) {
                // Get logged in user
                $USER = $_SESSION['user'];

                // Log user login by presence of session variable 'justLoggedIn'
                if (isset($_SESSION['justLoggedIn'])) {
                    insertDbLogData('INFO', 'IndexController::index', 'user login', 'new user login');
                    unset($_SESSION['justLoggedIn']); // unset variable so new log are not created
                }

                // Use curl to get data from API
                $sessionUserName = $_SESSION['user']['username'];

                $userExists = user_get('username', $sessionUserName);
                if (!$userExists) {
                    // User exists in Keycloak but not in service database
                    // Insert user to service db
                    $insertResult = user_insert_from_session();
                    $insertedUser = json_decode($insertResult['body'], true);
                    $_SESSION['user']['visibleUsername'] = $insertedUser['visibleUsername'];
                    $_SESSION['user']['id'] = $insertedUser['id'];
                } else {
                    $_SESSION['user']['visibleUsername'] = $userExists['visibleUsername'];
                    $_SESSION['user']['id'] = $userExists['id'];
                }

                $userExists = user_get('username', $sessionUserName);

                /* SET USER DATA */
                // Key used to decrypt data received from the REST API [services]

                $decryptedPubKey = "";
                $encryptedUserPublicKeyAsBase64String = $userExists['pubKey'];
                if($encryptedUserPublicKeyAsBase64String != "" || $encryptedUserPublicKeyAsBase64String != null) {
                    $ENCRYPTION_KEY_BASE64 = getenv("ENCRYPTION_KEY");
                    $decryptedPubKey =  CryptoUtil::decrypt($encryptedUserPublicKeyAsBase64String, $ENCRYPTION_KEY_BASE64);
                }

                $MAIN_USER = new User();
                $MAIN_USER->createUserFromSession();
                $MAIN_USER->setTokens($userExists['tokens']);
                $MAIN_USER->setWalletPublicKey($decryptedPubKey);

                //print_r($userExists);






            }
	break;

	case 'logout':
		session_unset();
		session_destroy();
		header("Location: index.php");
	break;
	
	default:
		// code...
	break;
}

