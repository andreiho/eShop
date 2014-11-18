<?php

include_once '../config/init.php';
$general->adminLoggedOutProtect();

// ADD NEW PRODUCT
if (isset($_POST['newProductSubmit'])) {

  if(
    empty($_POST['newProductName']) ||
    empty($_POST['newProductDescription']) ||
    empty($_POST['newProductImageUrl']) ||
    empty($_POST['newProductPrice'])
  ) {

    $productErrors[] = 'All fields are required.<br>';

  } else if(
    !empty($_POST['newProductName']) &&
    !empty($_POST['newProductDescription']) &&
    !empty($_POST['newProductImageUrl']) &&
    !empty($_POST['newProductPrice'])
  ) {

    $newProductImageUrl = $_POST['newProductImageUrl'];

    $newProductImageName = basename($newProductImageUrl);
    list($newProductImageNameText, $newProductImageNameExtension) = explode(".", $newProductImageName);
    $newProductImageName = $newProductImageNameText.time();
    $newProductImageName = $newProductImageName . "." . $newProductImageNameExtension;

    if(
      $newProductImageNameExtension == "jpg" or
      $newProductImageNameExtension == "jpeg" or
      $newProductImageNameExtension == "png" or
      $newProductImageNameExtension == "gif"
    ) {

      $newProductImageUpload = file_put_contents("../images/products/$newProductImageName",file_get_contents($newProductImageUrl));

    } else {

      $productErrors[] = 'Please only upload image files. Allowed extensions: .jpg, .jpeg, .png or .gif.<br>';

    }

    $newProductName = htmlentities($_POST['newProductName']);
    $newProductDescription = htmlentities($_POST['newProductDescription']);
    $newProductPrice = htmlentities($_POST['newProductPrice']);

    $products->addNewOwnProduct($newProductName, $newProductDescription, $newProductImageUrl, $newProductPrice);
    $update->ownProductsToJSON();
    $update->ownProductsToXML();

    header('Location: home.php?product-added');
    exit();

  }
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Panel | eShop</title>
  <link rel="shortcut icon" href="../images/ico/favicon.ico">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/main.css" rel="stylesheet">
</head>

<body class="eShop admin">
<?php include_once '../header.php'; ?>

<div class="container">
  <?php
  if (isset($_GET['product-added']) && empty($_GET['product-added'])) {
    echo "<div class='alert alert-success registerSuccess'>
              <strong>Yay, well done. </strong>A new product has been added successfully to your shop.
          </div>";
  }
  ?>
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">Add a new product</div>
            </div>
            <div class="panel-body">
              <form accept-charset="UTF-8" role="form" method="post">
                <fieldset>
                  <div class="form-group">
                    <input type="text" name="newProductName" placeholder="name" class="form-control" autofocus/>
                  </div>
                  <div class="form-group">
                    <input type="text" name="newProductPrice" placeholder="price" class="form-control" />
                  </div>
                  <div class="form-group">
                    <input type="url" name="newProductImageUrl" placeholder="image url" class="form-control" />
                  </div>
                  <div class="form-group">
                    <textarea name="newProductDescription" placeholder="description" class="form-control" rows="2"></textarea>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block" type="submit" name="newProductSubmit">Add new product</button>
                </fieldset>
              </form>
            </div>
            <?php
            if(empty($productErrors) === false){
              echo '<div class="panel-footer"><div class="alert alert-danger">' . implode($productErrors) . '</div></div>';
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">our orders</div>
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                <tr>
                  <th>id</th>
                  <th>order placed</th>
                </tr>
                </thead>
                <tbody class="text-left">
                <?php
                $ourOrders = $orders->getAllOwnOrders();

                foreach ($ourOrders as $order) {
                  echo '
                    <tr>
                      <td>' . $order['order_id'] . '</td>
                      <td>' . date('d-m-Y, H:m', $order['order_time']) . '</td>
                    </tr>
                  ';
                }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">partner orders</div>
            </div>
            <div class="panel-body">
              eshop orders go here
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">Active users</div>
            </div>
            <div class="panel-body">

              <table class="table">
                <thead>
                <tr>
                  <th>#</th>
                  <th>name</th>
                  <th>e-mail</th>
                </tr>
                </thead>
                <tbody class="text-left">
                <?php
                $allUsers = $users->getAllUsers();

                $n = 1;

                foreach ($allUsers as $user) {
                  echo '
                    <tr>
                      <td>' . $n . '</td>
                      <td>' . $user['user_name'] . '</td>
                      <td>' . $user['user_email'] . '</td>
                    </tr>
                  ';
                  $n++;
                }
                ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-title">Active partners</div>
            </div>
            <div class="panel-body">
              <table class="table">
                <thead>
                <tr>
                  <th>#</th>
                  <th>shop name</th>
                  <th>shop email</th>
                </tr>
                </thead>
                <tbody class="text-left">
                  <?php
                  $allVendors = $vendors->getAllVendors();

                  $n = 1;

                  foreach ($allVendors as $vendor) {
                    echo '
                    <tr>
                      <td>' . $n . '</td>
                      <td>' . $vendor['vendor_name'] . '</td>
                      <td>' . $vendor['vendor_email'] . '</td>
                    </tr>
                  ';
                    $n++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

include_once '../footer.php';
ob_flush();

?>