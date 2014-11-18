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
            <div class='text'>Are you sure you want to remove this product from the shop?</div>
          </div>
          <div class='col-md-3 text-right'>
            <a href='#' class='btn btn-primary' id="remove-product">Yes, remove</a>
            <button type='button' class='btn btn-default' data-dismiss='modal'>No, cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Enter Guest Customer Email -->
<div class='modal fade' id='guestCustomerCompleteOrder' tabindex='-1' role='dialog' aria-labelledby='guestCustomerCompleteOrder' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-body'>
        <div class='row'>
          <div class='col-md-9'>
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-4" id="order-details-image"></div>
                  <div class="col-md-8">
                    <h5><strong id="order-details-name"></strong></h5>
                    <p id="order-details-description"></p>
                    <span id="order-details-price" class="btn btn-default btn-xs price"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-6" style="border-left: 1px solid #eee">
                <div class="row">
                  <div class="col-md-10" style="padding-left: 30px">
                    <h5><strong>Guest customer</strong></h5>
                    <div style="margin-bottom: 10px">To complete your order, enter your e-mail address below:</div>
                    <div class="form-group">
                      <input type="email" id="guestCustomerEmailAddress" name="guestCustomerEmailAddress" class="form-control" placeholder="example@domain.com"/>
                    </div>
                    <a href="#" id="saveGuestCustomerEmailAddress" name="saveGuestCustomerEmailAddress" class="btn btn-primary btn-block btn-xs">Save e-mail address</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='col-md-3 text-right'>
            <a href="#" name="placeGuestOrder" class='btn btn-primary' id="place-order" style="visibility: hidden">Place order</a>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <?php
  if (isset($_GET['order-placed']) && empty($_GET['order-placed'])) {
    echo "<div class='alert alert-success registerSuccess'>
              <strong>Boom, your order has been placed. </strong>If the e-mail address you provided is valid, you should receive a confirmation of your order.
              Thank you for shopping with us.
          </div>";
  }
  ?>
  <div class="row">
    <div role="tabpanel">

      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#ownProducts" aria-controls="ownProducts" role="tab" data-toggle="tab">Our products</a></li>
        <li role="presentation"><a href="#partnerProducts" aria-controls="partnerProducts" role="tab" data-toggle="tab">Products from partners</a></li>
      </ul>

      <div class="tab-content">

        <div role="tabpanel" class="tab-pane fade in active" id="ownProducts">

          <?php

          $ownProducts = $products->getAllOwnProducts();

          foreach ($ownProducts as $product) {

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
                    <a href="#" data-toggle="modal" data-target="#guestCustomerCompleteOrder" class="btn btn-primary order-details" role="button"
                    data-product-id="' . $product['product_id'] . '"
                    data-product-vendor-id="' . $product['vendor_id'] . '"
                    data-product-name="' . $product['product_name'] . '"
                    data-product-description="' . $product['product_description'] . '"
                    data-product-image="' . $product['product_image_url'] . '"
                    data-product-price="' . $product['product_price'] . '">Buy this</a>
                  </p>
                </div>
              </div>
            </div>
          ';
            }
          };

          ?>

        </div>

        <div role="tabpanel" class="tab-pane fade" id="partnerProducts">

          <?php

          $vendorProducts = $products->getAllVendorProducts();

          foreach ($vendorProducts as $product) {

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
                    <a href="#" data-toggle="modal" data-target="#guestCustomerEmail" class="btn btn-primary" role="button">Buy this</a>
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
</div>

<?php if(!$general->adminLoggedIn()) { ?>
<a href="views/vendors/get-started.php" id="vendorTease">
  Partner with us
</a>
<?php } ?>

<?php include_once 'footer.php'; ?>