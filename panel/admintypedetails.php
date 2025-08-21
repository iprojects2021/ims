<?php
include("../includes/db.php");
include("../panel/util/statuscolour.php");
session_start();

// Check user session
if (!isset($_SESSION["user"]["name"]) || trim($_SESSION["user"]["name"]) === '') {
    header("Location: ../student/login.php");
    exit();
}

$studentName = $_SESSION["user"]["name"];
$email = $_SESSION['user']['email'] ?? null;
try{
// Fetch user data (if needed)
$sql="SELECT * FROM users WHERE email = :email";
$stmt = $db->prepare($sql);
$stmt->execute(['email' => $email]);
$userData = $stmt->fetch();
}
catch(Exception $e)
{
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());

}
// Fetch application by ID if posted
$applicationData = [];
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['id'])) {
    $id = $_POST['id'];
    try{
    $sql="SELECT * FROM application WHERE id = ?";  
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $applicationData = $stmt->fetch(); // Only one record expected
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
  <title>INDSAC SOFTECH | Admin Dashboard</title>

  <!-- AdminLTE Styles -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include("leftmenu.php"); ?>

  <!-- Main Content Wrapper -->
  <div class="content-wrapper">
    
    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <h1>Application Details</h1>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">

        <?php if ($applicationData): ?>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><?php echo htmlspecialchars($applicationData['type']); ?></h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              
              <!-- Application Info -->
              <div class="col-md-8">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-muted text-center">Estimated Budget</span>
                        <span class="info-box-number text-muted text-center mb-0">₹2300</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-muted text-center">Amount Spent</span>
                        <span class="info-box-number text-muted text-center mb-0">₹2000</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="info-box bg-light">
                      <div class="info-box-content">
                        <span class="info-box-text text-muted text-center">Project Duration</span>
                        <span class="info-box-number text-muted text-center mb-0">20 Days</span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Activities Placeholder -->
                <div class="mt-4">
                  <h5>Recent Activity</h5>
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="User image">
                      <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                      <span class="description">Shared publicly - Today</span>
                    </div>
                    <p>Lorem ipsum content example...</p>
                  </div>
                </div>
              </div>

              <!-- Application Details -->
              <div class="col-md-4">
                <h5 class="text-primary">Details</h5>
                <p><strong>ID:</strong> <?php echo htmlspecialchars($applicationData['id']); ?></p>
                <p><strong>Mobile:</strong> <?php echo htmlspecialchars($applicationData['mobile']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($applicationData['email']); ?></p>
                <p><strong>Project:</strong> <?php echo htmlspecialchars($applicationData['project']); ?></p>
                <p><strong>Outcome:</strong> <?php echo htmlspecialchars($applicationData['outcome']); ?></p>
                <p><strong>Start Date:</strong> <?php echo htmlspecialchars($applicationData['expected_start_date']); ?></p>
                <p><strong>Due Date:</strong> <?php echo htmlspecialchars($applicationData['expected_due_date']); ?></p>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($applicationData['type']); ?></p>
                <p><strong>Status:</strong> <?php echo getStatusBadge($applicationData['status']); ?></p>
                <p><strong>Created:</strong> <?php echo htmlspecialchars($applicationData['createddate']); ?></p>

                <!-- File Links -->
                <h6 class="mt-4">Project Files</h6>
                <ul class="list-unstyled">
                  <li><a href="#" class="btn-link"><i class="far fa-file-word"></i> Functional-requirements.docx</a></li>
                  <li><a href="#" class="btn-link"><i class="far fa-file-pdf"></i> UAT.pdf</a></li>
                </ul>

                <div class="text-center">
                  <a href="#" class="btn btn-sm btn-primary">Add Files</a>
                  <a href="#" class="btn btn-sm btn-warning">Report Issue</a>
                </div>
              </div>

            </div>
          </div>
        </div>
        <?php else: ?>
          <div class="alert alert-warning">No application data found.</div>
        <?php endif; ?>

      </div>
    </section>
  </div>

  <?php include("footer.php"); ?>

</div>
<style>
.badge-orange {
    background-color: #fd7e14; /* Bootstrap's orange */
    color: #fff;
}
</style>
<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
