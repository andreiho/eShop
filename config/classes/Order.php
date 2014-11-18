<?php

class Order {

  private $db;

  public function __construct($database) {
    $this->db = $database;
  }

  public function addNewOrder($newOrderVendorId, $newOrderUserId, $newOrderProductId, $newOrderProductQuantity, $newOrderDeliveryAddress, $newOrderEmail, $newOrderPhoneNumber) {

    $newOrderTime = time();

    $query = $this->db->prepare("INSERT INTO `orders` (`order_partner_id`, `order_customer_id`, `order_product_id`, `order_product_quantity`, `order_delivery_address`, `order_email`, `order_phone_number`, `order_timestamp`, `order_processed`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $query->bindValue(1, $newOrderVendorId);
    $query->bindValue(2, $newOrderUserId);
    $query->bindValue(3, $newOrderProductId);
    $query->bindValue(4, $newOrderProductQuantity);
    $query->bindValue(5, $newOrderDeliveryAddress);
    $query->bindValue(6, $newOrderEmail);
    $query->bindValue(7, $newOrderPhoneNumber);
    $query->bindValue(8, $newOrderTime);
    $query->bindValue(9, 0);

    try {

      $query->execute();

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  public function getAllOwnOrders() {

    $query = $this->db->prepare("SELECT * FROM `orders` WHERE `order_partner_id` = 28");

    try {

      $query->execute();

      $result = $query->fetchAll();
      return $result;

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function getProductNameInOrdersByProductId() {

    $query = $this->db->prepare("SELECT o.order_id, p.product_name FROM orders o JOIN products p ON o.order_product_id = p.product_id");

    try {

      $query->execute();

      $result = $query->fetchAll();
      return $result;

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

} 