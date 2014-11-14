<?php

include_once '../../config/init.php';
$general->userLoggedOutProtect();

/*$globalUserId = $user['userId'];
$globalVendorId = $vendor['vendorId'];*/

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
    <div class="col-md-12">
      THIS IS HOME SEEN BY USERS.
    </div>
  </div>
</div>

</body>
</html>