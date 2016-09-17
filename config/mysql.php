<?php

	// Turn off displaying errors if debug_mode is false
	ini_set("display_errors", $debug_mode);

	// DB options
	define("DB_HOST", $db_host);
	define("DB_USER", $db_user);
	define("DB_PASSWORD", $db_password);
	define("DB_NAME", $db_name);
	define("DB_PREFIX", $db_prefix);
	define("DB_CHARSET", $db_charset);

	// Connect to database
	$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASSWORD);

?>
