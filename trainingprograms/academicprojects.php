<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Year Project Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .project-hero {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            border-radius: 10px;
        }
        .feature-item, .milestone-item {
            border-left: 3px solid #3498db;
            padding-left: 15px;
            margin-bottom: 10px;
        }
        .tech-badge {
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        .timeline::before {
            content: "";
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #3498db;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-item::before {
            content: "";
            position: absolute;
            left: -30px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #2c3e50;
            border: 2px solid white;
        }
        .nav-tabs .nav-link.active {
            color: #3498db;
            font-weight: bold;
            border-bottom: 3px solid #3498db;
        }
        .nav-tabs .nav-link {
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Project Header -->
        <div class="project-hero p-4 mb-4">
            <div class="row">
                <div class="col-md-8">
                    <h1 id="project-title">Smart Campus Management System</h1>
                    <p class="lead" id="project-short-desc">An IoT-based solution for automated college campus operations</p>
                    <div class="d-flex flex-wrap mt-3" id="tech-stack">
                        <span class="badge bg-light text-dark tech-badge">IoT</span>
                        <span class="badge bg-light text-dark tech-badge">Python</span>
                        <span class="badge bg-light text-dark tech-badge">Django</span>
                        <span class="badge bg-light text-dark tech-badge">React</span>
                        <span class="badge bg-light text-dark tech-badge">Raspberry Pi</span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="d-flex flex-column">
                        <span class="mb-2"><i class="fas fa-user-graduate me-2"></i> <span id="project-team">Team of 4</span></span>
                        <span class="mb-2"><i class="fas fa-calendar-alt me-2"></i> <span id="project-duration">6 months</span></span>
                        <span class="mb-2"><i class="fas fa-university me-2"></i> <span id="project-department">Computer Engineering</span></span>
                        <span class="mb-2"><i class="fas fa-star me-2"></i> <span id="project-status">Completed (May 2024)</span></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Overview</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="features-tab" data-bs-toggle="tab" data-bs-target="#features" type="button" role="tab">Features</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="implementation-tab" data-bs-toggle="tab" data-bs-target="#implementation" type="button" role="tab">Implementation</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="gallery-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button" role="tab">Gallery</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="projectTabsContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="mb-4">Project Abstract</h3>
                        <div id="project-description">
                            <p>The Smart Campus Management System is an integrated IoT solution designed to automate various campus operations including attendance tracking, energy management, security monitoring, and facility booking.</p>
                            <p>By leveraging Raspberry Pi devices with sensor arrays and a centralized cloud dashboard, the system provides real-time monitoring and analytics to improve campus operational efficiency by approximately 40% based on our pilot implementation.</p>
                        </div>

                        <h3 class="mt-5 mb-4">Problem Statement</h3>
                        <div class="card bg-light p-3 mb-4">
                            <p>Traditional college campuses face challenges with:</p>
                            <ul>
                                <li>Manual attendance processes wasting faculty time</li>
                                <li>Energy inefficiency from lights/ACs left on in empty rooms</li>
                                <li>Security vulnerabilities in isolated areas</li>
                                <li>Inefficient facility utilization tracking</li>
                            </ul>
                        </div>

                        <h3 class="mt-5 mb-4">Project Timeline</h3>
                        <div class="timeline" id="timeline-list">
                            <div class="timeline-item">
                                <h5>December 2023 - Project Proposal</h5>
                                <p>Literature review and requirements gathering</p>
                            </div>
                            <div class="timeline-item">
                                <h5>January 2024 - Prototype Development</h5>
                                <p>Built initial hardware setup and basic dashboard</p>
                            </div>
                            <div class="timeline-item">
                                <h5>March 2024 - Pilot Testing</h5>
                                <p>Deployed in 3 classrooms for real-world testing</p>
                            </div>
                            <div class="timeline-item">
                                <h5>May 2024 - Final Implementation</h5>
                                <p>Full deployment with all features completed</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-trophy me-2"></i> Achievements</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <i class="fas fa-award text-warning me-2"></i>
                                        Won 1st Prize at TechFest 2024
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-newspaper text-info me-2"></i>
                                        Featured in Campus Tech Magazine
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fas fa-handshake text-success me-2"></i>
                                        Adopted by college for full implementation
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-cogs me-2"></i> Technical Specifications</h5>
                            </div>
                            <div class="card-body">
                                <h6>Hardware:</h6>
                                <ul class="small">
                                    <li>Raspberry Pi 4 Model B</li>
                                    <li>RFID Sensors</li>
                                    <li>PIR Motion Sensors</li>
                                    <li>Relay Modules</li>
                                </ul>
                                <h6 class="mt-3">Software:</h6>
                                <ul class="small">
                                    <li>Python 3.8</li>
                                    <li>Django REST Framework</li>
                                    <li>React.js Dashboard</li>
                                    <li>MySQL Database</li>
                                </ul>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-users me-2"></i> Team Members</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="Team member">
                                    <div>
                                        <h6 class="mb-0">Rahul Sharma</h6>
                                        <small class="text-muted">Hardware Specialist</small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="Team member">
                                    <div>
                                        <h6 class="mb-0">Priya Patel</h6>
                                        <small class="text-muted">Backend Developer</small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="Team member">
                                    <div>
                                        <h6 class="mb-0">Amit Kumar</h6>
                                        <small class="text-muted">Frontend Developer</small>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="Team member">
                                    <div>
                                        <h6 class="mb-0">Neha Gupta</h6>
                                        <small class="text-muted">Project Manager</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Tab -->
            <div class="tab-pane fade" id="features" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mb-4"><i class="fas fa-star me-2"></i> Key Features</h3>
                        <div id="features-list">
                            <div class="feature-item mb-4">
                                <h5>Automated Attendance System</h5>
                                <p>RFID-based tracking with facial recognition backup, integrated with college database</p>
                                <span class="badge bg-primary">Accuracy: 98.7%</span>
                            </div>
                            <div class="feature-item mb-4">
                                <h5>Smart Energy Management</h5>
                                <p>Motion-activated lighting and climate control with usage analytics</p>
                                <span class="badge bg-success">Energy Saved: 35%</span>
                            </div>
                            <div class="feature-item mb-4">
                                <h5>Facility Booking System</h5>
                                <p>Real-time room availability and reservation through mobile app</p>
                                <span class="badge bg-info">Utilization +40%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-4"><i class="fas fa-shield-alt me-2"></i> Security Features</h3>
                        <div class="card bg-light p-3 mb-3">
                            <div class="d-flex">
                                <i class="fas fa-user-lock text-primary me-3 fs-3"></i>
                                <div>
                                    <h5>Intruder Detection</h5>
                                    <p class="mb-0">AI-powered anomaly detection in restricted areas</p>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light p-3 mb-3">
                            <div class="d-flex">
                                <i class="fas fa-bell text-primary me-3 fs-3"></i>
                                <div>
                                    <h5>Emergency Alerts</h5>
                                    <p class="mb-0">Panic buttons with location tracking</p>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light p-3">
                            <div class="d-flex">
                                <i class="fas fa-chart-line text-primary me-3 fs-3"></i>
                                <div>
                                    <h5>Analytics Dashboard</h5>
                                    <p class="mb-0">Real-time data visualization for administrators</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Implementation Tab -->
            <div class="tab-pane fade" id="implementation" role="tabpanel">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="mb-4"><i class="fas fa-microchip me-2"></i> Hardware Implementation</h3>
                        <div class="card mb-4">
                            <img src="https://via.placeholder.com/800x400?text=Hardware+Setup" class="card-img-top" alt="Hardware Setup">
                            <div class="card-body">
                                <h5 class="card-title">Sensor Node Architecture</h5>
                                <ol class="mt-3">
                                    <li>Raspberry Pi central controller</li>
                                    <li>RFID reader for ID cards</li>
                                    <li>PIR motion sensors</li>
                                    <li>Relay module for device control</li>
                                    <li>Camera module for facial recognition</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="mb-4"><i class="fas fa-code me-2"></i> Software Architecture</h3>
                        <div class="card mb-4">
                            <img src="https://via.placeholder.com/800x400?text=System+Architecture" class="card-img-top" alt="System Architecture">
                            <div class="card-body">
                                <h5 class="card-title">Three-Tier Architecture</h5>
                                <ul class="mt-3">
                                    <li><strong>Frontend:</strong> React.js dashboard</li>
                                    <li><strong>Backend:</strong> Django REST API</li>
                                    <li><strong>Database:</strong> MySQL with TimescaleDB extension</li>
                                    <li><strong>IoT Layer:</strong> MQTT protocol for device communication</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h3><i class="fas fa-tasks me-2"></i> Challenges & Solutions</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Challenge</th>
                                        <th>Solution</th>
                                        <th>Outcome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Device synchronization</td>
                                        <td>Implemented NTP time synchronization</td>
                                        <td>±50ms accuracy across nodes</td>
                                    </tr>
                                    <tr>
                                        <td>Data overload</td>
                                        <td>TimescaleDB for time-series data</td>
                                        <td>80% faster queries</td>
                                    </tr>
                                    <tr>
                                        <td>Power fluctuations</td>
                                        <td>Added UPS backup</td>
                                        <td>99.9% uptime</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Tab -->
            <div class="tab-pane fade" id="gallery" role="tabpanel">
                <h3 class="mb-4"><i class="fas fa-images me-2"></i> Project Gallery</h3>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/600x400?text=Hardware+Prototype" class="card-img-top" alt="Prototype">
                            <div class="card-body">
                                <h5 class="card-title">Initial Prototype</h5>
                                <p class="card-text">First working model with basic sensors</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/600x400?text=Dashboard+Screenshot" class="card-img-top" alt="Dashboard">
                            <div class="card-body">
                                <h5 class="card-title">Admin Dashboard</h5>
                                <p class="card-text">Real-time monitoring interface</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/600x400?text=Team+Working" class="card-img-top" alt="Team">
                            <div class="card-body">
                                <h5 class="card-title">Development Process</h5>
                                <p class="card-text">Team working on the project</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/600x400?text=Presentation" class="card-img-top" alt="Presentation">
                            <div class="card-body">
                                <h5 class="card-title">Final Presentation</h5>
                                <p class="card-text">Demonstrating to faculty panel</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/600x400?text=Award+Ceremony" class="card-img-top" alt="Award">
                            <div class="card-body">
                                <h5 class="card-title">Award Ceremony</h5>
                                <p class="card-text">Receiving 1st prize at TechFest</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="https://via.placeholder.com/600x400?text=Campus+Deployment" class="card-img-top" alt="Deployment">
                            <div class="card-body">
                                <h5 class="card-title">Campus Deployment</h5>
                                <p class="card-text">Installing devices in classrooms</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // This would be replaced with actual data fetching from your backend
        function loadProjectData() {
            // In a real app, you would fetch this from your API
            const projectData = {
                title: "Smart Campus Management System",
                shortDesc: "An IoT-based solution for automated college campus operations",
                description: "The Smart Campus Management System is an integrated IoT solution designed to automate various campus operations including attendance tracking, energy management, security monitoring, and facility booking.\n\nBy leveraging Raspberry Pi devices with sensor arrays and a centralized cloud dashboard, the system provides real-time monitoring and analytics to improve campus operational efficiency by approximately 40% based on our pilot implementation.",
                team: "Team of 4",
                duration: "6 months",
                department: "Computer Engineering",
                status: "Completed (May 2024)",
                techStack: ["IoT", "Python", "Django", "React", "Raspberry Pi"],
                features: [
                    { 
                        title: "Automated Attendance System", 
                        desc: "RFID-based tracking with facial recognition backup, integrated with college database",
                        metric: "Accuracy: 98.7%"
                    },
                    { 
                        title: "Smart Energy Management", 
                        desc: "Motion-activated lighting and climate control with usage analytics",
                        metric: "Energy Saved: 35%"
                    }
                ],
                timeline: [
                    { time: "December 2023", activity: "Project Proposal" },
                    { time: "January 2024", activity: "Prototype Development" },
                    { time: "March 2024", activity: "Pilot Testing" }
                ],
                // You would continue with other data...
            };

            // Populate the page with data
            document.getElementById('project-title').textContent = projectData.title;
            document.getElementById('project-short-desc').textContent = projectData.shortDesc;
            document.getElementById('project-description').innerHTML = projectData.description.split('\n').map(p => `<p>${p}</p>`).join('');
            document.getElementById('project-team').textContent = projectData.team;
            document.getElementById('project-duration').textContent = projectData.duration;
            document.getElementById('project-department').textContent = projectData.department;
            document.getElementById('project-status').textContent = projectData.status;

            // Populate tech stack badges
            const techStackContainer = document.getElementById('tech-stack');
            techStackContainer.innerHTML = projectData.techStack.map(tech => 
                `<span class="badge bg-light text-dark tech-badge">${tech}</span>`
            ).join('');

            // You would continue populating other sections...
        }

        // Load project data when page loads
        window.addEventListener('DOMContentLoaded', loadProjectData);
    </script>
</body>
</html>