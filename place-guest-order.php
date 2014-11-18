<?php

include_once 'config/init.php';
$general->userLoggedInProtect();
$general->vendorLoggedInProtect();

if (
  isset($_GET['productId']) === true &&
  isset($_GET['vendorId']) === true &&
  isset($_GET['userId']) === true &&
  isset($_GET['guestEmail']) === true
) {

  $productId = trim($_GET['productId']);
  $vendorId = trim($_GET['vendorId']);
  $userId = trim($_GET['userId']);
  $guestEmail = trim($_GET['guestEmail']);

  $placeGuestOrder = $orders->addNewOrder($vendorId, $userId, $productId);

  $orderConfirmationSubject = 'eShop - Order confirmation';
  $orderConfirmationBody = "Hi there,\r\n\r\nYour order has been placed and it is now being processed.\r\n\r\nThank you for shopping with us.\r\n\r\nThe eShop Team";


  if ($placeGuestOrder === false) {

    $errors[] = 'Sorry, but something went wrong and we couldn\'t place your order.';

  } else {

    mail($guestEmail, $orderConfirmationSubject, $orderConfirmationBody);

    header('Location: /index.php?order-placed');
    exit();

  }

}