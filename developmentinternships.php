<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
<title>Software Development Internship Training | INDSAC SOFTECH</title>
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

     :root {
            --primary: #2563eb;
            --secondary: #1e40af;
            --accent: #1e3a8a;
            --light: #f8fafc;
            --dark: #1e293b;
            --text: #334155;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f1f5f9;
            color: var(--text);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        
        header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 4rem 0;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        h1 {
            font-size: 2.8rem;
            margin-bottom: 1rem;
        }
        
        .tagline {
            font-size: 1.3rem;
            max-width: 800px;
            margin: 0 auto 2rem;
        }
        
        .cta-button {
            display: inline-block;
            background: white;
            color: var(--primary);
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 1.1rem;
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .internship-tracks {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }
        
        .track-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border-top: 4px solid var(--primary);
        }
        
        .track-card:hover {
            transform: translateY(-5px);
        }
        
        .track-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .track-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-right: 1rem;
            width: 60px;
            height: 60px;
            background: rgba(37, 99, 235, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .track-title {
            font-size: 1.5rem;
            color: var(--dark);
        }
        
        .tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin: 1rem 0;
        }
        
        .tech-pill {
            background: #e0e7ff;
            color: var(--primary);
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .benefits-list {
            list-style-type: none;
            margin: 1.5rem 0;
        }
        
        .benefit-item {
            padding: 0.8rem 0;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
        }
        
        .benefit-item:last-child {
            border-bottom: none;
        }
        
        .benefit-item i {
            color: var(--primary);
            margin-right: 0.8rem;
            font-size: 0.9rem;
        }
        
        .program-details {
            background: white;
            border-radius: 10px;
            padding: 3rem 2rem;
            margin: 3rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .detail-card {
            padding: 1.5rem;
            border-radius: 8px;
            background: #f8fafc;
            border-left: 4px solid var(--primary);
        }
        
        .detail-card i {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        footer {
            text-align: center;
            margin-top: 4rem;
            padding: 3rem;
            background: var(--dark);
            color: white;
            border-radius: 10px;
        }
        
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
      <li><a href="">Home</a></li>
      <li><a href="student/register.php">Register</a></li>
      <li><a href="student/login.php">Login</a></li>
    </ul>
  </nav>
  <div class="container">
        <header>
            <h1>Software Development Internship Training</h1>
            <p class="tagline">Gain real-world experience and build your portfolio with hands-on projects in cutting-edge technologies</p>
            <a href="#apply" class="cta-button">Apply Now</a>
        </header>
        
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--dark);">Choose Your Specialization Track</h2>
        
        <div class="internship-tracks">
            <!-- Backend Development -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon">
                        <i class="fas fa-server"></i>
                    </div>
                    <h3 class="track-title">Backend Development</h3>
                </div>
                <div class="tech-stack">
                    <span class="tech-pill">PHP</span>
                    <span class="tech-pill">Java</span>
                    <span class="tech-pill">Python</span>
                    <span class="tech-pill">Node.js</span>
                </div>
                <p>Build scalable server-side applications and APIs</p>
                <ul class="benefits-list">
                    <li class="benefit-item"><i class="fas fa-check"></i> Database design & optimization</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> RESTful API development</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Authentication systems</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Performance tuning</li>
                </ul>
                <a href="#backend" class="cta-button" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Apply Now</a>
            </div>
            
            <!-- Frontend Development -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h3 class="track-title">Frontend Development</h3>
                </div>
                <div class="tech-stack">
                    <span class="tech-pill">HTML5</span>
                    <span class="tech-pill">CSS3</span>
                    <span class="tech-pill">JavaScript</span>
                    <span class="tech-pill">ReactJS</span>
                </div>
                <p>Create responsive and interactive user interfaces</p>
                <ul class="benefits-list">
                    <li class="benefit-item"><i class="fas fa-check"></i> Component-based architecture</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> State management</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Responsive design principles</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> API integration</li>
                </ul>
                <a href="#frontend" class="cta-button" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Apply Now</a>
            </div>
            
            <!-- DevOps -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h3 class="track-title">PHP Internship Training</h3>
                </div>
                <div class="tech-stack">
                    <span class="tech-pill">HTML</span>
                    <span class="tech-pill">PHP</span>
                    <span class="tech-pill">MYSQL</span>
                    <span class="tech-pill">CI/CD</span>
                </div>
                <p>Master development automation and cloud infrastructure</p>
                <ul class="benefits-list">
                    <li class="benefit-item"><i class="fas fa-check"></i> Database design & optimization</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Infrastructure as Code</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Monitoring & logging</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Web Development</li>
                </ul>
                <a href="#devops" class="cta-button" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Apply Now</a>
            </div>

                <!-- Software Testing -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon">
                        <i class="fas fa-bug"></i>
                    </div>
                    <h3 class="track-title">Software Testing</h3>
                </div>
                <div class="tech-stack">
                    <span class="tech-pill">Selenium</span>
                    <span class="tech-pill">JMeter</span>
                    <span class="tech-pill">JUnit</span>
                    <span class="tech-pill">Postman</span>
                </div>
                <p>Ensure software quality through systematic testing</p>
                <ul class="benefits-list">
                    <li class="benefit-item"><i class="fas fa-check"></i> Test automation</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Performance testing</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> API testing</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Test case management</li>
                </ul>
                <a href="#testing" class="cta-button" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Apply Now</a>
            </div>
            
            <!-- Software Testing -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon">
                        <i class="fas fa-bug"></i>
                    </div>
                    <h3 class="track-title">Software Testing</h3>
                </div>
                <div class="tech-stack">
                    <span class="tech-pill">Selenium</span>
                    <span class="tech-pill">JMeter</span>
                    <span class="tech-pill">JUnit</span>
                    <span class="tech-pill">Postman</span>
                </div>
                <p>Ensure software quality through systematic testing</p>
                <ul class="benefits-list">
                    <li class="benefit-item"><i class="fas fa-check"></i> Test automation</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Performance testing</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> API testing</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Test case management</li>
                </ul>
                <a href="#testing" class="cta-button" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Apply Now</a>
            </div>
            
            <!-- Systems Programming -->
            <div class="track-card">
                <div class="track-header">
                    <div class="track-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h3 class="track-title">Systems Programming</h3>
                </div>
                <div class="tech-stack">
                    <span class="tech-pill">C</span>
                    <span class="tech-pill">C++</span>
                    <span class="tech-pill">Rust</span>
                    <span class="tech-pill">Algorithms</span>
                </div>
                <p>Develop high-performance system-level software</p>
                <ul class="benefits-list">
                    <li class="benefit-item"><i class="fas fa-check"></i> Memory management</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Multithreading</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Network programming</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Data structures</li>
                </ul>
                <a href="#systems" class="cta-button" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Apply Now</a>
            </div>
        </div>
        
        <div class="program-details">
            <h2 style="text-align: center; color: var(--dark); margin-bottom: 1rem;">Internship Program Highlights</h2>
            <p style="text-align: center; max-width: 800px; margin: 0 auto 2rem;">Our 12-week intensive program is designed to bridge the gap between academia and industry</p>
            
            <div class="details-grid">
                <div class="detail-card">
                    <i class="fas fa-user-graduate"></i>
                    <h4>Mentorship</h4>
                    <p>1:1 guidance from senior developers</p>
                </div>
                <div class="detail-card">
                    <i class="fas fa-project-diagram"></i>
                    <h4>Live Projects</h4>
                    <p>Work on real Live projects </p>
                </div>
                <div class="detail-card">
                    <i class="fas fa-certificate"></i>
                    <h4>Certification</h4>
                    <p>Industry-recognized completion certificate</p>
                </div>
                <div class="detail-card">
                    <i class="fas fa-briefcase"></i>
                    <h4>Placement Assistance</h4>
                    <p>Interview Preparation</p>
                </div>
            </div>
        </div>
        
        <footer id="apply">
            <h3>Ready to Launch Your Tech Career?</h3>
            <p>Limited seats available for our next cohort</p>
            
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>internships@indsac.com</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>+91 7676289081 (Watsapp)</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Remote (WFH), India</span>
                </div>
            </div>
            
            <p>© </p>
        </footer>
    </div>

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
