<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: ../student/login.php"); // Change path if needed
    exit();
}

// Optional: Show session data for debugging
// echo "<pre>"; print_r($_SESSION); echo "</pre>";

// Use fallback values if keys are missing
$name = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : 
       (isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 
       (isset($_SESSION['email']) ? $_SESSION['email'] : 'Admin'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f9f9f9;
        }
        .welcome {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
            max-width: 500px;
            margin: auto;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="welcome">
        <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
        <p>This is the Admin Dashboard.</p>
        <p><a href="../student/logout.php">Logout</a></p>
    </div>

</body>
</html>

