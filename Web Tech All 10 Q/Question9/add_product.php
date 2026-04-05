<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .form-box {
      width: 420px;
      margin: 40px auto;
      padding: 25px;
      background: #f4f6f8;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .form-box input {
      width: 95%;
      margin: 8px 0;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #aaa;
      font-size: 1em;
    }
    .form-box button {
      width: 100%;
      padding: 10px;
      background: #333;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      cursor: pointer;
      margin-top: 10px;
    }
    .form-box button:hover { background: #555; }
    .error   { color: red; text-align: center; }
    .success { color: green; text-align: center; }
    a { display:block; text-align:center; margin-top:10px; color:#333; }
  </style>
</head>
<body>

<header>
  <h1 style="text-align:center; letter-spacing:2px;">🛍 Simple Shop</h1>
</header>

<hr>

<h2 style="text-align:center;">Add New Product</h2>

<?php
  $msg = "";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';

    $name        = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price       = trim($_POST['price']);
    $image       = trim($_POST['image']);

    // Validation
    $errors = [];

    if (empty($name))
      $errors[] = "Product name is required.";

    if (empty($description))
      $errors[] = "Description is required.";

    if (empty($price) || !is_numeric($price) || $price <= 0)
      $errors[] = "Enter a valid price.";

    if (empty($image))
      $errors[] = "Image filename is required.";

    if (count($errors) > 0) {
      foreach ($errors as $e) {
        echo "<p class='error'>❌ $e</p>";
      }
    } else {
      $sql = "INSERT INTO products (name, description, price, image)
              VALUES ('$name', '$description', '$price', '$image')";

      if (mysqli_query($conn, $sql)) {
        echo "<p class='success'>✅ Product added successfully!</p>";
      } else {
        echo "<p class='error'>❌ Error: " . mysqli_error($conn) . "</p>";
      }
    }

    mysqli_close($conn);
  }
?>

<div class="form-box">
  <form method="POST" action="add_product.php">

    <label>Product Name:</label>
    <input type="text" name="name" placeholder="e.g. Wireless Headphones">

    <label>Description:</label>
    <input type="text" name="description" placeholder="Short description">

    <label>Price (₹):</label>
    <input type="number" name="price" placeholder="e.g. 2999">

    <label>Image Filename:</label>
    <input type="text" name="image" placeholder="e.g. headphones.png">

    <button type="submit">Add Product</button>

  </form>
</div>

<a href="index.php">← Back to Products</a>

</body>
</html>