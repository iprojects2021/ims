<?php
session_start();
include("../includes/db.php");

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch student details
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$student_id'");
$student = mysqli_fetch_assoc($query);

// Redirect to login if student not found
if (!$student) {
    header("Location: login.php");
    exit();
}

// Page routing
$page = isset($_GET['page']) ? $_GET['page'] : 'status';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #2c3e50;
            color: white;
            position: fixed;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .toggle-btn {
            display: none;
            font-size: 22px;
            background: none;
            border: none;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -220px;
                position: absolute;
                transition: 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .toggle-btn {
                display: block;
            }
        }

        .profile-card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            max-width: 400px;
        }

        .progress-steps {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        .progress-steps li {
            padding: 10px 20px;
            background: #ddd;
            border-radius: 5px;
        }

        .progress-steps li.completed {
            background: #4CAF50;
            color: white;
        }

        .progress-steps li.active {
            background: #FFA500;
            color: white;
        }
    </style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <h2 style="text-align: center;">Student</h2>
    <a href="dashboard.php?page=profile">👤 Profile</a>
    <a href="dashboard.php?page=status">📄 Application Status</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="main-content">
    <div class="topbar">
        <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
        <h1>Welcome, <?php echo htmlspecialchars($student['full_name']); ?></h1>
    </div>

    <div class="content-section">
        <?php if ($page === 'profile') { ?>
            <h2>Your Profile</h2>
            <div class="profile-card">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($student['full_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
                <p><strong>Password:</strong> ********</p>
            </div>
        <?php } elseif ($page === 'status') { ?>
            <h2>Application Status</h2>
            <ul class="progress-steps">
                <li class="completed">Applied</li>
                <li class="completed">Under Review</li>
                <li class="active">Shortlisted</li>
                <li>Selected</li>
            </ul>
        <?php } ?>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
    }
</script>

</body>
</html>
