<?php
include("../includes/db.php");
include("../panel/util/session.php");
// Get current student/user ID
$studentId = $_SESSION["user"]["id"];
$createdBy = $studentId; // Assuming student created the ticket

// Handle form submission
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $subject = trim($_POST["subject"]);
//     $message = trim($_POST["message"]);
//     $status = "New"; // Default status

//     $filename = null;

//     // Handle file upload if a file was uploaded
//     if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
//         $uploadDir = "../uploads/tickets/";
//         if (!is_dir($uploadDir)) {
//             mkdir($uploadDir, 0777, true);
//         }

//         $originalName = basename($_FILES["file"]["name"]);
//         $filename = time() . "_" . preg_replace("/[^a-zA-Z0-9\._-]/", "_", $originalName); // sanitize filename
//         $targetPath = $uploadDir . $filename;

//         if (!move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) {
//             echo "<div class='alert alert-danger'>Failed to upload file.</div>";
//             exit();
//         }
//     }
//    try{
//     // Prepare SQL statement
//     $sql="INSERT INTO ticket 
//     (studentid, subject, message, status, assignedto, filename, createdate, createdby)
//     VALUES
//     (:studentid, :subject, :message, :status, :assignedto, :filename, NOW(), :createdby)
// ";
//     $stmt = $db->prepare($sql);

//     $result = $stmt->execute([
//         ':studentid' => $studentId,
//         ':subject' => $subject,
//         ':message' => $message,
//         ':status' => $status,
//         ':assignedto' => null,       // Ticket not yet assigned
//         ':filename' => $filename,
//         ':createdby' => $createdBy
//     ]);
//   }
//   catch(Exception $e)
//   {
//     $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
//   }

//     if ($result) {
//       echo '<div class="alert alert-success alert-dismissible">
//       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
//       <h5><i class="icon fas fa-check"></i> Alert!</h5>
//       Data saved successfully
//     </div>';
//     echo '<script type="text/javascript">
//     setTimeout(function() {
//         window.location.href = "studenthelp.php"; 
//     }, 2000); // Redirect after 2 seconds
//   </script>';

//     } else {
//       echo '<div class="alert alert-danger alert-dismissible">
//       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
//       <h5><i class="icon fas fa-times"></i> Error!</h5>
//       There was an error updating the data.
//     </div>';
//     }
// }
?>
<?php
try {
    $sql = "UPDATE notification 
            SET isread = 1 
            WHERE userid = 'admin' 
              AND menu_item = 'tickets'";
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
  <title>Admin-Ticket | INDSAC SOFTECH</title>
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
              <li class="breadcrumb-item active">Ticket</li>
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



      <?php
if (isset($_POST['userid'])) {
    $id = $_POST['userid'];

    try {
        $sql = "SELECT * FROM ticket WHERE studentid = :id ORDER BY createdate DESC";
        $stmt = $db->prepare($sql); // This was missing
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Use PARAM_STR if studentid is not always numeric
        $stmt->execute();
        $tickets = $stmt->fetchAll();
    } catch (Exception $e) {
        $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - ' . $sql . ' ,Exception Error = ' . $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT * FROM ticket ORDER BY createdate DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $tickets = $stmt->fetchAll();
    } catch (Exception $e) {
        $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - ' . $sql . ' ,Exception Error = ' . $e->getMessage());
    }
}
?>





<!-- AdminLTE Card with Table -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Ticket List</h3>
  </div>

  <!-- /.card-header -->
  <div class="card-body table-responsive">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>User Id</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Status</th>
          <th>Assigned To</th>
          <th>File</th>
          <th>Created Date</th>
          <th>Created By</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($tickets): ?>
          <?php foreach ($tickets as $ticket): ?>
            <tr class="clickable-row" data-id="<?= $ticket['id'] ?>">
              <td><?= htmlspecialchars($ticket['id']) ?></td>
              <td><?= htmlspecialchars($ticket['studentid']) ?></td>
              <td><?= htmlspecialchars($ticket['subject']) ?></td>
              <td><?= nl2br(htmlspecialchars($ticket['message'])) ?></td>
              <td>
                <?php if ($ticket['status'] == 'Open'): ?>
                  <span class="badge badge-success">Open</span>
                <?php elseif ($ticket['status'] == 'In Progress'): ?>
                  <span class="badge badge-warning">In Progress</span>
                <?php else: ?>
                  <span class="badge badge-secondary"><?= htmlspecialchars($ticket['status']) ?></span>
                <?php endif; ?>
              </td>
              <td><?= $ticket['assignedto'] ?? '<em>Not assigned</em>' ?></td>
              <td>
              <?php
// Remove the prefix 'uploads/ideas/' to get only the file name

$fileName = str_replace('uploads/', '', $ticket['filename'] ?? '');

?>

<a href="/ims/panel/download.php?file=<?= urlencode($fileName) ?>" target="_blank">View</a>
  </td>
              <td><?= date("Y-m-d H:i", strtotime($ticket['createdate'])) ?></td>
              <td><?= htmlspecialchars($ticket['createdby']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center">No tickets found.</td>
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
<form id="postForm" method="POST" action="adminticketdetails.php" style="display:none;">
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
