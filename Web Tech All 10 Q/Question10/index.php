<?php
  session_start();

  // Cookie: remember username for 7 days
  $username = "";
  if (isset($_POST['setname'])) {
    $username = $_POST['username'];
    setcookie("shop_user", $username, time() + (7 * 24 * 60 * 60), "/");
    // Immediately available this request
    $_COOKIE['shop_user'] = $username;
  }

  if (isset($_COOKIE['shop_user'])) {
    $username = $_COOKIE['shop_user'];
  }

  // Initialize cart session
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
?>
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
      padding: 6px 14px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      color: white;
      font-size: 0.9em;
    }
    .btn-cart    { background-color: #333; }
    .btn-cart:hover { background-color: #555; }
    .welcome-box {
      width: 400px;
      margin: 15px auto;
      padding: 15px;
      background: #eef2ff;
      border-radius: 8px;
      text-align: center;
    }
    .welcome-box input {
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #aaa;
      font-size: 1em;
      width: 60%;
    }
    .welcome-box button {
      padding: 8px 14px;
      background: #333;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 5px;
    }
    .cart-bar {
      text-align: center;
      margin: 10px;
      font-size: 1.1em;
    }
    .cart-bar a {
      color: #f0a500;
      font-weight: bold;
      text-decoration: none;
      margin-left: 10px;
    }
  </style>
</head>
<body>

<header>
  <h1 style="letter-spacing:2px; text-align:center;">🛍 Simple Shop</h1>
</header>

<hr>

<!-- Cookie: username greeting -->
<div class="welcome-box">
  <?php if (!empty($username)): ?>
    <p>👋 Welcome back, <strong><?php echo htmlspecialchars($username); ?></strong>!
      <a href="clear_cookie.php" style="color:red; font-size:0.85em;">Forget me</a>
    </p>
  <?php else: ?>
    <p>Enter your name so we can remember you!</p>
    <form method="POST" action="index.php">
      <input type="text" name="username" placeholder="Your name...">
      <button type="submit" name="setname">Save</button>
    </form>
  <?php endif; ?>
</div>

<!-- Session: cart count -->
<div class="cart-bar">
  🛒 Cart: <strong><?php echo count($_SESSION['cart']); ?> item(s)</strong>
  <a href="cart.php">View Cart</a>
</div>

<hr>

<h2 style="text-align:center;">Products</h2>

<table>
  <thead>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

<?php
  include 'db.php';
  $result = mysqli_query($conn, "SELECT * FROM products");

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
      <td><img src='" . $row['image'] . "' alt='" . $row['name'] . "'></td>
      <td>" . $row['name'] . "</td>
      <td>" . $row['description'] . "</td>
      <td style='color:green; font-weight:bold;'>₹" . $row['price'] . "</td>
      <td>
        <a href='add_to_cart.php?id=" . $row['id'] . "' class='btn btn-cart'>Add to Cart</a>
      </td>
    </tr>";
  }
  mysqli_close($conn);
?>

  </tbody>
</table>

</body>
</html>