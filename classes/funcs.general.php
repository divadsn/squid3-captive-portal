<?php

  function sanitize($str) {
    return strtolower(strip_tags(trim(($str))));
  }

  function isValidEmail($email) {
		return preg_match("/^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", trim($email));
	}

	function minMaxRange($min, $max, $str) {
    if (strlen(trim($str)) < $min) {
      return true;
    } else if (strlen(trim($str)) > $max) {
      return true;
    } else {
      return false;
    }
	}

	function generateHash($text, $salt = null) {
    if ($salt === null) {
    	$salt = substr(md5(uniqid(rand(), true)), 0, 25);
    } else {
    	$salt = substr($salt, 0, 25);
    }

    return $salt . sha1($salt . $text);
	}

	function replaceDefaultHook($str) {
		global $default_hooks, $default_replace;
		return (str_replace($default_hooks, $default_replace, $str));
	}

	function getUniqueCode($length = "") {
		$code = md5(uniqid(rand(), true));
		if ($length != "") return substr($code, 0, $length);
		else return $code;
	}

	function parseLength($length) {
    $user_units = strtolower(substr($length, -2));
    $user_time = substr($length, 0, -2);
    $units = array("mi" => 60, "hr" => 3600, "dy" => 86400, "wk" => 604800, "mo" => 2592000);

    if (!array_key_exists($user_units, $units)) {
    	die("Invalid unit of time.");
    } else if (!is_numeric($user_time)) {
    	die("Invalid length of time.");
    }

    return (int) $user_time * $units[$user_units];
	}

?>
