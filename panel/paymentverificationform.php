<?php
include("../includes/db.php");
include("../panel/util/session.php");
// Fetch the name from session
$studentName = isset($_SESSION["user"]["name"]) ? $_SESSION["user"]["name"] : "Student";
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['PaymentVerificationID'])) 
{
  $id = $_POST['PaymentVerificationID'];
  try{
    $sql="SELECT * FROM paymentverification WHERE PaymentVerificationID =?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$id]);
  $paymentdata = $stmt->fetchAll();
 
  }
  catch(Exception $e)
  {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
  }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatedata'])) {
    // Prepare SQL query
    $sql = "UPDATE paymentverification SET
                UserID = :UserID,
                PaymentID = :PaymentID,
                BankRRN = :BankRRN,
                OrderID = :OrderID,
                InvoiceID = :InvoiceID,
                PaymentMethod = :PaymentMethod,
                AmountPaid = :AmountPaid,
                Email = :Email,
                Phone = :Phone,
                Status = :Status,
                Refund = :Refund,
                Notes = :Notes,
                VerifiedBy = :VerifiedBy,
                VerificationStatus = :VerificationStatus,
                CreateDate = :CreateDate,
                VerificationDate = :VerificationDate,
                VerifyNotes = :VerifyNotes
            WHERE PaymentVerificationID = :PaymentVerificationID";

    $stmt = $db->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':UserID', $_POST['UserID']);
    $stmt->bindParam(':PaymentID', $_POST['PaymentID']);
    $stmt->bindParam(':BankRRN', $_POST['BankRRN']);
    $stmt->bindParam(':OrderID', $_POST['OrderID']);
    $stmt->bindParam(':InvoiceID', $_POST['InvoiceID']);
    $stmt->bindParam(':PaymentMethod', $_POST['PaymentMethod']);
    $stmt->bindParam(':AmountPaid', $_POST['AmountPaid']);
    $stmt->bindParam(':Email', $_POST['Email']);
    $stmt->bindParam(':Phone', $_POST['Phone']);
    $stmt->bindParam(':Status', $_POST['Status']);
    $stmt->bindParam(':Refund', $_POST['Refund']);
    $stmt->bindParam(':Notes', $_POST['Notes']);
    $stmt->bindParam(':VerifiedBy', $_POST['VerifiedBy']);
    $stmt->bindParam(':VerificationStatus', $_POST['VerificationStatus']);
    $stmt->bindParam(':CreateDate', $_POST['CreatedDate']);
    $stmt->bindParam(':VerificationDate', $_POST['VerificationDate']);
    $stmt->bindParam(':VerifyNotes', $_POST['VerifyNotes']);
    $stmt->bindParam(':PaymentVerificationID', $_POST['PaymentVerificationID']); // Unique identifier

    // Execute and check
    if ($stmt->execute()) {
      $showAlert = 'success';
    } else {
      $showAlert = 'error';
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
              <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a>
</li>
              <li class="breadcrumb-item active">Payment Details</li>
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
    <h3 class="card-title">Payment Details</h3>
  </div>
  <!-- /.card-header -->
  
  
  <form method="post">
 
    
  <!-- Part 1: Payment Details -->
    <div class="card-body py-2">
    <?php foreach ($paymentdata as $row): ?>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="PaymentVerificationID" class="mb-1">Payment Verification ID</label>
          <input type="text" value="<?php echo htmlspecialchars($row['PaymentVerificationID']); ?>" class="form-control form-control-sm" id="PaymentVerificationID" name="PaymentVerificationID" required>
        </div>
        <div class="form-group col-md-4">
          <label for="UserID" class="mb-1">User ID</label>
          <input type="text" value="<?php echo htmlspecialchars($row['UserID']); ?>" class="form-control form-control-sm" id="UserID" name="UserID" required>
        </div>
        <div class="form-group col-md-4">
          <label for="PaymentID" class="mb-1">Payment ID</label>
          <input type="text"  value="<?php echo htmlspecialchars($row['PaymentID']); ?>" class="form-control form-control-sm" id="PaymentID" name="PaymentID" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="BankRRN" class="mb-1">Bank RRN</label>
          <input type="text" value="<?php echo htmlspecialchars($row['BankRRN']); ?>" class="form-control form-control-sm" id="BankRRN" name="BankRRN">
        </div>
        <div class="form-group col-md-4">
          <label for="OrderID" class="mb-1">Order ID</label>
          <input type="text" value="<?php echo htmlspecialchars($row['OrderID']); ?>" class="form-control form-control-sm" id="OrderID" name="OrderID">
        </div>
        <div class="form-group col-md-4">
          <label for="InvoiceID" class="mb-1">Invoice ID</label>
          <input type="text" value="<?php echo htmlspecialchars($row['InvoiceID']); ?>" class="form-control form-control-sm" id="InvoiceID" name="InvoiceID">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="PaymentMethod" class="mb-1">Payment Method</label>
          <input type="text" value="<?php echo htmlspecialchars($row['PaymentMethod']); ?>" class="form-control form-control-sm" id="PaymentMethod" name="PaymentMethod">
        </div>
        <div class="form-group col-md-6">
          <label for="AmountPaid" class="mb-1">Amount Paid</label>
          <input type="number" value="<?php echo htmlspecialchars($row['AmountPaid']); ?>" step="0.01" class="form-control form-control-sm" id="AmountPaid" name="AmountPaid">
        </div>
      </div>
    </div>
  

  <!-- Part 2: Contact & Status Info -->
    <div class="card-body py-2">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="Email" class="mb-1">Email</label>
          <input type="email" value="<?php echo htmlspecialchars($row['Email']); ?>" class="form-control form-control-sm" id="Email" name="Email">
        </div>
        <div class="form-group col-md-6">
          <label for="Phone" class="mb-1">Phone</label>
          <input type="text" value="<?php echo htmlspecialchars($row['Phone']); ?>" class="form-control form-control-sm" id="Phone" name="Phone">
        </div>
      </div>

      <div class="form-row">
      <div class="form-group col-md-4">
    <label for="Status" class="mb-1">Status</label>
    <select class="form-control form-control-sm" id="Status" name="Status">
      <option value="">-- Select Status --</option>
      <option value="Pending" <?php if ($row['Status'] == 'Pending') echo 'selected'; ?>>Pending</option>
      <option value="Success" <?php if ($row['Status'] == 'Success') echo 'selected'; ?>>Success</option>
      <option value="Failed" <?php if ($row['Status'] == 'Failed') echo 'selected'; ?>>Failed</option>
      <option value="Refunded" <?php if ($row['Status'] == 'Refunded') echo 'selected'; ?>>Refunded</option>
    </select>
  </div>

  <div class="form-group col-md-4">
  <label for="Refund" class="mb-1">Refund</label>
  <select class="form-control form-control-sm" id="Refund" name="Refund">
    <option value="No" <?php if ($row['Refund'] == 'No') echo 'selected'; ?>>No</option>
    <option value="Yes" <?php if ($row['Refund'] == 'Yes') echo 'selected'; ?>>Yes</option>
  </select>
</div>
        <div class="form-group col-md-4">
          <label for="Notes" class="mb-1">Notes</label>
          <input type="text" value="<?php echo htmlspecialchars($row['Notes']); ?>" class="form-control form-control-sm" id="Notes" name="Notes">
        </div>
        
<div class="form-group col-md-4">
  <label for="VerificationStatus" class="mb-1">Verification Status</label>
  <select class="form-control form-control-sm" id="VerificationStatus" name="VerificationStatus">
    <option value="">-- Select Status --</option>
    <option value="Pending" <?php if ($row['VerificationStatus'] == 'Pending') echo 'selected'; ?>>Pending</option>
    <option value="Verified" <?php if ($row['VerificationStatus'] == 'Verified') echo 'selected'; ?>>Verified</option>
    <option value="Rejected" <?php if ($row['VerificationStatus'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
  </select>
</div>
<div class="form-group col-md-4">
  <label for="VerifiedBy" class="mb-1">Verified By</label>
  <input type="text" value="<?php echo htmlspecialchars($row['VerifiedBy']); ?>" class="form-control form-control-sm" id="VerifiedBy" name="VerifiedBy">
  </div>

<div class="form-group col-md-4">
  <label for="CreatedDate" class="mb-1">Created Date</label>
  <input type="date" 
         value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($row['CreateDate']))); ?>" 
         class="form-control form-control-sm" 
         id="CreatedDate" 
         name="CreatedDate">
</div>

<div class="form-group col-md-4">
  <label for="VerificationDate" class="mb-1">Verification Date</label>
  <input type="date"
  value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($row['VerificationDate']))); ?>" 
         class="form-control form-control-sm"
         id="VerificationDate"
         name="VerificationDate">
</div>

<div class="form-group col-md-4">
  <label for="VerifyNotes" class="mb-1">Verify Notes</label>
  <input type="text" value="<?php echo htmlspecialchars($row['VerifyNotes']); ?>" class="form-control form-control-sm" id="VerifyNotes" name="VerifyNotes">
</div>


      </div>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="text-right mb-4">
    <button type="submit" class="btn btn-sm btn-primary" name="updatedata">Submit Payment Info</button>
  </div>
  <?php endforeach; ?>

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
<?php include("../panel/util/alert.php");?>
</body>
</html>
