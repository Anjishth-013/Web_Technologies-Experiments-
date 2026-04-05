<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>
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
      background: #f0a500;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      cursor: pointer;
      margin-top: 10px;
    }
    .form-box button:hover { background: #c68400; }
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

<h2 style="text-align:center;">Edit Product</h2>

<?php
  include 'db.php';

  $id = $_GET['id'];

  // Handle update
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price       = trim($_POST['price']);
    $image       = trim($_POST['image']);

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
      $sql = "UPDATE products
              SET name='$name', description='$description',
                  price='$price', image='$image'
              WHERE id='$id'";

      if (mysqli_query($conn, $sql)) {
        echo "<p class='success'>✅ Product updated successfully!</p>";
      } else {
        echo "<p class='error'>❌ Error: " . mysqli_error($conn) . "</p>";
      }
    }
  }

  // Fetch existing product data
  $result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
  $row = mysqli_fetch_assoc($result);
?>

<div class="form-box">
  <form method="POST" action="edit_product.php?id=<?php echo $id; ?>">

    <label>Product Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>">

    <label>Description:</label>
    <input type="text" name="description" value="<?php echo $row['description']; ?>">

    <label>Price (₹):</label>
    <input type="number" name="price" value="<?php echo $row['price']; ?>">

    <label>Image Filename:</label>
    <input type="text" name="image" value="<?php echo $row['image']; ?>">

    <button type="submit">Update Product</button>

  </form>
</div>

<a href="index.php">← Back to Products</a>

<?php mysqli_close($conn); ?>

</body>
</html>