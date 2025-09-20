<?php
include("../panel/util/statuscolour.php");
include("../includes/db.php");
include("../panel/util/session.php");
$application = null;
$allideadetails[] = null;
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
  $sql="SELECT * FROM innovationideas WHERE id = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$id]);
  $allideadetails = $stmt->fetchAll();
  }
  catch(Exception $e)
  {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
  }
  
} 
?>


<?php
// Handle new comment submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add'])) {
    $id     = trim($_POST["id"]);
    $studentid  = trim($_POST["studentid"]);
    $status     = trim($_POST["new_status"]);
    $feedback   = trim($_POST["comment"]);

    
    $createdBy  = $_SESSION['user']['id']; 
     date_default_timezone_set('Asia/Kolkata'); 
     $date = date('Y-m-d H:i:s');

    try {
      $stmt = $db->prepare("UPDATE innovationideas 
      SET status = ?, feedback = ?, reviewer_id = ?, reviewed_at = ? 
      WHERE id = ?");
$stmt->execute([$status, $feedback, $createdBy, $date, $id]);
} catch (Exception $e) {
        echo '<div class="alert alert-danger">Failed to update application: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
    $showAlert = 'success';
    if ($stmt->rowCount() > 0) {
        // ✅ Send Notification
        $menuItem = 'innovationideas';
        $notificationMessage = "innovationideas Updated By Admin innovationideas id is #$id";
        $recipient = $studentid;

        try {
            $notifSql = "INSERT INTO notification (userid, menu_item, isread, message, createdBy) 
                         VALUES (:userid, :menu_item, 0, :message, :createdBy)";
            $notifStmt = $db->prepare($notifSql);
            $notifStmt->execute([
                ':userid'    => $recipient,
                ':menu_item' => $menuItem,
                ':message'   => $notificationMessage,
                ':createdBy' => $createdBy
            ]);
        } catch (Exception $e) {
            $logger->log('ERROR', 'Notification Insert Failed: ' . $e->getMessage());
        }
    } else {
        echo '<div class="alert alert-warning">No changes made.</div>';
    }
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

      <?php include("leftmenu.php"); ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>innovation ideas Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">innovation ideas Details</li>
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
          <h3 class="card-title"><?php foreach ($allideadetails as $applications): ?></h3>

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
      <span class="info-box-text text-center text-muted">--</span>
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
                  <h4></h4>
                    <div class="post">
                    



                    </div>



<!-- AdminLTE Card with Table -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title"></h3>
  </div>

  <!-- /.card-header -->
  <div class="card-body table-responsive">
    </div>
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
            <?php foreach ($allideadetails as $applications): ?>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
              <h3 class="text-primary"><i class="fas fa-paint-brush"></i>innovation ideas Details</h3>
              <div class="text-muted">
              <p class="text-sm">Id
                  <b class="d-block"><?php echo htmlspecialchars($applications['id']); ?></b>
                </p>
                
                <p class="text-sm">Title
                  <b class="d-block"><?php echo htmlspecialchars($applications['title']); ?></b>
                </p>
                <p class="text-sm">Student Id
                  <b class="d-block"><?php echo htmlspecialchars($applications['intern_id']); ?></b>
                </p>
                <p class="text-sm">Description
                  <b class="d-block"><?php echo htmlspecialchars($applications['description']); ?></b>
                </p>
                <p class="text-sm">Technology
                  <b class="d-block"><?php echo htmlspecialchars($applications['technology']); ?></b>
                </p>
                <p class="text-sm">Tags
                  <b class="d-block"><?php echo htmlspecialchars($applications['tags']); ?></b>
                </p>

                <p class="text-sm">Attachments<br>
                <?php
// Remove the prefix 'uploads/ideas/' to get only the file name
$fileName = str_replace('uploads/ideas/', '', $applications['attachments']);
?>

<a href="/ims/panel/downloadidea.php?file=<?= urlencode($fileName) ?>" target="_blank">View</a>
                </p>
                <p class="text-sm">Links
                  <b. class="d-block"><?php echo htmlspecialchars($applications['links']); ?></b>
                </p>
                <p class="text-sm">Submitted At
                  <b. class="d-block"><?php echo htmlspecialchars($applications['submitted_at']); ?></b>
                </p>
                <p class="text-sm">Reviewed At
                  <b. class="d-block"><?php echo htmlspecialchars($applications['reviewed_at']); ?></b>
                </p>
                <p class="text-sm">Reviewer Id
                  <b. class="d-block"><?php echo htmlspecialchars($applications['reviewer_id']); ?></b>
                </p>
                <p class="text-sm">Is Featured
                  <b. class="d-block"><?php echo htmlspecialchars($applications['is_featured']); ?></b>
                </p>
                <p class="text-sm">Views Count
                  <b. class="d-block"><?php echo htmlspecialchars($applications['views_count']); ?></b>
                </p>
 
<form  method="post">
<div class="form-group">
  <label for="statusSelect">Change Status</label>
  <select class="form-control" id="statusSelect" name="new_status">
    <option value="Pending"  <?php if ($applications['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
    <option value="Approved" <?php if ($applications['status'] == 'Approved') echo 'selected'; ?>>Approved</option>
    <option value="Rejected" <?php if ($applications['status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
  </select>
</div>


  <div class="form-group">
    <label for="comment">FeedBack</label>
    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Enter your comment here..."><?php echo htmlspecialchars($applications['feedback']); ?></textarea>
  </div>

  <!-- Include application ID as hidden input if needed -->
  <input type="hidden" name="id" value="<?php echo $applications['id']; ?>">
  <input type="hidden" name="studentid" value="<?php echo $applications['intern_id']; ?>">
 
  <button type="submit" class="btn btn-primary btn-sm" name="add">Submit</button>
</form>



                 </div>

              <h5 class="mt-5 text-muted"></h5>
             
              <div class="text-center mt-5 mb-3">
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
<?php include("../panel/util/alert.php");?>

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

