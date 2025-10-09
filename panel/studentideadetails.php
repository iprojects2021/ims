<?php
include("../includes/db.php");
include("../panel/util/session.php");

$userid = $_SESSION['user']['id'] ?? 0;

$ideadata = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    try {
        $sql = "SELECT * FROM innovationideas WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $ideadata = $stmt->fetchAll();
    } catch (Exception $e) {
        $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - ' . $sql . ' ,Exception Error = ' . $e->getMessage());
        echo "<div class='alert alert-danger'>Failed to fetch innovation idea data.</div>";
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
  // Get form data
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $technology = $_POST['technology'];
  $tags = $_POST['tags'];
  $links = $_POST['links'];

  // Get user ID from session, fallback 0
  $userid = $_SESSION['user']['id'] ?? 0;

  $attachmentPath = null;

  
  // Ensure base uploads folder exists
  if (!is_dir($uploadFolder)) {
      if (!mkdir($uploadFolder, 0755, true)) {
          die("Failed to create base folder: uploads");
      }
  }

  
  // Handle file upload if provided
  if (!empty($_FILES['attachment']['name']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
      $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'text/plain'];
      if (!in_array($_FILES['attachment']['type'], $allowedTypes)) {
          echo "<div class='alert alert-danger'>Invalid file type uploaded.</div>";
          exit;
      }

      // Sanitize original filename
      $originalName = basename($_FILES['attachment']['name']);
      $safeName = preg_replace("/[^a-zA-Z0-9.\-_]/", "_", $originalName);
      $uniqueName = time() . "_" . $safeName;
     // $fullPath = $ideasSubfolder . $uniqueName;
     $fullPath = $uploadFolder . DIRECTORY_SEPARATOR . $uniqueName;

      // Move uploaded file
      if (move_uploaded_file($_FILES['attachment']['tmp_name'], $fullPath)) {
          // Save relative path for DB/web access
          $attachmentPath = 'uploads/' . $uniqueName;
      } else {
          die("Error uploading the file.");
      }
  }

  // Build SQL query
  $sql = "UPDATE innovationideas 
          SET title = :title, 
              description = :description, 
              technology = :technology, 
              tags = :tags, 
              links = :links";

  if ($attachmentPath !== null) {
      $sql .= ", attachments = :attachments";
  }

  $sql .= " WHERE id = :id";

  try {
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':technology', $technology);
      $stmt->bindParam(':tags', $tags);
      $stmt->bindParam(':links', $links);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);

      if ($attachmentPath !== null) {
          $stmt->bindParam(':attachments', $attachmentPath);
      }

      if ($stmt->execute()) {
          $showAlert = 'success';

          // Insert notification for admin
          $menuItem = 'innovationideas';
          $notificationMessage = "Innovation idea updated by Student ID: " . $userid;
          $createdBy = $userid;

          try {
              $notifSql = "INSERT INTO notification 
                           (userid, menu_item, isread, message, createdBy) 
                           VALUES 
                           ('admin', :menu_item, 0, :message, :createdBy)";

              $notifStmt = $db->prepare($notifSql);
              $notifStmt->execute([
                  ':menu_item' => $menuItem,
                  ':message'   => $notificationMessage,
                  ':createdBy' => $createdBy
              ]);
          } catch (Exception $e) {
              error_log('Notification Insert Failed: ' . $e->getMessage());
          }
      } else {
          echo "<div class='alert alert-danger'>Failed to update innovation idea.</div>";
      }
  } catch (Exception $e) {
      error_log("Update failed: " . $e->getMessage());
      echo "<div class='alert alert-danger'>An error occurred while updating the idea.</div>";
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
              <li class="breadcrumb-item"><a href="student-dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">InnovationIdeas </li>
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
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Edit Innovation Ideas</h3>
    <p id="quote" class="quote visible">Think beyond fixes—create what doesn’t exist yet.</p>

  </div>
  <!-- /.card-header -->
  
  <!-- form start -->

<!-- form start -->
    <!-- form start -->
    <form method="post" enctype="multipart/form-data">
    <div class="card-body py-2">

        <?php if (!empty($ideadata)): ?>
            <?php foreach ($ideadata as $data): ?>
                <div class="form-row">
                    <!-- Hidden input for the idea id -->
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">

                    <div class="form-group col-md-8 mb-2">
                        <label for="title" class="mb-1">Title</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($data['title']); ?>" class="form-control form-control-sm" id="title" required>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="description" class="mb-1">Description</label>
                    <textarea name="description" class="form-control form-control-sm" id="description" rows="2" required><?php echo htmlspecialchars($data['description']); ?></textarea>
                </div>

                <div class="form-group mb-2">
                    <label for="feedback" class="mb-1">Feedback</label>
                    <textarea class="form-control form-control-sm" id="feedback" rows="2" readonly><?php echo htmlspecialchars($data['feedback'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-2">
                        <label for="technology" class="mb-1">Technology</label>
                        <input type="text" name="technology" value="<?php echo htmlspecialchars($data['technology']); ?>" class="form-control form-control-sm" id="technology">
                    </div>

                    <div class="form-group col-md-6 mb-2">
                        <label for="tags" class="mb-1">Tags</label>
                        <input type="text" name="tags" value="<?php echo htmlspecialchars($data['tags']); ?>" class="form-control form-control-sm" id="tags">
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="reviewed_at" class="mb-1">reviewed_at</label>
                        <input type="text"  value="<?php echo htmlspecialchars($data['reviewed_at'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
" class="form-control form-control-sm" id="reviewed_at" readonly>
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label for="reviewer_id" class="mb-1">reviewer_id</label>
                        <input type="text"  value="<?php echo htmlspecialchars($data['reviewer_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
" class="form-control form-control-sm" id="reviewer_id" readonly>
                    </div>


                    <div class="form-group col-md-6 mb-2">
                        <label for="status" class="mb-1">Status</label>
                        <input type="text" value="<?php echo htmlspecialchars($data['status']); ?>" class="form-control form-control-sm" id="status" readonly>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="attachment" class="mb-1">Attachment</label>
                    <div class="input-group input-group-sm">
                        <div class="custom-file">
                            <input type="file" name="attachment" class="custom-file-input" id="attachment">
                            <label class="custom-file-label" for="attachment">Choose file</label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="links" class="mb-1">Links</label>
                    <textarea name="links" class="form-control form-control-sm" id="links" rows="2"><?php echo htmlspecialchars($data['links']); ?></textarea>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No innovation idea selected.</p>
        <?php endif; ?>
    </div>

    <div class="card-footer py-2">
        <button type="submit" name="update" class="btn btn-primary">Submit</button>
    </div>
</form>

<!-- AdminLTE Card with Table -->

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
<?php include("../panel/util/alert.php");?>

</body>
</html>
<!-- Hidden form to send POST -->
<form id="postForm" method="POST" action="studenttypehelp.php" style="display:none;">
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
<script>
  document.querySelector('.custom-file-input').addEventListener('change', function (e) {
    const fileName = e.target.files[0]?.name || 'Choose file';
    e.target.nextElementSibling.innerText = fileName;
  });
</script>
<style>
    .card-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .quote {
      font-size: 18px;
      font-style: italic;
      transition: opacity 0.5s ease-in-out;
    }

    .hidden {
      opacity: 0;
    }

    .visible {
      opacity: 1;
    }


.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}







  </style>
  
  <script>
    const quotes = [
      "Think beyond fixes—create what doesn’t exist yet.",
      "🌱 Innovation starts where routine ends.",
      "🚀 Don’t just do tasks, design tomorrow.",
      "🧩 Your ideas can be the missing piece of the future.",
      "⚡ Challenge the normal, spark the new.",
      "✨ Don’t follow the path—draw the map."
    ];

    let currentIndex = 0;
    const quoteElement = document.getElementById('quote');

    setInterval(() => {
      // Fade out
      quoteElement.classList.remove('visible');
      quoteElement.classList.add('hidden');

      setTimeout(() => {
        // Change quote
        currentIndex = (currentIndex + 1) % quotes.length;
        quoteElement.textContent = quotes[currentIndex];

        // Fade in
        quoteElement.classList.remove('hidden');
        quoteElement.classList.add('visible');
      }, 500); // match the CSS transition duration
    }, 5000);
  </script>