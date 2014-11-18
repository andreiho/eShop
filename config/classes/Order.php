<?php

class Order {

  private $db;

  public function __construct($database) {
    $this->db = $database;
  }

  public function addNewOrder($newOrderVendorId, $newOrderUserId, $newOrderProductId) {

    $newOrderTime = time();

    $query = $this->db->prepare("INSERT INTO `orders` (`vendor_id`, `user_id`, `product_id`, `order_time`, `order_processed`) VALUES (?, ?, ?, ?, ?)");

    $query->bindValue(1, $newOrderVendorId);
    $query->bindValue(2, $newOrderUserId);
    $query->bindValue(3, $newOrderProductId);
    $query->bindValue(4, $newOrderTime);
    $query->bindValue(5, 0);

    try {

      $query->execute();

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  public function getAllOwnOrders() {

    $query = $this->db->prepare("SELECT * FROM `orders` WHERE `vendor_id` = 28 ORDER BY `order_id` ASC");

    try {

      $query->execute();

      $result = $query->fetchAll();
      return $result;

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

} 