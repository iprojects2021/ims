<?php
session_start();

// Session timeout after 15 minutes (900 seconds)
$timeout_duration = 900;

if (!isset($_SESSION['student_id'])) {
    // Not logged in
    header("Location: login.php");
    exit;
}

// Timeout check
if (isset($_SESSION['last_login']) && (time() - $_SESSION['last_login']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=1");
    exit;
}

// Update session time
$_SESSION['last_login'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="alert alert-success">
        <h4>Welcome, <?= htmlspecialchars($_SESSION['student_name']) ?>!</h4>
        <p>You are now logged into your dashboard.</p>
    </div>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>