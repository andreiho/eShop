<?php

include_once '../config/init.php';
$general->adminLoggedOutProtect();

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
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <div class="panel-title">Active users</div>
        </div>
        <div class="panel-body">
          list of users goes here
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <div class="panel-title">Active partners</div>
        </div>
        <div class="panel-body">
          list of partners goes here
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <div class="panel-title">Add a new product</div>
        </div>
        <div class="panel-body">
          <form accept-charset="UTF-8" role="form" method="post">
            <fieldset>
              <div class="form-group">
                <input type="text" name="newProductName" placeholder="name" class="form-control"/>
              </div>
              <div class="form-group">
                <input type="text" name="newProductPrice" placeholder="price" class="form-control" />
              </div>
              <div class="form-group">
                <input type="url" name="newProductImage" placeholder="image url" class="form-control" />
              </div>
              <div class="form-group">
                <textarea name="newProductDescription" placeholder="description" class="form-control" rows="3"></textarea>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="newProductSubmit">Add new product</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>