<?php
include("../includes/db.php");
include("../panel/util/session.php");
$studentName = htmlspecialchars($_SESSION["user"]["name"]);
$email = $_SESSION['user']['email'];
$userId = $_SESSION['user']['id'];
try
{
// Fetch user data securely
$sql="SELECT * FROM users WHERE email = :email LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute(['email' => $email]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(Exception $e)
{
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
}
// Fetch application data filtered by user email or ID (depending on your schema)

include("../panel/util/statuscolour.php");
try{
// Fetch current user data by ID securely
$sql="SELECT * FROM users WHERE id = :id LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $userId]);
$currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(Exception $e)
{
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
}
?>
<?php

try {
    $sql = "UPDATE notification 
            SET isread = 1 
            WHERE userid ='admin' 
              AND menu_item = 'application'";
    $db->query($sql);
} catch (Exception $e) {
    // Optional: Log the error
}
?>
<?php


if (isset($_POST['email'])) {
  $email = $_POST['email'];
    try {
      $sql = "SELECT * FROM application WHERE email = :email"; // Fixed syntax error
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR); // Use PARAM_STR for email
      $stmt->execute();
      $applicationData = $stmt->fetchAll(PDO::FETCH_ASSOC);
   } catch (Exception $e) {
      $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - ' . $sql . ' , Exception Error = ' . $e->getMessage());
  }
} else {
  try {
      $sql = "SELECT * FROM application";
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $applicationData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
      $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - ' . $sql . ' , Exception Error = ' . $e->getMessage());
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin-Application | INDSAC SOFTECH</title>
  <link rel="icon" type="image/png" href="../favico.png">


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
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Application</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        

        

        <!-- Applications table -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Applications</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Project</th>
                  <th>Outcome</th>
                  <th>Status</th>
                  <th>Type</th>
                  <th>Created Date</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($applicationData as $row): ?>
                  <tr class="clickable-row" data-id="<?= (int)$row['id'] ?>">
                    <td><?= htmlspecialchars($row['project']) ?></td>
                    <td><?= htmlspecialchars($row['outcome']) ?></td>
                    <td><?= getStatusBadge($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['type']) ?></td>
                    <td><?= htmlspecialchars($row['createddate']) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Project</th>
                  <th>Outcome</th>
                  <th>Status</th>
                  <th>Type</th>
                  <th>Created Date</th>
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

<script>
  $(function () {
    $("#example1").DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // Clickable rows redirect
    $('.clickable-row').on('click', function () {
      const id = $(this).data('id');
      $('<form>', {
        'method': 'POST',
        'action': 'admintypedetails.php'
      }).append($('<input>', {
        'type': 'hidden',
        'name': 'id',
        'value': id
      })).appendTo('body').submit();
    });
  });
</script>

</body>
</html>
