<?php
session_start();
include("../includes/db.php"); // PDO $db is used

$message = "";

// Get referral from URL if available
$referral_code_from_url = isset($_GET['referral']) ? trim($_GET['referral']) : '';

// Utility function to generate referral code
function generaterefercode($full_name, $db) {
    $first_name = strtoupper(explode(" ", trim($full_name))[0]);

    do {
        $random_code = strtoupper(substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6));
        $refercode = $first_name . "-" . $random_code;

        // Check if referral code already exists
        $stmt = $db->prepare("SELECT id FROM users WHERE refercode = ?");
        $stmt->execute([$refercode]);
    } while ($stmt->rowCount() > 0);

    return $refercode;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $contact = trim($_POST["contact"]);
    $college = trim($_POST["college"]);
    $course = trim($_POST["course"]);

    // Use the form value if filled, otherwise fallback to referral from URL
    $referredby = !empty($_POST["referredby"]) ? trim($_POST["referredby"]) : $referral_code_from_url;

    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        // Check if email already exists
        $check_query = "SELECT id FROM users WHERE email = ?";
        $stmt = $db->prepare($check_query);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $message = "Email already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Generate unique referral code
            $refercode = generaterefercode($full_name, $db);

            // Insert new user
            $insert_query = "INSERT INTO users (full_name, email, password, contact, college, course, role, referredby, refercode)
                             VALUES (?, ?, ?, ?, ?, ?, 'student', ?, ?)";
            $stmt = $db->prepare($insert_query);

            if ($stmt->execute([$full_name, $email, $hashed_password, $contact, $college, $course, $referredby, $refercode])) {
                $message = "Registered successfully! <a href='login.php'>Click here to login</a>";
            } else {
                $message = "Error occurred. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register | INDSAC Softech</title>
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
      max-width: 500px;
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
    .message {
      text-align: center;
      color: red;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .message.success {
      color: green;
    }
  </style>
</head>
<body>

<nav>
  <div class="logo"><a href="https://indsac.com" target="_blank">INDSAC SOFTECH</a></div>
  <div class="nav-buttons">
    <a href="/ims/index.php">Home</a>
    <a href="/ims/student/login.php">Login</a>
    <a href="/ims/student/register.php">Register</a>
  </div>
</nav>

<div class="container">
  <h2>Register for Internship Portal</h2>

  <?php if (!empty($message)): ?>
    <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : ''; ?>">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <form action="register.php<?php echo isset($_GET['referral']) ? '?referral=' . urlencode($_GET['referral']) : ''; ?>" method="POST">
    <label for="name">Full Name</label>
    <input type="text" id="name" name="full_name" required>

    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Confirm Password</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <label for="contact">Contact</label>
    <input type="text" id="contact" name="contact" required>

    <label for="college">College</label>
    <input type="text" id="college" name="college" required>

    <label for="course">Course / Branch</label>
    <input type="text" id="course" name="course" required>

    <label for="referredby">Referral Code</label>
    <input type="text" id="code" name="referredby" value="<?php echo htmlspecialchars($referral_code_from_url); ?>">

    <button type="submit">Register</button>
  </form>
</div>

<div class="footer">
  &copy; 2025 INDSAC Softech | Email: internships@indsac.com | <a style="color: #bbb;" href="https://indsac.com" target="_blank">indsac.com</a>
</div>

</body>
</html>
