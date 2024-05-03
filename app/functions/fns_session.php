<?php
function session_add_key($key, $value) {
	$_SESSION[$key] = $value;
}

function my_session_start() {
	global $phpsessid, $sessfile;
  
	if (!isset($_COOKIE['PHPSESSID']) || empty($_COOKIE['PHPSESSID'])) {
	  $phpsessid = my_base32_encode(my_random_bytes(16));
	  setcookie('PHPSESSID', $phpsessid, ini_get('session.cookie_lifetime'), ini_get('session.cookie_path'), ini_get('session.cookie_domain'), ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
	} else {
	  $phpsessid = substr(preg_replace('/[^a-z0-9]/', '', $_COOKIE['PHPSESSID']), 0, 26);
	}
  
	$sessfile = ini_get('session.save_path').'/sess_'.$phpsessid;
	if (is_file($sessfile)) {
	  $_SESSION = unserialize(file_get_contents($sessfile));
	} else {
	  $_SESSION = array();
	}
	register_shutdown_function('my_session_save');
  }
  
  function my_session_save() {
	global $sessfile;
	file_put_contents($sessfile, serialize($_SESSION));
  }
  
  function my_session_id() {
	global $phpsessid;
	return $phpsessid;
  }
  
  function my_random_bytes($length) {
	if (function_exists('random_bytes')) {
		return random_bytes($length);
	}
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= chr(rand(0, 255));
	}
	return $randomString;
  }
  
  function my_base32_encode($input) {
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