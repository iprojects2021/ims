<?php
// Start session if not already started
//print_r($_POST);die;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include(__DIR__ . '/includes/db.php');
include(__DIR__ . '/panel/util/checkemailandmobile.php');

// Fetch user info from session
$email = $_SESSION['user']['email'] ?? null;
$role = $_SESSION['user']['role'] ?? null;

// Initialize mobile number
$mobilenumber = '';

if ($email) {
    $stmt = $db->prepare("SELECT contact FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $clients = $stmt->fetchAll();
    foreach ($clients as $client) {
        $mobilenumber = $client['contact'];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect and sanitize form data
    $mobile = trim($_POST['mobile'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $project = trim($_POST['project'] ?? 'Internship & Live Project Support');
    $expected_start_date = $_POST['expected_start_date'] ?? null;
    $outcome = trim($_POST['outcome'] ?? '');
    $github = trim($_POST['github'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $amount = $_POST['amount'] ?? 0;
    $duration = $_POST['duration'] ?? '';
    $program_id = $_POST['program_id'] ?? '';

    // Store posted data in session variables
    $_SESSION['application_data'] = [
        'mobile' => $mobile,
        'fullname' => $fullname,
        'email' => $email,
        'project' => $project,
        'expected_start_date' => $expected_start_date,
        'outcome' => $outcome,
        'github' => $github,
        'type' => $type,
        'amount' => $amount,
        'duration' => $duration,
        'program_id' => $program_id,
    ];

    try {
        // Start transaction
        $db->beginTransaction();

        // Insert into 'application' table
        $stmt = $db->prepare("
            INSERT INTO application 
            (mobile, fullname, email, project, expected_start_date, outcome, status, github, type, amount, duration, program_id, mentorid) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'admin')
        ");
        $stmt->execute([
            $mobile,
            $fullname,
            $email,
            $project,
            $expected_start_date,
            $outcome,
            'Submitted',
            $github,
            $type,
            $amount,
            $duration,
            $program_id
            
        ]);
        $id = $db->lastInsertId();
        $_SESSION['applicationid']=$id;
        // Check for referral
        $referral = checkReferralByEmailOrPhone($db, $email, $mobile);

        if ($referral) {
            $referralid = $referral['id'];

            // Enroll user
            $enrollStmt = $db->prepare("
                INSERT INTO enrollments (referralid, program, enrollmentdate, fee_paid) 
                VALUES (?, ?, NOW(), ?)
            ");
            $enrollStmt->execute([$referralid, $project, 0.00]);

            // Update referral status
            $updateReferralStmt = $db->prepare("UPDATE referrals SET status = 'Enrolled' WHERE id = ?");
            $updateReferralStmt->execute([$referralid]);
        }
        // ✅ 6. Insert Notification for Admin
        $menuItem = 'application'; // Adjust to appropriate section name
        $notificationMessage = "New application submitted by email: " . $email;
        $createdBy = $email; // or use a fixed value like 'system' or 'webform'

        $notifSql = "INSERT INTO notification (userid, menu_item, isread, message, createdBy) 
                     VALUES ('admin', :menu_item, 0, :message, :createdBy)";
        $notifStmt = $db->prepare($notifSql);
        $notifStmt->execute([
            ':menu_item' => $menuItem,
            ':message' => $notificationMessage,
            ':createdBy' => $createdBy
        ]);

        // Commit all changes
        $db->commit();
        $showAlert = 'success';

    } catch (Exception $e) {
        $db->rollBack();
        $showAlert = 'error';
        error_log("Application submission failed: " . $e->getMessage());
    }
}
?>





<!DOCTYPE html>


<html lang="en">
<head><link rel="shortcut icon" href="favico.png" type="image/x-icon" />
  <meta charset="UTF-8">
  <title>Program Payment | INDSAC SOFTECH</title>
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

  <!-- ✅ Navbar -->
  <nav class="navbar">
    <div class="logo">INDSAC SOFTECH</div>
    <ul class="nav-links">
      <li><a href="/ims/index.php">Home</a></li>
      <li><a href="/ims/student/register.php">Register</a></li>
      <li><a href="/ims/student/login.php">Login</a></li>
    </ul>
  </nav>
   <div class="container">
    <br>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS - Payment Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --danger: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

      
       
        .header {
            background: var(--primary);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            font-size: 2rem;
        }

        .logo h1 {
            font-size: 1.8rem;
        }

        .nav {
            display: flex;
            gap: 20px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
        }

        .payment-details {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            background: white;
        }

        .payment-summary {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            background: #f9fafc;
            border-left: 1px solid #e2e8f0;
        }

        h2 {
            color: var(--dark);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: var(--primary);
            outline: none;
        }

        .row {
            display: flex;
            gap: 15px;
        }

        .row .form-group {
            flex: 1;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .summary-item p {
            color: var(--gray);
        }

        .summary-item .value {
            font-weight: 600;
            color: var(--dark);
        }

        .total {
            display: flex;
            justify-content: space-between;
            margin: 25px 0;
            padding: 15px;
            background: var(--light);
            border-radius: 8px;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .payment-methods {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .payment-method {
            flex: 1;
            text-align: center;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-method:hover {
            border-color: var(--primary);
        }

        .payment-method.selected {
            border-color: var(--primary);
            background: rgba(67, 97, 238, 0.1);
        }

        .payment-method i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .btn {
            display: block;
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: var(--secondary);
        }

        .secure {
            text-align: center;
            margin-top: 20px;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .secure i {
            color: var(--success);
            margin-right: 5px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: var(--gray);
            font-size: 0.9rem;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }
            
            .payment-summary {
                border-left: none;
                border-top: 1px solid #e2e8f0;
            }
            
            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .nav {
                justify-content: center;
            }
            
            .row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .payment-methods {
                flex-direction: column;
            }
            
            .logo h1 {
                font-size: 1.5rem;
            }
            
            h2 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="content">
            <div class="payment-details">
                <h2>Program Details</h2>
                <form id="payment-form">
                <div class="form-group">
        <label for="card-name">Program Id</label>
        <input type="text" id="card-name" name="program_id" placeholder="program_id" required 
               value="<?php echo htmlspecialchars($_SESSION['application_data']['program_id'] ?? '', ENT_QUOTES); ?>">
    </div>
    
    <div class="form-group">
        <label for="card-name">Name</label>
        <input type="text" id="card-name" name="fullname" placeholder="Name" required 
               value="<?php echo htmlspecialchars($_SESSION['application_data']['fullname'] ?? '', ENT_QUOTES); ?>">
    </div>
    
    <div class="form-group">
        <label for="card-number">Email</label>
        <input type="email" id="card-number" name="email" placeholder="Email" required 
               value="<?php echo htmlspecialchars($_SESSION['application_data']['email'] ?? '', ENT_QUOTES); ?>">
    </div>
    
    <div class="form-group">
        <label for="billing-address">Mobile</label>
        <input type="text" id="billing-address" name="mobile" placeholder="Mobile" required
               value="<?php echo htmlspecialchars($_SESSION['application_data']['mobile'] ?? '', ENT_QUOTES); ?>">
    </div>
    
    <div class="row">
        <div class="form-group">
            <label for="city">Program</label>
            <input type="text" id="city" name="project" placeholder="Program" required
                   value="<?php echo htmlspecialchars($_SESSION['application_data']['type'] ?? '', ENT_QUOTES); ?>">
        </div>
        
        <div class="form-group">
            <label for="zip">Duration</label>
            <input type="text" id="zip" name="duration" placeholder="Duration" required
                   value="<?php echo htmlspecialchars($_SESSION['application_data']['duration'] ?? '', ENT_QUOTES); ?>">
        </div>
    </div>
    
    <div class="row">
        <div class="form-group">
            <label for="expiry">Program Start Date</label>
            <input type="text" id="expiry" name="expected_start_date" placeholder="MM/YY" required
                   value="<?php echo htmlspecialchars($_SESSION['application_data']['expected_start_date'] ?? '', ENT_QUOTES); ?>">
        </div>
        
        <!-- <div class="form-group">
            <label for="cvv">College Passing Month</label>
            <input type="text" id="cvv" name="college_passing_month" placeholder="MM/YY" required
                   value="<?php echo htmlspecialchars($_SESSION['application_data']['college_passing_month'] ?? '', ENT_QUOTES); ?>">
        </div> -->
    </div>
    
    <!-- <div class="form-group">
        <label for="country">Country</label>
        <select id="country" name="country" required>
            <option value="">Select Country</option>
            <option value="usa" <?php if(($_SESSION['application_data']['country'] ?? '') === 'usa') echo 'selected'; ?>>United States</option>
            <option value="uk" <?php if(($_SESSION['application_data']['country'] ?? '') === 'uk') echo 'selected'; ?>>United Kingdom</option>
            <option value="canada" <?php if(($_SESSION['application_data']['country'] ?? '') === 'canada') echo 'selected'; ?>>Canada</option>
            <option value="australia" <?php if(($_SESSION['application_data']['country'] ?? '') === 'australia') echo 'selected'; ?>>Australia</option>
            <option value="india" <?php if(($_SESSION['application_data']['country'] ?? '') === 'india') echo 'selected'; ?>>India</option>
        </select>
    </div> -->
</form>

            </div>
            
            <div class="payment-summary">
                <h2>Program Summary</h2>
                
                <div class="summary-item">
                    <p>Program Amount</p>
                    <p><strong>Amount:</strong> <span id="modal-amount"><?php echo htmlspecialchars($amount); ?></span></p>
                </div>
                
                
                                
                <div class="total">
                    <p>Total</p>
                   <p>₹<?php echo htmlspecialchars($amount); ?></p>
                </div>
                
                <h2>Payment Method Available</h2>
                
                <div class="payment-methods">
                    <div class="payment-method">
                        <i class="fas fa-qrcode"></i>
                        <p> QR Code</p>
                    </div>
                    <div class="payment-method">
                        <i class="fas fa-credit-card"></i>
                        <p> Card</p>
                    </div>
                    
                    <div class="payment-method">
                        <i class="fab fa-wallet"></i>
                        <p>Wallet</p>
                    </div>
                    
                    <div class="payment-method">
                        <i class="fas fa-university"></i>
                        <p>NetBanking</p>
                    </div>
                </div>
                <form><?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize amount
    $amount = isset($_POST['amount']) ? preg_replace('/\D/', '', $_POST['amount']) : 0;
    $amount = (int)$amount; // Convert to integer
    $_SESSION['amount'] = $amount;


    

    switch ($amount) {
        case 1000:
            echo '<script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_RHsuqTDPNwtf43" async> </script>';
            break;
        case 2000:
            echo '<script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_RGali4u2zGlJvr" async> </script>';
            break;
        case 3000:
            echo '<script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_RBUyb7qUMYYVAi" async> </script>';
            break;
        case 5000:
            echo '<script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_RBVc6Cd6lxZitM" async> </script>';
            break;
        case 8000:
            echo '<script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_RBVfcVC1KtbWd3" async> </script>';
            break;
        case 10000:
            echo '<script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_RBVj0dPZqQBouR" async> </script>';
            break;
        default:
            echo "<p style='color:red;'>⚠ Invalid plan amount selected!</p>";
            break;
    }
} else {
    echo "<p style='color:red;'>Invalid plan selected.</p>";
}
?>
 </form>

               
                <div class="secure">
                    <p><i class="fas fa-lock"></i> Your payment is secure and encrypted</p>
                </div>
            </div>
        </div>
        

        <div class="footer">
            <p>© 2023 Inventory Management System. All rights reserved.</p>
            <p>Need help? Contact support at support@ims.com or call +1 (800) 123-4567</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method selection
            const paymentMethods = document.querySelectorAll('.payment-method');
            
            paymentMethods.forEach(method => {
                method.addEventListener('click', function() {
                    paymentMethods.forEach(m => m.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });
            
            // Format card number input
            const cardNumberInput = document.getElementById('card-number');
            
            cardNumberInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 16) value = value.slice(0, 16);
                
                // Format with spaces every 4 characters
                let formattedValue = '';
                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) formattedValue += ' ';
                    formattedValue += value[i];
                }
                
                this.value = formattedValue;
            });
            
            // Format expiry date input
            const expiryInput = document.getElementById('expiry');
            
            expiryInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 4) value = value.slice(0, 4);
                
                if (value.length > 2) {
                    this.value = value.slice(0, 2) + '/' + value.slice(2);
                } else {
                    this.value = value;
                }
            });
            
            // Form submission
            const paymentForm = document.getElementById('payment-form');
            
            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // In a real application, you would process the payment here
                alert('Payment processed successfully!');
                
                // You would typically redirect to a success page here
                // window.location.href = "/payment-success.html";
            });
        });
    </script>
</body>
</html>
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
