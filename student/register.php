<?php
include("../includes/db.php");
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $contact = $_POST['contact'];
    $college = $_POST['college'];
    $course = $_POST['course'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password too short.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email already exists.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, contact , college, course ) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $email, $hashed, $contact, $college, $course);
            $stmt->execute();
            $success = "Registered successfully! <a href='login.php'>Login</a>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .register-container {
      max-width: 550px;
      margin: 50px auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
    h3 {
      text-align: center;
      margin-bottom: 25px;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="register-container">
    <h3>Student Registration</h3>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

    <form method="POST">
      <div class="mb-3"><label>Full Name</label><input name="full_name" class="form-control" required></div>
      <div class="mb-3"><label>Email</label><input name="email" type="email" class="form-control" required></div>
      <div class="mb-3"><label>Password</label><input name="password" type="password" class="form-control" required></div>
      <div class="mb-3"><label>Confirm Password</label><input name="confirm_password" type="password" class="form-control" required></div>
      <div class="mb-3"><label>Contact</label><input name="contact" class="form-control" required></div>
      <div class="mb-3"><label>College</label><input name="college" class="form-control" required></div>
      <div class="mb-3"><label>Course/Branch</label><input name="course" class="form-control" required></div>
      <div class="d-grid gap-2">
        <button class="btn btn-success" type="submit">Register</button>
        <a href="login.php" class="btn btn-link text-center">Already registered? Login</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
