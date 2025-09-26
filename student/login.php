<?php
include("../includes/db.php");
include(__DIR__ . "/../panel/util/PdoSessionHandler.php");

// Secure session configuration
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true, // ensure HTTPS
    'httponly' => true,
    'samesite' => 'Strict'
]);

// Start secure session with PDO handler
$handler = new PdoSessionHandler($db);
session_set_save_handler($handler, true);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Portal | INDSAC SOFTECH</title>
  <link rel="icon" type="image/png" href="../favico.png">

  <!-- Bootstrap and jQuery -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa;
    }

    nav {
      background-color: #1a73e8;
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav .logo a {
      color: white;
      font-size: 1.5rem;
      font-weight: bold;
      text-decoration: none;
    }

    nav .nav-buttons a {
      color: white;
      background-color: #0f5acc;
      padding: 8px 16px;
      margin-left: 10px;
      border-radius: 4px;
      text-decoration: none;
    }

    nav .nav-buttons a:hover {
      background-color: #0c48a1;
    }

    .container {
      max-width: 400px;
      margin: 80px auto;
      background-color: white;
      padding: 30px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
      border-radius: 10px;
    }

    h2 {
      text-align: center;
      color: #1a73e8;
      margin-bottom: 30px;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    button {
      background-color: #1a73e8;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #0f5acc;
    }

    .footer {
      text-align: center;
      padding: 20px;
      background: #222;
      color: white;
      margin-top: 60px;
    }

    @media (max-width: 600px) {
      nav {
        flex-direction: column;
        align-items: flex-start;
      }

      .container {
        margin: 40px 20px;
        padding: 20px;
      }
    }
  </style>
</head>
<body>

<!-- Header -->
<nav>
  <div class="logo"><a href="https://indsac.com" target="_blank">INDSAC SOFTECH</a></div>
  <div class="nav-buttons">
    <a href="/ims/index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
  </div>
</nav>

<!-- Login Form -->
<div class="container">
  <h2>Login to Internship Portal</h2>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
      $password = $_POST["password"];

      $query = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
      $query->bindParam(':email', $email, PDO::PARAM_STR);
      $query->execute();

      $user = $query->fetch(PDO::FETCH_ASSOC);

      if ($user && password_verify($password, $user["password"])) {
          $_SESSION["login"] = true;
          $_SESSION["user"] = [
              "id" => $user["id"],
              "email" => $user["email"],
              "name" => $user["full_name"],
              "role" => $user["role"]
          ];

          $redirect = ($user["role"] === "admin") ? "../panel/admin_dashboard.php" : "../panel/student-dashboard.php";

          echo "<script>window.location.href = '$redirect';</script>";
          exit;
      } else {
          echo '
          <div id="statusContainer" style="position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
                  z-index: 1050; width: 400px; max-width: 90%;">
              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="statusAlert">
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
                  Invalid email or password!
              </div>
          </div>
          <script>
              setTimeout(() => {
                  $("#statusAlert").alert("close");
              }, 2500);
          </script>';
      }
  }
  ?>

  <form action="" method="POST">
    <label for="email">Email Address</label>
    <input type="text" id="email" name="email" placeholder="Enter your email" required />

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" required />

    <button type="submit">Login</button>
  </form>
</div>

<!-- Footer -->
<div class="footer">
  &copy; 2025 INDSAC Softech | Email: internships@indsac.com | 
  <a style="color: #bbb;" href="https://indsac.com" target="_blank">indsac.com</a>
</div>

</body>
</html>
