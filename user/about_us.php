<?php
include 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us | Noble Home Corp.</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="..//about_us.css">
</head>
<body>
  <section class="about-us">
  <div class="about-heading-container">
  <h1 class="about-header">About Us</h1>
</div>
    <div class="about-content">
      <img src="../image/nobleicon.png" alt="Noble Home Corp Logo">
      <div class="about-text">
        Welcome to Noble Home Corp., a leading provider of high-quality construction products. With years of experience, we pride ourselves on delivering top-notch products that transform spaces. Our goal is to offer solutions that enhance the functionality and aesthetic appeal of homes and commercial spaces alike.
      </div>
    </div>

    <div class="section mission-vision">
      <div class="mission-vision-container">
        <div class="mission">
          <h2>Our Mission</h2>
          <ul>
            <li><strong>For Our Buyers:</strong><br> We are committed to offering high-quality, aesthetically pleasing, and reasonably priced homes tailored to your needs and aspirations.</li>
            <li><strong>For Our Employees & Agents:</strong><br> We provide a nurturing environment that encourages professional growth, personal development, and long-term financial success.</li>
            <li><strong>For Our Business Partners:</strong><br> We build long-lasting relationships grounded in trust, transparency, and mutual benefit.</li>
          </ul>
        </div>
        <div class="vision">
          <h2>Our Vision</h2>
          <p>We envision a future where Noble Home Corp. stands as the premier name in the construction product industry—recognized for exceptional quality, innovation, and customer trust.</p>
          <p>We aim to continuously exceed expectations by empowering our team, embracing innovation, and staying true to our values in all we do.</p>
        </div>
      </div>
    </div>

    <div class="section company-values">
      <h2>Our Core Values</h2>
      <div class="values-list">
        <div class="value-item">
          <i class="fas fa-cogs"></i>
          <h3>Quality</h3>
          <p>We ensure the highest standards in every product we offer. Precision and craftsmanship define our work.</p>
        </div>
        <div class="value-item">
          <i class="fas fa-handshake"></i>
          <h3>Integrity</h3>
          <p>Honesty and transparency are at the core of all our business practices. We build trust with our clients and partners.</p>
        </div>
        <div class="value-item">
          <i class="fas fa-users"></i>
          <h3>Customer Focus</h3>
          <p>Your satisfaction is our priority. We aim to deliver exceptional service and solutions tailored to your needs.</p>
        </div>
      </div>
    </div>
  </section>
</body>
<?php 
include 'footer.php';
?>
</html>

<style>
body {
  font-family: 'Segoe UI', Tahoma, sans-serif;
  margin: 0;
  background-color: #e9ecef;
  background-image: url('https://www.transparenttextures.com/patterns/concrete-wall.png');
  background-repeat: repeat;
  background-attachment: fixed;
  color: #333;
}

/* ===== About Us Container ===== */
.about-us {
  max-width: 1200px;
  margin: 4rem auto;
  background: #ffffff;
  padding: 3rem 2rem;
  border-radius: 10px;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
}

/* ===== Headings ===== */
.about-header,
.section h2 {
  text-align: center;
  font-size: 2.5rem;
  line-height: double;
  color: #222;
  margin-bottom: 2rem;
  font-weight: 600;
  position: relative;
}

.section h2::after {
  content: '';
  width: 350px;
  height: 2px;
  background-color: #FB9526;
  display: block;
  margin: 0.5rem auto 0;
  border-radius: 1px;
}

/* ===== About Content ===== */
.about-content {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
  align-items: center;
  justify-content: center;
}

.about-content img {
  max-width: 500px;
  width: 100%;
  border-radius: 10px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.about-text {
  flex: 1;
  font-size: 1.1rem;
  color: #555;
  text-align: justify;
  line-height: 35px;
}

/* ===== Section Layout ===== */
.section {
  margin-top: 5rem;
  padding: 2rem 1rem;
}

/* ===== Mission & Vision Section ===== */
.mission-vision-container {
  display: flex;
  gap: 2rem;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 2rem;
}

.mission, .vision {
  flex: 1;
  min-width: 300px;
  background: #ffffff;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
  border-left: 4px solid #FB9526;
}

.mission h2, .vision h2 {
  font-size: 1.6rem;
  color: #333;
  margin-bottom: 1rem;
  font-weight: 600;
}

.mission ul {
  padding-left: 1rem;
  list-style-type: disc;
  color: #555;
}

.vision p {
  font-size: 1.05rem;
  color: #555;
}

/* ===== Values List ===== */
.values-list {
  display: flex;
  gap: 1.5rem;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 2rem;
}

.value-item {
  background: #ffffff;
  padding: 1.5rem;
  border-radius: 8px;
  width: 260px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.04);
  text-align: center;
  transition: transform 0.2s ease;
}

.value-item:hover {
  transform: translateY(-5px);
}

.value-item h3 {
  font-size: 1.3rem;
  color: #222;
  margin-bottom: 0.7rem;
  font-weight: 600;
}

.value-item p {
  font-size: 0.95rem;
  color: #666;
}

/* ===== Footer ===== */
footer {
  background-color: #1d1d1d;
  color: #eee;
  padding: 2rem 1rem;
  text-align: center;
  font-size: 0.95rem;
  margin-top: 5rem;
}

/* ===== Responsive Layout ===== */
@media (max-width: 768px) {
  .about-content, 
  .mission-vision-container, 
  .values-list {
    flex-direction: column;
  }

  .about-header,
  .section h2 {
    font-size: 2rem;
  }
}

.about-heading-container {
  text-align: center;
  margin-bottom: 3rem;
}

.about-header {
  font-size: 3rem;
  font-weight: 700;
  color:rgb(0, 0, 0);
  position: relative;
  display: inline-block;
  margin-bottom: 0;

}

.about-header::after {
  content: "";
  width: 350px;
  height: 4px;
  background: #FB9526;
  display: block;
  margin: 0.5rem auto 0;
  border-radius: 2px;
}


</style>