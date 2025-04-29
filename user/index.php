<?php
include '../database.php';

$query = "
  SELECT p.*
  FROM products p
  INNER JOIN (
    SELECT MIN(product_id) AS min_id
    FROM products
    GROUP BY category
  ) first_products ON p.product_id = first_products.min_id
";

$result = mysqli_query($conn, $query);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact']) && $_POST['contact'] == 'contact') {
  // Get form data
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);
  $contact = trim($_POST['contact']);
  $phone = trim($_POST['phone']);
  $created_at = date('Y-m-d H:i:s'); // Set current date and time

  // Simple validation (check if fields are not empty)
  if (!empty($name) && !empty($email) && !empty($message)) {
      // Validate email format
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          // Prepare SQL query to insert data into inquiries table
          $query = "INSERT INTO inquiry (name, phone, email, message, created_at, product_name) 
                    VALUES (?, ?, ?, ?, ?, ?)";
          
          // Prepare the statement
          $stmt = $conn->prepare($query);
          $stmt->bind_param("sissss", $name, $phone, $email, $message, $created_at, $contact);
          
          // Execute the query
          if ($stmt->execute()) {
              echo "<script>alert('Your message has been sent successfully!'); window.location.href='index.php';</script>";
          } else {
              echo "<script>alert('Failed to submit your inquiry. Please try again later.');</script>";
          }

          // Close the prepared statement
          $stmt->close();
      } else {
          echo "<script>alert('Please enter a valid email address.');</script>";
      }
  } else {
      echo "<script>alert('Please fill in all the fields.');</script>";
  }
}

// Close the database connection
$conn->close();
?>


<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Noble Home Corp.
  </title>
  <link href="../css/index.css?v=2.0" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <script src="index.js"></script>

 </head>

  <header>
    <?php include "header.php";?>
  </header>
 <body>

 <!-- intro slide show -->

 <section class="hero">
  <div class="hero-slideshow">
    <img 
      alt="Group of workers" 
      src="https://images.unsplash.com/photo-1698536946246-79ec6e017fe1?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y29uc3RydWN0aW9uJTIwc2l0ZSUyMGJhY2tncm91bmR8ZW58MHx8MHx8fDA%3D" 
      class="active"
    >
    <img 
      alt="Workplace" 
      src="../image/asdfg.png"
      
    >
  </div>

  <div class="hero-content">
    <h1>MODERN FURNISHING SUPPLIES</h1>
    <p>
      Turn Your Vision Into Reality — Decorate Your Dreams with NobleHome’s Timeless Style and Trusted Strength.
    </p>
  </div>
</section>
  

<!-- picture slideshow -->

<section class="more-than-steel">
  <section class="construction-section">
    <div class="construction-images">
      <img src="../image/product1.jpg" alt="Image 1" class="construction-img active">
      <img src="../image/product2.jpg" alt="Image 2" class="construction-img">
      <img src="../image/product3.jpg" alt="Image 3" class="construction-img">
      <img src="../image/product4.jpg" alt="Image 4" class="construction-img">
      <img src="../image/product5.jpg" alt="Image 5" class="construction-img">
    </div>

    <div class="construction-text">
      <h1>We Help You Build Spaces</h1>
      <p>
        We design, fabricate, supply, and install high-quality modular cabinets, laminated boards,
        and home improvement solutions. Elevate your space with premium craftsmanship at market-competitive prices!
      </p>
      <a href="about_us.php" class="construction-btn-link">
  <button class="construction-btn">View Products</button>
</a>
    </div>
  </section>
</section>

      
    
    <!-- features -->
   <div class="features-container">
    <div class="feature-item">
        <img src="https://cdn-icons-png.flaticon.com/512/2794/2794301.png" alt="Fast Delivery">
        <h4>Fast Delivery</h4>
        <p>For Selected Area</p>
    </div>
    <div class="feature-item">
        <img src="https://icons.veryicon.com/png/o/object/material-design-icons-1/rotate-3d.png" alt="Change Items">
        <h4>Change Items</h4>
        <p>If goods have problems</p>
    </div>
    <div class="feature-item">
        <img src="https://cdn-icons-png.freepik.com/512/62/62780.png" alt="Online Payment">
        <h4>Online Payment</h4>
        <p>100% Secure payment</p>
    </div>
    <div class="feature-item">
        <img src="https://cdn-icons-png.freepik.com/512/61/61521.png" alt="Discounts/Coupon">
        <h4>Discounts/Coupon</h4>
        <p>Support gift service</p>
    </div>
</div>
  </section>


<!-- Available products -->

  <div class="product_avalable">
  <h2>List Of Product</h2>
  <p>
    You can find everything that you need, all coming from a brand with a guarantee of good quality.
  </p>
  <a href="product_user.php" class="construction-btn-link">
  <button class="construction-btn">View Products</button>
</a>
</div>
  <div class="carousel-container">
  <button class="carousel-btn prev">❮</button>
  <div class="carousel-track">
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="carousel-slide">
        <img src="../image/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
        <div class="carousel-caption"><?= strtoupper(htmlspecialchars($row['category'])) ?></div>
      </div>
    <?php endwhile; ?>
  </div>
  <button class="carousel-btn next">❯</button>
</div>


<!-- contact us -->

<section id="contact">
<div class="contact-us-container">
  <div class="contact-left">
  <h2>Contact Us</h2>
    <p>If you have any questions or inquiries, feel free to reach out to us. We are here to help!</p>
    
    <form action="index.php" method="post" class="contact-form">
      <input type="hidden" name ="contact" value="Contact">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="name">Phone Number</label>
        <input type="number" id="name" name="phone" placeholder="Enter your Phone Number" required>
      </div>
      <div class="form-group">
        <label for="message">Your Message</label>
        <textarea id="message" name="message" placeholder="Enter your message" required></textarea>
      </div>
      <button type="submit" class="submit-btn">Send Message</button>
    </form>
  </div>



  <div class="contact-right">
    <h3>Our Location</h3>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5322.549084318683!2d121.00074891181939!3d14.657136675628683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b712dc89bb99%3A0x935f93a6e49ab912!2sMC%20Premiere!5e1!3m2!1sen!2sph!4v1745371861561!5m2!1sen!2sph"
       width="100%" height="85%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    
  </div>
  
</div>

    </section>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


  </body>
<?php
include '../user/footer.php';
?>


</html>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    let currentIndex = 0;
    const images = document.querySelectorAll('.hero-slideshow img');
    const totalImages = images.length;
  
    function showNextImage() {
      // Remove active class from current image
      images[currentIndex].classList.remove('active');
      
      // Update index
      currentIndex = (currentIndex + 1) % totalImages;
      
      // Add active class to next image
      images[currentIndex].classList.add('active');
    }
  
    // Start the slideshow
    setInterval(showNextImage,  5000);
  
    // Display the first image initially
    images[currentIndex].classList.add('active');
  });

</script>