<?php
  session_start();
  include 'db.php';

  $id = $_GET['id'];

  // Fetch product from DB
  $result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
  $product = mysqli_fetch_assoc($result);

  if ($product) {
    // Store in session cart
    $_SESSION['cart'][] = [
      'id'    => $product['id'],
      'name'  => $product['name'],
      'price' => $product['price'],
      'image' => $product['image']
    ];
  }

  mysqli_close($conn);

  // Redirect back to shop
  header("Location: index.php");
  exit();
?>