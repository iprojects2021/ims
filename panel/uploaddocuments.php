<?php
include("../includes/db.php");
include("../panel/util/session.php");
session_start();

$useriddata=$_SESSION['user']['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $education = $_POST['education'];
    $remark = $_POST['remark'];
    $studentid = $useriddata; // Make sure $useriddata is defined
    $createdBy = $studentid;  // Assuming the student is the one who created it

    if (isset($_FILES['document']) && $_FILES['document']['error'] === 0) {
        $targetDir =$uploadFolder;
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $filename = basename($_FILES["document"]["name"]);
      //  $targetFilePath = $targetDir . time() . "_" . $filename;
      $targetFilePath = rtrim($targetDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . time() . "_" . $filename;

        if (move_uploaded_file($_FILES["document"]["tmp_name"], $targetFilePath)) {
            // Save document info to database
            $stmt = $db->prepare("INSERT INTO documents (education_level, file_path, remark, studentid, status) VALUES (?, ?, ?, ?, 'uploaded')");
            $result = $stmt->execute([$education, $targetFilePath, $remark, $studentid]);

            if ($result) {
                // Insert notification
                $menuItem = 'document'; // Use 'documents' or relevant menu section
                $notificationMessage = "New document uploaded by Student ID: " . $studentid;

                try {
                    $notifSql = "INSERT INTO notification (userid, menu_item, isread, message, createdBy) 
                                 VALUES ('admin', :menu_item, 0, :message, :createdBy)";
                    $notifStmt = $db->prepare($notifSql);
                    $notifStmt->execute([
                        ':menu_item' => $menuItem,
                        ':message' => $notificationMessage,
                        ':createdBy' => $createdBy
                    ]);
                } catch (Exception $e) {
                    // Optional: handle/log error
                    $logger->log('ERROR', 'Notification Insert Failed: ' . $e->getMessage());
                }

                $showAlert = 'success';
              } else {
                echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-times"></i> Error!</h5>
                    There was an error saving your document.
                </div>';
            }
        } else {
            echo "<div class='alert alert-danger'>Error uploading file.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>No file selected or upload error.</div>";
    }
}


?>

<?php

try{
$sql="SELECT * FROM documents where studentid=$useriddata";
$stmt = $db->prepare($sql);
$stmt->execute();
$documentlist = $stmt->fetchAll();
}
catch(Exception $e)
{
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
}
try{
  $sql="SELECT * FROM application";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $checkstatus = $stmt->fetchAll();
  }
  catch(Exception $e)
  {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
  }
?>
<?php
$useriddata=$_SESSION['user']['id'];
try {
    $sql = "UPDATE notification 
            SET isread = 1 
            WHERE userid =$useriddata 
              AND menu_item = 'document'";
    $db->query($sql);
} catch (Exception $e) {
    // Optional: Log the error
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
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Document</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

  
  <!-- form start -->
<!-- AdminLTE styled form -->
<div class="container mt-5">
    <div class="card card-primary">
        <div class="card-header"><h3 class="card-title">Upload Document</h3></div>
        <form method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="education">Select Education Level</label>
                    <select class="form-control" name="education" id="education" required>
                        <option value="">-- Select --</option>
                        <option value="10th">10th</option>
                        <option value="12th">12th</option>
                        <option value="Graduation">Graduation</option>
                    </select>
                </div>

                <div id="uploadSection" style="display:none;">
                    <div class="form-group">
                        <label for="document">Choose File</label>
                        <input type="file" class="form-control" name="document" id="document" required>
                    </div>
                    <div class="form-group">
                        <label for="remark">Remark</label>
                        <textarea class="form-control" name="remark" id="remark" rows="3" placeholder="Enter remark" ></textarea>
                    </div>
                </div>
            </div>
            <?php 
$allowedStatuses = ['Approved', 'Offer Sent', 'Confirmed', 'Ongoing', 'Completed'];

foreach ($checkstatus as $checkstatusdata): 
    if (in_array($checkstatusdata['status'], $allowedStatuses)): ?>
    
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="uploadBtn">Upload</button>
        </div>

<?php 
    endif;
endforeach; 
?>

             </form>
    </div>
</div>
<!-- AdminLTE Card with Table -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Document List</h3>
  </div>

  <!-- /.card-header -->
  <div class="card-body table-responsive">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Student ID</th>
          <th>Document Name</th>
          <th>Document File</th>
          <th>Remark</th>
          <th>Status</th>
          <th>Uploaded At</th>
          </tr>
      </thead>
      <tbody>
        <?php if ($documentlist): ?>
          <?php foreach ($documentlist as $documentdata): ?>
            <tr class="clickable-row" data-id="<?= $documentdata['id'] ?>">
              <td><?= htmlspecialchars($documentdata['id']) ?></td>
              <td><?= htmlspecialchars($documentdata['studentid']) ?></td>
              <td><?= htmlspecialchars($documentdata['education_level']) ?></td>
              <td>  <?php
// Remove the prefix 'uploads/ideas/' to get only the file name
$fileName = str_replace('uploads/', '', $documentdata['file_path']);
?>

<a href="/ims/panel/download.php?file=<?= urlencode($fileName) ?>" target="_blank">View</a>

                  </td>
              <td><?= htmlspecialchars($documentdata['remark']) ?></td>
              <td><?= htmlspecialchars($documentdata['status']) ?>
                </td>
              <td><?= date("Y-m-d H:i", strtotime($documentdata['uploaded_at'])) ?></td>
              
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
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<?php include("../panel/util/alert.php");?>
</body>
</html>
<!-- Script to show file upload when dropdown is selected -->
<script>
document.getElementById('education').addEventListener('change', function () {
    const selected = this.value;
    const uploadSection = document.getElementById('uploadSection');
    const uploadBtn = document.getElementById('uploadBtn');
    if (selected) {
        uploadSection.style.display = 'block';
        uploadBtn.style.display = 'inline-block';
    } else {
        uploadSection.style.display = 'none';
        uploadBtn.style.display = 'none';
    }
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

