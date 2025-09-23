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
    $sql="SELECT * FROM task WHERE id = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$id]);
  $applicationdata = $stmt->fetchAll();
  }
  catch(Exception $e)
  {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
  }
  //echo "<pre>";print_r($applicationdata);die;
    // Fetch ticket comments for this ticket
    try{
    $sql="SELECT * FROM taskcommit WHERE taskid = ? ORDER BY createdate ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $ticketdata = $stmt->fetchAll();
    }
    catch(Exception $e)
    {
      $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
    }
} 
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $taskid = $_POST['taskid'];
    $studentid = $_POST['studentid'];
    $new_status = $_POST['new_status'];
    $comment = $_POST['comment'];
    $changed_by=$_SESSION['user']['id'];
    try{
    $sql="INSERT INTO taskstatushistory (taskid,  new_status, comment,changed_by) VALUES (?, ?, ?, ?)";   
    $stmt = $db->prepare($sql);
    $stmt->execute([$taskid, $new_status, $comment,$changed_by]);
    }
    catch(Exception $e)
    {
      $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
    }
    if ($stmt->rowCount() > 0) {
      // ✅ Notification setup
      $menuItem = 'task';
      $notificationMessage = "Task Updated By Admin Task ID #.$taskid";
      $recipient =$studentid; // You can replace this with dynamic logic to notify specific users
      $createdBy = $createdBy;

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
         // print_r($notifStmt);die;
      } catch (Exception $e) {
          $logger->log('ERROR', 'Notification Insert Failed: ' . $e->getMessage());
      }

       } else {
       }
    if ($stmt->rowCount() > 0) {
      // Success: Show alert and redirect
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
            window.location.href = "admintaskdetails.php?id=' . $taskid . '";
        }, 2000);
    </script>';
  } else {
      // Error: Show error alert
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="statusAlert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h5><i class="icon fas fa-times"></i> Error!</h5>
              There was an error updating the data.
            </div>';
  }
  
  // Auto-dismiss script
  echo "<script>
      setTimeout(function() {
          var alert = document.getElementById('statusAlert');
          if(alert) {
              alert.classList.remove('show');
              alert.classList.add('fade');
              setTimeout(function() {
                  alert.remove();
              }, 500); // Wait for fade-out animation
          }
      }, 3000); // 3 seconds
  </script>";
  
  
  
    
}
// Fetch ticket comments
try{
$sql="SELECT * FROM taskstatushistory";  
$stmt = $db->prepare($sql);
$stmt->execute();
$statushistorydata = $stmt->fetchAll();
}
catch(Exception $e)
{
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
}
if (isset($_GET['id'])) {
  $taskid = $_GET['id'];
   try
   {
  // Fetch ticket details
  $sql="SELECT * FROM task WHERE id = ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$taskid]);
  $applicationdata = $stmt->fetchAll();
   }
   catch(Exception $e)
   {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
   }
  // Fetch ticket comments
  try {
    // Get the ID from GET or POST
    

    if ($taskid === null) {
        throw new Exception("No task ID provided.");
    }

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM taskstatushistory WHERE taskid = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$taskid]);
    $statushistorydata = $stmt->fetchAll();
} catch (Exception $e) {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - ' . ($sql ?? 'N/A') . ' , Exception Error = ' . $e->getMessage());
}
} 
?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
 // Fetch ticket details
 try{
 $sql="SELECT * FROM task WHERE id = ?";  
 $stmt = $db->prepare($sql);
 $stmt->execute([$id]);
 $applicationdata = $stmt->fetchAll();
 }
 catch(Exception $e)
 {
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
 }
    try{
    // Fetch ticket comments for this ticket
    $sql="SELECT * FROM taskcommit WHERE taskid = ? ORDER BY createdate ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $ticketdata = $stmt->fetchAll();
    }
    catch(Exception $e)
    {
      $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
    }
}

?>
<?php
$userId = $_SESSION['user']['id'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && $userId) {
    $taskid = (int) $_POST['id'];

    try {

        // Prepare and execute the update query
        $stmt = $db->prepare("UPDATE task SET assignedto = :assignedto WHERE id = :id");
        $stmt->bindParam(':assignedto', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':id', $taskid, PDO::PARAM_INT);

        if ($stmt->execute()) {
          //  echo "Ticket assigned to you successfully.";
        } else {
            echo "Failed to assign ticket.";
        }

    } catch (PDOException $e) {
        echo "Database error: " . htmlspecialchars($e->getMessage());
    }
} else {
   // echo "Invalid request or user not logged in.";
}
?>
<?php
// Handle new comment submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addcommit'])) {
    $taskid = trim($_POST["taskid"]);
    $message = trim($_POST["message"]);
    $studentid = trim($_POST["studentid"]);

        try {
            $stmt = $db->prepare("INSERT INTO taskcommit (taskid, message, createdate, createdby) VALUES (?, ?, NOW(), ?)");
            $stmt->execute([$taskid, $message, $createdBy]);
            echo '<div class="alert alert-success">Comment added successfully.</div>';
            echo '<script>setTimeout(() => { window.location.href = "admintaskdetails.php?id=' . htmlspecialchars($taskid) . '"; }, 1500);</script>';
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Failed to add comment.</div>';
        }
        if ($stmt->rowCount() > 0) {
          // ✅ Notification setup
          $menuItem = 'task';
          $notificationMessage = "Task Updated By Admin Task ID #.$taskid";
          $recipient =$studentid; // You can replace this with dynamic logic to notify specific users
          $createdBy = $createdBy;
  
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
             // print_r($notifStmt);die;
          } catch (Exception $e) {
              $logger->log('ERROR', 'Notification Insert Failed: ' . $e->getMessage());
          }
  
           } else {
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
<?php include("leftmenu.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Task Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Task Details</li>
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
      <span class="info-box-text text-center text-muted">Assigned TO</span>
      <?php if (empty($applications['assignedto'])): ?>
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
      <?php endif; ?>
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
                  <h4>Recent Activity</h4>
                    <div class="post">
                    <?php foreach ($applicationdata as $applications): ?>

                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#"><?php echo htmlspecialchars($applications['title']); ?></a>
                        </span>
                        <span class="description"><?php echo htmlspecialchars($applications['created_at']); ?></span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                      <?php echo htmlspecialchars($applications['description']); ?>
                      </p>

                      <p>
                       <?php endforeach; ?> </p>


                <?php foreach ($ticketdata as $ticket): ?>

<div class="user-block">
  <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user image">
  <span class="username">
    <a href="#"><?php echo htmlspecialchars($ticket['createdby']); ?></a>
  </span>
  <span class="description"><?php echo htmlspecialchars($ticket['createdate']); ?></span>
</div>
<!-- /.user-block -->
<p>
<?php echo htmlspecialchars($ticket['message']); ?>
</p>

<p>
<?php endforeach; ?> </p>




                    </div>
                    
                    <form method="post">
  <input type="hidden" name="taskid" value="<?php echo htmlspecialchars($applications['id']); ?>">
  <input type="hidden" name="studentid" value="<?php echo htmlspecialchars($applications['studentid']); ?>">
  <div class="form-group">
    <textarea name="message" class="form-control" rows="2" placeholder="Add a comment..." required></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary btn-sm" name="addcommit">Submit</button>
</form>
<?php




?>

<!-- AdminLTE Card with Table -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Status History</h3>
  </div>

  <!-- /.card-header -->
  <div class="card-body table-responsive">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Ticket Id</th>
          <th>Changed By</th>
          <th>Previous Status</th>
          <th>New Status</th>
          <th>Comment</th>
          <th>Changed At</th>
          
        </tr>
      </thead>
      <tbody>
        <?php if ($statushistorydata): ?>
          <?php foreach ($statushistorydata as $statusdata): ?>
            <tr class="clickable-row" data-id="<?= $statusdata['id'] ?>">
              <td><?= htmlspecialchars($statusdata['id']) ?></td>
              <td><?php echo htmlspecialchars($statusdata['taskid']); ?></td>
              <td><?php echo htmlspecialchars($statusdata['changed_by']); ?></td>
              <td></td>
              <td><?php echo htmlspecialchars($statusdata['new_status']); ?></td>
              <td><?php echo htmlspecialchars($statusdata['comment']); ?></td>
              <td><?php echo htmlspecialchars($statusdata['changed_at']); ?></td>
              
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
              <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Task details</h3>
              <div class="text-muted">
              <p class="text-sm">Title
                  <b class="d-block"><?php echo htmlspecialchars($applications['title']); ?></b>
                </p>
                
                <p class="text-sm">Id
                  <b class="d-block"><?php echo htmlspecialchars($applications['id']); ?></b>
                </p>
                <p class="text-sm">Student Id
                  <b class="d-block"><?php echo htmlspecialchars($applications['studentid']); ?></b>
                </p>
                <p class="text-sm">Description
                  <b class="d-block"><?php echo htmlspecialchars($applications['description']); ?></b>
                </p>
                <p class="text-sm mb-1">
  Status
  <b class="d-block mb-2"><?php echo htmlspecialchars($applications['status']); ?></b>
</p>
<form  method="post">
  <div class="form-group">
    <label for="statusSelect">Change Status</label>
    <select class="form-control" id="statusSelect" name="new_status">
      <option value="New">New</option>
      <option value="Open">Open</option>
      <option value="In-Progress">In-Progress</option>
      <option value="ReOpen">ReOpen</option>
      <option value="Close">Close</option>
    </select>
  </div>

  <div class="form-group">
    <label for="comment">Comment</label>
    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Enter your comment here..."></textarea>
  </div>

  <!-- Include application ID as hidden input if needed -->
  <input type="hidden" name="taskid" value="<?php echo $applications['id']; ?>">
  <input type="hidden" name="studentid" value="<?php echo $applications['studentid']; ?>">
 
  <button type="submit" class="btn btn-primary btn-sm" name="add">Submit</button>
</form>

<p class="text-sm mb-1">
  Crated At
  <b class="d-block mb-2"><?php echo htmlspecialchars($applications['created_at']); ?></b>
</p>
<p class="text-sm mb-1">
  Updated At
  <b class="d-block mb-2"><?php echo htmlspecialchars($applications['updated_at']); ?></b>
</p>


                 </div>

              <h5 class="mt-5 text-muted">Project files</h5>
              <ul class="list-unstyled">
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                </li>
              </ul>
              <div class="text-center mt-5 mb-3">
                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
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

