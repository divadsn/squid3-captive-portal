<?php

  // Database Information
  $db_host = "localhost";
  $db_user = "root";
  $db_password = "";
  $db_name = "database";
  $db_prefix = "proxy_";
  $db_charset = "utf8";

	$langauge = "en";

	// Generic website variables
	$websiteName = "Squid3 Captive Portal";
	$websiteUrl = "http://example.com:8080/"; // including trailing slash

	// Do you wish us to send out emails for confirmation of registration?
	// We recommend this be set to true to prevent spam bots.
	// False = instant activation
	// If this variable is falses the resend-activation file not work.
	$emailActivation = false;

	// In hours, how long before UserPie will allow a user to request another account activation email
	// Set to 0 to remove threshold
	$resend_activation_threshold = 1;

	// Tagged onto our outgoing emails
	$emailAddress = "noreply@example.com";

	// Date format used on email's
	$emailDate = date("l \\t\h\e jS");

	// Directory where txt files are stored for the email templates.
	$mail_templates_dir = "config/mail-templates/";

	$default_hooks = array("#WEBSITENAME#", "#WEBSITEURL#", "#DATE#");
	$default_replace = array($websiteName, $websiteUrl, $emailDate);

	// Display explicit error messages?
	$debug_mode = true;

  // Amount of time to remain logged in.
	$session_length = "3hr";

?>
