<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>College Projects | INDSAC SOFTECH</title>
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
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
            --primary: #3b82f6;
            --secondary: #2563eb;
            --accent: #1d4ed8;
            --light: #f8fafc;
            --dark: #1e293b;
            --text: #334155;
            --danger: #ff4d4d;
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
            padding: 2rem 0;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .tagline {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 1.5rem;
        }
        
        .cta-button1 {
            display: inline-block;
            background: white;
            color: var(--primary);
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .cta-button1:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .project-categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }
        
        .category-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
        }
        
        .category-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .category-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-right: 1rem;
        }
        
        .category-title {
            font-size: 1.5rem;
            color: var(--dark);
        }
        
        .project-list {
            list-style-type: none;
        }
        
        .project-item {
            padding: 0.8rem 0;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
        }
        
        .project-item:last-child {
            border-bottom: none;
        }
        
        .project-item i {
            color: var(--primary);
            margin-right: 0.8rem;
            font-size: 0.9rem;
        }
        
        .benefits-section {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin: 3rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .benefit-card {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary);
        }
.hero-section {
            background: linear-gradient(135deg, #6c63ff 0%, #4a3fcf 100%);
            color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
        }
        .price-tag {
            background: var(--danger);
            color: white;
            font-weight: bold;
            padding: 5px 15px;
            border-radius: 20px;
            display: inline-block;
            margin: 10px 0;
        }
        .usp-card {
            border-left: 4px solid var(--primary);
            transition: transform 0.3s;
        }
        .usp-card:hover {
            transform: translateY(-5px);
        }
        .guarantee-badge {
            background: #ffcc00;
            color: #333;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .cta-button {
            background: var(--danger);
            border: none;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s;
        }
        .cta-button:hover {
            background: #e63946;
            transform: scale(1.05);
        }
        .testimonial-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
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
            <h1>Final Year Project Development</h1>
            <p class="tagline">Get expert guidance and complete support for your engineering/CS final year projects from concept to completion</p>
            <a href="collegeprojectsform.php" class="cta-button1">Get Project Help Now</a>
        </header>
       
        
    
          <div class="project-categories">
            <!-- Software & Coding Projects -->
            <div class="category-card">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                    <h3 class="category-title">50% Cheaper Than Market</h3>
                </div>
                <ul class="project-list">
                    <li class="project-item"><i class="fas fa-check"></i> Others charge ₹15K–₹20K for the same quality. Save your budget for placements!</li>
                  </ul>
            </div>
            <div class="category-card">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="category-title"> Ready-to-Deploy Projects</h3>
                </div>
                <ul class="project-list">
                    <li class="project-item"><i class="fas fa-check"></i> Get Full documentation, source code, and 1-year support included.</li>
                  </ul>
            </div>
            <div class="category-card">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="category-title">7-Day Delivery Guarantee</h3>
                </div>
                <ul class="project-list">
                    <li class="project-item"><i class="fas fa-check"></i> Need it urgently? We deliver faster than competitors!</li>
                  </ul>
            </div>
          </div>  
         <!-- Hero Section -->
        <div class="hero-section text-center">
            <h1><i class="fas fa-graduation-cap"></i> Your Final Year Project Starts Here!</h1>
            <h3 class="my-3">Premium Quality at <span class="price-tag">₹5,000 – ₹10,000 Only</span></h3>
            <p class="lead">Lowest price guaranteed or we’ll match it! ⚡</p>
        </div> 
        <h2 style="text-align: center; margin-bottom: 2rem; color: var(--dark);">Our Project Development Services</h2>
        
        <div class="project-categories">
            <!-- Software & Coding Projects -->
            <div class="category-card">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3 class="category-title">Software & Coding Projects</h3>
                </div>
                <ul class="project-list">
                    <li class="project-item"><i class="fas fa-check"></i> Web Development (HTML/CSS, JavaScript, React, Node.js)</li>
                    <li class="project-item"><i class="fas fa-check"></i> Mobile App Development (Android, iOS, Flutter)</li>
                    <li class="project-item"><i class="fas fa-check"></i> AI/ML Projects (Python, TensorFlow, NLP)</li>
                    <li class="project-item"><i class="fas fa-check"></i> Blockchain & Web3 (Solidity, Smart Contracts)</li>
                    <li class="project-item"><i class="fas fa-check"></i> Cybersecurity Projects (Ethical Hacking)</li>
                    <li class="project-item"><i class="fas fa-check"></i> Cloud Computing (AWS, Azure, Firebase)</li>
                </ul>
            </div>
            
            <!-- Hardware & Embedded Systems -->
            <div class="category-card">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <h3 class="category-title">Hardware & Embedded Systems</h3>
                </div>
                <ul class="project-list">
                    <li class="project-item"><i class="fas fa-check"></i> IoT Projects (Raspberry Pi, Arduino)</li>
                    <li class="project-item"><i class="fas fa-check"></i> Robotics & Automation (AI robots, drones)</li>
                    <li class="project-item"><i class="fas fa-check"></i> PCB Design & Circuit Simulation</li>
                    <li class="project-item"><i class="fas fa-check"></i> Sensor-based Systems</li>
                    <li class="project-item"><i class="fas fa-check"></i> Embedded C Programming</li>
                    <li class="project-item"><i class="fas fa-check"></i> VLSI Projects</li>
                </ul>
            </div>
            
            <!-- Database & Networking -->
            <div class="category-card">
                <div class="category-header">
                    <div class="category-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3 class="category-title">Database & Networking</h3>
                </div>
                <ul class="project-list">
                    <li class="project-item"><i class="fas fa-check"></i> SQL/NoSQL Database Projects</li>
                    <li class="project-item"><i class="fas fa-check"></i> Networking Projects</li>
                    <li class="project-item"><i class="fas fa-check"></i> Socket Programming</li>
                    <li class="project-item"><i class="fas fa-check"></i> VPN Implementations</li>
                    <li class="project-item"><i class="fas fa-check"></i> Packet Tracer Simulations</li>
                    <li class="project-item"><i class="fas fa-check"></i> Cloud Database Systems</li>
                </ul>
            </div>
        </div>
        
        <div class="benefits-section">
            <h2 style="color: var(--dark); margin-bottom: 1rem;">Why Choose Our Project Assistance?</h2>
            <p>We provide comprehensive support to ensure your academic success</p>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4>End-to-End Development</h4>
                    <p>From concept to final implementation with complete documentation</p>
                </div>
                <div class="benefit-card">
                    <h4>Expert Mentors</h4>
                    <p>Guidance from industry professionals with 5+ years experience</p>
                </div>
                <div class="benefit-card">
                    <h4>100% Original Work</h4>
                    <p>Reports with proper citations</p>
                </div>
                <div class="benefit-card">
                    <h4>Viva Preparation</h4>
                    <p>Mock sessions and Q&A to ace your project defense</p>
                </div>
            </div>
        </div>
        
        <!-- Urgency Trigger -->
        <div class="alert alert-warning text-center">
            <h4><i class="fas fa-exclamation-triangle"></i> Limited Slots Available!</h4>
            <p class="mb-0">Only <strong>5 projects</strong> left at ₹5,000. Next batch starts at ₹7,000.</p>
        </div>
    </div>
   <!-- Testimonials -->
        <h3 class="text-center my-5"><i class="fas fa-quote-left"></i> Trusted by 1,000+ Students</h3>
        <div class="row mb-5">
            <div class="col-md-4 mb-4">
                <div class="card p-3">
                    <div class="d-flex align-items-center mb-3">
                       
                        <div>
                            <h5 class="mb-0">Priya K.</h5>
                            <small>Computer Science, Mumbai</small>
                        </div>
                    </div>
                    <p class="mb-0">"Got an IoT project for ₹6,500 with full Viva preparation. Best decision!"</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-3">
                    <div class="d-flex align-items-center mb-3">
                        
                        <div>
                            <h5 class="mb-0">Rahul S.</h5>
                            <small>ECE, Delhi</small>
                        </div>
                    </div>
                    <p class="mb-0">"Paid ₹8,000 for an AI project. My guide said it looked like a ₹20K project!"</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card p-3">
                    <div class="d-flex align-items-center mb-3">
                        
                        <div>
                            <h5 class="mb-0">Ananya P.</h5>
                            <small>Mechanical, Remote (WFH)</small>
                        </div>
                    </div>
                    <p class="mb-0">"Submitted 2 weeks early thanks to their fast delivery. Worth every rupee."</p>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center p-4 bg-white rounded shadow">
            <h3 class="mb-4">Ready to Ace Your Final Year?</h3>
            <p class="lead mb-4">Get a <span class="guarantee-badge">100% Approval Guarantee</span> </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="collegeprojectsform.php" class="btn btn-primary btn-lg cta-button">
                    <i class="fas fa-phone-alt me-2"></i> Contact Now
                </a>
                <a href="collegeprojectsform.php" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-envelope me-2"></i> Email Enquiry
                </a>
            </div>
            <p class="text-muted mt-3"><i class="fas fa-lock"></i> Secure payment options available</p>
        </div>
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
