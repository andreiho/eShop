<?php

include_once '../config/init.php';
$general->logged_in_protect();

?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Confirm Partner | eShop</title>
  <link rel="shortcut icon" href="../images/ico/favicon.ico">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/font-awesome.min.css" rel="stylesheet">
  <link href="../css/main.css" rel="stylesheet">
</head>

<body class="eShop activate">
<?php include_once '../header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">Congratulations!</div>
        </div>
        <div class="panel-body">
          <strong>A new partner account has been successfully activated.</strong>
          <br><br>
          You can inform the new partner that they can start using their account now.
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <div class="panel-title">Become a partner</div>
        </div>
        <div class="panel-body">
          Sign up as a partner shop and feature your own products on our website.
          <br><br>
          <i class="fa fa-star fa-2x"></i>
          <br><br>
          We offer low commision, 24/7 support and permanent backup of your products and orders.
        </div>
        <div class="panel-footer">
          <a href="partners/get-started.php" class="btn btn-primary btn-lg btn-block">Get Started Now</a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>