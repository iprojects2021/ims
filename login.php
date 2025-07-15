<?php
session_start();
require("includes/db.php"); // Make sure db.php returns a $db PDO object

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = $db->prepare("SELECT * FROM users WHERE email = :email AND role = 'student'");
    $query->execute(["email" => $email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user"] = $user;
        $_SESSION["login"] = true;

        header("Location: students/index.php"); // redirect to student dashboard
        exit;
    } else {
        echo "<script>alert('Invalid email, password or not a student account.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | INDSAC Softech</title>
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
    nav .logo {
      font-size: 1.5rem;
      font-weight: bold;
    }
    nav .logo a {
      color: white;
      text-decoration: none;
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
  </style>
</head>
<body>

<!-- Header -->
<nav>
  <div class="logo"><a href="#">INDSAC SOFTECH</a></div>
  <div class="nav-buttons">
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
  </div>
</nav>

<!-- Login Form -->
<div class="container">
  <h2>Student Login</h2>
  <form method="POST" action="">
    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" required placeholder="Enter your email" />

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required placeholder="Enter your password" />

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
