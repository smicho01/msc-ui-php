<?php
include_once('../init.php');

$USER_SERVICE = new UserService();

if(isset($_POST['urlcommand'])) {

    switch($_POST['urlcommand']){
        case 'getkeys':
            // It will return wallet with encrypted keys
            $userWalletDTO = $USER_SERVICE->user_get_keys($_SESSION['user']['id']);
            // Encrypt keys
            $ENCRYPTION_KEY_BASE64 = getenv("ENCRYPTION_KEY");
            if($userWalletDTO['publicKeyEncrypted'] !='' && $userWalletDTO['privateKeyEncrypted'] != '') {
                $pubKeyDecrypted =  CryptoUtil::decrypt($userWalletDTO['publicKeyEncrypted'], $ENCRYPTION_KEY_BASE64);
                $privKeyDecrypted =  CryptoUtil::decrypt($userWalletDTO['privateKeyEncrypted'], $ENCRYPTION_KEY_BASE64);

                $data = [
                        'publicKey' => $pubKeyDecrypted,
                        'privateKey' => $privKeyDecrypted
                    ];

                echo  $jsonData = json_encode($data);
            } else {
                $data = [
                    'publicKey' => '',
                    'privateKey' => '',
                ];

                echo  $jsonData = json_encode($data);
            }

            break;
    }
}