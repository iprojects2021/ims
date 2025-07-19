<?php
session_start();

// Check if user is logged in and is a student
if (!isset($_SESSION["login"]) || $_SESSION["user"]["role"] !== "student") {
    header("Location: ../login/login.php");
    exit;
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css"> <!-- Optional: Add your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f6f9;
            margin: 0;
            padding: 0;
        }

        .dashboard-container {
            max-width: 600px;
            margin: 80px auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 12px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .info {
            margin-top: 20px;
            font-size: 18px;
        }

        .info p {
            margin: 8px 0;
        }

        .logout-btn {
            margin-top: 30px;
            text-align: center;
        }

        .logout-btn a {
            padding: 10px 20px;
            background-color: #ff4b5c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .logout-btn a:hover {
            background-color: #e43f4a;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h1>Welcome, <?php echo htmlspecialchars($user["name"]); ?> 👋</h1>

    <div class="info">
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user["email"]); ?></p>
        <p><strong>Role:</strong> Student</p>
        <!-- Add more profile info if available -->
    </div>

    <div class="logout-btn">
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
