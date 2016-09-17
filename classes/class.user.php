<?php

class User {
  public $id;
  public $username;
  public $password;
  public $displayname;
  public $email;

  function User($id, $username, $password, $displayname, $email) {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->displayname = $displayname;
    $this->email = $email;
  }

  function getId() {
    return $this->id;
  }

  function getUsername() {
    return $this->username;
  }

  function getPassword() {
    return $this->password;
  }

  function getDisplayname() {
    return $this->displayname;
  }

  function setDisplayname($displayname) {
    global $db;

    $displayname = sanitize($displayname);

    $stmt = $db->prepare("UPDATE `" . DB_PREFIX . "users` SET `displayname`='?' WHERE id='?'");
    if ($stmt->execute(array($displayname, $this->id))) {
      $this->displayname = $displayname;
      return true;
    }

    return false;
  }

  function getGroups() {
    global $db;

    $stmt = $db->prepare("SELECT * FROM " . DB_PREFIX . "users WHERE id='?'");
    $stmt->execute(array($this->id));

    if (!$user = $stmt->fetch(PDO::FETCH_OBJ)) {
      return null;
    }

    $array = array();

    $groups = explode(",", $user->groups);
    foreach ($groups AS $name) {
      $id = getGroupId($name);
      if (existsGroup($id)) {
        array_push($array, getGroup($id));
      }
    }

    return $array;
  }

  function getPrimaryGroup() {
    $groups = $this->getGroups();
    if (sizeof($groups) > 0) {
      return $groups[0];
    }

    return null;
  }

  function setPrimaryGroup($group) {
    $groups = array($group);
    foreach ($this->getGroups() AS $group) {
      if ($group instanceof Group) {
        $id = $group->getId();
        if (!in_array($group, $groups)) {
          array_push($groups, $group);
        }
      }
    }

    return $this->setGroups($groups);
  }

  function addGroup($group) {
    $groups = $this->getGroups();
    if (in_array($group, $groups)) {
      return false;
    }

    $id = $group->getId();
    if (existsGroup($id)) {
      array_push($groups, $group);
    }

    return $this->setGroups($groups);
  }

  function hasGroup($group) {
    $groups = $this->getGroups();
    return in_array($group, $groups);
  }

  function removeGroup($group) {
    $groups = $this->getGroups();
    if (!in_array($group, $groups)) {
      return false;
    }

    $id = $group->getId();
    if (existsGroup($id)) {
      unset($groups[array_search($group, $groups)]);
    }

    return $this->setGroups($groups);
  }

  function setGroups($groups) {
    global $db;

    $array = array();
    foreach ($groups as $group) {
      if ($group instanceof Group) {
        $id = $group->getId();
        if (existsGroup($id)) {
          array_push($array, $group->getName());
        }
      }
    }

    $groups = implode(",", $array);

    $stmt = $db->prepare("UPDATE `" . DB_PREFIX . "users` SET `groups`='?' WHERE id='?'");
    if ($stmt->execute(array($groups, $this->id))) {
      return true;
    }

    return false;
  }

  function getEmail() {
    return $this->email;
  }

  function setEmail($email) {
    global $db;

    $email = sanitize($email);

    $stmt = $db->prepare("UPDATE `" . DB_PREFIX . "users` SET `email`='?' WHERE id='?'");
    if ($stmt->execute(array($email, $this->id))) {
      $this->email = $email;
      return true;
    }

    return false;
  }

  function getGravatar($type="", $size=80, $rating="pg") {
  	return "gravatar.php?id=" . $this->getId() . "&type=" . $type . "&rating=" . $rating . "&size=" . $size;
  }

  function hasGravatar() {
  	$headers = get_headers($this->getGravatar("404"), 1);
  	if (strpos($headers[0], '200')) return true;
  	else if (strpos($headers[0], '404')) return false;
  }

  function getRegisterDate() {
    global $db;

    $stmt = $db->prepare("SELECT * FROM " . DB_PREFIX . "users WHERE id='?'");
    $stmt->execute(array($this->id));

    if (!$user = $stmt->fetch(PDO::FETCH_OBJ)) {
      return null;
    }

    return $user->register;
  }

  function setRegisterDate($date) {
    global $db;

    $date = sanitize($date);

    $stmt = $db->prepare("UPDATE `" . DB_PREFIX . "users` SET `register`='?' WHERE id='?'");
    if ($stmt->execute(array($date, $this->id))) {
      return true;
    }

    return false;
  }

  function getLastLogin() {
    global $db;

    $stmt = $db->prepare("SELECT * FROM " . DB_PREFIX . "users WHERE id='?'");
    $stmt->execute(array($this->id));

    if (!$user = $stmt->fetch(PDO::FETCH_OBJ)) {
      return null;
    }

    return $user->lastlogin;
  }
}

?>
