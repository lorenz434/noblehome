<?php
    include '../database.php';
    include 'header.php';


    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $date_time = $_POST['date_time'];
      $created_at = date("Y-m-d H:i:s");
    
      $stmt = mysqli_prepare($conn, "INSERT INTO booking (name, email, phone, date_time, created_at) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $phone, $date_time, $created_at);
    
      if (mysqli_stmt_execute($stmt)) {
        echo "<script>
          alert('Booking successfully submitted! Check email for verification.');
          window.location.href='location.php';
        </script>";
        exit;
      } else {
        echo "Database error: " . mysqli_error($conn);
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Locations - Noblehome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <link rel="stylesheet" href="../css/location.css">


<body>

  <div class="header">
    Noble Home Showroom Location
  </div>

  <section class="location-section">
    <h2>Visit Our Showroom</h2>
    <p>MC Premier - 1181 EDSA Balintawak, Quezon City 1008, Philippines</p>

    <div class="content-wrapper">
      <div class="location-image">
        <img src="https://coblonal.com/wp-content/uploads/2024/04/24.-Cocinas-Vista-General-3-_-Coblonal-Interiorismo-para-Azul-Acocsa-R-952x700.jpg" alt="Noble Home Showroom">
      </div>
      <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5322.549084318683!2d121.00074891181939!3d14.657136675628683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b712dc89bb99%3A0x935f93a6e49ab912!2sMC%20Premiere!5e1!3m2!1sen!2sph!4v1745371861561!5m2!1sen!2sph"
          allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>

    <button class="cta-button" onclick="openModal()">Book Showroom Appointment</button>
  </section>

<!-- Booking Modal -->
<div id="bookingModal" class="modal-overlay">
  <div class="modal-content">
    <button class="modal-close" onclick="closeModal()">&times;</button>
    <h2>Book a Showroom Appointment</h2>

    <div class="modal-body">
      <!-- Personal Information Section -->
      <div class="modal-form">
        <h3>Personal Information</h3>
        <form id="bookingForm" method="POST" action="location.php">
          <input type="text" name="name" placeholder="Full Name" required>
          <input type="email" name="email" placeholder="Email Address" required>
          <input type="tel" name="phone" placeholder="Phone Number" required>

          <!-- Date & Time Picker -->
          <div class="calendar-wrapper">
            <h3>Date & Time</h3>
            <input id="calendarPicker" name="date_time" class="calendar-picker" type="datetime-local" placeholder="Select Date and Time" required>
          </div>

          <!-- Submit Button -->
          <div class="modal-footer">
            <button type="submit" class="submit-button">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <script>
    function openModal() {
      document.getElementById('bookingModal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('bookingModal').style.display = 'none';
    }
  </script>

  <?php include 'footer.php'; ?>
</body>

</html>


<!-- Flatpickr Library -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Modal Function -->
<script>
  function openModal() {
    document.getElementById("bookingModal").style.display = "flex";
  }

  function closeModal() {
    document.getElementById("bookingModal").style.display = "none";
  }

  // Flatpickr init
  flatpickr("#calendarPicker", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minDate: "today",
    altInput: true,
    altFormat: "F j, Y (h:i K)",
    time_24hr: false,
  });
</script>
