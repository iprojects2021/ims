<?php
include("../panel/util/statuscolour.php");
include("../includes/db.php");
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
  $id = $_POST['id'];
  try{
 // $sql="SELECT * FROM application WHERE id = ?";
 $sql = "SELECT *
        FROM paymentverification pv
        JOIN application a ON pv.program_id = a.program_id
        JOIN programs p ON pv.program_id = p.program_id
        WHERE a.id = ?";

  
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
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php include("leftmenu.php"); ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

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
          <li class="breadcrumb-item"><a href="#">Home</a></li>
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
        <i class="fas fa-file-alt"></i> <?php echo htmlspecialchars($app['type']); ?>
      </h3>
    </div>
    <div class="card-body">

      <!-- Top Summary Info -->
      <div class="row">
        <div class="col-md-4">
          <div class="info-box bg-gradient-info">
            <div class="info-box-content text-center">
              <span class="info-box-text">Payment Verification Status</span>
              <span class="info-box-number"><?php echo htmlspecialchars($app['VerificationStatus']); ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-box bg-gradient-success">
            <div class="info-box-content text-center">
              <span class="info-box-text">Status</span>
              <span class="info-box-number"><?php echo htmlspecialchars($app['Status']); ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info-box bg-gradient-warning">
            <div class="info-box-content text-center">
              <span class="info-box-text">Amount Paid</span>
              <span class="info-box-number"><?php echo htmlspecialchars($app['AmountPaid']); ?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Application Information -->
      <div class="row mt-4">
        <div class="col-md-4">
          <h5><i class="fas fa-user"></i> Applicant Info</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">ID: <b><?php echo htmlspecialchars($app['id']); ?></b></li>
            <li class="list-group-item">Mobile: <b><?php echo htmlspecialchars($app['mobile']); ?></b></li>
            <li class="list-group-item">Email: <b><?php echo htmlspecialchars($app['email']); ?></b></li>
            <li class="list-group-item">Project: <b><?php echo htmlspecialchars($app['project']); ?></b></li>
            <li class="list-group-item">Outcome: <b><?php echo htmlspecialchars($app['outcome']); ?></b></li>
            <li class="list-group-item">Start Date: <b><?php echo htmlspecialchars($app['expected_start_date']); ?></b></li>
            <li class="list-group-item">Program Type: <b><?php echo htmlspecialchars($app['type']); ?></b></li>
            <li class="list-group-item">Status: <b><?php echo getStatusBadge($app['status']); ?></b></li>
            <li class="list-group-item">Created Date: <b><?php echo htmlspecialchars($app['createddate']); ?></b></li>
          </ul>
        </div>

        <!-- Program Details -->
        <div class="col-md-4">
          <h5><i class="fas fa-info-circle"></i> Program Details</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Program ID: <b><?php echo htmlspecialchars($app['program_id']); ?></b></li>
            <li class="list-group-item">Title: <b><?php echo htmlspecialchars($app['title']); ?></b></li>
            <li class="list-group-item">Slug: <b><?php echo htmlspecialchars($app['slug']); ?></b></li>
            <li class="list-group-item">Short Description: <b><?php echo htmlspecialchars($app['short_description']); ?></b></li>
            <li class="list-group-item">Duration: <b><?php echo htmlspecialchars($app['duration']); ?> days</b></li>
            <li class="list-group-item">Start Date: <b><?php echo htmlspecialchars($app['start_date']); ?></b></li>
            <li class="list-group-item">Remote: <b><?php echo htmlspecialchars($app['is_remote']); ?></b></li>
            <li class="list-group-item">Stipend: <b><?php echo getStatusBadge($app['stipend_amount']); ?></b></li>
            <li class="list-group-item">Created At: <b><?php echo htmlspecialchars($app['created_at']); ?></b></li>
          </ul>
        </div>

        <!-- Payment Verification -->
        <div class="col-md-4">
          <h5><i class="fas fa-credit-card"></i> Payment Verification</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Payment ID: <b><?php echo htmlspecialchars($app['PaymentVerificationID']); ?></b></li>
            <li class="list-group-item">User ID: <b><?php echo htmlspecialchars($app['UserID']); ?></b></li>
            <li class="list-group-item">Payment Ref: <b><?php echo htmlspecialchars($app['PaymentID']); ?></b></li>
            <li class="list-group-item">Bank RRN: <b><?php echo htmlspecialchars($app['BankRRN']); ?></b></li>
            <li class="list-group-item">Order ID: <b><?php echo htmlspecialchars($app['OrderID']); ?></b></li>
            <li class="list-group-item">Invoice ID: <b><?php echo htmlspecialchars($app['InvoiceID']); ?></b></li>
            <li class="list-group-item">Email: <b><?php echo htmlspecialchars($app['Email']); ?></b></li>
            <li class="list-group-item">Phone: <b><?php echo htmlspecialchars($app['Phone']); ?></b></li>
            <li class="list-group-item">Created Date: <b><?php echo htmlspecialchars($app['createddate']); ?></b></li>
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
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
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
