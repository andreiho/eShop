<?php

include_once 'config/init.php';
$general->userLoggedInProtect();
$general->vendorLoggedInProtect();

?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Home | eShop</title>
  <link rel="shortcut icon" href="images/ico/favicon.ico">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>

<body class="eShop home">
<?php include_once 'header.php'; ?>

<!-- Modal Edit Product -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <input type="text" name="editProductName" placeholder="name" class="form-control"/>
            </div>
            <div class="form-group">
              <input type="text" name="editProductPrice" placeholder="price" class="form-control" />
            </div>
            <div class="form-group">
              <input type="url" name="editProductImageUrl" placeholder="image url" class="form-control" />
            </div>
            <div class="form-group">
              <textarea name="editProductDescription" placeholder="description" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <div class="col-md-3 text-right">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete Product -->
<div class='modal fade' id='deleteProductModal' tabindex='-1' role='dialog' aria-labelledby='deleteProductModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-body'>
        <div class='row'>
          <div class='col-md-9'>
            <div class='text'>Are you sure you want to remove this product</b> from the shop?</div>
          </div>
          <div class='col-md-3 text-right'>
            <a href='#' class='btn btn-primary remove-product'>Yes, remove</a>
            <button type='button' class='btn btn-default' data-dismiss='modal'>No, cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <?php

        $allProducts = $products->getAllOwnProducts();

        foreach ($allProducts as $product) {

          if($general->adminLoggedIn()) {
            echo '
              <div class="col-md-3">
                <div class="thumbnail product">
                  <div class="image" style="background: url(' . $product['product_image_url'] . ') no-repeat center; background-size:100%"></div>
                  <div class="caption text-center">
                    <h4 class="title">' . $product['product_name'] . '</h4>
                    <p class="description">' . $product['product_description'] . '</p>
                    <p class="controls">
                      <span class="btn btn-default price">DKK ' . $product['product_price'] . '</span>
                      <a href="#" class="btn btn-primary" role="button">Buy this</a>
                    </p>
                    <a href="#" data-toggle="modal" data-target="#editProductModal" class="edit"><i class="fa fa-pencil fa-lg"></i></a>
                    <a href="#" data-toggle="modal" data-target="#deleteProductModal" data-remove-product="' . $product['product_id'] . '" class="remove"><i class="fa fa-times fa-lg"></i></a>
                  </div>
                </div>
              </div>
            ';
          } else {
            echo '
              <div class="col-md-3">
                <div class="thumbnail product">
                  <div class="image" style="background: url(' . $product['product_image_url'] . ') no-repeat center; background-size:100%"></div>
                  <div class="caption text-center">
                    <h4 class="title">' . $product['product_name'] . '</h4>
                    <p class="description">' . $product['product_description'] . '</p>
                    <p class="controls">
                      <span class="btn btn-default price">DKK ' . $product['product_price'] . '</span>
                      <a href="#" class="btn btn-primary" role="button">Buy this</a>
                    </p>
                  </div>
                </div>
              </div>
            ';
          }
        };

        ?>
      </div>
    </div>
  </div>
</div>

<?php if(!$general->adminLoggedIn()) { ?>
<a href="views/vendors/get-started.php" id="vendorTease">
  Partner with us
</a>
<?php } ?>

<?php include_once 'footer.php'; ?>