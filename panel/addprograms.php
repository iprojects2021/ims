<?php session_start();
include("../includes/db.php");

// now $pdo is available to use for queries
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
  $stmt = $db->prepare("INSERT INTO programs (
    title, slug, short_description, detailed_description, duration,
    start_date,end_date ,is_remote, location, timezone,
    stipend_amount, stipend_currency, is_paid,
    application_deadline, max_applicants, is_active
) VALUES (
    :title, :slug, :short_description, :detailed_description, :duration,
    :start_date,:end_date, :is_remote, :location, :timezone,
    :stipend_amount, :stipend_currency, :is_paid,
    :application_deadline, :max_applicants, :is_active
)");

// Bind parameters from POST
$stmt->execute([
    ':title' => $_POST['title'],
    ':slug' => $_POST['slug'],
    ':short_description' => $_POST['short_description'],
    ':detailed_description' => $_POST['detailed_description'],
    ':duration' => $_POST['duration'],
    ':start_date' => $_POST['start_date'],
    ':end_date' => $_POST['end_date'],
    ':is_remote' => $_POST['is_remote'],
    ':location' => $_POST['location'],
    ':timezone' => $_POST['timezone'],
    ':stipend_amount' => $_POST['stipend_amount'],
    ':stipend_currency' => $_POST['stipend_currency'],
    ':is_paid' => $_POST['is_paid'],
    ':application_deadline' => $_POST['application_deadline'],
    ':max_applicants' => $_POST['max_applicants'],
    ':is_active' => $_POST['is_active']
]);


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
              window.location.href = "addprograms.php"; 
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
                    <h2 class="form-title">Add Programs</h2>
                    <form id="projectForm" method="post">
                        <!-- Mobile Number -->
                        <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" id="title" placeholder="e.g., Internship in Web Dev" required>
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" name="slug" class="form-control" id="slug" placeholder="e.g., web-dev-internship" required>
</div>

<div class="mb-3">
    <label for="short_description" class="form-label">Short Description</label>
    <input type="text" name="short_description" class="form-control" id="short_description" placeholder="A short overview..." required>
</div>

<div class="mb-3">
    <label for="detailed_description" class="form-label">Detailed Description</label>
    <textarea name="detailed_description" class="form-control" id="detailed_description" rows="4" placeholder="Full internship details..." required></textarea>
</div>

<div class="mb-3">
    <label for="duration" class="form-label">Duration</label>
    <input type="text" name="duration" class="form-control" id="duration" placeholder="e.g., 3 months" required>
</div>

<div class="mb-3">
    <label for="start_date" class="form-label">Start Date</label>
    <input type="date" name="start_date" class="form-control" id="start_date" required>
</div>
<div class="mb-3">
    <label for="end_date" class="form-label">End Date</label>
    <input type="date" name="end_date" class="form-control" id="end_date" required>
</div>

<div class="mb-3">
    <label for="is_remote" class="form-label">Is Remote</label>
    <select name="is_remote" class="form-control" id="is_remote" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
</div>

<div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <input type="text" name="location" class="form-control" id="location" placeholder="e.g., Mumbai, India" required>
</div>

<div class="mb-3">
    <label for="timezone" class="form-label">Time Zone</label>
    <input type="text" name="timezone" class="form-control" id="timezone" placeholder="e.g., IST" required>
</div>

<div class="mb-3">
    <label for="stipend_amount" class="form-label">Stipend Amount</label>
    <input type="number" name="stipend_amount" class="form-control" id="stipend_amount" placeholder="e.g., 10000" required>
</div>

<div class="mb-3">
    <label for="stipend_currency" class="form-label">Stipend Currency</label>
    <input type="text" name="stipend_currency" class="form-control" id="stipend_currency" placeholder="e.g., INR" required>
</div>

<div class="mb-3">
    <label for="is_paid" class="form-label">Is Paid</label>
    <select name="is_paid" class="form-control" id="is_paid" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
</div>

<div class="mb-3">
    <label for="application_deadline" class="form-label">Application Deadline</label>
    <input type="date" name="application_deadline" class="form-control" id="application_deadline" required>
</div>

<div class="mb-3">
    <label for="max_applicants" class="form-label">Max Applicants</label>
    <input type="number" name="max_applicants" class="form-control" id="max_applicants" placeholder="e.g., 100" required>
</div>

<div class="mb-3">
    <label for="is_active" class="form-label">Is Active</label>
    <select name="is_active" class="form-control" id="is_active" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
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
