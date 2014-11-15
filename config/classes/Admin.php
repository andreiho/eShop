<?php

class Admin {

  private $db;

  public function __construct($database) {
    $this->db = $database;
  }

  public function doesAdminUsernameExist($adminUsername) {

    $query = $this->db->prepare("SELECT COUNT(*) FROM `admin` WHERE `admin_username`= ?");
    $query->bindValue(1, $adminUsername);

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

  public function loginAdmin($adminUsername, $adminPassword) {

    $query = $this->db->prepare("SELECT COUNT(*) FROM `admin` WHERE `admin_username` = ? AND `admin_password` = ?");
    $query->bindValue(1, $adminUsername);
    $query->bindValue(2, MD5($adminPassword));

    try {
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