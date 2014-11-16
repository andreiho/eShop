<?php

include_once '../../config/init.php';
$general->vendorLoggedOutProtect();

$globalVendorId = $vendor['vendor_id'];
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
        <div class="col-md-4">
          vendor product here
        </div>
        <div class="col-md-4">
          vendor product here
        </div>
        <div class="col-md-4">
          vendor product here
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