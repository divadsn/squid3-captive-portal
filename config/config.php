<?php

	// The following line appeases recent versions of PHP. If you want a different time zone,
	// insert a similar call into models/settings.php with your desired time zone
	// NOTE: You probably do want a different time zone.
	date_default_timezone_set('Europe/Warsaw');

  if (!defined("DIR_PATH")) {
    define("DIR_PATH", dirname(dirname(__FILE__)));
  }

	require_once(DIR_PATH . "/config/settings.php");
	require_once(DIR_PATH . "/config/mysql.php");

	if (!isset($language)) {
		$langauge = "en";
	}

	require_once(DIR_PATH . "/config/lang/" . $langauge . ".php");

	require_once(DIR_PATH . "/classes/class.user.php");
	require_once(DIR_PATH . "/classes/class.group.php");
	require_once(DIR_PATH . "/classes/funcs.general.php");
	require_once(DIR_PATH . "/classes/funcs.groups.php");
	require_once(DIR_PATH . "/classes/funcs.register.php");
	require_once(DIR_PATH . "/classes/funcs.sessions.php");
	require_once(DIR_PATH . "/classes/funcs.users.php");

  session_start();

?>
