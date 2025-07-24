<?php
include "../config.php";
session_start();
echo "<h2>Admin Panel</h2>";
$result = $conn->query("SELECT * FROM orders");
while ($row = $result->fetch_assoc()) {
    echo "<p>Order #{$row['id']} | User: {$row['user_id']} | Total: \${$row['total_price']}</p>";
}
?>