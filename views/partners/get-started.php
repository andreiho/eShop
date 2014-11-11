<?php

include_once '../../config/init.php';
$general->logged_in_protect();

// REGISTRATION
if (isset($_POST['vendorRegisterSubmit'])) {

  if(
    empty($_POST['vendorRegisterName']) ||
    empty($_POST['vendorRegisterEmail']) ||
    empty($_POST['vendorRegisterCommission']) ||
    empty($_POST['vendorRegisterUrl'])
  ) {

    $vendorRegisterErrors[] = 'All fields are required.';

  } else {

    if (filter_var($_POST['vendorRegisterEmail'], FILTER_VALIDATE_EMAIL) === false) {
      $vendorRegisterErrors[] = 'Please enter a valid e-mail address.';
    } else if ($vendors->doesVendorRegisterEmailExist($_POST['vendorRegisterEmail']) === true) {
      $vendorRegisterErrors[] = 'Darn, that e-mail address is already registered.';
    }

  }

  if(empty($vendorRegisterErrors) === true){

    $vendorRegisterName = htmlentities($_POST['vendorRegisterName']);
    $vendorRegisterEmail = htmlentities($_POST['vendorRegisterEmail']);
    $vendorRegisterCommission = htmlentities($_POST['vendorRegisterCommission']);
    $vendorRegisterUrl = htmlentities($_POST['vendorRegisterUrl']);

    $vendors->registerVendor($vendorRegisterName, $vendorRegisterEmail, $vendorRegisterCommission, $vendorRegisterUrl);
    header('Location: get-started.php?success');
    exit();
  }
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Become a Partner | eShop</title>
  <link rel="shortcut icon" href="../../images/ico/favicon.ico">
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/font-awesome.min.css" rel="stylesheet">
  <link href="../../css/main.css" rel="stylesheet">
</head>

<body class="eShop partners">
<?php include_once '../../header.php'; ?>

<div class="container">
  <?php
  if (isset($_GET['success']) && empty($_GET['success'])) {
    echo "<div class='alert alert-success registerSuccess'>
              <strong>Thank you for signing up as a partner. </strong>We will notify you on the e-mail address you provided as soon as your account has been activated.
              In the meantime, <a href='../products'>browse some of our products.</a>
          </div>";
  }
  ?>
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">Become a Partner</div>
        </div>
        <div class="panel-body">
          <form accept-charset="UTF-8" role="form" method="post">
            <div class="form-group">
              <label for="vendorRegisterName" class="control-label">Shop name</label>
              <input type="text" id="vendorRegisterName" class="form-control" name="vendorRegisterName" placeholder="eg. Proshop"
                     value="<?php if(isset($_POST['vendorRegisterName'])) echo htmlentities($_POST['vendorRegisterName']); ?>"/>
            </div>
            <div class="form-group">
              <label for="vendorRegisterEmail" class="control-label">Official e-mail</label>
              <input type="email" id="vendorRegisterEmail" class="form-control" name="vendorRegisterEmail" placeholder="eg. contact@proshop.dk"
                     value="<?php if(isset($_POST['vendorRegisterEmail'])) echo htmlentities($_POST['vendorRegisterEmail']); ?>"/>
            </div>
            <div class="form-group">
              <label for="vendorRegisterCommission" class="control-label">Desired commission</label>
              <input type="text" id="vendorRegisterCommission" class="form-control" name="vendorRegisterCommission" placeholder="eg. 10%"
                     value="<?php if(isset($_POST['vendorRegisterCommission'])) echo htmlentities($_POST['vendorRegisterCommission']); ?>"/>
            </div>
            <div class="form-group">
              <label for="vendorRegisterUrl" class="control-label">URL to your API</label>
              <input type="url" id="vendorRegisterUrl" class="form-control" name="vendorRegisterUrl" placeholder="eg. http://yourshop.dk/products.json"
                     value="<?php if(isset($_POST['vendorRegisterUrl'])) echo htmlentities($_POST['vendorRegisterUrl']); ?>"/>
            </div>
            <input type="submit" name="vendorRegisterSubmit" value="I am ready" class="btn btn-primary btn-block btn-lg"/>
          </form>
        </div>
        <?php
        if(empty($vendorRegisterErrors) === false){
          echo '<div class="panel-footer"><div class="alert alert-danger">' . implode($vendorRegisterErrors) . '</div></div>';
        }
        ?>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title text-center">What do you get?</div>
        </div>
        <div class="panel-body">
          <p class="text-center">By signing up as a partner shop,
            you get the unique opportunity to feature and sell
            your own products on our website.</p>
          <br>
          <p><i class="fa fa-user fa-fw"></i> Your own partner account</p>
          <p><i class="fa fa-database fa-fw"></i> Unlimited no. of products</p>
          <p><i class="fa fa-support fa-fw"></i> 24/7 stellar support</p>
          <p><i class="fa fa-lock fa-fw"></i> State of the art security</p>
          <p><i class="fa fa-history fa-fw"></i> Permanent backup</p>
        </div>
      </div>
    </div>
  </div>

</body>
</html>