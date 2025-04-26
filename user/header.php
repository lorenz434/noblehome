
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Noble Home Corp.</title>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<style>
</style>
<header>
    <nav class="navbar">
        <div class="container">
        <div class="logo">
        <a href="../user/index.php">
          <img src="../image/noblehomelogo.png" alt="Noble Home Corp" />
        </a>
      </div>

          <div class="nav-links">
            <a href="../user/product_user.php">Products</a>
            <a href="../user/location.php">Locations</a>
            <a href="../user/about_us.php">About Us</a>
            <a href="../user/faqs.php">FAQs</a>
            <a href="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? '#contact' : 'index.php#contact' ?>">Contact us</a>
            </div>
      
          
      </nav>

</header>
<body>
</body>
</html>
