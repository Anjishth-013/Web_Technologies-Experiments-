<?php
  session_start();

  // Clear only cart from session
  unset($_SESSION['cart']);

  header("Location: cart.php");
  exit();
?>