<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Dashboard - Internship Portal</title>
  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", sans-serif;
      background: #f7f9fc;
      color: #333;
    }

    header {
      background: #2c3e50;
      color: white;
      padding: 1rem 2rem;
      text-align: center;
    }

    h1 {
      margin: 0;
      font-size: 1.8em;
    }

    .dashboard-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 20px;
      width: 100%;
      max-width: 300px;
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h2 {
      font-size: 1.2em;
      margin-bottom: 10px;
      color: #2c3e50;
    }

    .card p {
      margin: 0.5em 0;
      font-size: 0.95em;
    }

    .btn {
      display: inline-block;
      margin-top: 10px;
      background: #2980b9;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 6px;
      font-size: 0.95em;
    }

    @media (min-width: 768px) {
      .dashboard-container {
        justify-content: space-around;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Welcome, Student Name</h1>
    <p>Your Internship Dashboard</p>
  </header>

  <div class="dashboard-container">
    <!-- Internship Status -->
    <div class="card">
      <h2>Internship Status</h2>
      <p><strong>Position:</strong> Web Developer Intern</p>
      <p><strong>Company:</strong> TechSoft Solutions</p>
      <p><strong>Status:</strong> Selected</p>
      <p><strong>Duration:</strong> 3 Months</p>
    </div>

    <!-- Applications Summary -->
    <div class="card">
      <h2>Application Summary</h2>
      <p>Applied: <strong>5</strong></p>
      <p>Shortlisted: <strong>2</strong></p>
      <p>Selected: <strong>1</strong></p>
      <p>Rejected: <strong>2</strong></p>
    </div>

    <!-- Upcoming Events -->
    <div class="card">
      <h2>Upcoming Interview</h2>
      <p><strong>Date:</strong> July 28, 2025</p>
      <p><strong>Time:</strong> 11:00 AM</p>
      <p><strong>Company:</strong> FutureTech Inc</p>
    </div>

    <!-- Document Upload -->
    <div class="card">
      <h2>Documents</h2>
      <p>Resume: ✅</p>
      <p>NOC: ❌ <a href="#" class="btn">Upload</a></p>
      <p>Offer Letter: ❌</p>
    </div>

    <!-- Mentor Info -->
    <div class="card">
      <h2>Mentor Info</h2>
      <p><strong>Name:</strong> Mr. Raj Malhotra</p>
      <p><strong>Email:</strong> raj@example.com</p>
      <p><strong>Status:</strong> Online 🟢</p>
    </div>

    <!-- Recommendations -->
    <div class="card">
      <h2>Recommended Internships</h2>
      <p><strong>Role:</strong> Data Analyst Intern</p>
      <p><strong>Company:</strong> Insight Labs</p>
      <a href="#" class="btn">Apply Now</a>
    </div>
  </div>

</body>
</html>
