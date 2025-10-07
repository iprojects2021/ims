<?php
include("../panel/util/statuscolour.php");
include("../includes/db.php");
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
  $id = $_POST['id'];
  try{
 // $sql="SELECT * FROM application WHERE id = ?";
 $sql = "SELECT 
 a.*, 
 p.*, 
 pv.*,
 a.status AS application_status
FROM application a
LEFT JOIN programs p 
 ON a.program_id = p.program_id
LEFT JOIN paymentverification pv 
 ON a.paymentverificationid = pv.PaymentVerificationID
WHERE a.id = ?
";

  
  $stmt = $db->prepare($sql);
  $stmt->execute([$id]);
  $applicationdata = $stmt->fetchAll();
  //print_r($applicationdata);die;
   
  }
  catch(Exception $e)
  {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
  }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Portal | INDSAC SOFTECH</title>
  <link rel="icon" type="image/png" href="../favico.png">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
<?php include("leftmenu.php"); ?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Application Details</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="student-dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Application Type</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">

  <?php foreach ($applicationdata as $app): ?>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-file-alt"></i> <?php echo htmlspecialchars($app['type'] ?? ''); ?>

      </h3>
    </div>
    <div class="card-body">

      <!-- Top Summary Info -->
      <div class="row">
        <div class="col-md-4">
          <div class="info-box bg-gradient-info">
            <div class="info-box-content text-center">
              <span class="info-box-text">Payment Verification Status</span>
              <span class="info-box-number"><?php echo htmlspecialchars($app['VerificationStatus'] ?? ''); ?>
</span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-box bg-gradient-success">
            <div class="info-box-content text-center">
              <span class="info-box-text">Payment Status</span>
              <span class="info-box-number"><?php echo htmlspecialchars($app['Status'] ?? ''); ?>
</span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-box bg-gradient-warning">
            <div class="info-box-content text-center">
              <span class="info-box-text">Amount Paid</span>
              <span class="info-box-number"><?php echo htmlspecialchars($app['AmountPaid'] ?? ''); ?>
</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Application Information -->
      <div class="row mt-4">
        <div class="col-md-4">
          <h5><i class="fas fa-user"></i> Applicant Info</h5>
          <ul class="list-group list-group-flush">
          <li class="list-group-item">ID: <b><?php echo htmlspecialchars($app['id'] ?? ''); ?></b></li>
<li class="list-group-item">Mobile: <b><?php echo htmlspecialchars($app['mobile'] ?? ''); ?></b></li>
<li class="list-group-item">Email: <b><?php echo htmlspecialchars($app['email'] ?? ''); ?></b></li>
<li class="list-group-item">Project: <b><?php echo htmlspecialchars($app['project'] ?? ''); ?></b></li>
<li class="list-group-item">Outcome: <b><?php echo htmlspecialchars($app['outcome'] ?? ''); ?></b></li>
<li class="list-group-item">Start Date: <b><?php echo htmlspecialchars($app['expected_start_date'] ?? ''); ?></b></li>
<li class="list-group-item">Program Type: <b><?php echo htmlspecialchars($app['type'] ?? ''); ?></b></li>
<li class="list-group-item">Status: <b><?php echo getStatusBadge($app['application_status'] ?? ''); ?></b></li>
<li class="list-group-item">Created Date: <b><?php echo htmlspecialchars($app['createddate'] ?? ''); ?></b></li>
          </ul>
        </div>

        <!-- Program Details -->
        <div class="col-md-4">
          <h5><i class="fas fa-info-circle"></i> Program Details</h5>
          <ul class="list-group list-group-flush">
          <li class="list-group-item">Program ID: <b><?php echo htmlspecialchars($app['program_id'] ?? ''); ?></b></li>
<li class="list-group-item">Title: <b><?php echo htmlspecialchars($app['title'] ?? ''); ?></b></li>
<li class="list-group-item">Slug: <b><?php echo htmlspecialchars($app['slug'] ?? ''); ?></b></li>
<li class="list-group-item">Short Description: <b><?php echo htmlspecialchars($app['short_description'] ?? ''); ?></b></li>
<li class="list-group-item">Duration: <b><?php echo htmlspecialchars($app['duration'] ?? ''); ?> </b></li>
<li class="list-group-item">Start Date: <b><?php echo htmlspecialchars($app['start_date'] ?? ''); ?></b></li>
<li class="list-group-item">Remote: <b><?php echo htmlspecialchars($app['is_remote'] ?? ''); ?></b></li>
<li class="list-group-item">Stipend: <b><?php echo getStatusBadge($app['stipend_amount'] ?? ''); ?></b></li>
<li class="list-group-item">Created At: <b><?php echo htmlspecialchars($app['created_at'] ?? ''); ?></b></li>
          </ul>
        </div>

        <!-- Payment Verification -->
        <div class="col-md-4">
          <h5><i class="fas fa-credit-card"></i> Payment Verification</h5>
          <ul class="list-group list-group-flush">
          <li class="list-group-item">Payment ID: <b><?php echo htmlspecialchars($app['PaymentVerificationID'] ?? ''); ?></b></li>
<li class="list-group-item">User ID: <b><?php echo htmlspecialchars($app['UserID'] ?? ''); ?></b></li>
<li class="list-group-item">Payment Ref: <b><?php echo htmlspecialchars($app['PaymentID'] ?? ''); ?></b></li>
<li class="list-group-item">Bank RRN: <b><?php echo htmlspecialchars($app['BankRRN'] ?? ''); ?></b></li>
<li class="list-group-item">Order ID: <b><?php echo htmlspecialchars($app['OrderID'] ?? ''); ?></b></li>
<li class="list-group-item">Invoice ID: <b><?php echo htmlspecialchars($app['InvoiceID'] ?? ''); ?></b></li>
<li class="list-group-item">Email: <b><?php echo htmlspecialchars($app['Email'] ?? ''); ?></b></li>
<li class="list-group-item">Phone: <b><?php echo htmlspecialchars($app['Phone'] ?? ''); ?></b></li>
<li class="list-group-item">Created Date: <b><?php echo htmlspecialchars($app['CreateDate'] ?? ''); ?></b></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

</section>
</div>
<!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2025 <a href="https://indsac.com">INDSAC SOFTECH</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<style>
.badge-orange {
    background-color: #fd7e14; /* Bootstrap's orange */
    color: #fff;
}
</style>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
