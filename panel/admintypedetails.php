<?php
include("../panel/util/statuscolour.php");
include("../includes/db.php");
include("../panel/util/session.php");





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
  //echo "<pre>";print_r($applicationdata);die;

  foreach ($applicationdata as $app)

{
  $_SESSION['UserID'] = $app['UserID'];
  $_SESSION['email1'] = $app['email'];

}
//count for task
$stmt = $db->prepare("SELECT COUNT(*) FROM task WHERE studentid = :studentid");
$stmt->bindParam(':studentid', $_SESSION['UserID'], PDO::PARAM_INT);
$stmt->execute();
$taskCount = $stmt->fetchColumn();


//count for document
$stmt = $db->prepare("SELECT COUNT(*) FROM documents WHERE studentid = :studentid");
$stmt->bindParam(':studentid', $_SESSION['UserID'], PDO::PARAM_INT);
$stmt->execute();
$documentCount = $stmt->fetchColumn();

//count for ticket
$stmt = $db->prepare("SELECT COUNT(*) FROM ticket WHERE studentid = :studentid");
$stmt->bindParam(':studentid', $_SESSION['UserID'], PDO::PARAM_INT);
$stmt->execute();
$ticketCount = $stmt->fetchColumn();

//count for referal
$stmt = $db->prepare("SELECT COUNT(*) FROM referrals WHERE userid = :studentid");
$stmt->bindParam(':studentid', $_SESSION['UserID'], PDO::PARAM_INT);
$stmt->execute();
$referralCountdata = $stmt->fetchColumn();

// Count for application
$stmt = $db->prepare("SELECT COUNT(*) FROM application WHERE email = :email1");
$stmt->bindParam(':email1', $_SESSION['email1'], PDO::PARAM_STR); // use PARAM_STR for strings
$stmt->execute();
$applicationCount1 = $stmt->fetchColumn();

   
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
  <title>Admin-Application | INDSAC SOFTECH</title>
  <link rel="icon" type="image/png" href="../favico.png">
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
    <?php foreach ($applicationdata as $app): ?>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-file-alt"></i> <?php echo htmlspecialchars($app['type']); ?>
      </h3>
    </div>
    <div class="card-body">
  <!-- Stat boxes -->
  <div class="row">
  
    <!-- Referral Count -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-light">
        <div class="inner">
          <h3><?php echo $referralCountdata ?></h3>
          <p>Total Referral Count</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-friends"></i>
        </div>
        <form action="adminreferral.php" method="POST">
          <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
          <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    View Referrals <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
  </form>
      </div>
    </div>

    <!-- Document Count -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-light">
        <div class="inner">
          <h3><?php echo $documentCount ?></h3>
          <p>Total Document Count</p>
        </div>
        <div class="icon">
          <i class="fas fa-file-alt"></i>
        </div>
        <form action="admindocument.php" method="POST">
          <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
          <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    View Documents <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
        </form>
      </div>
    </div>

    <!-- Task Count -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-light">
        <div class="inner">
          <h3><?php echo $taskCount ?></h3>
          <p>Total Task Count</p>
        </div>
        <div class="icon">
          <i class="fas fa-tasks"></i>
        </div>
        <form action="admintasks.php" method="POST">
          <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
          <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    View Tasks <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>  </form>
      </div>
    </div>

    <!-- Ticket Count -->
    <div class="col-lg-3 col-6">
      <div class="small-box bg-light">
        <div class="inner">
          <h3><?php echo $ticketCount ?></h3>
          <p>Total Ticket Count</p>
        </div>
        <div class="icon">
          <i class="fas fa-ticket-alt"></i>
        </div>
        <form action="admintickets.php" method="POST">
          <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
          <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    View Tickets <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
        </form>
      </div>
    </div>
     <!-- Ticket Count -->
    <!-- Application Count Box 1 -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-light">
    <div class="inner">
      <h3><?php echo $applicationCount1 ?? '--'; ?></h3>
      <p>Total Application Count</p>
    </div>
    <div class="icon">
      <i class="fas fa-hourglass-half"></i>
    </div>
    <form action="application.php" method="POST">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($app['email']); ?>">
      <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    View Applications <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>   </form>
  </div>
</div>

<!-- Application Count Box 2 -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-light">
    <div class="inner">
      <h3><?php echo $applicationCount2 ?? '--'; ?></h3>
      <p>--</p>
    </div>
    <div class="icon">
      <i class="fas fa-check-circle"></i>
    </div>
    <form action="#" method="POST">
      <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
      <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    -- <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
    </form>
  </div>
</div>

<!-- Application Count Box 3 -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-light">
    <div class="inner">
      <h3><?php echo $applicationCount3 ?? '--'; ?></h3>
      <p>--</p>
    </div>
    <div class="icon">
      <i class="fas fa-search"></i>
    </div>
    <form action="#" method="POST">
      <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
      <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    -- <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
    </form>
  </div>
</div>

<!-- Application Count Box 4 -->
<div class="col-lg-3 col-6">
  <div class="small-box bg-light">
    <div class="inner">
      <h3><?php echo $applicationCount4 ?? '--'; ?></h3>
      <p>--</p>
    </div>
    <div class="icon">
      <i class="fas fa-times-circle"></i>
    </div>
    <form action="#" method="POST">
      <input type="hidden" name="userid" value="<?php echo htmlspecialchars($app['UserID']); ?>">
      <div class="card-footer p-2 text-center small-box-footer" style="background-color: #f4f6f9; border-top: 1px solid #ddd;">
  <button type="submit" class="btn btn-link p-0" style="width: 100%; text-align: center;">
    -- <i class="fas fa-arrow-circle-right"></i>
  </button>
</div>
    </form>
  </div>
</div>

  </div>
</div>

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
              <span class="info-box-text">Payment Status</span>
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
            <li class="list-group-item">Status: <b><?php echo getStatusBadge($app['application_status']); ?></b></li>
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
            <li class="list-group-item">Duration: <b><?php echo htmlspecialchars($app['duration']); ?> </b></li>
            <li class="list-group-item">Start Date: <b><?php echo htmlspecialchars($app['start_date']); ?></b></li>
            <li class="list-group-item">Remote: <b><?php echo htmlspecialchars($app['is_remote']); ?></b></li>
            <li class="list-group-item">Stipend: <b><?php echo getStatusBadge($app['stipend_amount']); ?></b></li>
            <li class="list-group-item">Created At: <b><?php echo htmlspecialchars($app['created_at']); ?></b></li>
            <button type="button" class="btn btn-sm btn-primary" onclick="redirectToFormeditprograms('<?php echo $app['program_id']; ?>')">Edit</button>
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
            <li class="list-group-item">Created Date: <b><?php echo htmlspecialchars($app['CreateDate']); ?></b></li>
            <button type="button" class="btn btn-sm btn-primary" onclick="redirectToForm('<?php echo $app['PaymentVerificationID']; ?>')">Edit</button>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
  <?php endforeach; ?>
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
<form id="postRedirectFormedit" method="POST" action="editprograms.php" style="display:none;">
    <input type="hidden" name="program_id" id="posteditprogramid">
</form>


<script>
function redirectToFormeditprograms(id) {
    document.getElementById('posteditprogramid').value = id;
    document.getElementById('postRedirectFormedit').submit();
}
</script>
<form id="postRedirectForm" method="POST" action="paymentverificationform.php" style="display:none;">
    <input type="hidden" name="PaymentVerificationID" id="postPaymentVerificationID">
</form>


<script>
function redirectToForm(id) {
    document.getElementById('postPaymentVerificationID').value = id;
    document.getElementById('postRedirectForm').submit();
}
</script>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
