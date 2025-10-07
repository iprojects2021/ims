<?php
include("../includes/db.php");
include("../panel/util/session.php");
$useriddata=$_SESSION['user']['id'];
try
{$sql="SELECT * FROM users where id=$useriddata";
$stmt = $db->prepare($sql);
$stmt->execute();
$clients = $stmt->fetchAll();
//echo "<pre>";print_r($clients);die;
}
catch(Exception $e)
{
  $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());
}

// update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $skills = $_POST['skills'];
  $experience = $_POST['experience'];
  $course = $_POST['course'];
  $college = $_POST['college'];
  try{
  $sql="UPDATE users SET full_name = ?, email = ?, contact = ?, skills = ?,experience=?,course=?,college=? WHERE id =$useriddata";
  $stmt = $db->prepare($sql);
  $stmt->execute([$full_name, $email, $contact, $skills,$experience,$course,$college]);
  }
  catch(Exception $e)
  {
    $logger->log('ERROR', 'Line ' . __LINE__ . ': Query - '.$sql.' ,Exception Error = ' . $e->getMessage());

  }

  
 // Check if the query was successful
 if ($stmt->rowCount() > 0) {
  // Success: Show alert and redirect
  echo '
<div style="position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
            z-index: 1050; width: 400px; max-width: 90%;">
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="statusAlert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        Profile updated successfully.
    </div>
</div>
';

  // Redirect using JavaScript after displaying the success message
  echo '<script type="text/javascript">
          setTimeout(function() {
              window.location.href = "profile.php"; 
          }, 2000); // Redirect after 2 seconds
        </script>';
} else {
  // Error: Show error alert
  echo '<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-times"></i> Error!</h5>
          There was an error updating the data.
        </div>';
}

  
  
  //exit();
  
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
<div class="wrapper">
  
<?php include("leftmenu.php"); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="student-dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <a href="#"><i class="fas fa-user-circle fa-3x" style="color: #0d6efd;"></i>
</a>
                </div>
                <?php foreach ($clients as $client): ?>
                
                <h3 class="profile-username text-center"><?php echo htmlspecialchars($client['full_name']); ?></h3>
                
                <p class="text-muted text-center"><?php echo htmlspecialchars($client['role']); ?></p>
                
                <!--<ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>-->

                <!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                <?php echo htmlspecialchars($client['course']); ?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> College</strong>

                <p class="text-muted"><?php echo htmlspecialchars($client['college']); ?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger"><?php echo htmlspecialchars($client['skills'] ?? ''); ?>
</span>
                  <!--<span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>-->
                </p>

                <hr>

                <!--<strong><i class="far fa-file-alt mr-1"></i></strong>-->

                <p class="text-muted"></p>
              </div><?php endforeach; ?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <!--<li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>-->
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    <!-- Post -->
                  
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                      </div>
                      <!-- /.user-block -->
                      <div class="row mb-3">
                        <div class="col-sm-6">
                       
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-6">
                              </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                               </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <p>
                        <span class="float-right">
                         </span>
                      </p>

                      
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        
                        <div class="timeline-item">
                          
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        
                      </div>
                    </div>
                  </div>
                  
                  <!-- /.tab-pane -->

                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal" method="post">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="full_name" id="inputName" value="<?php echo htmlspecialchars($client['full_name']); ?>">
                        </div>
                        
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" name="email" class="form-control" id="inputEmail" value="<?php echo htmlspecialchars($client['email']); ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Mobile No</label>
                        <div class="col-sm-10">
                          <input type="text" name="contact" class="form-control" id="inputName2" value="<?php echo htmlspecialchars($client['contact']); ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="experience"  id="inputExperience" placeholder="Experience"><?php echo htmlspecialchars($client['experience'] ?? ''); ?>
</textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEducation" class="col-sm-2 col-form-label">Education</label>
                        <div class="col-sm-10">
                          <input type="text" name="course" class="form-control"  value="<?php echo htmlspecialchars($client['course']); ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputCollege" class="col-sm-2 col-form-label">College</label>
                        <div class="col-sm-10">
                          <input type="text" name="college" class="form-control"  value="<?php echo htmlspecialchars($client['college']); ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" name="skills" class="form-control" id="inputSkills" value="<?php echo htmlspecialchars($client['skills'] ?? ''); ?>
">
                        </div>
                      </div>
                      <!--<div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>-->
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2025 <a href="https://indsac.com">INDSAC SOFTECH</a>.</strong> All rights reserved.
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
