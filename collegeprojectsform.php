<?php session_start();
include(__DIR__ . '/includes/db.php'); // if db.php is in ims/includes/
?>



<!DOCTYPE html>


<html lang="en">
<head><link rel="shortcut icon" href="favico.png" type="image/x-icon" />
  <meta charset="UTF-8">
  <title>College Projects Form | INDSAC SOFTECH</title>
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-top: 30px;
        }
        .form-title {
            color: #0d6efd;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-submit {
            width: 100%;
            padding: 10px;
            font-weight: bold;
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
  <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $project = $_POST['project'];
  $expected_due_date = $_POST['expected_due_date'];
  $outcome = $_POST['outcome'];
  $stmt = $db->prepare("INSERT INTO application(mobile, email,project,expected_due_date,outcome,status,type) VALUES (?, ?, ?, ?,?,?,?)");
  $stmt->execute([$mobile, $email, $project, $expected_due_date,$outcome,"Submited","College Final Year Projects Development
  "]);
  // Check if the query was successful
 if ($stmt->rowCount() > 0) {
  // Success: Show alert and redirect
  echo '<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i> Alert!</h5>
          Data saved successfully
        </div>';

  // Redirect using JavaScript after displaying the success message
  echo '<script type="text/javascript">
          setTimeout(function() {
              window.location.href = "collegeprojectsform.php"; 
          }, 2000); // Redirect after 2 seconds
        </script>';
} else {
  // Error: Show error alert
  echo '<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-times"></i> Error!</h5>
          There was an error updating the data.
        </div>';
}

  //header('Location: collegeprojectsform.php');
  //exit();
}?>
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
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="form-container">
                    <h2 class="form-title">Final Year Project Enquiry</h2>
                    <form id="projectForm" method="post">
                        <!-- Mobile Number -->
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile Number*</label>
                            <input type="mobile"  name ="mobile"class="form-control" id="mobile" placeholder="e.g., +91 9876543210" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="e.g., student@example.com" required>
                        </div>

                        <!-- Project Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Project Description/Idea*</label>
                            <textarea class="form-control" name="project" id="description" rows="4" placeholder="Describe your project idea in detail..." required></textarea>
                        </div>

                        <!-- Expected Outcome -->
                        <div class="mb-3">
                            <label for="outcome" class="form-label">Expected Outcome*</label>
                            <textarea class="form-control" name="outcome" id="outcome" rows="3" placeholder="What do you hope to achieve with this project?" required></textarea>
                        </div>

                        <!-- Due Date -->
                        <div class="mb-3">
                            <label for="duedate" class="form-label">Expected Due Date*</label>
                            <input type="date" name="expected_due_date" class="form-control" id="duedate" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-submit">Submit Enquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS (Optional, for form validation) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Form Submission Handling (Example) -->
    <!--<script>
        document.gemobileementById('projectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Enquiry submitted successfully! We will contact you soon.');
            // You can add AJAX/fetch() here to send data to a server
        });
    </script>-->


  <!-- 🔻 Footer -->
  <div class="footer">
    <div class="footer-content">
      <div class="footer-row">
        <div class="footer-col">
          <ul>
            <li><a href="#">About us</a></li>
            <li><a href="#">We're hiring</a></li>
            <li><a href="referralworkflow.php">Referral Program</a></li>
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
