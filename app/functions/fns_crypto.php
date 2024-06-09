<?php

/**
 * The CryptoUtil class provides encryption and decryption functionality using the AES-256-CBC algorithm.
 */
class CryptoUtil {
    private static $algorithm = "aes-256-cbc";
    private static $key;
    private static $iv;
    private static $options = OPENSSL_RAW_DATA;

    public static function encrypt($data, $key) {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$algorithm));
        $encrypted = openssl_encrypt($data, self::$algorithm, $key, self::$options, $iv);
        $encrypted = $iv . $encrypted;
        return base64_encode($encrypted);
    }

    public static function decrypt($encryptedData, $key) {
        $key = base64_decode($key);
        $data = base64_decode($encryptedData);
        $ivLength = openssl_cipher_iv_length(self::$algorithm);
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);
        $decrypted = openssl_decrypt($encrypted, self::$algorithm, $key, self::$options, $iv);
        return $decrypted;
    }
}