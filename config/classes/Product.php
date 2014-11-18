<?php

class Product {

  private $db;

  public function __construct($database) {
    $this->db = $database;
  }

  public function getNumberOfRows() {

    $query = $this->db->prepare("SELECT COUNT(*) FROM `products`");

    try {

      $query->execute();
      $rows = $query->fetchColumn();

      return $rows;

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function addNewOwnProduct($newProductName, $newProductDescription, $newProductImage, $newProductQuantity, $newProductPrice) {

    $query = $this->db->prepare("INSERT INTO `products` (`product_name`, `product_description`, `product_image_url`, `product_quantity`, `product_price`, `vendor_id`) VALUES ( ?, ?, ?, ?, ?, ? ) ");

    $query->bindValue(1, $newProductName);
    $query->bindValue(2, $newProductDescription);
    $query->bindValue(3, $newProductImage);
    $query->bindValue(4, $newProductQuantity);
    $query->bindValue(5, $newProductPrice);
    $query->bindValue(6, 28);

    try {

      $query->execute();

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function getAllProducts() {

    $query = $this->db->prepare("SELECT * FROM `products` WHERE `product_removed` = 0 ORDER BY `vendor_id` ASC");

    try {

      $query->execute();

      $result = $query->fetchAll();
      return $result;

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function getAllOwnProducts() {

    $query = $this->db->prepare("SELECT * FROM `products` WHERE `vendor_id` = 28 AND `product_removed` = 0");

    try {

      $query->execute();

      $result = $query->fetchAll();
      return $result;

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function removeProduct($productId) {

    $query = $this->db->prepare("SELECT COUNT(*) FROM `products` WHERE `product_id` = ? AND `product_removed` = ?");

    $query->bindValue(1, $productId);
    $query->bindValue(2, 0);

    try {

      $query->execute();
      $rows = $query->fetchColumn();

      if($rows == 1) {

        $query_2 = $this->db->prepare("UPDATE `products` SET `product_removed` = ? WHERE `product_id` = ?");

        $query_2->bindValue(1, 1);
        $query_2->bindValue(2, $productId);

        $query_2->execute();
        return true;

      } else {
        return false;
      }

    } catch(PDOException $e) {
      die($e->getMessage());
    }
  }

  public function addProductsFromPartner($vendorId, $productId, $productName, $productDescription, $productImageUrl, $productPrice){

    $query = $this->db->prepare("INSERT INTO `products` (`vendor_id`, `ext_product_id`, `product_name`, `product_description`, `product_image_url`, `product_price`) VALUES ( ?, ?, ?, ?, ?, ? ) ");

    $query->bindValue(1, $vendorId);
    $query->bindValue(2, $productId);
    $query->bindValue(3, $productName);
    $query->bindValue(4, $productDescription);
    $query->bindValue(5, $productImageUrl);
    $query->bindValue(6, $productPrice);

    try {

      $query->execute();

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function getAllVendorProducts() {

    $query = $this->db->prepare("SELECT * FROM `products` WHERE `vendor_id` <> 28 AND `product_removed` = 0");

    try {

      $query->execute();

      $result = $query->fetchAll();
      return $result;

    } catch (PDOException $e) {
      die($e->getMessage());
    }

  }

  public function getVendorProductsByVendorId($vendorId) {

    $query = $this->db->prepare("SELECT * FROM `products` WHERE `vendor_id` = ? AND `product_removed` = 0");

    $query->bindValue(1, $vendorId);

    try {

      $query->execute();

      $result = $query->fetchAll();
      return $result;

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

} 