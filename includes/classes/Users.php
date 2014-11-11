<?php

class Users {

  private $db;

  public function __construct($database) {
    $this->db = $database;
  }

  public function email_exists($registerEmail) {

    $query = $this->db->prepare("SELECT COUNT(`user_id`) FROM `users` WHERE `user_email`= ?");
    $query->bindValue(1, $registerEmail);

    try {
      $query->execute();
      $rows = $query->fetchColumn();

      if($rows == 1) {
        return true;
      } else {
        return false;
      }

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function register($registerEmail, $registerPassword) {

    global $bcrypt;

    $time = time();
    $email_code = $email_code = uniqid(true);
    $activate_email = "Hi there,\r\n\r\nThank you for registering with us. To get started, follow the link bellow to activate your account: \r\n\r\nhttp://andreihorodinca.dk/devops/eShop/activate.php?email=$registerEmail&code=$email_code\r\n\r\nThe eShop Team";

    $registerPassword = $bcrypt->genHash($registerPassword);

    $query = $this->db->prepare("INSERT INTO `users` (`user_email`, `user_password`, `user_timestamp`, `user_code`) VALUES (?, ?, ?, ?)");

    $query->bindValue(1, $registerEmail);
    $query->bindValue(2, $registerPassword);
    $query->bindValue(3, $time);
    $query->bindValue(4, $email_code);

    try {
      $query->execute();

      mail($registerEmail, 'Activate your account on eShop', $activate_email);

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  public function activate($registerEmail, $email_code) {

    $query = $this->db->prepare("SELECT COUNT(`user_id`) FROM `users` WHERE `user_email` = ? AND `user_code` = ? AND `user_confirmed` = ?");

    $query->bindValue(1, $registerEmail);
    $query->bindValue(2, $email_code);
    $query->bindValue(3, 0);

    try {
      $query->execute();
      $rows = $query->fetchColumn();

      if($rows == 1) {

        $query_2 = $this->db->prepare("UPDATE `users` SET `user_confirmed` = ? WHERE `user_email` = ?");

        $query_2->bindValue(1, 1);
        $query_2->bindValue(2, $registerEmail);

        $query_2->execute();
        return true;

      } else {
        return false;
      }

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  public function login($loginEmail, $loginPassword) {

    global $bcrypt;

    $query = $this->db->prepare("SELECT `user_password`, `user_id` FROM `users` WHERE `user_email` = ?");
    $query->bindValue(1, $loginEmail);

    try {

      $query->execute();
      $data = $query->fetch();
      $stored_password = $data['loginPassword'];
      $id = $data['id'];

      if($bcrypt->verify($loginPassword, $stored_password) === true) {
        return $id;
      } else {
        return false;
      }

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  public function email_registered($loginEmail) {

    $query = $this->db->prepare("SELECT COUNT(`user_id`) FROM `users` WHERE `user_email`= ?");
    $query->bindValue(1, $loginEmail);

    try {
      $query->execute();
      $rows = $query->fetchColumn();

      if($rows == 1) {
        return true;
      } else {
        return false;
      }

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function email_confirmed($loginEmail) {

    $query = $this->db->prepare("SELECT COUNT(`user_id`) FROM `users` WHERE `user_email`= ? AND `user_confirmed` = ?");
    $query->bindValue(1, $loginEmail);
    $query->bindValue(2, 1);

    try{

      $query->execute();
      $rows = $query->fetchColumn();

      if($rows == 1) {
        return true;
      } else {
        return false;
      }

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

} 