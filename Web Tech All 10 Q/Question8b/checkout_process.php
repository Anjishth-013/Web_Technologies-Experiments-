<!DOCTYPE html>
<html>
<head>
  <title>Order Result - Simple Shop</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .result-box {
      width: 450px;
      margin: 60px auto;
      padding: 25px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .success { background: #d4edda; color: #155724; }
    .error   { background: #f8d7da; color: #721c24; }
    a {
      display: inline-block;
      margin-top: 15px;
      color: #222;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<header>
  <h1 style="letter-spacing: 2px;">🛍 Simple Shop</h1>
</header>

<?php
  // Collect form data
  $fullname = trim($_POST['fullname']);
  $email    = trim($_POST['email']);
  $phone    = trim($_POST['phone']);
  $address  = trim($_POST['address']);
  $product  = trim($_POST['product']);
  $payment  = trim($_POST['payment']);

  // Validation
  $errors = [];

  if (empty($fullname)) {
    $errors[] = "Full name is required.";
  } elseif (strlen($fullname) < 3) {
    $errors[] = "Full name must be at least 3 characters.";
  }

  if (empty($email)) {
    $errors[] = "Email is required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }

  if (empty($phone)) {
    $errors[] = "Phone number is required.";
  } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
    $errors[] = "Phone must be exactly 10 digits.";
  }

  if (empty($address)) {
    $errors[] = "Delivery address is required.";
  }

  if (empty($product)) {
    $errors[] = "Please select a product.";
  }

  if (empty($payment)) {
    $errors[] = "Please select a payment method.";
  }

  // Show result
  if (count($errors) > 0) {
    echo '<div class="result-box error">';
    echo '<h2>❌ Order Failed</h2>';
    echo '<ul style="text-align:left;">';
    foreach ($errors as $error) {
      echo "<li>$error</li>";
    }
    echo '</ul>';
    echo '<a href="checkout.html">← Go Back</a>';
    echo '</div>';
  } else {
    echo '<div class="result-box success">';
    echo '<h2>✅ Order Placed Successfully!</h2>';
    echo "<p><strong>Name:</strong> $fullname</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Phone:</strong> $phone</p>";
    echo "<p><strong>Address:</strong> $address</p>";
    echo "<p><strong>Product:</strong> $product</p>";
    echo "<p><strong>Payment:</strong> $payment</p>";
    echo '<br><p>🚚 Your order will be delivered in 3-5 business days!</p>';
    echo '<a href="index.html">← Continue Shopping</a>';
    echo '</div>';
  }
?>

</body>
</html>