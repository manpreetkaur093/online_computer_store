<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    echo "<div class='alert alert-warning'>Please log in first.</div>";
    exit;
}

$uid = $_SESSION['user_id'];


$total = 0;
$stmt = $conn->prepare("SELECT products.price, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?");
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $total += $row['price'] * $row['quantity'];
}


$stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, order_date) VALUES (?, ?, NOW())");
$stmt->bind_param("id", $uid, $total);
$stmt->execute();


$conn->query("DELETE FROM cart WHERE user_id = $uid");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2>✅ Order Placed Successfully!</h2>
  <p class="lead">Your total is <strong>$<?= number_format($total, 2) ?></strong></p>

  <div class="card mt-4">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Enter Payment Details</h5>
    </div>
    <div class="card-body">
      <form method="post" action="thank_you.php">
        <div class="mb-3">
          <label>Card Number</label>
          <input type="text" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" required>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label>Expiry Date</label>
            <input type="text" name="expiry" class="form-control" placeholder="MM/YY" required>
          </div>
          <div class="col-md-6">
            <label>CVV</label>
            <input type="text" name="cvv" class="form-control" placeholder="123" required>
          </div>
        </div>
        <button type="submit" class="btn btn-success w-100">Pay Now</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>