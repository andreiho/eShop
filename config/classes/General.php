<?php

class General {

  // Protection for admin
  public function adminLoggedIn () {
    return(isset($_SESSION['adminId'])) ? true : false;
  }

  public function adminLoggedInProtect() {
    if ($this->adminLoggedIn() === true) {
      header('Location: /admin/home.php');
      exit();
    }
  }

  public function adminLoggedOutProtect() {
    if ($this->adminLoggedIn() === false) {
      header('Location: /admin/index.php');
      exit();
    }
  }

  // Protection for users
  public function userLoggedIn () {
    return(isset($_SESSION['userId'])) ? true : false;
  }

  public function userLoggedInProtect() {
    if ($this->userLoggedIn() === true) {
      header('Location: /views/users/home.php');
      exit();
    }
  }

  public function userLoggedOutProtect() {
    if ($this->userLoggedIn() === false) {
      header('Location: /index.php');
      exit();
    }
  }

  // Protection for vendors
  public function vendorLoggedIn () {
    return(isset($_SESSION['vendorId'])) ? true : false;
  }

  public function vendorLoggedInProtect() {
    if ($this->vendorLoggedIn() === true) {
      header('Location: /views/vendors/home.php');
      exit();
    }
  }

  public function vendorLoggedOutProtect() {
    if ($this->vendorLoggedIn() === false) {
      header('Location: /index.php');
      exit();
    }
  }


} 