<?php 
   
    include("../includes/db.php");
    include("../panel/util/session.php");    

  try {
       
        // Prepare and execute query securely
     
        $stmt = $db->prepare("SELECT id, full_name, resumepath FROM users WHERE id = :id");
        $stmt->bindParam(':id', $_SESSION["user"]["id"]);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $stud = $stmt->fetch(PDO::FETCH_ASSOC);
            $studResumePath = $stud['resumepath'];
        }else {
            echo "No Data  found: ";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INDSAC SOFTECH  |Resume Upload</title>

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
   <style> .message {
      text-align: center;
      color: red;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .messagesuccess {
     text-align: center;
      color: green;
      font-weight: bold;
      margin-bottom: 20px;
    }
  </style>
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  <?php
// Ensure session is started and $sid, $studName, $studResumePath are available

if (isset($_POST['upload']) && !empty($_POST['upload'])) {
    if (isset($_FILES['resume_file']) && !empty($_FILES['resume_file']['name'])) {

        // File upload config
        //$targetDir = "../".$uploadFolder ."/resume/";
        $targetDir =$uploadFolder;
        $baseFileName = basename($_FILES['resume_file']['name']);
        $fileType = strtolower(pathinfo($baseFileName, PATHINFO_EXTENSION));
        $fileSize = $_FILES['resume_file']['size'];

        // Filename should be unique and student-specific
        $fileName =  time();
       // $targetFilePath = $targetDir . $fileName . '.' . $fileType;
       $targetFilePath = rtrim($targetDir, '/\\') . DIRECTORY_SEPARATOR . $fileName . '.' . $fileType;

        // Validate file
        if ($fileSize > 1153433) {
            $msg = "<script>showNotify('File size should be less than 1 MB.',1);</script>";
        } elseif ($fileType !== 'pdf') {
            $msg = "<script>showNotify('Upload resume only in PDF format.',1);</script>";
        } else {
            try {
                // Connect with PDO
            
                // Prepare the update query
                $stmt = $db->prepare("UPDATE users SET resumepath = :path WHERE id = :sid");
                $stmt->bindParam(':path', $targetFilePath);
                $stmt->bindParam(':sid', $_SESSION["user"]["id"]);

                // Create directory if it doesn't exist
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}
                if ($stmt->execute()) {
                    if (move_uploaded_file($_FILES['resume_file']['tmp_name'], $targetFilePath)) {
                     
                       
                        $message = "Uploaded Successfully";
                        $studResumePath = $targetFilePath;
                        $msg = "";

                    } else {
                        $msg = "File upload failed. Try again";
                    }
                } else {
                    $msg = "Database update failed";
                }

            } catch (PDOException $e) {
                $msg = "Error: " . addslashes($e->getMessage()) . "',1);";
            }
        }

    } else {
        $msg = "Invalid file format or size";
    }

    echo $msg;
}
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
  
         <div class="resume-container">
                <h2>Resume</h2>
                <div class="profile-message1">
                  

  <?php if (!empty($message)): ?>
    <div class="messagesuccess">
        <?php echo $message; ?>
    </div>
<?php else: ?>
    <!-- Optionally show nothing or a different message -->
    <p> 
                        &#9888; Always make sure it is up to date. Resume file format should be PDF with size less than 1 MB
                    </p>
<?php endif; ?>
                   
                </div>
                <form method="POST" enctype="multipart/form-data" action="">
                    <div class="btn1">
                        <input class="choose-file-btn" type="file" name="resume_file"><br><br>
                        <input class="resume-upload-btn" type="submit" value="Upload Resume" name="upload"><br><br>
                   
                    </div>
                    <div class="resume-div">
                        <?php
                            if ($studResumePath) {
                                echo "<object class='resume-file' data='$studResumePath' width='100%' height='100%'></object>";                                
                            }else{
                                echo "You haven't upload any resume.";
                            }
                        ?>
                    </div>
                </form>
            </div>
    
    
  
    <div class="modal fade" id="modal-success">
        <div class="modal-dialog">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title">Success Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-light">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2025 <a href="https://indsac.com">INDSAC SOFTECH</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

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
</body>
</html>
