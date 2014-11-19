<?php

class Search {

  private $db;

  public function __construct($database) {
    $this->db = $database;
  }

  public function searchProducts($q) {

    $query = $this->db->prepare("SELECT * FROM `products` WHERE (`product_name` LIKE '%" . $q . "%') OR (`product_description` LIKE '%" . $q . "%') OR (`product_price` LIKE '%" . $q . "%')");

    try {

      $query->execute();

      $result = $query->fetchAll();
      return $result;

    } catch (PDOException $e) {
      die($e->getMessage());
    }

  }

}
