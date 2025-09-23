<?php
include("../panel/util/statuscolour.php");
include("../includes/db.php");
include("../panel/util/session.php");
$application = null;
$applicationdata[] = null;
$ticketdata[]=null;
$comments = [];
$taskid = $_GET['id'] ?? $_POST['id'] ?? null;
$id = $_GET['id'] ?? $_POST['id'] ?? null;
$createdBy = $_SESSION["user"]["id"] ?? null;

//fetch admin task details
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) 
{
  $id = $_POST['id'];
  try{
    $sql="SELECT * FROM documents WHERE id = ?";
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

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $id = $_POST['id'];
    $studentid = $_POST['studentid'];
    $status = $_POST['status'];

    try {
        // Use named placeholders for security and clarity
        $sql = "UPDATE documents SET status = :status WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);

                    // ✅ Show success alert and redirect
                    echo '
                    <div style="position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
                                z-index: 1050; width: 400px; max-width: 90%;">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="statusAlert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Success!</h5>
                            Status updated successfully.
                        </div>
                    </div>
                    <script type="text/javascript">
                        setTimeout(function() {
                        }, 2000);
                    </script>';
        

        if ($stmt->rowCount() > 0) {
            // ✅ Notification setup
            $menuItem = 'document';
            $notificationMessage = "Document Status Updated By Admin. Document ID #$id";
            $recipient = $studentid;
            $createdBy = $_SESSION['userid'] ?? 'admin'; // Replace with actual session user ID or fallback

            try {
                $notifSql = "INSERT INTO notification (userid, menu_item, isread, message, createdBy) 
                             VALUES (:userid, :menu_item, 0, :message, :createdBy)";
                $notifStmt = $db->prepare($notifSql);
                $notifStmt->execute([
                    ':userid' => $recipient,
                    ':menu_item' => $menuItem,
                    ':message' => $notificationMessage,
                    ':createdBy' => $createdBy
                ]);
            } catch (Exception $e) {
                $logger->log('ERROR', 'Notification Insert Failed: ' . $e->getMessage());
            }

        } else {
        }
    } catch (Exception $e) {
        $logger->log('ERROR', 'Line ' . __LINE__ . ': SQL Error = ' . $e->getMessage());
    }

    // ✅ Auto-dismiss alert script
    echo "<script>
        setTimeout(function() {
            var alert = document.getElementById('statusAlert');
            if(alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }
        }, 3000);
    </script>";
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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
<?php include("leftmenu.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Document Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Document Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?php foreach ($applicationdata as $applications): ?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Status</span>
                      <span class="info-box-number text-center text-muted mb-0"><?php echo htmlspecialchars($applications['status']); ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
  <div class="info-box bg-light">
    <div class="info-box-content">
      <span class="info-box-text text-center text-muted">Test</span>
      <!-- <?php if (empty($applications['assignedto'])): ?>
        <div class="text-center">
        <form method="post">
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($applications['id']); ?>"> 
  <button type="submit" class="btn btn-primary btn-sm">Assign to Me</button>
</form>
   </div>
      <?php else: ?>
        <span class="info-box-number text-center text-muted mb-0">
          <?php echo htmlspecialchars($applications['assignedto']); ?>
        </span>
      <?php endif; ?> -->
    </div>
  </div>
</div>
<div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Estimated Ticket duration</span>
                      <span class="info-box-number text-center text-muted mb-0">2 days</span>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
              <div class="row">
                <div class="col-12">
                    
     

<!-- AdminLTE Card with Table -->
<div class="card">
  <div class="card-header">
    
  </div>

  <!-- /.card-header -->
   <!-- /.card-body -->
</div>
<!-- /.card -->



                     
                    

                    <div class="post">
                      <div class="user-block">
                      </div>
                      <!-- /.user-block -->
                      
                      
                    </div>
                </div>
              </div>
            </div>
            <?php foreach ($applicationdata as $applications): ?>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Document details</h3>
              <div class="text-muted">
              <p class="text-sm">Id
                  <b class="d-block"><?php echo htmlspecialchars($applications['id']); ?></b>
                </p>
                
                <p class="text-sm">Education Level
                  <b class="d-block"><?php echo htmlspecialchars($applications['education_level']); ?></b>
                </p>
                <p class="text-sm">File
                <b class="d-block"> <?php
// Remove the prefix 'uploads/ideas/' to get only the file name
$fileName = str_replace('uploads/', '', $applications['file_path']);
?>

<a href="/ims/panel/download.php?file=<?= urlencode($fileName) ?>" target="_blank">View</a>
</b>
                </p>
                <p class="text-sm">Remark
                  <b class="d-block"><?php echo htmlspecialchars($applications['remark']); ?></b>
                </p>
                <p class="text-sm mb-1">Status
                  <b class="d-block mb-2"><?php echo htmlspecialchars($applications['status']); ?></b>
                </p>
                <p class="text-sm mb-1">Student Id
                  <b class="d-block mb-2"><?php echo htmlspecialchars($applications['studentid']); ?></b>
                </p>
                <form method="post" action="">
  <div class="form-group">
    <label for="statusSelect">Change Status</label>
    <select class="form-control" id="statusSelect" name="status" required>
      <option value="">-- Select Status --</option>
      <option value="Verified" <?php if ($applications['status'] == 'Verified') echo 'selected'; ?>>Verified</option>
      <option value="Pending Action" <?php if ($applications['status'] == 'Pending Action') echo 'selected'; ?>>Pending Action</option>
    </select>
  </div>

  <!-- Hidden inputs to preserve necessary data -->
  <input type="hidden" name="id" value="<?php echo htmlspecialchars($applications['id']); ?>">
  <input type="hidden" name="studentid" value="<?php echo htmlspecialchars($applications['studentid']); ?>">

  <button type="submit" class="btn btn-primary btn-sm" name="add">Submit</button>
</form>




                 </div>

                  </div>
            <?php endforeach; ?>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
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
<script>
function showAlert(type, title, message, redirectUrl = null, delay = 2000) {
    const alertBox = document.createElement("div");
    alertBox.style.position = "fixed";
    alertBox.style.top = "50%";
    alertBox.style.left = "50%";
    alertBox.style.transform = "translate(-50%, -50%)";
    alertBox.style.zIndex = "1050";
    alertBox.style.width = "400px";
    alertBox.style.maxWidth = "90%";

    let icon = (type === "success") ? "fas fa-check" : "fas fa-times";
    alertBox.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon ${icon}"></i> ${title}</h5>
            ${message}
        </div>
    `;

    document.body.appendChild(alertBox);

    if (redirectUrl) {
        setTimeout(function() {
            window.location.href = redirectUrl;
        }, delay);
    }
}
</script>

