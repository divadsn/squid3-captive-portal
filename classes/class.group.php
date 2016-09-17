<?php

class Group {
  public $id;
  public $name;
  public $displayname;

  function Group($id, $name, $displayname) {
    $this->id = $id;
    $this->name = $name;
    $this->displayname = $displayname;
  }

  function getId() {
    return $this->id;
  }

  function getName() {
    return $this->name;
  }

  function getDisplayname() {
    return $this->displayname;
  }

  function setDisplayname($displayname) {
    global $db;

    $displayname = sanitize($displayname);

    $stmt = $db->prepare("UPDATE `" . DB_PREFIX . "groups` SET `displayname`='?' WHERE id='?'");
    if ($stmt->execute(array($displayname, $this->id))) {
      $this->displayname = $displayname;
      return true;
    }

    return false;
  }

  function getOwners() {
    global $db;

    $stmt = $db->prepare("SELECT * FROM " . DB_PREFIX . "groups WHERE id='?'");
    $stmt->execute(array($this->id));

    if (!$group = $stmt->fetch(PDO::FETCH_OBJ)) {
      return null;
    }

    $array = array();

    $users = explode(",", $group->owners);
    foreach ($users AS $username) {
      $id = getUserId($username);
      if (existsUser($id)) {
        array_push($array, getUser($id));
      }
    }

    return $array;
  }

  function setOwners($owners) {
    global $db;

    $array = array();
    foreach ($owners AS $user) {
      if ($user instanceof User) {
        if (!in_array($this, $user->getGroups())) {
          $user->addGroup(this);
        }

        array_push($array, $user->getUsername());
      }
    }

    $users = implode(",", $array);

    $stmt = $db->prepare("UPDATE `" . DB_PREFIX . "groups` SET `owners`='?' WHERE id='?'");
    if ($stmt->execute(array($users, $this->id))) {
      return true;
    }

    return false;
  }

  function isOwner($user) {
    return in_array($user, $this->getOwners());
  }

  function getMembers() {
    global $db;

    $stmt = $db->prepare("SELECT * FROM " . DB_PREFIX . "groups WHERE id='?'");
    $stmt->execute(array($this->id));

    if (!$group = $stmt->fetch(PDO::FETCH_OBJ)) {
      return null;
    }

    $array = array();

    $users = explode(",", $group->members);
    foreach ($users AS $username) {
      $id = getUserId($username);
      if (existsUser($id)) {
        array_push($array, getUser($id));
      }
    }

    return $array;
  }

  function setMembers($members) {
    global $db;

    $array = array();
    foreach ($members AS $user) {
      if ($user instanceof User) {
        if (!in_array($this, $user->getGroups())) {
          $user->addGroup(this);
        }

        array_push($array, $user->getUsername());
      }
    }

    $users = implode(",", $array);

    $stmt = $db->prepare("UPDATE `" . DB_PREFIX . "groups` SET `members`='?' WHERE id='?'");
    if ($stmt->execute(array($users, $this->id))) {
      return true;
    }

    return false;
  }

  function isMember($user) {
    return in_array($user, $this->getMembers());
  }
}

?>
