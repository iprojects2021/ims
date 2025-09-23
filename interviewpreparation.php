<?php 
session_start();
include(__DIR__ . '/includes/db.php');
$email = $_SESSION['user']['email'] ?? null;
$role = $_SESSION['user']['role'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head><link rel="shortcut icon" href="favico.png" type="image/x-icon" />
  <meta charset="UTF-8">
  <title>Career & Interview Preparation | INDSAC SOFTECH</title>
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
            --primary: #4f46e5;
            --secondary: #4338ca;
            --accent: #3730a3;
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
        
        header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 20px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="white"></path><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="white"></path><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="white"></path></svg>');
            background-size: cover;
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
            margin-top: 1rem;
        }
        
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }
        
        .service-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border-top: 4px solid var(--primary);
        }
        
        .service-card:hover {
            transform: translateY(-5px);
        }
        
        .service-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .service-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-right: 1rem;
            width: 60px;
            height: 60px;
            background: rgba(79, 70, 229, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .service-title {
            font-size: 1.5rem;
            color: var(--dark);
        }
        
        .service-desc {
            color: #64748b;
            margin-bottom: 1.5rem;
        }
        
        .benefits-list {
            list-style-type: none;
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
        
        .features-section {
            background: white;
            border-radius: 10px;
            padding: 3rem 2rem;
            margin: 3rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .feature-card {
            padding: 1.5rem;
            border-radius: 8px;
            background: #f8fafc;
            border-left: 4px solid var(--primary);
        }
        
        .feature-card i {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .testimonials {
            margin: 4rem 0;
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
        .hero-section {
            background: linear-gradient(135deg, #6c63ff 0%, #4a3fcf 100%);
            color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
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
</nav> <div class="container">
        <header>
            <h1>Career & Interview Preparation</h1>
            <p class="tagline">Get job-ready with our comprehensive career development programs and ace your technical interviews</p>
            <a href="interviewpreprationpage.php" class="cta-button">Start Your Preparation</a>
        </header>
        
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--dark);">Our Career Services</h2>
        
        <div class="services">
            <!-- Resume Building -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="service-title">ATS-Friendly Resume Building</h3>
                </div>
                <p class="service-desc">Craft the perfect resume that gets past Applicant Tracking Systems and catches recruiters' attention</p>
                <ul class="benefits-list">
                    <li class="benefit-item"><i class="fas fa-check"></i> Keyword optimization for ATS</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Industry-specific templates</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Professional formatting</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Cover letter assistance</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> LinkedIn profile optimization</li>
                </ul>
            </div>
            
            <!-- Mock Interviews -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="service-title">Mock Technical Interviews</h3>
                </div>
                <p class="service-desc">Practice with industry experts and get detailed feedback to improve your performance</p>
                <ul class="benefits-list">
                    <li class="benefit-item"><i class="fas fa-check"></i> FAANG-style interviews</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> DSA & system design practice</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Real-time coding challenges</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Behavioral interview prep</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Detailed performance analysis</li>
                </ul>
            </div>
            
            <!-- Coding Bootcamps -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="service-title">Coding Bootcamps & Workshops</h3>
                </div>
                <p class="service-desc">Intensive training programs to master in-demand technologies</p>
                <ul class="benefits-list">
                    <li class="benefit-item"><i class="fas fa-check"></i> Python/Java programming</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Full-stack development</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Data structures & algorithms</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> System design fundamentals</li>
                    <li class="benefit-item"><i class="fas fa-check"></i> Live coding sessions</li>
                </ul>
            </div>
            
          
        </div>
          <!-- Hero Section -->
        <div class="hero-section text-center" id="contact">
            <h1 style="text-align: center;  margin-bottom: 1rem;"><i class="fas fa-graduation-cap"></i> Your Career & Interview Preparation Starts Here!</h1>
            <h3 style="text-align: center; color:  margin-bottom: 1rem;" class="my-3">Premium Quality at <span class="price-tag">₹5,000  Only</span></h3>
            <p style="text-align: center; color:  margin-bottom: 1rem;" class="lead">Lowest price guaranteed or we’ll match it! ⚡</p>
        </div>
        
        <div class="features-section">
            <h2 style="text-align: center; color: var(--dark); margin-bottom: 1rem;">Our Unique Approach</h2>
            <p style="text-align: center; max-width: 800px; margin: 0 auto 2rem;">We combine technical training with career coaching to maximize your job prospects</p>
            
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-user-tie"></i>
                    <h4>1-on-1 Career Coaching</h4>
                    <p>Personalized guidance from industry professionals</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-project-diagram"></i>
                    <h4>Real Project Experience</h4>
                    <p>Work on actual projects for your portfolio</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-network-wired"></i>
                    <h4>Industry Connections</h4>
                    <p>Access to our hiring partner network</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-line"></i>
                    <h4>Progress Tracking</h4>
                    <p>Regular assessments and improvement plans</p>
                </div>
            </div>
        </div>
        
        <div class="testimonials">
            <h2 style="text-align: center; margin-bottom: 2rem; color: var(--dark);">Success Stories</h2>
            <!-- Testimonial cards can be added here -->
        </div>
        
        <footer id="contact">
            <h3>Ready to Transform Your Career?</h3>
            <p>Contact us today to schedule your career assessment</p>
            
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
            
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
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
