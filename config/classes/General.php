<?php

class General {

  public function userLoggedIn () {
    return(isset($_SESSION['userId'])) ? true : false;
  }

  public function vendorLoggedIn () {
    return(isset($_SESSION['vendorId'])) ? true : false;
  }

  public function loggedInProtect() {
    if ($this->userLoggedIn() === true || $this->vendorLoggedIn() === true) {
      header('Location: home.php');
      exit();
    }
  }

  public function loggedOutProtect() {
    if ($this->userLoggedIn() === false || $this->vendorLoggedIn() === false) {
      header('Location: index.php');
      exit();
    }
  }

} 