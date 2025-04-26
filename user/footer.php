<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    
.footer {
  background-color: #2c2c2c;
  color: white;
  padding: 40px 0;
  font-family: 'Arial', sans-serif;
  text-align: center;
}

.footer-container {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

.footer-section {
  margin-bottom: 20px;
  padding: 10px;
}

.footer-section h3 {
  font-size: 1.5rem;
  margin-bottom: 15px;
  color: #FB9526;
}

.footer-section ul {
  list-style: none;
  padding: 0;
}

.footer-section ul li {
  margin: 10px 0;
}

.footer-section ul li a {
  color: white;
  text-decoration: none;
  transition: color 0.3s;
}

.footer-section ul li a:hover {
  color: #FB9526;
}

.social-links {
  display: flex;
  justify-content: center;
  gap: 15px;
}

.social-links img {
  width: 30px;
  height: 30px;
  transition: transform 0.3s;
}

.social-links img:hover {
  transform: scale(1.1);
}

.footer-bottom {
  background-color: #1c1c1c;
  padding: 10px;
  font-size: 0.9rem;
}

.footer-bottom p {
  margin: 0;
  color: #bbb;
}


</style>
<body>
    
</body>
<footer class = "footer">
<div class="footer-container">
    <div class="footer-section">
      <h3>Contact Us</h3>
      <ul>
        <li>Email: <a href="mailto:info@example.com">noblehome@gmail.com</a></li>
        <li>Phone: +991 324</li>
        <li>Address: MC Premier
          1181 EDSA Balintawak, Quezon City, Philippines</li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Follow Us</h3>
      <ul class="social-links">
        <li><a href="https://www.facebook.com/noblehomedepotph"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/2023_Facebook_icon.svg/500px-2023_Facebook_icon.svg.png" alt="Facebook"></a></li>
        <li><a href="#"><img src="https://static.vecteezy.com/system/resources/thumbnails/016/716/450/small_2x/tiktok-icon-free-png.png" alt="Twitter"></a></li>
        <li><a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/2048px-Instagram_icon.png" alt="Instagram"></a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 Noble Home Construction. All rights reserved.</p>
  </div>
    
</footer>
</html>