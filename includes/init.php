<?php

include_once 'classes/Bcrypt.php';
include_once 'classes/General.php';
include_once 'classes/Users.php';
include_once 'connect/connect.php';

$users = new Users($db);
$general = new General();
$bcrypt = new Bcrypt();
$date = new DateTime();

/*if ($general->logged_in() === true)  {
  $user_id 	= $_SESSION['id'];
  $user 	= $users->userdata($user_id);
}*/

$errors = array();