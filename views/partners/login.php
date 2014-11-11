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
  <title>Partner Login | eShop</title>
  <link rel="shortcut icon" href="../../images/ico/favicon.ico">
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/font-awesome.min.css" rel="stylesheet">
  <link href="../../css/main.css" rel="stylesheet">
</head>

<body class="eShop partners">
<?php include_once '../../header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">Login to your partner account</div>
        </div>
        <div class="panel-body">
          <form accept-charset="UTF-8" role="form" method="post">
            <div class="form-group">
              <label for="vendorLoginEmail" class="control-label">Your e-mail</label>
              <input type="email" class="form-control" id="vendorLoginEmail" name="vendorLoginEmail"/>
            </div>
            <div class="help-block">
              To login as a partner, you need to go through the secure verification login process.
            </div>
            <div class="help-block" style="margin-bottom: 20px">
              A unique code will be generated and e-mailed to you. Use that code when prompted to login to your account.
            </div>
            <input type="submit" name="vendorSendCodeSubmit" value="Send me the login code" class="btn btn-primary btn-block btn-lg"/>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <div class="panel-title">Not a partner yet?</div>
        </div>
        <div class="panel-body">
          You have an online shop and want to feature and sell your products
          on our website?
          <br/><br/>
          Then sign up as a partner of eShop and benefit.
          We offer great services at low cost.
        </div>
        <div class="panel-footer">
          <a href="/views/partners/get-started.php" class="btn btn-default btn-lg btn-block">Get Started Now</a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>