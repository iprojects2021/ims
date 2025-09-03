<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ... CSS includes ... -->
<!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- your custom styles here -->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Sidebar -->
    <?php include("leftmenu.php"); ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Your attendance dashboard goes here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intern Attendance Tracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: white;
            padding: 20px 0;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .dashboard {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .status-card {
            text-align: center;
        }

        .time-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #4b6cb7;
            margin: 15px 0;
        }

        .date-display {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 20px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 5px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #182848 0%, #4b6cb7 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background: #f1f1f1;
            color: #333;
        }

        .btn-secondary:hover {
            background: #e1e1e1;
            transform: translateY(-2px);
        }

        .btn-success {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);
            transform: translateY(-2px);
        }

        .activity-form textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 15px;
            resize: vertical;
            min-height: 120px;
        }

        .activity-list {
            margin-top: 30px;
        }

        .activity-item {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #4b6cb7;
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            align-items: center;
        }

        .activity-time {
            font-weight: bold;
            color: #4b6cb7;
        }

        .activity-duration {
            background: #f1f5f9;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .activity-content {
            color: #555;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-top: 20px;
        }

        .stat-item {
            padding: 15px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #4b6cb7;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        h2 {
            color: #4b6cb7;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        h3 {
            color: #4b6cb7;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .history-list {
            max-height: 400px;
            overflow-y: auto;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: #666;
            font-size: 0.9rem;
        }

        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
        }

        .tab.active {
            border-bottom: 3px solid #4b6cb7;
            color: #4b6cb7;
            font-weight: bold;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .hourly-activities {
            margin-top: 20px;
        }

        .hour-input {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .hour-input select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .hour-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            background: #2ecc71;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .notification.show {
            transform: translateX(0);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-clock"></i> Intern Attendance Tracker</h1>
            <p>Track your working hours and activities efficiently</p>
        </header>

        <div class="dashboard">
            <div class="card status-card">
                <h2>Current Status</h2>
                <div class="time-display" id="current-time">00:00:00</div>
                <div class="date-display" id="current-date">Loading...</div>
                <div id="status-indicator">
                    <p>You are currently <span id="status-text">not logged in</span></p>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-success" id="clock-in-btn"><i class="fas fa-sign-in-alt"></i> Work Login</button>
                    <button class="btn btn-danger" id="clock-out-btn" disabled><i class="fas fa-sign-out-alt"></i> Work Logout</button>
                </div>
            </div>

            <div class="card">
                <h2>Today's Summary</h2>
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-value" id="hours-worked">0h 0m</div>
                        <div class="stat-label">Hours Worked</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="activities-logged">0</div>
                        <div class="stat-label">Activities Logged</div>
                    </div>
                </div>
                
                <div class="activity-form">
                    <h3>Log Today's Work</h3>
                    <textarea id="work-description" placeholder="Describe what you worked on today..."></textarea>
                    <button class="btn btn-primary" id="save-activity-btn"><i class="fas fa-save"></i> Save Activity</button>
                </div>
            </div>
        </div>

        <div class="tabs">
            <div class="tab active" data-tab="hourly">Hourly Activities</div>
            <div class="tab" data-tab="history">Attendance History</div>
        </div>

        <div class="tab-content active" id="hourly-tab">
            <div class="card">
                <h2>Log Hourly Activity</h2>
                <div class="hourly-activities">
                    <div class="hour-input">
                        <select id="hour-select">
                            <option value="1">1 hour</option>
                            <option value="2">2 hours</option>
                            <option value="3">3 hours</option>
                            <option value="4">4 hours</option>
                        </select>
                        <input type="text" id="hour-activity" placeholder="What did you work on during this time?">
                    </div>
                    <button class="btn btn-primary" id="log-hourly-btn"><i class="fas fa-plus"></i> Log Hourly Activity</button>
                </div>

                <div class="activity-list">
                    <h3>Today's Activities</h3>
                    <div id="activities-container">
                        <!-- Activities will be added here dynamically -->
                        <p id="no-activities">No activities logged yet. Add your first activity above.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content" id="history-tab">
            <div class="card">
                <h2>Attendance History</h2>
                <div class="history-list" id="history-container">
                    <!-- History items will be added here dynamically -->
                    <p>No attendance history available yet.</p>
                </div>
            </div>
        </div>

        <footer>
            <p>Intern Attendance Tracker &copy; 2023 | Designed for Internship Program</p>
        </footer>
    </div>

    <div class="notification" id="notification">
        <span id="notification-text">Activity logged successfully!</span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const currentTimeElement = document.getElementById('current-time');
            const currentDateElement = document.getElementById('current-date');
            const statusTextElement = document.getElementById('status-text');
            const clockInBtn = document.getElementById('clock-in-btn');
            const clockOutBtn = document.getElementById('clock-out-btn');
            const hoursWorkedElement = document.getElementById('hours-worked');
            const activitiesLoggedElement = document.getElementById('activities-logged');
            const workDescriptionElement = document.getElementById('work-description');
            const saveActivityBtn = document.getElementById('save-activity-btn');
            const activitiesContainer = document.getElementById('activities-container');
            const noActivitiesElement = document.getElementById('no-activities');
            const historyContainer = document.getElementById('history-container');
            const hourSelect = document.getElementById('hour-select');
            const hourActivity = document.getElementById('hour-activity');
            const logHourlyBtn = document.getElementById('log-hourly-btn');
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            const notification = document.getElementById('notification');

            // State variables
            let isClockedIn = false;
            let clockInTime = null;
            let activities = [];
            let attendanceHistory = [];

            // Update clock function
            function updateClock() {
                const now = new Date();
                const timeString = now.toLocaleTimeString();
                const dateString = now.toLocaleDateString('en-US', { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                });
                
                currentTimeElement.textContent = timeString;
                currentDateElement.textContent = dateString;
                
                // Update hours worked if clocked in
                if (isClockedIn) {
                    updateHoursWorked();
                }
            }

            // Update hours worked
            function updateHoursWorked() {
                if (clockInTime) {
                    const now = new Date();
                    const diff = now - clockInTime;
                    const hours = Math.floor(diff / 1000 / 60 / 60);
                    const minutes = Math.floor((diff / 1000 / 60) % 60);
                    hoursWorkedElement.textContent = `${hours}h ${minutes}m`;
                }
            }

            // Clock in function
            function clockIn() {
                isClockedIn = true;
                clockInTime = new Date();
                statusTextElement.textContent = "clocked in";
                statusTextElement.style.color = "#2ecc71";
                clockInBtn.disabled = true;
                clockOutBtn.disabled = false;
                
                showNotification("Clocked in successfully!");
            }

            // Clock out function
            function clockOut() {
                isClockedIn = false;
                const clockOutTime = new Date();
                const workDuration = clockOutTime - clockInTime;
                const hours = Math.floor(workDuration / 1000 / 60 / 60);
                const minutes = Math.floor((workDuration / 1000 / 60) % 60);
                
                // Add to attendance history
                attendanceHistory.push({
                    date: new Date(),
                    clockIn: clockInTime,
                    clockOut: clockOutTime,
                    duration: workDuration,
                    description: workDescriptionElement.value
                });
                
                statusTextElement.textContent = "not logged in";
                statusTextElement.style.color = "#e74c3c";
                clockInBtn.disabled = false;
                clockOutBtn.disabled = true;
                
                // Save to localStorage
                saveHistory();
                
                showNotification(`Clocked out successfully! Worked for ${hours}h ${minutes}m`);
                
                // Reset for new day
                hoursWorkedElement.textContent = "0h 0m";
                workDescriptionElement.value = "";
                activities = [];
                updateActivitiesCount();
                renderActivities();
            }

            // Save activity
            function saveActivity() {
                const description = workDescriptionElement.value.trim();
                if (description === "") {
                    showNotification("Please enter a work description", true);
                    return;
                }
                
                showNotification("Daily work description saved!");
            }

            // Log hourly activity
            function logHourlyActivity() {
                const hours = parseInt(hourSelect.value);
                const activity = hourActivity.value.trim();
                
                if (activity === "") {
                    showNotification("Please describe your activity", true);
                    return;
                }
                
                activities.push({
                    hours,
                    activity,
                    timestamp: new Date()
                });
                
                hourActivity.value = "";
                updateActivitiesCount();
                renderActivities();
                saveActivities();
                
                showNotification("Hourly activity logged successfully!");
            }

            // Update activities count
            function updateActivitiesCount() {
                activitiesLoggedElement.textContent = activities.length;
            }

            // Render activities
            function renderActivities() {
                if (activities.length === 0) {
                    noActivitiesElement.style.display = "block";
                    activitiesContainer.innerHTML = "";
                    return;
                }
                
                noActivitiesElement.style.display = "none";
                
                let html = "";
                activities.forEach((activity, index) => {
                    const timeString = activity.timestamp.toLocaleTimeString();
                    html += `
                        <div class="activity-item">
                            <div class="activity-header">
                                <span class="activity-time">${timeString}</span>
                                <span class="activity-duration">${activity.hours} hour(s)</span>
                            </div>
                            <div class="activity-content">
                                ${activity.activity}
                            </div>
                        </div>
                    `;
                });
                
                activitiesContainer.innerHTML = html;
            }

            // Render history
            function renderHistory() {
                if (attendanceHistory.length === 0) {
                    historyContainer.innerHTML = "<p>No attendance history available yet.</p>";
                    return;
                }
                
                let html = "";
                attendanceHistory.forEach(entry => {
                    const dateString = entry.date.toLocaleDateString();
                    const clockInString = entry.clockIn.toLocaleTimeString();
                    const clockOutString = entry.clockOut.toLocaleTimeString();
                    const hours = Math.floor(entry.duration / 1000 / 60 / 60);
                    const minutes = Math.floor((entry.duration / 1000 / 60) % 60);
                    
                    html += `
                        <div class="activity-item">
                            <div class="activity-header">
                                <span class="activity-time">${dateString}</span>
                                <span class="activity-duration">${hours}h ${minutes}m</span>
                            </div>
                            <div class="activity-content">
                                <p><strong>Clock In:</strong> ${clockInString} | <strong>Clock Out:</strong> ${clockOutString}</p>
                                <p><strong>Description:</strong> ${entry.description || "No description provided"}</p>
                            </div>
                        </div>
                    `;
                });
                
                historyContainer.innerHTML = html;
            }

            // Show notification
            function showNotification(message, isError = false) {
                const notificationText = document.getElementById('notification-text');
                notificationText.textContent = message;
                
                if (isError) {
                    notification.style.background = "#e74c3c";
                } else {
                    notification.style.background = "#2ecc71";
                }
                
                notification.classList.add('show');
                
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }

            // Tab switching
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const tabId = tab.getAttribute('data-tab');
                    
                    // Update active tab
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    
                    // Show active tab content
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                        if (content.id === `${tabId}-tab`) {
                            content.classList.add('active');
                        }
                    });
                });
            });

            // Save activities to localStorage
            function saveActivities() {
                localStorage.setItem('internActivities', JSON.stringify(activities));
            }

            // Load activities from localStorage
            function loadActivities() {
                const savedActivities = localStorage.getItem('internActivities');
                if (savedActivities) {
                    activities = JSON.parse(savedActivities);
                    updateActivitiesCount();
                    renderActivities();
                }
            }

            // Save history to localStorage
            function saveHistory() {
                localStorage.setItem('internHistory', JSON.stringify(attendanceHistory));
            }

            // Load history from localStorage
            function loadHistory() {
                const savedHistory = localStorage.getItem('internHistory');
                if (savedHistory) {
                    attendanceHistory = JSON.parse(savedHistory);
                    renderHistory();
                }
            }

            // Initialize the app
            function init() {
                updateClock();
                setInterval(updateClock, 1000);
                
                loadActivities();
                loadHistory();
                
                // Event listeners
                clockInBtn.addEventListener('click', clockIn);
                clockOutBtn.addEventListener('click', clockOut);
                saveActivityBtn.addEventListener('click', saveActivity);
                logHourlyBtn.addEventListener('click', logHourlyActivity);
            }

            // Start the app
            init();
        });
    </script>
</body>
</html>
    </div>

    <!-- Footer -->
    <?php include("footer.php"); ?>
  </div>

  <!-- JS scripts at end -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Hidden form to send POST -->
<form id="postForm" method="POST" action="typedetails.php" style="display:none;">
    <input type="hidden" name="id" id="hiddenId">
</form>
<script>
  
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            document.getElementById('hiddenId').value = id;
            document.getElementById('postForm').submit();
        });
    });
</script>
<style>
.badge-orange {
    background-color: #fd7e14; /* Bootstrap's orange */
    color: #fff;
}
</style>

</body>
</html>
