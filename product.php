<?php
include "config.php";
session_start();
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
?>
<h2><?= $product['name'] ?></h2>
<p><?= $product['description'] ?></p>
<p>\$<?= $product['price'] ?></p>
<form method="post" action="cart.php">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
    Quantity: <input type="number" name="quantity" value="1"><br>
    <button type="submit" name="add">Add to Cart</button>
</form>