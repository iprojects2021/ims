<?php
include("../includes/db.php");
include("../panel/util/session.php");

$studentId = $_SESSION["user"]["id"] ?? null;
if (!$studentId) {
    die("Unauthorized access.");
}

// Fetch Tasks
if (isset($_POST['userid'])) {
  $id = $_POST['userid'];
  try {
      $stmt = $db->prepare("SELECT * FROM task WHERE studentid = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Use PARAM_STR if it's not an integer
      $stmt->execute();
      $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
      $error = "Error fetching tasks: " . $e->getMessage();
      $tasks = [];
  }
} else {
  try {
      $stmt = $db->prepare("SELECT * FROM task");
      $stmt->execute();
      $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
      $error = "Error fetching tasks: " . $e->getMessage();
      $tasks = [];
  }
}


?>
<?php

try {
    $sql = "UPDATE notification 
            SET isread = 1 
            WHERE userid ='admin' 
              AND menu_item = 'task'";
    $db->query($sql);
} catch (Exception $e) {
    // Optional: Log the error
}
?>
<?php

try {
    $sql = "UPDATE notification 
            SET isread = 1 
            WHERE userid ='admin' 
              AND menu_item = 'task'";
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
  <title>Admin-Task  | INDSAC SOFTECH</title>
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

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid"><ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Tasks</li>
            </ol>
        
        <h1 class="m-0"> Tasks List</h1>
        
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

      
        </div>

        <!-- Task Table -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tasks List</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Due Date</th>
                  <th>Status</th>
                  
                  <th>Created</th>
                  <th>Updated</th>
            
                </tr>
              </thead>
              <tbody>
              <?php foreach ($tasks as $task): ?>
                <tr class="clickable-row" data-id="<?= $task['id'] ?>">
                  <td><?= $task['id'] ?></td>
                  <td><?= $task['studentid'] ?></td>
                  <td><?= htmlspecialchars($task['title']) ?></td>
                  <td><?= nl2br(htmlspecialchars($task['description'])) ?></td>
                  <td><?= htmlspecialchars($task['due_date']) ?></td>
                  <td>
                    <?php if ($task['status'] === 'Completed'): ?>
                      <span class="badge badge-success">Completed</span>
                    <?php elseif ($task['status'] === 'In Progress'): ?>
                      <span class="badge badge-warning">In Progress</span>
                    <?php else: ?>
                      <span class="badge badge-secondary"><?= htmlspecialchars($task['status']) ?></span>
                    <?php endif; ?>
                  </td>
                  
                  <td><?= date("Y-m-d H:i", strtotime($task['created_at'])) ?></td>
                  <td><?= date("Y-m-d H:i", strtotime($task['updated_at'])) ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>
  </div>

  <?php include("footer.php"); ?>

</div>

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

<!-- Hidden form to send POST -->
<form id="postForm" method="POST" action="admintaskdetails.php" style="display:none;">
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
<?php include("../panel/util/alert.php");?>
</body>
</html>
