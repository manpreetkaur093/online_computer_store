<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thank You</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5 text-center">
    <div class="card shadow-sm">
      <div class="card-body">
        <h1 class="text-success mb-4">🎉 Thank You for Your Order!</h1>
        <p class="lead">Your payment was processed successfully and your order is confirmed.</p>
        <p>We will keep you updated as we prepare your products for shipping.</p>
        <a href="index.php" class="btn btn-primary mt-4">Return to Home</a>
      </div>
    </div>
  </div>
</body>
</html>