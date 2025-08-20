<?php
include("../includes/log.php");
$logger = new AdvancedLogger();
$logger->log('INFO', 'Entered into student_dashboard');
$manual_error = true;
if($manual_error){
  $logger->log('ERROR', 'This Manual Error');
}
?>

<?php
include("../includes/db.php");
// Start the session
session_start();
// Check if user session exists and name is not empty
if (
    !isset($_SESSION["user"]) || 
    !isset($_SESSION["user"]["name"]) || 
    trim($_SESSION["user"]["name"]) === ''
) {
    // Redirect to login page
    header("Location: ../student/login.php"); // Update this path as needed
    exit();
}
// Fetch the name from session
$studentName = isset($_SESSION["user"]["name"]) ? $_SESSION["user"]["name"] : "Student";
?>
<?php
$email = $_SESSION['user']['email'];
$stmt = $db->prepare("SELECT *FROM application WHERE email = :email ORDER BY createddate DESC 
LIMIT 1;
");
$stmt->execute(['email' => $email]);
$enuiry_data = $stmt->fetchAll();

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
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --light-bg: #f8f9fa;
            --dark-text: #212529;
            --light-text: #6c757d;
            --white: #ffffff;
            --success-color: #4bb543;
        }
     /* Compact Referral Section */
        .referral-widget {
            background-color: var(--white);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }
        
        .referral-widget::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: var(--accent-color);
        }
        
        .referral-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .referral-title {
            font-size: 1rem;
            font-weight: 600;
        }
        
        .referral-stats {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-weight: bold;
            color: var(--primary-color);
        }
        
        .stat-label {
            font-size: 0.8rem;
            color: var(--light-text);
        }
        
        .referral-link-container {
            display: flex;
            margin-bottom: 15px;
        }
        
        .referral-link {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
            font-size: 0.9rem;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        
        .copy-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0 15px;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .copy-btn:hover {
            background-color: var(--secondary-color);
        }
        
        .share-buttons {
            display: flex;
            gap: 10px;
        }
        
        .share-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .share-btn:hover {
            transform: translateY(-2px);
        }
        
        .email-btn {
            background-color: var(--light-text);
        }
        
        .sms-btn {
            background-color: var(--success-color);
        }
        
        .whatsapp-btn {
            background-color: #25D366;
        }
        
        .success-message {
            display: none;
            background-color: rgba(75, 181, 67, 0.2);
            color: var(--success-color);
            padding: 8px 12px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 0.9rem;
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
            <h1 class="m-0">Dashboard</h1>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
              <div class="callout callout-success">
                  <h5> Welcome!</h5>
                  Hello <strong><?php echo htmlspecialchars($studentName); ?></strong>, we're glad to have you here. Explore your dashboard, and make the most of your learning journey. Let's achieve greatness together!
              </div>
            </div>



<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-info">
    <div class="inner">
      <h3>Status</h3>
      <?php if (!empty($enuiry_data)): ?>
        <?php foreach ($enuiry_data as $enquiry): ?> 
          <p><?php echo htmlspecialchars($enquiry['type']); ?> -- <?php echo htmlspecialchars($enquiry['status']); ?></p>
        <?php endforeach; ?>
      <?php else: ?>
        <p>-</p>
      <?php endif; ?>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
    <p class="small-box-footer">Application Status</p>
  </div>
</div>
<!-- ./col -->

<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3>Resume</h3>
      <p>--</p>
    </div>
    <div class="icon">
      <i class="ion ion-stats-bars"></i>
    </div>
    <a href="resume_upload.php" class="small-box-footer">Upload Resume <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->

<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-warning">
    <div class="inner">
      <?php
      $useriddata = $_SESSION['user']['id'];
      $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
      $stmt->execute(['id' => $useriddata]);
      $clients = $stmt->fetchAll();
      ?>

      <?php if (!empty($clients)): ?>
        <?php foreach ($clients as $client): ?>
          <h3><?php echo htmlspecialchars($client['id']); ?></h3>
          <p><?php echo htmlspecialchars($client['full_name']); ?></p>
        <?php endforeach; ?>
      <?php else: ?>
        <h3>-</h3>
        <p>-</p>
      <?php endif; ?>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
    <a href="profile.php" class="small-box-footer">Profile <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>
<!-- ./col -->
  <!-- ./col -->
  <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
  </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
         <div class="row">
         
          <div class="col-12">
 <!-- Compact Referral Widget -->
            <div class="referral-widget">
                <div class="referral-header">
                    <span class="referral-title">Earn with Referrals</span>
                    <i class="fas fa-gift" style="color: var(--accent-color);"></i>
                </div>
                
                <div class="referral-stats">
                    <div class="stat-item">
                        <div class="stat-number">8</div>
                        <div class="stat-label">Referred</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">3</div>
                        <div class="stat-label">Enrolled</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">$150</div>
                        <div class="stat-label">Earned</div>
                    </div>
                </div>
                
                <div class="referral-link-container">
                    <div class="referral-link" id="referralLink">https://indsac.com/ims/referral/sarah456</div>
                    <button class="copy-btn" id="copyBtn">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
                <div class="success-message" id="copySuccess">Link copied to clipboard!</div>
                
                <p style="font-size: 0.9rem; color: var(--light-text); margin-bottom: 15px;">
                    Share your link and earn $50 when friends enroll in programs
                </p>
                
                <div class="share-buttons">
                    <div class="share-btn email-btn" title="Send via Email">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="share-btn sms-btn" title="Send via SMS">
                        <i class="fas fa-sms"></i>
                    </div>
                    <div class="share-btn whatsapp-btn" title="Share on WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                </div>
            </div>
  </div>

        </div>
    
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
</body>
</html>
