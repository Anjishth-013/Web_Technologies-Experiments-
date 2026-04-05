<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Simple Shop</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    img { width: 100px; height: auto; border-radius: 8px; }
    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
    }
    th {
      background-color: #333;
      color: white;
      padding: 10px;
    }
    td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ccc;
    }
    tr:nth-child(even) { background-color: #f2f2f2; }
    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      color: white;
      text-decoration: none;
      font-size: 0.9em;
    }
    .btn-edit  { background-color: #f0a500; }
    .btn-delete { background-color: #e53935; }
    .btn-add   { background-color: #222; }
    .top-bar {
      text-align: center;
      margin: 20px;
    }
  </style>
</head>
<body>

<header>
  <h1 style="letter-spacing:2px; text-align:center;">🛍 Simple Shop</h1>
</header>

<hr>

<div class="top-bar">
  <h2>All Products</h2>
  <a href="add_product.php" class="btn btn-add">+ Add New Product</a>
</div>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Image</th>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>

<?php
  include 'db.php';

  $result = mysqli_query($conn, "SELECT * FROM products");

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td><img src='" . $row['image'] . "' alt='" . $row['name'] . "'></td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['description'] . "</td>";
      echo "<td style='color:green; font-weight:bold;'>₹" . $row['price'] . "</td>";
      echo "<td>
              <a href='edit_product.php?id=" . $row['id'] . "' class='btn btn-edit'>Edit</a>
              &nbsp;
              <a href='delete_product.php?id=" . $row['id'] . "' class='btn btn-delete'
                onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
            </td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='6'>No products found. Add some!</td></tr>";
  }

  mysqli_close($conn);
?>

  </tbody>
</table>

</body>
</html>