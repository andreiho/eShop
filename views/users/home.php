<?php

include_once '../../config/init.php';
$general->userLoggedOutProtect();

$globalUserId = $user['user_id'];
$customerName = $user['user_name'];

?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Home | eShop</title>
  <link rel="shortcut icon" href="../../images/ico/favicon.ico">
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/font-awesome.min.css" rel="stylesheet">
  <link href="../../css/main.css" rel="stylesheet">
</head>

<body class="eShop home">
<?php include_once '../../header.php'; ?>

  <div class="container">
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

          <div role="tabpanel" class="tab-pane fade" id="partnerProducts">

            <?php

            $vendorProducts = $products->getAllVendorProducts();

            foreach ($vendorProducts as $product) {
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
            };

            ?>


          </div>
        </div>
      </div>
    </div>
  </div>

<?php

include_once '../../footer.php';
ob_flush();

?>