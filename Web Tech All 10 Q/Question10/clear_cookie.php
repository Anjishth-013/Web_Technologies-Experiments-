<?php
  // Delete cookie by setting expiry in the past
  setcookie("shop_user", "", time() - 3600, "/");

  header("Location: index.php");
  exit();
?>