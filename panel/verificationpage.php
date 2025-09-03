<?php
include("../includes/db.php");
include("../panel/util/statuscolour.php");
include("../panel/util/session.php");
$studentName = htmlspecialchars($_SESSION["user"]["name"]);
$email = $_SESSION['user']['email'];
$userId = $_SESSION['user']['id'];

try
{
$stmt = $db->prepare("SELECT COUNT(*) AS pending_count FROM paymentverification WHERE VerificationStatus = 'Pending'");
$stmt->execute();
$pendingcount = $stmt->fetch(PDO::FETCH_ASSOC);

$sql="SELECT * FROM paymentverification";
$stmt = $db->prepare($sql);
$stmt->execute();
$applicationData = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(Exception $e)
{
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>INDSAC SOFTECH | Admin Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css" />
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />
  <style>
    .badge-orange {
      background-color: #fd7e14;
      color: #fff;
    }
    /* Add cursor pointer for clickable rows */
    .clickable-row {
      cursor: pointer;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include("leftmenu.php"); ?>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        
        <!-- Stat boxes -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $pendingcount['pending_count'];?></h3>
                <p>Pending</p>
              </div>
              <div class="icon"><i class="ion ion-bag"></i></div>
              <p class="small-box-footer">Application Status</p>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Resume</h3>
                <p>--</p>
              </div>
              <div class="icon"><i class="ion ion-stats-bars"></i></div>
              <a href="resume_upload.php" class="small-box-footer">Upload Resume <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                  <h3>--</h3>
                  <p>test</p>
                
              </div>
              <div class="icon"><i class="ion ion-person-add"></i></div>
              <a href="profile.php" class="small-box-footer">Profile <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>Unique Visitors</p>
              </div>
              <div class="icon"><i class="ion ion-pie-graph"></i></div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <!-- Applications table -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Applications</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Payment Verification ID</th>
                  <th>User ID</th>
                  <th>Payment ID</th>
                  <th>Bank RRN</th>
                  <th>Order ID</th>
                  <th>Invoice ID</th>
                  <th>Payment Method</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Amount Paid</th>
                  <th>Status</th>
                  <th>Notes</th>
                  <th>Refund</th>
                  <th>Verified By</th>
                  <th>Verfication Status</th>
                  <th>Created Date</th>
                  <th>Verification Date</th>
                  <th>Verify Notes</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($applicationData as $row): ?>
        
         <tr class="clickable-row" data-id="<?= $row['PaymentVerificationID'] ?>">
        <td><?= htmlspecialchars($row['PaymentVerificationID']) ?></td>
        <td><?= htmlspecialchars($row['UserID']) ?></td>
        <td><?= htmlspecialchars($row['PaymentID']) ?></td>
        <td><?= htmlspecialchars($row['BankRRN']) ?></td>
        <td><?= htmlspecialchars($row['OrderID']) ?></td>
        <td><?= htmlspecialchars($row['InvoiceID']) ?></td>
        <td><?= htmlspecialchars($row['PaymentMethod']) ?></td>
        <td><?= htmlspecialchars($row['Email']) ?></td>
        <td><?= htmlspecialchars($row['Phone']) ?></td>
        <td><?= htmlspecialchars($row['AmountPaid']) ?></td>
        <td><?= getStatusBadge($row['Status']) ?></td>
        <td><?= htmlspecialchars($row['Notes']) ?></td>
        <td><?= htmlspecialchars($row['Refund']) ?></td>
        <td><?= htmlspecialchars($row['VerifiedBy']) ?></td>
        <td><?= htmlspecialchars($row['VerificationStatus']) ?></td>
        <td><?= htmlspecialchars($row['CreateDate']) ?></td>
        <td><?= htmlspecialchars($row['VerificationDate']) ?></td>
            <td><?= htmlspecialchars($row['VerifyNotes']) ?></td>
        
      </tr>
    <?php endforeach; ?>

              </tbody>
              <tfoot>
                <tr>
                <th>Payment Verification ID</th>
                  <th>User ID</th>
                  <th>Payment ID</th>
                  <th>Bank RRN</th>
                  <th>Order ID</th>
                  <th>Invoice ID</th>
                  <th>Payment Method</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Amount Paid</th>
                  <th>Status</th>
                  <th>Notes</th>
                  <th>Refund</th>
                  <th>Verified By</th>
                  <th>Verfication Status</th>
                  <th>Created Date</th>
                  <th>Verification Date</th>
                  <th>Verify Notes</th>
                  </tr>
              </tfoot>
            </table>
          </div>
        </div>

      </div>
    </section>
  </div>

  <?php include("footer.php"); ?>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-- JS Includes -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<!-- Hidden form to send POST -->
<form id="postForm" method="POST" action="paymentverificationform.php" style="display:none;">
    <input type="hidden" name="PaymentVerificationID" id="hiddenId">
</form>
<script>
  
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            document.getElementById('hiddenId').value = id;
            document.getElementById('postForm').submit();
        });
    });
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

<!-- Add this CSS to hide any remaining + icon rows -->
<style>
  /* Hide the + icon cell if it somehow still appears */
  table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child::before,
  table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child::before {
    display: none !important;
  }

  /* Prevent the extra column for the + icon */
  table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child,
  table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child {
    padding-left: 8px !important;
  }
</style>

</body>
</html>
