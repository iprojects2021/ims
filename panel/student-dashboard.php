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
          <div class="dashboard-container">
    <!-- Internship Status -->
   <!-- <div class="card">
      <h2>Internship Status</h2>
      <p><strong>Position:</strong> Web Developer Intern</p>
      <p><strong>Company:</strong> TechSoft Solutions</p>
      <p><strong>Status:</strong> Selected</p>
      <p><strong>Duration:</strong> 3 Months</p>
    </div>-->

    <!-- Applications Summary -->
    <!--<div class="card">
      <h2>Application Summary</h2>
      <p>Applied: <strong>5</strong></p>
      <p>Shortlisted: <strong>2</strong></p>
      <p>Selected: <strong>1</strong></p>
      <p>Rejected: <strong>2</strong></p>
    </div>-->

    <!-- Upcoming Events -->
    <!--<div class="card">
      <h2>Upcoming Interview</h2>
      <p><strong>Date:</strong> July 28, 2025</p>
      <p><strong>Time:</strong> 11:00 AM</p>
      <p><strong>Company:</strong> FutureTech Inc</p>
    </div>-->

    <!-- Document Upload -->
   <!-- <div class="card">
      <h2>Documents</h2>
      <p>Resume: ✅</p>
      <p>NOC: ❌ <a href="#" class="btn">Upload</a></p>
      <p>Offer Letter: ❌</p>
    </div>-->

    <!-- Mentor Info -->
    <!--<div class="card">
      <h2>Mentor Info</h2>
      <p><strong>Name:</strong> Mr. Raj Malhotra</p>
      <p><strong>Email:</strong> raj@example.com</p>
      <p><strong>Status:</strong> Online 🟢</p>
    </div>-->

    <!-- Recommendations -->
    <!--<div class="card">
      <h2>Recommended Internships</h2>
      <p><strong>Role:</strong> Data Analyst Intern</p>
      <p><strong>Company:</strong> Insight Labs</p>
      <a href="#" class="btn">Apply Now</a>
    </div>-->
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
</body>
</html>
