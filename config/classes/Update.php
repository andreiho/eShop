<?php

include_once 'Product.php';
include_once 'Vendor.php';

class Update {

  private $db;

  public function __construct($database) {
    $this->db = $database;
  }

  public function ownProductsToJSON() {

    $ownProductFromDb = new Product($this->db);
    $ownProducts = $ownProductFromDb->getAllOwnProducts();

    $allProductsArray = array();

    foreach ($ownProducts as $ownProduct) {
      $product = new stdClass();

      $productId = "id";
      $productName = "name";
      $productDescription = "description";
      $productImageUrl = "image";
      $productPrice = "price";

      $product->$productId = $ownProduct['product_id'];
      $product->$productName = $ownProduct['product_name'];
      $product->$productDescription = $ownProduct['product_description'];
      $product->$productImageUrl = $ownProduct['product_image_url'];
      $product->$productPrice = $ownProduct['product_price'];

      array_push($allProductsArray, $product);
    }

    $allProductsArrayWithName = array('products' => $allProductsArray);
    $allProducts = json_encode($allProductsArrayWithName);

    $file = '../api/products.json';

    file_put_contents($file, $allProducts);
  }

  public function ownProductsToXML() {

    $ownProductFromDb = new Product($this->db);
    $ownProducts = $ownProductFromDb->getAllOwnProducts();

    $allProductsXml = new SimpleXMLElement("<products/>");

    for($i = 0; $i < count($ownProducts); $i++) {

      $productId = "productId";
      $productName = "name";
      $productDescription = "description";
      $productImageUrl = "image";
      $productPrice = "price";

      $allProductsXml->addChild("product")->addChild($productId, $ownProducts[$i]['product_id']);
      $allProductsXml->product[$i]->addChild($productName, $ownProducts[$i]['product_name']);
      $allProductsXml->product[$i]->addChild($productDescription, $ownProducts[$i]['product_description']);
      $allProductsXml->product[$i]->addChild($productImageUrl, $ownProducts[$i]['product_image_url']);
      $allProductsXml->product[$i]->addChild($productPrice, $ownProducts[$i]['product_price']);

    }

    $file = '../api/products.xml';
    file_put_contents($file, $allProductsXml->asXML());

  }

  public function vendorProductsToDb($vendorId) {

    $vendorFromDB = new Vendor($this->db);
    $vendor = $vendorFromDB->vendorData($vendorId);
    $vendorApiPath = $vendor['vendor_url'];

    // Check if path to API is .json or .xml
    if (substr($vendorApiPath,-5) == ".json") {

      $jsonProducts = file_get_contents($vendorApiPath);
      $vendorProducts = json_decode($jsonProducts);

      $vendorProductsToDb = new Product( $this->db );

      for($i = 0; $i < count($vendorProducts->products); $i++) {

        $vendorProduct = $vendorProducts->products[$i];

        $vendorProductId = $vendorProduct->id;
        $vendorProductName = $vendorProduct->name;
        $vendorProductDescription = $vendorProduct->description;
        $vendorProductImageUrl = $vendorProduct->image;
        $vendorProductPrice = $vendorProduct->price;

        $vendorProductsToDb->addProductsFromPartner($vendorId, $vendorProductId, $vendorProductName, $vendorProductDescription, $vendorProductImageUrl, $vendorProductPrice);

      }

    } else if (substr($vendorApiPath,-4) == ".xml") {

      $xmlProducts = file_get_contents($vendorApiPath);
      $vendorProducts = simplexml_load_string($xmlProducts);

      $vendorProductsToDb = new Product( $this->db );

      foreach ($vendorProducts as $vendorProduct) {

        $vendorProductId = $vendorProduct->productId;
        $vendorProductName = $vendorProduct->name;
        $vendorProductDescription = $vendorProduct->description;
        $vendorProductImageUrl = $vendorProduct->image;
        $vendorProductPrice = $vendorProduct->price;

        $vendorProductsToDb->addProductsFromPartner($vendorId, $vendorProductId, $vendorProductName, $vendorProductDescription, $vendorProductImageUrl, $vendorProductPrice);

      }

    }
  }

  public function updateAllVendorProducts( ){

    $vendorFromDb = new Vendor( $this->db );
    $allVendorsById = $vendorFromDb->getAllVendorsById();

    $updateAllVendors = new Update( $this->db );

    foreach ($allVendorsById as $vendorById) {

      $currentVendorId = $vendorById[0];

      if ($currentVendorId != 28){
        $updateAllVendors->vendorProductsToDb($currentVendorId);
      }

    }

  }

}