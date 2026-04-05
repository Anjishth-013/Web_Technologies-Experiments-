<!DOCTYPE html>
<html>
<head>
  <title>Contact Result - Cat House</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .result-box {
      width: 400px;
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

  <div class="navbar">
    <a href="index.html">Main Menu</a>
    <a href="contact.html">Contact</a>
  </div>

<?php
  // Collect form data
  $name    = trim($_POST['name']);
  $email   = trim($_POST['email']);
  $phone   = trim($_POST['phone']);
  $message = trim($_POST['message']);

  // Validation
  $errors = [];

  if (empty($name)) {
    $errors[] = "Name is required.";
  } elseif (strlen($name) < 3) {
    $errors[] = "Name must be at least 3 characters.";
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

  if (empty($message)) {
    $errors[] = "Message cannot be empty.";
  }

  // Show result
  if (count($errors) > 0) {
    echo '<div class="result-box error">';
    echo '<h2>❌ Validation Failed</h2>';
    echo '<ul style="text-align:left;">';
    foreach ($errors as $error) {
      echo "<li>$error</li>";
    }
    echo '</ul>';
    echo '<a href="contact.html">← Go Back</a>';
    echo '</div>';
  } else {
    echo '<div class="result-box success">';
    echo '<h2>✅ Message Sent Successfully!</h2>';
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Phone:</strong> $phone</p>";
    echo "<p><strong>Message:</strong> $message</p>";
    echo '<a href="contact.html">← Send Another Message</a>';
    echo '</div>';
  }
?>

</body>
</html>