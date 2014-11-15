<?php

session_start();

include_once 'classes/Admin.php';
include_once 'classes/Bcrypt.php';
include_once 'classes/General.php';
include_once 'classes/Product.php';
include_once 'classes/User.php';
include_once 'classes/Vendor.php';
include_once 'connect/connect.php';

$admin = new Admin($db);
$bcrypt = new Bcrypt();
$general = new General();
$products = new Product($db);
$users = new User($db);
$vendors = new Vendor($db);
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