<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Internshop</title>
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      background-color: #fff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .logo {
      font-weight: bold;
      font-size: 24px;
      color: rgb(43, 40, 188);
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    .nav-links li a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    /* Search */
    .search-wrapper {
      display: flex;
      justify-content: center;
      margin: 40px 0 20px;
    }

    .custom-search {
      display: flex;
      border-radius: 8px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 90%;
    }

    .custom-search input {
      padding: 15px 20px;
      font-size: 16px;
      border: none;
      flex: 1;
      outline: none;
    }

    .custom-search button {
      background-color: #00aaff;
      border: none;
      color: #fff;
      padding: 0 25px;
      font-size: 18px;
      cursor: pointer;
    }

    /* Hero */
    .hero {
      height: 440px;
      background-image: url("assets/images/banner1.png");
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      background-color: #fff;
      margin: 0 auto;
      max-width: 1500px;
    }

    /* Internships */
    .internships {
      background-color: #fff;
      padding: 40px 20px;
    }

    .internships h2 {
      font-size: 26px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 10px;
    }

    .internships p {
      text-align: center;
      color: #555;
      margin-bottom: 30px;
    }

    .cities {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 40px;
    }

    .city-box {
      text-align: center;
      width: 120px;
    }

    .city-box img {
      width: 50px;
      height: 80px;
      object-fit: contain;
    }

    .city-box p {
      margin-top: 10px;
      font-weight: 500;
    }

    .city-box:hover {
      transform: scale(1.05);
    }

    /* Categories */
    .categories {
      background-color: #fff;
      padding: 50px 70px;
    }

    .img-title {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 30px;
      text-align: center;
    }

    .images {
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
      justify-content: center;
    }

    .box {
      width: 130px;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .box img {
      width: 80px;
      height: 80px;
      object-fit: contain;
    }

    .box p {
      margin-top: 10px;
      font-size: 14px;
      font-weight: 500;
    }

    .box:hover {
      transform: scale(1.05);
    }

    /* Footer */
    .footer {
      background-color: #222;
      color: #fff;
      padding: 40px 20px;
      margin-top: 40px;
    }

    .footer-content {
      max-width: 1200px;
      margin: auto;
    }

    .footer-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .footer-col ul {
      list-style: none;
    }

    .footer-col ul li {
      margin-bottom: 10px;
    }

    .footer-col ul li a {
      color: #ccc;
      text-decoration: none;
    }

    .footer-col ul li a:hover {
      text-decoration: underline;
    }

    .footer-bottom-row {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 30px;
    }

    .app-badges img {
      width: 140px;
      margin: 0 10px;
    }

    .social-icons {
      display: flex;
      gap: 15px;
    }

    .social-icons a {
      color: white;
      font-size: 20px;
      text-decoration: none;
    }

    .footer-underline {
      border-top: 1px solid #444;
      margin: 20px 0;
    }

    .footer-copyright {
      text-align: center;
      font-size: 14px;
      color: #aaa;
    }

    @media screen and (max-width: 768px) {
      .hero {
        background-size: cover;
        height: auto;
        padding: 30px 0;
      }

      .footer-row {
        flex-direction: column;
        gap: 20px;
      }

      .footer-bottom-row {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

  <!-- ✅ Navbar -->
  <nav class="navbar">
    <div class="logo">INDSAC SOFTECH</div>
    <ul class="nav-links">
      <li><a href="#">Internships</a></li>
      <li><a href="student/register.php">Register</a></li>
      <li><a href="student/login.php">Login</a></li>
    </ul>
  </nav>

  <!-- 🔍 Search Bar -->
  <div class="search-wrapper">
    <div class="custom-search">
      <input type="text" placeholder="What are you looking for? e.g Design, Mumbai, Infosys">
      <button><i class="fas fa-search"></i></button>
    </div>
  </div>

  <!-- 📢 Hero Section -->
  <div class="hero"></div>

  <!-- 📍 Popular Cities -->
  <section class="internships">
    <h2>Internships</h2>
    <p>Apply to 10,000+ internships for free</p>
    <div class="cities">
      <div class="city-box"><img src="assets/images/1wfh.png"><p>Work from home</p></div>
      <div class="city-box"><img src="assets/images/2delhi.png"><p>Delhi/NCR</p></div>
      <div class="city-box"><img src="assets/images/3banglor.png"><p>Bangalore</p></div>
      <div class="city-box"><img src="assets/images/4mumbai.png"><p>Mumbai</p></div>
      <div class="city-box"><img src="assets/images/5chennai.png"><p>Chennai</p></div>
      <div class="city-box"><img src="assets/images/6kolkata.png"><p>Kolkata</p></div>
    </div>
  </section>

  <!-- 🧩 Popular Categories -->
  <section class="categories">
    <h2 class="img-title">Popular categories</h2>
    <div class="images">
      <div class="box"><a href="#"><img src="assets/images/cat1.png"><p>Information Technology</p></a></div>
      <div class="box"><a href="#"><img src="assets/images/cat2.png"><p>Business Management</p></a></div>
      <div class="box"><a href="#"><img src="assets/images/cat3.png"><p>Humanities</p></a></div>
      <div class="box"><a href="#"><img src="assets/images/cat4.png"><p>Science & Technology</p></a></div>
      <div class="box"><a href="#"><img src="assets/images/cat5.png"><p>Law</p></a></div>
      <div class="box"><a href="#"><img src="assets/images/cat6.png"><p>Architecture</p></a></div>
    </div>
  </section>

  <!-- 🔻 Footer -->
  <div class="footer">
    <div class="footer-content">
      <div class="footer-row">
        <div class="footer-col">
          <ul>
            <li><a href="#">About us</a></li>
            <li><a href="#">We're hiring</a></li>
            <li><a href="#">Hire interns for your company</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <ul>
            <li><a href="#">Team Diary</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Our Services</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <ul>
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Contact us</a></li>
          </ul>
        </div>
      </div>

      <!-- Bottom -->
      <div class="footer-bottom-row">
        <div class="app-badges">
          <img src="assets/images/play-store.png" alt="Play Store">
          <img src="assets/images/app-store.png" alt="App Store">
        </div>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>

      <div class="footer-underline"></div>
      <p class="footer-copyright">
        © 2025 <a href="https://indsac.com" style="color: inherit; text-decoration: none;">INDSAC SOFTECH</a>
      </p>
    </div>
  </div>

</body>
</html>
