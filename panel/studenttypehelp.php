<?php
include("../panel/util/statuscolour.php");
include("../includes/db.php");
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
  $id = $_POST['id'];
  try{
  $sql="SELECT * FROM ticket WHERE id = ?";  
  $stmt = $db->prepare($sql);
  $stmt->execute([$id]);
  $applicationdata = $stmt->fetchAll();
   
  }
  catch(Exception $e)
  {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
  }
   
} 
?>
<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
 // Fetch ticket details
 try{
 $sql="SELECT * FROM ticket WHERE id = ?";  
 $stmt = $db->prepare($sql);
 $stmt->execute([$id]);
 $applicationdata = $stmt->fetchAll();
 }
 catch(Exception $e){
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());

 }
  try{
    // Fetch ticket comments for this ticket
    $sql="SELECT * FROM ticketcomment WHERE ticketid = ? ORDER BY createdate ASC";
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
            <h1>Ticket Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="student-dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Support</li>
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
          <h3 class="card-title"><?php foreach ($applicationdata as $applications): ?><?php endforeach; ?></h3>

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
                      <span class="info-box-text text-center text-muted">Estimated budget</span>
                      <span class="info-box-number text-center text-muted mb-0">2300</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Total amount spent</span>
                      <span class="info-box-number text-center text-muted mb-0">2000</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-light">
                    <div class="info-box-content">
                      <span class="info-box-text text-center text-muted">Estimated project duration</span>
                      <span class="info-box-number text-center text-muted mb-0">20</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h4>Recent Activity</h4>
                    <div class="post">
                    <?php foreach ($applicationdata as $applications): ?>

<div class="user-block">
  <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user image">
  <span class="username">
    <a href="#"><?php echo htmlspecialchars($applications['subject']); ?></a>
  </span>
  <span class="description"><?php echo htmlspecialchars($applications['createdate']); ?></span>
</div>
<!-- /.user-block -->
<p>
<?php echo htmlspecialchars($applications['message']); ?>
</p>

<p>
<?php if (!empty($applications['filename'])): ?>
                  <a href="../uploads/tickets/<?= urlencode($applications['filename']) ?>" target="_blank">View</a>
                <?php else: ?>
                  <em>No file</em>
                <?php endif; ?>
                   
</p>
</div>
<?php endforeach; ?>
<form method="post" action="studentticket.php">
  <input type="hidden" name="ticketid" value="<?php echo htmlspecialchars($applications['id']); ?>">
  <div class="form-group">
    <textarea name="message" class="form-control" rows="2" placeholder="Add a comment..." required></textarea>
  </div>
  <div class="form-group">
      <label for="file">Upload File</label>
      <input type="file" class="form-control-file" id="file" name="file">
    </div>

  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
</form>

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
              <h3 class="text-primary"><i class="fas fa-paint-brush"></i> Ticket details</h3>
              <div class="text-muted">
                <p class="text-sm">Id
                  <b class="d-block"><?php echo htmlspecialchars($applications['id']); ?></b>
                </p>
                <p class="text-sm">Student Id
                  <b class="d-block"><?php echo htmlspecialchars($applications['studentid']); ?></b>
                </p>
              <!-- <p class="text-sm">Subject
                  <b class="d-block"><?php echo htmlspecialchars($applications['subject']); ?></b>
                </p>
                <p class="text-sm">Message
                  <b class="d-block"><?php echo htmlspecialchars($applications['message']); ?></b>
                </p>-->
                <p class="text-sm">Status
                  <b class="d-block"><?php echo htmlspecialchars($applications['status']); ?></b>
                </p>
                <p class="text-sm">AssignedTo
                  <b class="d-block"><?php echo htmlspecialchars($applications['assignedto']); ?></b>
                </p>
                <p class="text-sm">FileName
                  <b class="d-block"> <?php
// Remove the prefix 'uploads/ideas/' to get only the file name
$fileName = str_replace('uploads/', '', $applications['filename'] ?? '');

?>

<a href="/ims/panel/download.php?file=<?= urlencode($fileName) ?>" target="_blank">View</a>
</b>
                </p>
                <p class="text-sm">CreateDate
 
                  <b class="d-block"><?php echo htmlspecialchars($applications['createdate']); ?></b>
                </p>
                <p class="text-sm">CreatedBy
                  <b class="d-block"><?php echo htmlspecialchars($applications['createdby']); ?></b>
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
