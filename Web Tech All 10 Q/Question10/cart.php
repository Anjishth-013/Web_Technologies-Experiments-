<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    table {
      width: 70%;
      margin: 30px auto;
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
    img { width: 70px; border-radius: 6px; }
    .total {
      text-align: right;
      width: 70%;
      margin: 0 auto 20px;
      font-size: 1.2em;
      font-weight: bold;
      color: green;
    }
    .btn {
      display: inline-block;
      padding: 8px 16px;
      border-radius: 5px;
      color: white;
      text-decoration: none;
      border: none;
      cursor: pointer;
      font-size: 1em;
    }
    .btn-back  { background: #333; }
    .btn-clear { background: #e53935; }
    .center { text-align: center; margin-top: 15px; }
  </style>
</head>
<body>

<header>
  <h1 style="text-align:center; letter-spacing:2px;">🛍 Simple Shop</h1>
</header>

<hr>

<h2 style="text-align:center;">🛒 Your Cart</h2>

<?php
  // Cookie: show username
  if (isset($_COOKIE['shop_user'])) {
    echo "<p style='text-align:center;'>Logged in as: <strong>"
      . htmlspecialchars($_COOKIE['shop_user']) . "</strong></p>";
  }

  if (empty($_SESSION['cart'])): ?>
    <p style="text-align:center;">Your cart is empty!</p>
  <?php else: ?>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Image</th>
          <th>Product</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $total = 0;
          $i = 1;
          foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'];
            echo "<tr>
              <td>$i</td>
              <td><img src='" . $item['image'] . "' alt='" . $item['name'] . "'></td>
              <td>" . $item['name'] . "</td>
              <td style='color:green; font-weight:bold;'>₹" . $item['price'] . "</td>
            </tr>";
            $i++;
          }
        ?>
      </tbody>
    </table>

    <div class="total">Total: ₹<?php echo number_format($total, 2); ?></div>

<?php endif; ?>

<div class="center">
  <a href="index.php" class="btn btn-back">← Continue Shopping</a>
  &nbsp;
  <a href="clear_cart.php" class="btn btn-clear">🗑 Clear Cart</a>
</div>

</body>
</html>