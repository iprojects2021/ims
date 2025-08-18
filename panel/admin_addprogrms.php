

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
$stmt = $db->prepare("SELECT *FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
$enuiry_data = $stmt->fetchAll();

?>
<?php



include("../panel/util/statuscolour.php");



$stmt = $db->prepare("SELECT * FROM application");
$stmt->execute(['email' => $email]);
$applicationdata = $stmt->fetchAll();


?>
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
              window.location.href = "admin_addprogrms.php"; 
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

      <!-- AdminLTE Card Wrapper -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Add New Program</h3>
  </div>
  <!-- /.card-header -->
  
  <!-- form start -->
  <form method="post">
    <div class="card-body">

      <div class="form-group">
        <label for="title">Program Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="e.g., Internship in Web Dev" required>
      </div>

      <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" id="slug" name="slug" placeholder="e.g., web-dev-internship" required>
      </div>

      <div class="form-group">
        <label for="short_description">Short Description</label>
        <input type="text" class="form-control" id="short_description" name="short_description" placeholder="A short overview..." required>
      </div>

      <div class="form-group">
        <label for="detailed_description">Detailed Description</label>
        <textarea class="form-control" id="detailed_description" name="detailed_description" rows="4" placeholder="Full internship details..." required></textarea>
      </div>

      <div class="form-group">
        <label for="duration">Duration</label>
        <input type="text" class="form-control" id="duration" name="duration" placeholder="e.g., 3 months" required>
      </div>

      <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="date" class="form-control" id="start_date" name="start_date" required>
      </div>

      <div class="form-group">
        <label for="end_date">End Date</label>
        <input type="date" class="form-control" id="end_date" name="end_date" required>
      </div>

      <div class="form-group">
        <label for="is_remote">Is Remote</label>
        <select class="form-control" id="is_remote" name="is_remote" required>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="form-group">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="e.g., Mumbai, India" required>
      </div>

      <div class="form-group">
        <label for="timezone">Time Zone</label>
        <input type="text" class="form-control" id="timezone" name="timezone" placeholder="e.g., IST" required>
      </div>

      <div class="form-group">
        <label for="stipend_amount">Stipend Amount</label>
        <input type="number" class="form-control" id="stipend_amount" name="stipend_amount" placeholder="e.g., 10000" required>
      </div>

      <div class="form-group">
        <label for="stipend_currency">Stipend Currency</label>
        <input type="text" class="form-control" id="stipend_currency" name="stipend_currency" placeholder="e.g., INR" required>
      </div>

      <div class="form-group">
        <label for="is_paid">Is Paid</label>
        <select class="form-control" id="is_paid" name="is_paid" required>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="form-group">
        <label for="application_deadline">Application Deadline</label>
        <input type="date" class="form-control" id="application_deadline" name="application_deadline" required>
      </div>

      <div class="form-group">
        <label for="max_applicants">Max Applicants</label>
        <input type="number" class="form-control" id="max_applicants" name="max_applicants" placeholder="e.g., 100" required>
      </div>

      <div class="form-group">
        <label for="is_active">Is Active</label>
        <select class="form-control" id="is_active" name="is_active" required>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit Program</button>
    </div>
  </form>
</div>
<!-- /.card -->

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
