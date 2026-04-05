<?php
  include 'db.php';

  $id = $_GET['id'];

  $sql = "DELETE FROM products WHERE id='$id'";

  if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
    exit();
  } else {
    echo "Error deleting product: " . mysqli_error($conn);
  }

  mysqli_close($conn);
?>