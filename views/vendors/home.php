<?php

include_once '../../config/init.php';
$general->vendorLoggedOutProtect();

$vendorId = $vendor['vendor_id'];
$vendorName = $vendor['vendor_name'];
$vendorApiPath = $vendor['vendor_url'];

// UPLOAD API PATH
if (isset($_POST['apiPathSubmit'])) {

  if(empty($_POST['apiPath'])) {

    $errors[] = 'You need to enter the path to your API (JSON or XML)';

  } else {

    // Check if path to API is .json or .xml
    if ( substr($_POST['apiPath'],-5) == ".json" || substr($_POST['apiPath'],-4) == ".xml" ) {

      $apiPath = htmlentities($_POST['apiPath']);
      $vendors->uploadPathToApi($apiPath, $vendor['vendor_id']);
      $update->vendorProductsToDb($vendor['vendor_id']);

      header('Location: home.php?api-updated');
      exit();

    } else {
      $errors[] = 'It looks like the path to your API is not JSON or XML.';
    }
  }
}

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
    <div class="col-md-9">
      <div class="row">
        <div role="tabpanel">

          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#myProducts" aria-controls="myProducts" role="tab" data-toggle="tab">My products</a></li>
          </ul>

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="myProducts">

              <?php

              $vendorProducts = $products->getVendorProductsByVendorId($vendorId);

              foreach ($vendorProducts as $product) {
                echo '
                  <div class="col-md-4">
                    <div class="thumbnail product">
                      <div class="image" style="background: url(' . $product['product_image_url'] . ') no-repeat center; background-size:100%"></div>
                      <div class="caption text-center">
                        <h4 class="title">' . $product['product_name'] . '</h4>
                        <p class="description">' . $product['product_description'] . '</p>
                        <p class="controls">
                          <span class="btn btn-default price">DKK ' . $product['product_price'] . '</span>
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
    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">Path to your API</div>
            </div>
            <div class="panel-body">
              <form accept-charset="UTF-8" role="form" method="post">
                <div class="form-group">
                  <input type="url" name="apiPath" class="form-control" placeholder="JSON or XML" value="<?php echo $vendorApiPath ?>"/>
                </div>
                <input type="submit" name="apiPathSubmit" value="SAVE API PATH" class="btn btn-primary btn-block btn-lg"/>
              </form>
            </div>
            <?php
            if(empty($errors) === false){
              echo '<div class="panel-footer"><div class="alert alert-danger">' . implode($errors) . '</div></div>';
            }
            ?>
          </div>
        </div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">Your orders</div>
            </div>
            <div class="panel-body">
              orders received by partner here
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

include_once '../../footer.php';
ob_flush();

?>