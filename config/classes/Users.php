<?php

class Users {

  private $db;

  public function __construct($database) {
    $this->db = $database;
  }

  public function registerUser($registerEmail, $registerPassword) {

    global $bcrypt;

    $time = time();
    $activationCode = $activationCode = uniqid(true);

    $emailSubject = 'eShop - Activate your account';
    $emailBody = "Hi there,\r\n\r\nThank you for registering with us. To get started, follow the link bellow to activate your account: \r\n\r\nhttp://andreihorodinca.dk/devops/eShop/views/users/activate.php?email=$registerEmail&code=$activationCode\r\n\r\nThe eShop Team";

    $registerPassword = $bcrypt->genHash($registerPassword);

    $query = $this->db->prepare("INSERT INTO `users` (`user_email`, `user_password`, `user_timestamp`, `user_code`) VALUES (?, ?, ?, ?)");

    $query->bindValue(1, $registerEmail);
    $query->bindValue(2, $registerPassword);
    $query->bindValue(3, $time);
    $query->bindValue(4, $activationCode);

    try {
      $query->execute();

      mail($registerEmail, $emailSubject, $emailBody);

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  public function doesRegisterEmailExist($registerEmail) {

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

  public function activateUser($registerEmail, $activationCode) {

    $query = $this->db->prepare("SELECT COUNT(`user_id`) FROM `users` WHERE `user_email` = ? AND `user_code` = ? AND `user_confirmed` = ?");

    $query->bindValue(1, $registerEmail);
    $query->bindValue(2, $activationCode);
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

  public function loginUser($loginEmail, $loginPassword) {

    global $bcrypt;

    $query = $this->db->prepare("SELECT `user_password`, `user_id` FROM `users` WHERE `user_email` = ?");
    $query->bindValue(1, $loginEmail);

    try {

      $query->execute();
      $data = $query->fetch();
      $storedPassword = $data['loginPassword'];
      $id = $data['id'];

      if($bcrypt->verify($loginPassword, $storedPassword) === true) {
        return $id;
      } else {
        return false;
      }

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  public function doesLoginEmailExist($loginEmail) {

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

  public function isLoginEmailConfirmed($loginEmail) {

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