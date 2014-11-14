<?php

session_start();

include_once 'classes/Bcrypt.php';
include_once 'classes/General.php';
include_once 'classes/Users.php';
include_once 'classes/Vendors.php';
include_once 'connect/connect.php';

$users = new Users($db);
$vendors = new Vendors($db);
$general = new General();
$bcrypt = new Bcrypt();
$date = new DateTime();

if ($general->userLoggedIn() === true)  {
  $userId = $_SESSION['userId'];
  $user = $users->userData($userId);
}

if ($general->vendorLoggedIn() === true)  {
  $vendorId = $_SESSION['vendorId'];
  $vendor = $vendors->vendorData($vendorId);
}

$errors = array();

ob_start();

?>