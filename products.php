<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Computer Store</a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
      <?php if(isset($_SESSION['user_id'])): ?>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<!-- PRODUCTS GRID -->
<div class="container mt-4">
  <h2 class="text-center mb-4">Browse Products</h2>
  <div class="row">
    <?php
    $result = $conn->query("SELECT * FROM products");
    while ($row = $result->fetch_assoc()) {
    ?>
      <div class="col-md-4">
        <div class="card mb-4 shadow">
          <img src="<?= $row['image_url'] ?>" class="card-img-top" alt="<?= $row['name'] ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $row['name'] ?></h5>
            <p class="card-text"><?= $row['description'] ?></p>
            <p class="text-success fw-bold">$<?= $row['price'] ?></p>
            <?php if(isset($_SESSION['user_id'])): ?>
              <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                <input type="number" name="quantity" value="1" min="1" class="form-control w-50 mb-2">
                <button type="submit" name="add" class="btn btn-primary w-100">Add to Cart</button>
              </form>
            <?php else: ?>
              <p class="text-muted">Login to add to cart</p>
            <?php endif; ?>
            <a href="product.php?id=<?= $row['id'] ?>" class="btn btn-outline-secondary mt-2 w-100">View Details</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

</body>
</html>