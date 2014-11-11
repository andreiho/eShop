<?php

class Vendors {

  private $db;

  public function __construct($database) {
    $this->db = $database;
  }

  public function registerVendor($vendorRegisterName, $vendorRegisterEmail, $vendorRegisterCommission, $vendorRegisterUrl) {

    $vendorActivationCode = $vendorActivationCode = uniqid(true);

    $adminEmail = 'andrei.horodinca@gmail.com';
    $emailToAdminSubject = 'eShop - A new partner requires activation';
    $emailToAdminBody = "Hello admin,\r\n\r\nA shop owner has signed up as a partner on eShop. Follow the link below to approve the partnership:\r\n\r\nhttp://andreihorodinca.dk/devops/eShop/views/activate-vendor.php?email=$vendorRegisterEmail&code=$vendorActivationCode\r\n\r\nStay classy!";

    $emailToVendorSubject = 'eShop - Thank your for signing up as a partner';
    $emailToVendorBody = "Hi there,\r\n\r\nThank you for signing up to become a partner of eShop.\r\n\r\nYour request is now pending approval. Once your account has been approved by an administrator, you will be notified on your email.\r\n\r\nThe eShop Team";

    $query = $this->db->prepare("INSERT INTO `vendors` (`vendor_name`, `vendor_email`, `vendor_commission`, `vendor_url`, `vendor_code`) VALUES (?, ?, ?, ?, ?)");

    $query->bindValue(1, $vendorRegisterName);
    $query->bindValue(2, $vendorRegisterEmail);
    $query->bindValue(3, $vendorRegisterCommission);
    $query->bindValue(4, $vendorRegisterUrl);
    $query->bindValue(5, $vendorActivationCode);

    try {
      $query->execute();

      mail($adminEmail, $emailToAdminSubject, $emailToAdminBody);
      mail($vendorRegisterEmail, $emailToVendorSubject, $emailToVendorBody);

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  public function doesVendorRegisterEmailExist($vendorRegisterEmail) {

    $query = $this->db->prepare("SELECT COUNT(`vendor_id`) FROM `vendors` WHERE `vendor_email`= ?");
    $query->bindValue(1, $vendorRegisterEmail);

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

  public function activateVendor($vendorRegisterEmail, $vendorActivationCode) {

    $query = $this->db->prepare("SELECT COUNT(`vendor_id`) FROM `vendors` WHERE `vendor_email` = ? AND `vendor_code` = ? AND `vendor_confirmed` = ?");

    $query->bindValue(1, $vendorRegisterEmail);
    $query->bindValue(2, $vendorActivationCode);
    $query->bindValue(3, 0);

    try {
      $query->execute();
      $rows = $query->fetchColumn();

      if($rows == 1) {

        $query_2 = $this->db->prepare("UPDATE `vendors` SET `vendor_confirmed` = ? WHERE `vendor_email` = ?");

        $query_2->bindValue(1, 1);
        $query_2->bindValue(2, $vendorRegisterEmail);

        $query_2->execute();
        return true;

      } else {
        return false;
      }

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

} 