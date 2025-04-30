<?php
include '../database.php';

if (!isset($_GET['id'])) {
  echo "No product selected.";
  exit;
}

$product_id = $_GET['id'];
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
  echo "Product not found.";
  exit;
}

$product = mysqli_fetch_assoc($result);
$category = $product['category'];

$related_query = "SELECT * FROM products LIMIT 7";
$related_result = mysqli_query($conn, $related_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];
  $product_name = $_POST['product_name'];  // Get product_name from the form

  $created_at = date("Y-m-d H:i:s");

  $stmt = mysqli_prepare($conn, "INSERT INTO inquiry (name, email, phone, message, product_name, created_at) VALUES (?, ?, ?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, 'ssssss', $name, $email, $phone, $message, $product_name, $created_at);

  if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Product inquiry successfully submitted!'); window.location.href='product_details.php?id=$product_id';</script>";
  } else {
    echo "Database error: " . mysqli_error($conn);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($product['product_name']) ?> - Product Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/product_details.css?v=1.0">
  </head>
<header>
  <?php include "header.php"; ?>
</header>
<body>
  

  <!-- Main Product Section -->
  <div class="product-section">
    <div class="product-wrapper">
      <div class="product-image">
        <img id="mainImage" src="../image/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">

        <div class="thumbnail-container">
          <img class="thumbnail" src="../image/<?= htmlspecialchars($product['image']) ?>" alt="Main Image" onclick="changeImage(this)">
          <?php if (!empty($product['image2'])): ?>
            <img class="thumbnail" src="../image/<?= htmlspecialchars($product['image2']) ?>" alt="Image 2" onclick="changeImage(this)">
          <?php endif; ?>
          <?php if (!empty($product['image3'])): ?>
            <img class="thumbnail" src="../image/<?= htmlspecialchars($product['image3']) ?>" alt="Image 3" onclick="changeImage(this)">
          <?php endif; ?>
        </div>
      </div>

      <div class="product-info">
        <h1><?= htmlspecialchars($product['product_name']) ?></h1>
        <p><strong>Category:</strong> <?= htmlspecialchars($product['category']) ?></p>
        <p><strong>Brand:</strong> <?= htmlspecialchars($product['brand_name']) ?></p>
        <p><strong>Unit:</strong> <?= htmlspecialchars($product['unit_of_measure']) ?></p>
        <p><strong>Weight:</strong> <?= htmlspecialchars($product['weight']) ?></p>
        <p><strong>Material:</strong> <?= htmlspecialchars($product['material_type']) ?></p>
        <p><strong>Description:</strong> <?= htmlspecialchars($product['description']) ?></p>

        <div class="button-group">
          <button class="inquire-btn" id="openModal">Inquire Now</button> 

          <form action="add_to_cart.php" method="POST">
          <input type="hidden" name="product_id" value="<?= $product_id ?>">
          <button type="submit" class="inquire-btn">Add to Cart</button>
        </form>
        </div>

        
        <a href="product_user.php" class="back-btn">← Back to Products</a>

      </div>
      
    </div>
  </div>

  <!-- Inquiry Modal -->
  <div id="inquiryModal" class="noble-modal">
    <div class="noble-modal-content">
      <span class="noble-close" onclick="document.getElementById('inquiryModal').style.display='none'">&times;</span>
      <h2 class="noble-modal-title">Product Inquiry</h2>
      <p class="noble-modal-subtitle">We’d love to hear from you. Please fill out the form below, and our team will get back to you shortly.</p>

      <form action="product_details.php?id=<?= $product_id ?>" method="POST" class="noble-form">
        <input type="hidden" name="id" value="<?= $product_id ?>">
        <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>">

        <div class="noble-form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" required>
        </div>

        <div class="noble-form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="noble-form-group">
          <label for="phone">Contact Number</label>
          <input type="number" id="phone" name="phone" required>
        </div>

        <div class="noble-form-group">
          <label for="message">Your Message</label>
          <textarea id="message" name="message" rows="4" required placeholder="Let us know what you’re interested in..."></textarea>
        </div>
        <p class="noble-modal-subtitle" style=" color: red;">*Note: We are a wholesale supplier and only accept bulk orders. Kindly fill out the form below and our team will respond promptly.*</p>


        <button type="submit" class="noble-submit-btn">Send Inquiry</button>
      </form>
    </div>
  </div>

  <!-- Related Products Section -->
  <?php if (mysqli_num_rows($related_result) > 0): ?>
    <div class="related-section-container">
      <div class="related-section">
        <h2>Related Products</h2>
        <div class="related-grid">
          <?php while ($related = mysqli_fetch_assoc($related_result)) : ?>
            <a href="product_details.php?id=<?= $related['product_id'] ?>" class="related-card">
              <img src="../image/<?= htmlspecialchars($related['image']) ?>" alt="<?= htmlspecialchars($related['product_name']) ?>">
              <h4><?= htmlspecialchars($related['product_name']) ?></h4>
              <p><?= htmlspecialchars($related['material_type']) ?></p>
            </a>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <style>

  </style>
      
</body>

<?php
 include 'footer.php';
?>
</html>


<script src="product_details.js"></script>

<script>
  function changeImage(element) {
    var mainImage = document.getElementById('mainImage');
    mainImage.src = element.src;
  }

  document.getElementById("openModal").onclick = function () {
    document.getElementById("inquiryModal").style.display = "block";
  };

  document.querySelector(".noble-close").onclick = function () {
    document.getElementById("inquiryModal").style.display = "none";
  };

  window.onclick = function (event) {
    if (event.target == document.getElementById("inquiryModal")) {
      document.getElementById("inquiryModal").style.display = "none";
    }
  };
</script>