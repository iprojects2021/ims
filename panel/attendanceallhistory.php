<?php
include("../includes/db.php");
include("../panel/util/session.php");
$useriddata=$_SESSION['user']['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['userid'])) 
{
  $id = $_POST['userid'];
  try{
    $sql="SELECT * FROM userhourlytracker WHERE userid =?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$id]);
  $allhistory = $stmt->fetchAll();
  //print_r($allhistory);die;
  
  }
  catch(Exception $e)
  {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
  }
}
$stmt = $db->prepare("SELECT *
FROM userattendance ua
JOIN userdaytracker udt ON ua.userid = udt.userid
WHERE ua.userid = :userid
");
$stmt->bindParam(':userid', $useriddata, PDO::PARAM_INT);
$stmt->execute();
$daytrackerhistory = $stmt->fetchAll();
//print_r($daytrackerhistory);die;
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
              <li class="breadcrumb-item"><a href="student-dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Attendance</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


<!-- AdminLTE Card with Table -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">All History List</h3>
  </div>
  <?php foreach ($daytrackerhistory as $row): ?>

    <div class="row">
  <!-- Login Time Box -->
  <div class="col-lg-4 col-md-6 col-12">
    <div class="small-box bg-gradient-danger shadow-lg">
      <div class="inner">
        <h4 class="mb-2">🕒 Login</h4>
        <p><strong>DateTime:</strong> </p>
        <p><strong></strong> <?php echo htmlspecialchars($row['logintime']); ?></p>
      </div>
      <div class="icon">
        <i class="fas fa-sign-in-alt"></i>
      </div>
      
    </div>
  </div>

  <!-- Logout Time Box -->
  <div class="col-lg-4 col-md-6 col-12">
    <div class="small-box bg-gradient-warning shadow-lg">
      <div class="inner">
        <h4 class="mb-2">🚪 Logout</h4>
        <p><strong>DateTime:</strong> </p>
        <p><strong></strong> <?php echo htmlspecialchars($row['logouttime'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
</p>
      </div>
      <div class="icon">
        <i class="fas fa-sign-out-alt"></i>
      </div>
      
    </div>
  </div>

  <!-- Notes Box -->
  <div class="col-lg-4 col-md-12 col-12">
    <div class="small-box bg-gradient-info shadow-lg">
      <div class="inner">
        <h4 class="mb-2">📝 Notes</h4>
        <p><?php echo nl2br(htmlspecialchars($row['notes'])); ?></p>
      </div>
      <div class="icon">
        <i class="fas fa-sticky-note"></i>
      </div>
      
    </div>
  </div>
</div><?php endforeach; ?>
<!-- /.card-header -->
  <div class="card-body table-responsive">
  <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>User Id</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Notes</th>
          <th>Create Date</th>
          
          </tr>
      </thead>
      <tbody>
        <?php if ($allhistory): ?>
          <?php foreach ($allhistory as $documentdata): ?>
            <tr>
              <td><?= htmlspecialchars($documentdata['id']) ?></td>
              <td><?= htmlspecialchars($documentdata['userid']) ?></td>
              <td><?= htmlspecialchars($documentdata['start_time']) ?></td>
              <td><?= htmlspecialchars($documentdata['start_time']) ?></td>
              <td><?= htmlspecialchars($documentdata['notes']) ?></td>
              <td><?= htmlspecialchars($documentdata['createdate']) ?></td>
              
              
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center">No documentdata found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->



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
<!-- DataTables  & Plugins -->
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
</body>
</html>
<!-- Hidden form to send POST -->
<form id="postForm" method="POST" action="studenttypehelp.php" style="display:none;">
    <input type="hidden" name="id" id="hiddenId">
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
</script>
