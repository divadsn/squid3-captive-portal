<?php

  session_start();

  $headers = array("X-Forwarded-For", "HTTP_X_FORWARDED_FOR", "HTTP_CLIENT_IP", "HTTP_VIA", "REMOTE_ADDR");
  foreach ($headers as $header) {
    if (!empty($_SERVER[$header])) {
      $ip_address = $_SERVER[$header];
      break;
    }
  }

  if (strpos($ip_address, ',') !== false) {
    $ip_address = substr($ip_address, 0, strpos($ip_address, ','));
  }

  if (isset($_POST['submit'])) {
    if (isset($_POST['form_id']) && isset($_SESSION['form_id'])) {
      $form_hash = $_POST['form_id'];
      if (sha1($_SESSION['form_id']) === $form_hash) {
        $logged_in = true;
        shell_exec("/usr/share/nginx/www/scripts/session.sh 10800 " . $ip_address . " LOGIN");
      }
    }
  }

  if (!isset($form_id)) {
    $form_id = uniqid("form_");
    $_SESSION['form_id'] = $form_id;
  }

  $url = !empty($_GET['url']) ? $_GET['url'] : (isset($_POST['redirect_to']) ? $_POST['redirect_to'] : "http://www.google.com");
  $form_hash = sha1($form_id);

  include("views/connect.php");

?>
