<?php
session_start();
include "config.php";


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add']) && isset($_SESSION['user_id'])) {
    $pid = intval($_POST['product_id']);
    $qty = max(1, intval($_POST['quantity']));
    $uid = $_SESSION['user_id'];

    
    $check = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $check->bind_param("ii", $uid, $pid);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        
        $check->bind_result($existing_qty);
        $check->fetch();
        $new_qty = $existing_qty + $qty;

        $update = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $update->bind_param("iii", $new_qty, $uid, $pid);
        $update->execute();
    } else {
        
        $insert = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insert->bind_param("iii", $uid, $pid, $qty);
        $insert->execute();
    }

    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Computer Store</a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4">🛒 Your Shopping Cart</h2>

    <?php
    if (!isset($_SESSION['user_id'])) {
        echo "<div class='alert alert-warning'>Please log in to view your cart.</div>";
    } else {
        $uid = $_SESSION['user_id'];

        $stmt = $conn->prepare("
            SELECT cart.id, products.name, products.image_url, products.price, cart.quantity
            FROM cart
            JOIN products ON cart.product_id = products.id
            WHERE cart.user_id = ?");
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo "<p>Your cart is empty.</p>";
        } else {
            echo "<table class='table table-bordered align-middle'>";
            echo "<thead><tr><th>Image</th><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr></thead><tbody>";

            $grand_total = 0;
            while ($row = $result->fetch_assoc()) {
                $total = $row['price'] * $row['quantity'];
                $grand_total += $total;

                echo "<tr>
                    <td><img src='{$row['image_url']}' alt='{$row['name']}' style='height:60px;'></td>
                    <td>{$row['name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>\${$row['price']}</td>
                    <td>\$" . number_format($total, 2) . "</td>
                </tr>";
            }

            echo "</tbody></table>";
            echo "<h4 class='text-end'>Grand Total: \$" . number_format($grand_total, 2) . "</h4>";
            echo "<div class='text-end'><a href='checkout.php' class='btn btn-success'>Proceed to Checkout</a></div>";
        }
    }
    ?>
</div>

</body>
</html>