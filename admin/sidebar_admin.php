<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sidebar Menu | Side Navigation Bar</title>
  <link rel="stylesheet" href="../css/sidebar_admin.css" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
  <div class="custom-sidebar-container">
    <nav>
      <div class="logo">
        <i class="bx bx-menu menu-icon"></i>
        <span class="logo-name">Noblehome Dashboard</span>
      </div>
      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">Noblehome</span>
        </div>
        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="admin_dashboard.php" class="nav-link">
                <i class="bx bx-home-alt icon"></i>
                <span class="link">Dashboard</span>
              </a>
            </li>
            <li class="list">
              <a href="inquiry_admin.php" class="nav-link">
                <i class="bx bx-message-rounded icon"></i>
                <span class="link">Messages</span>
              </a>
            </li>
            <li class="list">
              <a href="booking_admin.php" class="nav-link">
                <i class="bx bx-calendar icon"></i>
                <span class="link">Booking</span>
              </a>
            </li>
            <li class="list">
              <a href="product_admin.php" class="nav-link">
                <i class="bx bx-store icon"></i>
                <span class="link">Products</span>
              </a>
            </li>
          </ul>
          <li class="list">
            <a href="#" class="nav-link">
              <i class="bx bx-log-out icon"></i>
              <span class="link">Logout</span>
            </a>
          </li>
        </div>
      </div>
    </nav>
    <section class="overlay"></section>
  </div>
  
  <script>
    const navBar = document.querySelector("nav"),
          menuBtns = document.querySelectorAll(".menu-icon"),
          overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
      menuBtn.addEventListener("click", () => {
        navBar.classList.toggle("open");
      });
    });
    overlay.addEventListener("click", () => {
      navBar.classList.remove("open");
    });
  </script>
</body>
</html>
