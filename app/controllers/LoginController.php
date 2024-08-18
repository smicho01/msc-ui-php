<?php
$VIEW = isset($VIEW) ? $VIEW : 'index';

switch ($VIEW) {

    case 'process':
        unset($_SESSION['message']);
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        try {
            $keycloakUserData = $USER_SERVICE->user_login($_POST['username'], $_POST['password']);
            error_log("Login username: " . $_POST['username'], 4);
        } catch (ErrorException $e) {
            print_r($e);
        }
        // If user was logged in
        if (isset($keycloakUserData['access_token'])) {

            $_SESSION['user'] = array();
            $_SESSION['token'] = $keycloakUserData['access_token'];
            $decodedToken = decodeJwtToken($keycloakUserData['access_token']);

            try {
                $findUserDb = $USER_SERVICE->getUser('username', $decodedToken->preferred_username);
                if ($findUserDb) {
                    if ($findUserDb['active'] != 1) {
                        $_SESSION['message'] = "<p class='alert alert-danger'>Inactive account</p>";
                        header("Location: index.php?c=login");
                    }
                }
            } catch (Exception $e) {
                // log exception
            }

            $_SESSION['user']['name'] = $decodedToken->given_name . " " . $decodedToken->family_name;
            $_SESSION['user']['username'] = $decodedToken->preferred_username;
            $_SESSION['user']['email'] = $decodedToken->email;
            $_SESSION['user']['roles'] = $decodedToken->realm_access->roles;
            $_SESSION['tokenexpiry'] = $decodedToken->exp;
            $_SESSION['user']['college'] = $decodedToken->college;
            $_SESSION['user']['questions'] = [];
            $_SESSION['user']['questions-size'] = 0;
            $_SESSION['user']['answers'] = [];
            $_SESSION['user']['answers-size'] = 0;
            $_SESSION['justLoggedIn'] = 1;
            $_SESSION['user']['imageid'] = 1;
            $_SESSION['user']['isAdmim'] = in_array('ADMIN', $decodedToken->realm_access->roles);
            error_log("User logged in", 4);
            header("Location: index.php");
        } else {
            header("Location: index.php?c=login&msg=Login failed");
        }
        break;

    default:
        // code...
        break;
}