<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<!-- FontAwesome (for alert icon) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | INDSAC Softech</title>
  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa;
    }

    /* Header */
   nav {
      background-color: #1a73e8;
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav .logo {
      font-size: 1.5rem;
      font-weight: bold;
    }

    nav .logo a {
      color: white;
      text-decoration: none;
    }

    nav .logo a:hover {
      color: white;
    }
    nav .nav-buttons a {
      text-decoration: none;
      color: white;
      background-color: #0f5acc;
      padding: 8px 16px;
      margin-left: 10px;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    nav .nav-buttons a:hover {
      background-color: #0c48a1;
    }

    /* Main Container */
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

    form label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
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
      font-size: 1rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
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
      .nav-buttons {
        margin-top: 10px;
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
  <div class="logo"><a href="https://indsac.com" target="_blank"> INDSAC SOFTECH</a></div>
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
include("../includes/db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and get input
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = $_POST["sifre"];

    // Query user (admin or student)
    $query = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Verify password and handle based on role
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["login"] = true;
        $_SESSION["user"] = [
            "id" => $user["id"],
            "email" => $user["email"],
            "name" => $user["full_name"],
            "role" => $user["role"]
        ];

        // Redirect based on role
        if ($user["role"] === "admin") {
            header("Location: ../panel/admin_dashboard.php");
        } else {
            header("Location: ../panel/student-dashboard.php");
        }
        exit;
    } else {
      echo '
    <div id="statusContainer" style="position: fixed; top: 10%; left: 50%; transform: translate(-50%, -50%);
                z-index: 1050; width: 400px; max-width: 90%;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="statusAlert" style="box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
            Invalid email or password!
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(function() {
            var alert = document.getElementById("statusAlert");
            if (alert) {
                $(alert).alert("close");
            }
        }, 2500);
    </script>';

        //  Login failed
        // $_SESSION["error"] = "Invalid email or password!";
        // header("Location: login.php");
        // exit;
    }
}
?>

  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    <label for="email">Email Address</label>
    <input type="text" id="mail" name="email" placeholder="Enter your email" required />

    <label for="password">Password</label>
    <input type="password" id="sifre" name="sifre" placeholder="Enter your password" required />

    <button type="submit">Login</button>
  </form>
</div>

<!-- Footer -->
<div class="footer">
  &copy; 2025 INDSAC Softech | Email: internships@indsac.com | <a style="color: #bbb;" href="https://indsac.com" target="_blank">indsac.com</a>
</div>

</body>
</html>

