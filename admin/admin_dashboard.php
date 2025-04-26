<?php
include '../database.php';

$productCount = 0;
$convoCount = 0;

// Get product count
$productSql = "SELECT COUNT(*) AS total FROM products";
$productResult = $conn->query($productSql);
if ($productResult) {
  $row = $productResult->fetch_assoc();
  $productCount = $row['total'];
}

// Get conversation count
$convoSql = "SELECT COUNT(*) AS total FROM inquiry";
$convoResult = $conn->query($convoSql);
if ($convoResult) {
  $row = $convoResult->fetch_assoc();
  $convoCount = $row['total'];
}

// Get conversation count
$bookingSql = "SELECT COUNT(*) AS total FROM booking";
$bookingResult = $conn->query($bookingSql);
if ($bookingResult) {
  $row = $bookingResult->fetch_assoc();
  $bookingCount = $row['total'];
}

$conn->close();

include 'sidebar_admin.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Noble Home Dashboard</title>
  <link rel="stylesheet" href="../css/admin_dashboard.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
  
</style>
<body class="bg-gray-100 font-sans">
  <div class="flex h-screen">
    

    <main class="main-content">
      <div class="header">
        <h1>Dashboard</h1>
        <p>Overview of your activity</p>
      </div>

<div class="stats">
  <div class="card blue-card">
    <div>
      <h4>Products</h4>
      <p><?= $productCount ?></p>
    </div>
    <div class="icon">📦</div>
  </div>
  

  <div class="card green-card">
    <div>
      <h4>Messages</h4>
      <p><?= $convoCount ?></p>
    </div>
    <div class="icon">💬</div>
  </div>

  <div class="card green-card">
    <div>
      <h4>Appointment</h4>
      <p><?= $bookingCount ?></p>
    </div>
    <div class="icon">📅</div>
  </div>
</div>

<h2 class="section-heading">Latest Products</h2>
<div class="product-grid">
 
 <?php
    include '../database.php';
    $latestQuery = "SELECT product_name, description, image FROM products ORDER BY product_id DESC LIMIT 6";
    $latestResult = $conn->query($latestQuery);

    if ($latestResult && $latestResult->num_rows > 0) {
      while ($product = $latestResult->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<img src="../image/' . htmlspecialchars($product['image']) . '" alt="Product Image" style="width: 100%; height: 350px; object-fit: cover; border-radius: 8px; margin-bottom: 0.5rem;">';
        echo '<h3>' . htmlspecialchars($product['product_name']) . '</h3>';
        echo '<p>' . htmlspecialchars($product['description']) . '</p>';
        echo '</div>';
      }
    } else {
      echo '<p>No products found.</p>';
    }
  ?>
</div>

</body>
</html>
