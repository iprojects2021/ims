

<?php
include("../includes/db.php");
include("../panel/util/session.php");
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
$stmt->execute();
$applicationdata = $stmt->fetchAll();


?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $stmt = $db->prepare("INSERT INTO programs (
    title, slug, short_description, detailed_description, duration,
    start_date,end_date ,is_remote, location, timezone,
    stipend_amount, stipend_currency, is_paid,
    application_deadline, max_applicants, is_active, status, mentorid, SuperProgram
) VALUES (
    :title, :slug, :short_description, :detailed_description, :duration,
    :start_date,:end_date, :is_remote, :location, :timezone,
    :stipend_amount, :stipend_currency, :is_paid,
    :application_deadline, :max_applicants, :is_active, :status, :mentorid, :SuperProgram
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
    ':is_active' => $_POST['is_active'],
    ':status' =>"new",
    ':mentorid' =>"admin",
    ':SuperProgram' =>$_POST['SuperProgram']
    
]);


    // Check if the query was successful
 if ($stmt->rowCount() > 0) {
  $showAlert = 'success';
} else {
  $showAlert = 'error';
}

  //header('Location: collegeprojectsform.php');
  //exit();
}?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin-Programs | INDSAC SOFTECH</title>
  <link rel="icon" type="image/png" href="../favico.png">


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
               <div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="m-0">Dashboard</h1>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
    Add Program
  </button>
</div>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Add Programs</li>
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
    <div class="row">

      <div class="col-md-6 mb-2">
        <label for="title" class="form-label">Program Title</label>
        <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="e.g., Internship in Web Dev" required>
      </div>
      <div class="col-md-6 mb-2">
        <label for="SuperProgram" class="form-label">SuperProgram</label>
        <input type="text" class="form-control form-control-sm" id="SuperProgram" name="SuperProgram" placeholder="e.g., Internship in Web Dev" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control form-control-sm" id="slug" name="slug" placeholder="e.g., web-dev-internship" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="short_description" class="form-label">Short Description</label>
        <input type="text" class="form-control form-control-sm" id="short_description" name="short_description" placeholder="A short overview..." required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="duration" class="form-label">Duration</label>
        <input type="text" class="form-control form-control-sm" id="duration" name="duration" placeholder="e.g., 3 months" required>
      </div>

      <div class="col-md-12 mb-2">
        <label for="detailed_description" class="form-label">Detailed Description</label>
        <textarea class="form-control form-control-sm" id="detailed_description" name="detailed_description" rows="3" placeholder="Full internship details..." required></textarea>
      </div>

      <div class="col-md-6 mb-2">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" class="form-control form-control-sm" id="start_date" name="start_date" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" class="form-control form-control-sm" id="end_date" name="end_date" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="is_remote" class="form-label">Is Remote</label>
        <select class="form-control form-control-sm" id="is_remote" name="is_remote" required>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="col-md-6 mb-2">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control form-control-sm" id="location" name="location" placeholder="e.g., Mumbai, India" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="timezone" class="form-label">Time Zone</label>
        <input type="text" class="form-control form-control-sm" id="timezone" name="timezone" placeholder="e.g., IST" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="stipend_amount" class="form-label">Stipend Amount</label>
        <input type="number" class="form-control form-control-sm" id="stipend_amount" name="stipend_amount" placeholder="e.g., 10000" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="stipend_currency" class="form-label">Stipend Currency</label>
        <input type="text" class="form-control form-control-sm" id="stipend_currency" name="stipend_currency" placeholder="e.g., INR" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="is_paid" class="form-label">Is Paid</label>
        <select class="form-control form-control-sm" id="is_paid" name="is_paid" required>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="col-md-6 mb-2">
        <label for="application_deadline" class="form-label">Application Deadline</label>
        <input type="date" class="form-control form-control-sm" id="application_deadline" name="application_deadline" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="max_applicants" class="form-label">Max Applicants</label>
        <input type="number" class="form-control form-control-sm" id="max_applicants" name="max_applicants" placeholder="e.g., 100" required>
      </div>

      <div class="col-md-6 mb-2">
        <label for="is_active" class="form-label">Is Active</label>
        <select class="form-control form-control-sm" id="is_active" name="is_active" required>
          <option value="1">Yes</option>
          <option value="0">No</option>
        </select>
      </div>

    </div>
  </div>

  <div class="card-footer text-end">
    <button type="submit" class="btn btn-sm btn-primary">Submit Program</button>
  </div>
</form>
<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="uploadModalLabel">Upload Program File</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="upload_programs.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          <div class="form-group">
            <label for="programFile">Choose file</label>
            <input type="file" class="form-control-file" id="programFile" name="program_file" required>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" >Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
<?php include("../panel/util/alert.php");?>
</body>
</html>
