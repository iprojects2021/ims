<?php
include("../includes/db.php");
include("../panel/util/session.php");
?>
<?php
$email = $_SESSION['user']['email'];
$stmt = $db->prepare("SELECT *FROM application WHERE email = :email ORDER BY createddate DESC 
LIMIT 1;
");
$stmt->execute(['email' => $email]);
$enuiry_data = $stmt->fetchAll();

?>
 <?php
      $useriddata = $_SESSION['user']['id'];
      $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
      $stmt->execute(['id' => $useriddata]);
      $referdata = $stmt->fetchAll();
      
      ?>

<?php
$userid = $_SESSION['user']['id'];

// Get count of all statuses
$stmt = $db->prepare("
    SELECT status, COUNT(*) AS status_count 
    FROM referrals 
    WHERE userid = :id  
    GROUP BY status
");
$stmt->execute(['id' => $userid]);
$referralCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize variables
$pendingCount = 0;
$paidCount = 0;
$enrolledCount = 0;
$totalCount = 0;

// Map results
foreach ($referralCounts as $row) {
    $status = $row['status'];
    $count = $row['status_count'];
    $totalCount += $count;

    switch ($status) {
        case 'Pending':
            $pendingCount = $count;
            break;
        case 'Paid':
            $paidCount = $count;
            break;
        case 'Enrolled':
            $enrolledCount = $count;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INDSAC SOFTECH  |Student Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
      <style>
        :root {
            --primary-color: #4a6bff;
            --secondary-color: #f8f9fa;
            --accent-color: #ff6b6b;
            --text-color: #333;
            --light-text: #777;
            --white: #fff;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .hero {
            background: linear-gradient(135deg, var(--primary-color), #6a11cb);
            color: var(--white);
            padding: 60px 20px;
            text-align: center;
            border-radius: 10px;
            margin: 20px 0;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .hero p {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto 25px;
        }
        
        .referral-card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .card-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--primary-color);
        }
        
        .referral-stats {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-item {
            text-align: center;
            padding: 20px;
            background-color: var(--secondary-color);
            border-radius: 8px;
            flex: 1;
            min-width: 150px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--light-text);
            font-size: 0.9rem;
        }
        
        .referral-link-container {
            margin-bottom: 30px;
        }
        
        .referral-link-box {
            display: flex;
            margin-top: 15px;
        }
        
        .referral-link {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            font-size: 0.9rem;
            overflow-x: auto;
            white-space: nowrap;
        }
        
        .copy-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0 20px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .copy-btn:hover {
            background-color: #3a56d4;
        }
        
        .share-options {
            margin-top: 30px;
        }
        
        .share-method {
            margin-bottom: 20px;
        }
        
        .share-method h3 {
            margin-bottom: 15px;
            font-size: 1.2rem;
        }
        
        .input-group {
            display: flex;
            margin-bottom: 10px;
        }
        
        .input-group input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            font-size: 1rem;
        }
        
        .input-group button {
            background-color: var(--accent-color);
            color: var(--white);
            border: none;
            padding: 0 20px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .input-group button:hover {
            background-color: #e05555;
        }
        
        .social-share {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
        }
        
        .facebook {
            background-color: #3b5998;
        }
        
        .twitter {
            background-color: #1da1f2;
        }
        
        .linkedin {
            background-color: #0077b5;
        }
        
        .whatsapp {
            background-color: #25d366;
        }
        
        .rewards-section {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        .rewards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .reward-card {
            background-color: var(--secondary-color);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }
        
        .reward-card:hover {
            transform: translateY(-5px);
        }
        
        .reward-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }
        
        .reward-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        
        .reward-amount {
            font-weight: bold;
            color: var(--accent-color);
            font-size: 1.3rem;
            margin-bottom: 10px;
        }
        
        .reward-desc {
            color: var(--light-text);
            font-size: 0.9rem;
        }
        
        footer {
            text-align: center;
            padding: 30px 0;
            color: var(--light-text);
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .referral-stats {
                flex-direction: column;
            }
            
            .input-group {
                flex-direction: column;
            }
            
            .input-group input {
                border-radius: 5px;
                margin-bottom: 5px;
            }
            
            .input-group button {
                border-radius: 5px;
                padding: 12px;
            }
            
            .referral-link-box {
                flex-direction: column;
            }
            
            .referral-link {
                border-radius: 5px 5px 0 0;
            }
            
            .copy-btn {
                border-radius: 0 0 5px 5px;
                padding: 12px;
            }
        }
        
        /* Success message */
        .success-message {
            display: none;
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include("leftmenu.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Your Referral Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <section class="hero">
            <h1>Refer Friends, Earn Rewards</h1>
            <p>Share your unique referral link and earn when your friends enroll in our internship programs. The more you share, the more you earn!</p>
        </section>
        
        <section class="referral-card">
            
        
            <div class="referral-stats">
                <div class="stat-item">
                    <div class="stat-number"><?php echo $totalCount; ?></div>
                    <div class="stat-label">Referred</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $enrolledCount; ?></div>
                    <div class="stat-label">Enrolled</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $paidCount; ?></div>
                    <div class="stat-label">Earned</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo $pendingCount; ?></div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>
        
            <div class="referral-link-container">
                <h5>Your Unique Referral Link</h5>
                <?php foreach ($referdata as $info): ?>
                <div class="referral-link-box">
                    <div class="referral-link" id="referralLink"><?php echo htmlspecialchars($url . $info['refercode']); ?></div>
                    <button class="copy-btn" id="copyBtn">Copy</button>
                </div>
                <?php endforeach; ?>
                <div class="success-message" id="copySuccess">Link copied to clipboard!</div>
            </div>
            
            <div class="share-options">
                <h5>Share Your Link</h5>
                
                <div class="share-method">
                    <h6>Send via Email</h6>
                    <div class="input-group">
                        <input type="email" id="emailInput" placeholder="Enter friend's email address">
                        <button id="sendEmailBtn">Send</button>
                    </div>
                    <div class="success-message" id="emailSuccess">Email sent successfully!</div>
                </div>
                
                <div class="share-method">
                    <h6>Send via SMS</h6>
                    <div class="input-group">
                        <input type="tel" id="phoneInput" placeholder="Enter friend's mobile number">
                        <button id="sendSmsBtn">Send</button>
                    </div>
                    <div class="success-message" id="smsSuccess">SMS sent successfully!</div>
                </div>
                
                <div class="social-share">
                    <div class="social-btn facebook" title="Share on Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="social-btn twitter" title="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="social-btn linkedin" title="Share on LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                    <div class="social-btn whatsapp" title="Share on WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="rewards-section">
            
            <p>Here's what you can earn when your referrals enroll in our programs</p>
            
            <div class="rewards-grid">
                <div class="reward-card">
                    <div class="reward-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="reward-title">Basic Enrollment</h3>
                    <div class="reward-amount">$50</div>
                    <p class="reward-desc">When a friend enrolls in any basic internship program</p>
                </div>
                
                <div class="reward-card">
                    <div class="reward-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="reward-title">Tech Program</h3>
                    <div class="reward-amount">$75</div>
                    <p class="reward-desc">When a friend enrolls in a technical internship</p>
                </div>
                
                           
                <div class="reward-card">
                    <div class="reward-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="reward-title">Premium Program</h3>
                    <div class="reward-amount">$100</div>
                    <p class="reward-desc">When a friend enrolls in a premium internship</p>
                </div>
            </div>
        </section>
  </div>
  <!-- /.content-wrapper -->
 <?php include("footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
  <script>
        // Copy referral link functionality
        document.getElementById('copyBtn').addEventListener('click', function() {
            const referralLink = document.getElementById('referralLink');
            const copySuccess = document.getElementById('copySuccess');
            
            navigator.clipboard.writeText(referralLink.textContent)
                .then(() => {
                    copySuccess.style.display = 'block';
                    setTimeout(() => {
                        copySuccess.style.display = 'none';
                    }, 3000);
                })
                .catch(err => {
                    console.error('Failed to copy: ', err);
                });
        });
        
        // Email button functionality
        document.querySelector('.email-btn').addEventListener('click', function() {
            const referralLink = document.getElementById('referralLink').textContent;
            window.open(`mailto:?subject=Check out this internship opportunity&body=Hi! I thought you might be interested in this internship program. Use my referral link: ${encodeURIComponent(referralLink)}`);
        });
        
        // SMS button functionality
        document.querySelector('.sms-btn').addEventListener('click', function() {
            const referralLink = document.getElementById('referralLink').textContent;
            window.open(`sms:?&body=Check out this internship program! Use my referral link: ${encodeURIComponent(referralLink)}`);
        });
        
        // WhatsApp button functionality
        document.querySelector('.whatsapp-btn').addEventListener('click', function() {
            const referralLink = document.getElementById('referralLink').textContent;
            const message = `Check out this internship program! Use my referral link: ${referralLink}`;
            window.open(`https://wa.me/?text=${encodeURIComponent(message)}`);
        });
    </script>
    
    <script>
        // Copy Referral Link to Clipboard
        document.getElementById('copyBtn').addEventListener('click', function() {
            const referralLink = document.getElementById('referralLink').innerText;
            navigator.clipboard.writeText(referralLink).then(() => {
                document.getElementById('copySuccess').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('copySuccess').style.display = 'none';
                }, 2000);
            });
        });

        // Send Referral Data to Backend (PHP) when sharing via email or SMS
        function sendReferralData(email, phone) {
            fetch('saveReferral.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    'referred_email': email,
                    'referred_phone': phone,
                }),
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      console.log('Referral saved successfully:', data.referral_id);
                  } else {
                      console.log('Error saving referral:', data.message);
                  }
              }).catch(error => {
                  console.error('Error:', error);
              });
        }

        // Send Referral Link via Email
        document.getElementById('sendEmailBtn').addEventListener('click', function() {
            const email = document.getElementById('emailInput').value;
            const referralLink = document.getElementById('referralLink').innerText;

            if (email) {
                sendReferralData(email, null); // Send only email for now
                document.getElementById('emailSuccess').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('emailSuccess').style.display = 'none';
                }, 2000);
            } else {
                alert('Please enter a valid email address');
            }
        });

        // Send Referral Link via SMS
        document.getElementById('sendSmsBtn').addEventListener('click', function() {
            const phone = document.getElementById('phoneInput').value;
            const referralLink = document.getElementById('referralLink').innerText;

            if (phone) {
                sendReferralData(null, phone); // Send only phone number
                document.getElementById('smsSuccess').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('smsSuccess').style.display = 'none';
                }, 2000);
            } else {
                alert('Please enter a valid phone number');
            }
        });
    </script>
</body>
</html>
