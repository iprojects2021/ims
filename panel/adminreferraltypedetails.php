<?php
include("../includes/db.php");
include("../panel/util/statuscolour.php");
include("../panel/util/session.php");
$studentName = $_SESSION["user"]["name"];
$email = $_SESSION['user']['email'] ?? null;
try{
// Fetch user data (if needed)
$sql="SELECT * FROM users WHERE email = :email";
$stmt = $db->prepare($sql);
$stmt->execute(['email' => $email]);
$userData = $stmt->fetch();
}
catch(Exception $e)
{
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());

}
// Fetch application by ID if posted
$applicationData = [];
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['id'])) {
    $id = $_POST['id'];
    try{
    $sql="SELECT * FROM referrals WHERE id = ?";  
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $applicationData = $stmt->fetch(); // Only one record expected
    }
    catch(Exception $e)
    {
      $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
    }

    
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id']) && isset($_POST['userid'])) 
    {
      $id = $_POST['id'];
      $userid= $_POST['userid'];
      try{
         $sql = "SELECT * FROM enrollments WHERE referralid = ?";  
         $stmt = $db->prepare($sql);
         $stmt->execute([$id]);
         $paymentandenrollmentdata = $stmt->fetchAll(PDO::FETCH_ASSOC);

         $sql = "SELECT * FROM users WHERE id = ?";  
         $stmt = $db->prepare($sql);
         $stmt->execute([$userid]);
         $userdetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
         }
      catch(Exception $e)
         {
        $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
         }
         }
    
      
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin-Referral | INDSAC SOFTECH</title>
  <link rel="icon" type="image/png" href="../favico.png">


  <!-- AdminLTE Styles -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include("leftmenu.php"); ?>

  <!-- Main Content Wrapper -->
  <div class="content-wrapper">
    
    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <h1>Referral Details</h1>
      </div>
    </section>

    <!-- Main Content -->
    <section class="content">
  <div class="container-fluid">

    <?php if ($applicationData): ?>
      <!-- Referral Details Card -->
      <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0"><i class="fas fa-user-friends mr-2"></i>Referral Details</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool text-white" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            
            <!-- Left: Budget Info -->
            <div class="col-md-8">
              <div class="row">
                <div class="col-sm-4 mb-3">
                  <div class="info-box bg-light border border-primary shadow-sm">
                    <div class="info-box-content text-center">
                      <span class="info-box-text text-primary font-weight-bold">Referral Status</span>
                      <span class="info-box-number text-dark display-6"><?= htmlspecialchars($applicationData['status']) ?></span>
                    </div>
                  </div>
                </div>
                <?php foreach ($paymentandenrollmentdata as $row): ?>
                <div class="col-sm-4 mb-3">
                  <div class="info-box bg-light border border-success shadow-sm">
                    <div class="info-box-content text-center">
                      <span class="info-box-text text-success font-weight-bold">--</span>
                      <span class="info-box-number text-dark display-6">--</span>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
                <div class="col-sm-4 mb-3">
                  <div class="info-box bg-light border border-info shadow-sm">
                    <div class="info-box-content text-center">
                      <span class="info-box-text text-info font-weight-bold">Project Duration</span>
                      <span class="info-box-number text-dark display-6">20 Days</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Program Table -->
              <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                  <h4 class="card-title mb-0"><i class="fas fa-list-alt mr-2"></i>Enrollment Table</h4>
                </div>
                <div class="card-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th>ID</th>
                        <th>Referral ID</th>
                        <th>Amount</th>
                        <th>Program</th>
                        <th>Enrollment Date</th>
                        <th>Enrolled User Email</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($paymentandenrollmentdata as $row): ?>
                        <tr class="clickable-row" data-id="<?= $row['id'] ?>">
                          <td><?= htmlspecialchars($row['id']) ?></td>
                          <td><?= htmlspecialchars($row['referralid']) ?></td>
                          <td><?= htmlspecialchars($row['fee_paid']) ?></td>
                          <td><?= htmlspecialchars($row['program']) ?></td>
                          <td><?= htmlspecialchars($row['enrollmentdate']) ?></td>
                          <td><?= htmlspecialchars($row['enrolleduseremail']) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot class="bg-light">
                      <tr>
                      <th>ID</th>
                        <th>Referral ID</th>
                        <th>Amount</th>
                        <th>Program</th>
                        <th>Enrollment Date</th>
                        <th>Enrolled User Email</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>

            <!-- Right: Application Details -->
            <div class="col-md-4">
            <div class="border p-3 rounded shadow-sm bg-light">
            <?php foreach ($userdetails as $client): ?>
                <h5 class="text-primary"><i class="fas fa-info-circle mr-2"></i>User Details</h5>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>User Id:</strong> <?= htmlspecialchars($client['id']) ?></li>
                  <li class="list-group-item"><strong>Name:</strong> <?= htmlspecialchars($client['full_name']) ?? ''?></li>
                  <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($client['email'] ?? '') ?></li>
                  <li class="list-group-item"><strong>Phone:</strong> <?= htmlspecialchars($client['contact'] ?? '')?></li>
                  <li class="list-group-item"><strong>Upi Id:</strong> <?= htmlspecialchars($client['upiid']) ?? '' ?></li>
                  </ul>
              </div>  
              <?php endforeach; ?>
            <div class="border p-3 rounded shadow-sm bg-light">
                <h5 class="text-primary"><i class="fas fa-info-circle mr-2"></i>Referral Summary</h5>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>ID:</strong> <?= htmlspecialchars($applicationData['id']) ?></li>
                  <li class="list-group-item"><strong>User ID:</strong> <?= htmlspecialchars($applicationData['userid']) ?></li>
                  <li class="list-group-item"><strong>Referred Email:</strong> <?= htmlspecialchars(($applicationData['referred_email'] ?? '') && strtolower($applicationData['referred_email']) !== 'null' ? $applicationData['referred_email'] : '--') ?></li>
                  <li class="list-group-item"><strong>Referred Phone:</strong> <?= htmlspecialchars(($applicationData['referred_phone'] ?? '') && strtolower($applicationData['referred_phone']) !== 'null' ? $applicationData['referred_phone'] : '--') ?></li>
                  <li class="list-group-item"><strong>Status:</strong> <?= htmlspecialchars($applicationData['status']) ?></li>
                  <li class="list-group-item"><strong>Created At:</strong> <?= htmlspecialchars($applicationData['created_at']) ?></li>
                </ul>
              </div>
            </div>
            

          </div> <!-- /.row -->
        </div> <!-- /.card-body -->
      </div> <!-- /.card -->
    <?php else: ?>
      <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> No application data found.</div>
    <?php endif; ?>

  </div> <!-- /.container-fluid -->
</section>
  </div>

  <?php include("footer.php"); ?>

</div>
<style>
.badge-orange {
    background-color: #fd7e14; /* Bootstrap's orange */
    color: #fff;
}
</style>
<form id="postForm" method="POST" action="adminreferraltypedetails.php" style="display:none;">
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

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>
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
</body>
</html>
