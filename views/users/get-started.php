<?php

include_once '../../includes/init.php';
$general->logged_in_protect();

// LOGIN
if (isset($_POST['loginSubmit'])) {

  if (empty($_POST) === false) {

    $loginEmail = trim($_POST['loginEmail']);
    $loginPassword = trim($_POST['loginPassword']);

    if (empty($loginEmail) === true || empty($loginPassword) === true) {
      $loginErrors[] = 'Sorry, but we need both your e-mail and password.';
    } else if ($users->email_registered($loginEmail) === false) {
      $loginErrors[] = 'Oops, looks like that e-mail isn\'t registered.';
    } else if ($users->email_confirmed($loginEmail) === false) {
      $loginErrors[] = 'You need to activate your account. Please check your e-mail.';
    } else {

      $login = $users->login($loginEmail, $loginPassword);

      if ($login === false) {
        $loginErrors[] = 'Oops, seems like that e-mail/password is invalid.';
      } else {
        $_SESSION['id'] = $login;
        header('Location: home.php');
        exit();
      }
    }
  }
}

// REGISTRATION
if (isset($_POST['registerSubmit'])) {

  if(empty($_POST['registerEmail']) || empty($_POST['registerPassword'])){

    $registerErrors[] = 'All fields are required.';

  } else {
    if (filter_var($_POST['registerEmail'], FILTER_VALIDATE_EMAIL) === false) {
      $registerErrors[] = 'Please enter a valid e-mail address.';
    } else if ($users->email_exists($_POST['registerEmail']) === true) {
      $registerErrors[] = 'Darn, that e-mail address is already registered.';
    }
    if (strlen($_POST['registerPassword']) < 6){
      $registerErrors[] = 'Your password must be at least 6 characters long.';
    }
    if($_POST['registerPassword'] != $_POST['confirmRegisterPassword']){
      $registerErrors[] = 'Oops, looks like the passwords don\'t match.';
    }
  }

  if(empty($registerErrors) === true){

    $registerEmail = htmlentities($_POST['registerEmail']);
    $registerPassword = $_POST['registerPassword'];

    $users->register($registerEmail, $registerPassword);
    header('Location: get-started.php?success');
    exit();
  }
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register | eShop</title>
  <link rel="shortcut icon" href="../../images/ico/favicon.ico">
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/font-awesome.min.css" rel="stylesheet">
  <link href="../../css/main.css" rel="stylesheet">
</head>

<body class="eShop register">

<?php include_once '../../includes/header.php'; ?>

<div id="myAccount" class="container">
  <?php
  if (isset($_GET['success']) && empty($_GET['success'])) {
    echo "<div id='registerSuccess' class='alert alert-success'>
              <strong>Yay, you're in. </strong>If the e-mail address you entered is valid, you should receive an activation link.
              Follow that link to activate your account and start shopping.
          </div>";
  }
  ?>
  <div class="row">
    <!-- login -->
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Returning customer?</h3>
        </div>
        <div class="panel-body">
          <form accept-charset="UTF-8" role="form" method="post">
            <fieldset>
              <div class="form-group">
                <input type="text" name="loginEmail" placeholder="Your e-mail" class="form-control"
                       value="<?php if(isset($_POST['loginEmail'])) echo htmlentities($_POST['loginEmail']); ?>" />
              </div>
              <div class="form-group">
                <input type="password" name="loginPassword" placeholder="Your password" class="form-control" />
              </div>
              <div class="form-group">
                <a href="#" class="forgot-password">Forgot your password?</a>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="loginSubmit">Sign In</button>
            </fieldset>
          </form>
        </div>
        <?php
        if(empty($loginErrors) === false){
          echo '<div class="panel-footer"><div class="alert alert-danger">' . implode('</p><p>', $loginErrors) . '</div></div>';
        }
        ?>
      </div>
    </div>
    <div class="col-md-2">
      <div class="or">
        OR
      </div>
    </div>
    <!-- register -->
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">New customer?</h3>
        </div>
        <div class="panel-body">
          <form accept-charset="UTF-8" role="form" method="post">
            <fieldset>
              <div class="form-group">
                <input type="text" name="registerEmail" placeholder="Your e-mail" class="form-control"
                       value="<?php if(isset($_POST['registerEmail'])) echo htmlentities($_POST['registerEmail']); ?>" />
              </div>
              <div class="form-group">
                <input type="password" name="registerPassword" placeholder="Choose a password" class="form-control" />
              </div>
              <div class="form-group">
                <input type="password" name="confirmRegisterPassword" placeholder="Confirm your password" class="form-control" />
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="registerSubmit">Create Account</button>
            </fieldset>
          </form>
        </div>
        <?php
        if(empty($registerErrors) === false){
          echo '<div class="panel-footer"><div class="alert alert-danger">' . implode($registerErrors) . '</div></div>';
        }
        ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>

