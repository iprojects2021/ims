<?php
session_start();

// Example: Assume the role is stored in session
$role = $_SESSION['user']['role'] ?? null;
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <link rel="shortcut icon" href="favico.png" type="image/x-icon" />
  <meta charset="UTF-8">
  <title>Student Portal | INDSAC SOFTECH</title>
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
:root {
            --primary: #2563eb;
            --secondary: #1e40af;
            --light: #f8fafc;
            --dark: #1e293b;
        }
      .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .service-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
        }
        
        .service-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }
        
        .service-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--secondary);
        }
        
        .service-desc {
            color: #64748b;
            margin-bottom: 2rem;
        }
        
        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        
        .btn:hover {
            background: var(--secondary);
        }
    /* Hero */
    .hero {
      height: 440px;
      background-image: url("assets/images/banner1.png");
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      background-color: #fff;
      margin: 2rem auto;
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
        <?php if ($role === 'admin'): ?>
            <li><a href="/ims/index.php">Home</a></li>
            <li><a href="/ims/panel/admin_dashboard.php">Dashboard</a></li>
            <li><a href="/ims/panel/adminlogout.php">Logout</a></li>

        <?php elseif ($role === 'student'): ?>
            <li><a href="/ims/index.php">Home</a></li>
            <li><a href="/ims/panel/student-dashboard.php">Dashboard</a></li>
            <li><a href="student/logout.php">Logout</a></li>

        <?php else: ?>
<li><a href="index.php">Home</a></li>
            <li><a href="student/register.php">Register</a></li>
            <li><a href="student/login.php">Login</a></li>
                    <?php endif; ?>
    </ul>
</nav>

  <!-- 🔍 Search Bar -->
  <div class="search-wrapper">
    <div class="custom-search">
      <input type="text" placeholder="What are you looking for? e.g Design, Mumbai, Infosys">
      <button><i class="fas fa-search"></i></button>
    </div>
  </div>
<div class="services-grid">
   <!-- Service 4 -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="service-title">Internship Training & Live Project Support</h3>
                <p class="service-desc">
                    Real-world project training experience with mentorship from industry professionals.
                </p>
                <a href="developmentinternships.php" class="btn">Learn More</a>
            </div>

             <!-- Service 2 -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3 class="service-title">Professional Training Program</h3>
                <p class="service-desc">
                    Industry-aligned certification courses and hands-on workshops on emerging technologies.
                </p>
                <a href="developmentinternships.php" class="btn">Learn More</a>
                <!-- <a href="trainingprograms.php" class="btn">Learn More</a> -->
            </div>                     
            
            <!-- Service 3 -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="service-title">Interview & Career Preparation</h3>
                <p class="service-desc">
                    Resume building, mock interviews, and coding bootcamps to make you job-ready.
                </p>
                <a href="developmentinternships.php" class="btn">Learn More</a>
                <!-- <a href="interviewpreparation.php" class="btn">Learn More</a> -->
            </div>
                   <!-- Service 1 -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h3 class="service-title">College Final Year Projects</h3>
                <p class="service-desc">
                    End-to-end project development from concept to execution with documentation support.
                </p>
                <a href="collegeprojects.php" class="btn">Learn More</a>
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
      <div class="city-box"><img src="assets/images/3banglor.png"><p>Remote (WFH)</p></div>
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
            <li><a href="https://indsac.com/about.html">About us</a></li>
            <li><a href="https://indsac.com/pge/ca/career.html">We're hiring</a></li>
            <li><a href="referralworkflow.php">Referral Program</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <ul>
            <li><a href="https://indsac.com/about.html">Team Diary</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="https://indsac.com/services.html">Our Services</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <ul>
            <li><a href="https://indsac.com/termsandconditions.html">Terms & Conditions</a></li>
            
            <li><a href="https://indsac.com/contact.html">Contact us</a></li>
          </ul>
        </div>
      </div>

      <!-- Bottom -->
      <div class="footer-bottom-row">
        
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/company/indsac-softech/"><i class="fab fa-linkedin-in"></i></a>
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
