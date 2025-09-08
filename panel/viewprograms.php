<?php
include("../includes/db.php");
include("../panel/util/statuscolour.php");
include("../panel/util/session.php");
try {
    $sql = "SELECT * FROM programs";

$stmt = $db->prepare($sql);
$stmt->execute();
$applicationData = $stmt->fetchAll(PDO::FETCH_ASSOC);
//  print_r($applicationData);die;

    
} catch (Exception $e) {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - ' . $sql . ' , Exception Error = ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>INDSAC SOFTECH | Admin Dashboard</title>

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
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        
        <!-- Stat boxes -->
        
        <!-- Applications table -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">All Programs</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>program_id</th>
                  <th>title	</th>
                  <th>slug</th>
                  <th>short_description</th>
                  <th>detailed_description</th>
                  <th>duration</th>
                  <th>start_date</th>
                  <th>end_date	</th>
                  <th>is_remote		</th>
                  <th>location		</th>
                  <th>timezone		</th>
                  <th>stipend_amount		</th>
                  <th>stipend_currency		</th>
                  <th>is_paid		</th>
                  <th>application_deadline	</th>
                  <th>max_applicants</th>
                  <th>is_active	</th>
                  <th>created_at	</th>
                  <th>updated_at	</th>
                  </tr>
              </thead>
              <tbody>
<?php foreach ($applicationData as $row): ?>
  <tr class="clickable-row" data-id="<?= $row['program_id'] ?>">
    <td><?= htmlspecialchars($row['program_id']) ?></td>
    <td><?= htmlspecialchars($row['title']) ?></td>
    <td><?= htmlspecialchars($row['slug']) ?></td>
    <td><?= htmlspecialchars($row['short_description']) ?></td>
    <td><?= htmlspecialchars($row['detailed_description']) ?></td>
    <td><?= htmlspecialchars($row['duration']) ?></td>
    <td><?= htmlspecialchars($row['start_date']) ?></td>
    <td><?= htmlspecialchars($row['end_date']) ?></td>
    <td><?= htmlspecialchars($row['is_remote']) ?></td>
    <td><?= htmlspecialchars($row['location']) ?></td>
    <td><?= htmlspecialchars($row['timezone']) ?></td>
    <td><?= htmlspecialchars($row['stipend_amount']) ?></td>
    <td><?= htmlspecialchars($row['stipend_currency']) ?></td>
    <td><?= htmlspecialchars($row['is_paid']) ?></td>
    <td><?= htmlspecialchars($row['application_deadline']) ?></td>
    <td><?= htmlspecialchars($row['max_applicants']) ?></td>
    <td><?= htmlspecialchars($row['is_active']) ?></td>
    <td><?= htmlspecialchars($row['created_at']) ?></td>
    <td><?= htmlspecialchars($row['updated_at']) ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
<tfoot>
                <tr>
                <th>program_id</th>
                  <th>title	</th>
                  <th>slug</th>
                  <th>short_description</th>
                  <th>detailed_description</th>
                  <th>duration</th>
                  <th>start_date</th>
                  <th>end_date	</th>
                  <th>is_remote		</th>
                  <th>location		</th>
                  <th>timezone		</th>
                  <th>stipend_amount		</th>
                  <th>stipend_currency		</th>
                  <th>is_paid		</th>
                  <th>application_deadline	</th>
                  <th>max_applicants</th>
                  <th>is_active	</th>
                  <th>created_at	</th>
                  <th>updated_at	</th>
                  
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
<!-- Hidden form to send POST -->
<form id="postForm" method="POST" action="paymentverificationform.php" style="display:none;">
    <input type="hidden" name="PaymentVerificationID" id="hiddenId">
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
<!-- Add this CSS to hide any remaining + icon rows -->
<style>
  /* Hide the + icon cell if it somehow still appears */
  table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child::before,
  table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child::before {
    display: none !important;
  }

  /* Prevent the extra column for the + icon */
  table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child,
  table.dataTable.dtr-inline.collapsed > tbody > tr > th:first-child {
    padding-left: 8px !important;
  }
</style>

</body>
</html>
