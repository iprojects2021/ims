<?php
require("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $phone = $_POST["phone"];
    $role = $_POST["role"];

    // ✅ (Optional) Only allow specific email to register as admin
    //if ($role === 'admin' && $email !== 'admin@yourdomain.com') {
        //echo "<script>alert('Only authorized email can register as admin.');</script>";
        //exit;
    //}

    // Check for duplicate email
    $check = $db->prepare("SELECT * FROM users WHERE email = :email");
    $check->execute(["email" => $email]);

    if ($check->rowCount() > 0) {
        echo "<script>alert('Email already registered');</script>";
    } else {
        $stmt = $db->prepare("INSERT INTO users (full_name, email, password, role, phone) 
                              VALUES (:full_name, :email, :password, :role, :phone)");
        $success = $stmt->execute([
            "full_name" => $full_name,
            "email"     => $email,
            "password"  => $password,
            "role"      => $role,
            "phone"     => $phone
        ]);

        if ($success) {
            echo "<script>alert('Registered successfully! Please login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Something went wrong. Try again.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register | INDSAC Softech</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      max-width: 450px;
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
    input, select {
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

<!-- Registration Form -->
<div class="container">
  <h2>Register for Internship Portal</h2>
  <form method="POST" action="">
    <label for="full_name">Full Name</label>
    <input type="text" id="full_name" name="full_name" required placeholder="Your full name" />

    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" required placeholder="Your email" />

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required placeholder="Create a password" />

    <label for="phone">Phone</label>
    <input type="text" id="phone" name="phone" required placeholder="Your phone number" />

    <label for="role">Select Role</label>
    <select name="role" id="role" required>
      <option value="">-- Select Role --</option>
      <option value="student">Student</option>
      <option value="admin">Admin</option>
    </select>

    <button type="submit">Register</button>
  </form>
</div>

<!-- Footer -->
<div class="footer">
  &copy; 2025 INDSAC Softech | Email: internships@indsac.com |
  <a style="color: #bbb;" href="https://indsac.com" target="_blank">indsac.com</a>
</div>

</body>
</html>
