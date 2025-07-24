<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Online Computer Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hero {
      background: url('images/hero-banner.jpg') no-repeat center center;
      background-size: cover;
      height: 400px;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .feature-card img {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Computer Store</a>
    <ul class="navbar-nav ms-auto">
      <?php if(isset($_SESSION['user_id'])): ?>
        <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>


<div class="hero">
  <div>
    <h1 class="display-4">Build Your Dream Setup</h1>
    <p class="lead">Top-tier desktops, laptops, and accessories</p>
    <a href="products.php" class="btn btn-primary btn-lg">Shop Now</a>
  </div>
</div>


<div class="container mt-5">
  <h2 class="text-center mb-4">Featured Categories</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card feature-card shadow">
        <img src="images/laptop.jpg" class="card-img-top" alt="Laptops">
        <div class="card-body">
          <h5 class="card-title">Laptops</h5>
          <p class="card-text">Portable power for work, gaming, or school.</p>
          <a href="products.php?category=laptops" class="btn btn-outline-primary">Browse Laptops</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card feature-card shadow">
        <img src="images/desktop.jpg" class="card-img-top" alt="Desktops">
        <div class="card-body">
          <h5 class="card-title">Desktops</h5>
          <p class="card-text">Performance-packed machines for creators and gamers.</p>
          <a href="products.php?category=desktops" class="btn btn-outline-primary">Browse Desktops</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card feature-card shadow">
        <img src="images/acessories.jpg" class="card-img-top" alt="Accessories">
        <div class="card-body">
          <h5 class="card-title">Accessories</h5>
          <p class="card-text">Keyboards, mice, headsets, and more to complete your setup.</p>
          <a href="products.php?category=accessories" class="btn btn-outline-primary">Browse Accessories</a>
        </div>
      </div>
    </div>
  </div>
</div>


<footer class="bg-dark text-white text-center py-3 mt-5">
  &copy; <?= date('Y') ?> Online Computer Store. All rights reserved.
</footer>

</body>
</html>