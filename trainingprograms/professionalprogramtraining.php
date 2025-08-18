<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Java Spring Boot Mastery + Campus Placement Prep</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome@6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6f42c1;
            --secondary: #20c997;
        }
        .course-hero123 {
            background: linear-gradient(135deg, var(--primary) 0%, #6610f2 100%);
            color: white;
            border-radius: 10px;
        }
        .nav-tabs .nav-link.active {
            color: var(--primary);
            font-weight: bold;
            border-bottom: 3px solid var(--primary);
        }
        .module-card {
            border-left: 4px solid var(--primary);
            transition: transform 0.3s;
        }
        .module-card:hover {
            transform: translateY(-5px);
        }
        .placement-badge {
            background-color: var(--secondary);
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
            background: var(--primary);
        }
        .timeline-item {
            position: relative;
            margin-bottom: 25px;
        }
        .timeline-item::before {
            content: "";
            position: absolute;
            left: -30px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary);
            border: 3px solid white;
        }
        .interview-card {
            border-top: 3px solid var(--secondary);
        }
        .apply-btn {
            background: var(--primary);
            border: none;
        }
        .apply-btn:hover {
            background: #5a32a3;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Course Header -->
        <div class="course-hero123 p-4 mb-4 shadow">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-leaf me-2"></i> Java Spring Boot Mastery</h1>
                    <p class="lead">With Campus Placement Interview Preparation</p>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <span class="badge bg-light text-dark"><i class="fas fa-clock me-1"></i> 12 Weeks</span>
                        <span class="badge bg-light text-dark"><i class="fas fa-laptop-code me-1"></i> 80+ Hours</span>
                        <span class="badge placement-badge"><i class="fas fa-briefcase me-1"></i> Placement Prep</span>
                        <span class="badge bg-light text-dark"><i class="fas fa-certificate me-1"></i> Certificate</span>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="d-flex flex-column">
                        <div class="mb-2">
                            <span class="fs-4 fw-bold">₹15,999</span>
                            <span class="text-decoration-line-through text-light ms-2">₹24,999</span>
                        </div>
                        <a class="btn btn-light btn-lg apply-btn" href="#chooseplan">
                            <i class="fas fa-arrow-right me-2"></i> Enroll Now
    </a>
                        <small class="text-light mt-1">Next batch starts: July 15, 2024</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" id="courseTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button">Overview</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button">Curriculum</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="placement-tab" data-bs-toggle="tab" data-bs-target="#placement" type="button">Placement Prep</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="projects-tab" data-bs-toggle="tab" data-bs-target="#projects" type="button">Projects</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="courseTabsContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="mb-4"><i class="fas fa-info-circle me-2"></i> Course Description</h3>
                        <div class="mb-4">
                            <p>This intensive 12-week program transforms you from Java beginner to Spring Boot professional while preparing you for campus placement interviews at top tech companies like TCS, Infosys, Wipro, and product-based firms.</p>
                            <p>You'll build 5+ real-world projects, solve 100+ DSA problems, and participate in 15+ mock interviews with industry experts.</p>
                        </div>

                        <h3 class="mb-4"><i class="fas fa-bullseye me-2"></i> Learning Outcomes</h3>
                        <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
                            <div class="col">
                                <div class="card h-100 module-card shadow-sm">
                                    <div class="card-body">
                                        <h5><i class="fas fa-code text-primary me-2"></i> Core Java & Spring Boot</h5>
                                        <ul class="mt-3">
                                            <li>Master OOPs, Collections, Multithreading</li>
                                            <li>Build REST APIs with Spring MVC</li>
                                            <li>Implement JPA/Hibernate for databases</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100 module-card shadow-sm">
                                    <div class="card-body">
                                        <h5><i class="fas fa-server text-primary me-2"></i> Backend Development</h5>
                                        <ul class="mt-3">
                                            <li>Microservices with Spring Cloud</li>
                                            <li>Authentication with JWT</li>
                                            <li>Docker & AWS Deployment</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100 module-card shadow-sm">
                                    <div class="card-body">
                                        <h5><i class="fas fa-brain text-primary me-2"></i> DSA & Problem Solving</h5>
                                        <ul class="mt-3">
                                            <li>Solve 100+ curated problems</li>
                                            <li>Focus on TCS, Infosys question patterns</li>
                                            <li>Time/space complexity analysis</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100 module-card shadow-sm">
                                    <div class="card-body">
                                        <h5><i class="fas fa-comments text-primary me-2"></i> Interview Prep</h5>
                                        <ul class="mt-3">
                                            <li>15+ mock technical interviews</li>
                                            <li>HR interview simulations</li>
                                            <li>Resume building workshops</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="mb-4"><i class="fas fa-road me-2"></i> Course Journey</h3>
                        <div class="timeline mb-4">
                            <div class="timeline-item">
                                <h5>Weeks 1-4: Core Foundation</h5>
                                <p>Java refresher + Spring Boot fundamentals + Basic DSA</p>
                            </div>
                            <div class="timeline-item">
                                <h5>Weeks 5-8: Advanced Backend</h5>
                                <p>Microservices + Databases + Intermediate DSA</p>
                            </div>
                            <div class="timeline-item">
                                <h5>Weeks 9-12: Placement Prep</h5>
                                <p>Mock interviews + Resume building + Advanced DSA</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i> Placement Stats</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6>2023 Batch Results:</h6>
                                    <div class="progress mt-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 87%">87% Placed</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <h6>Average Package:</h6>
                                    <div class="d-flex align-items-center">
                                        <span class="fs-4 fw-bold">₹6.5 LPA</span>
                                        <span class="badge bg-success ms-2">+22% YoY</span>
                                    </div>
                                </div>
                                <div>
                                    <h6>Top Recruiters:</h6>
                                    <div class="d-flex flex-wrap gap-2 mt-2">
                                        <span class="badge bg-light text-dark">TCS</span>
                                        <span class="badge bg-light text-dark">Infosys</span>
                                        <span class="badge bg-light text-dark">Wipro</span>
                                        <span class="badge bg-light text-dark">Cognizant</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i> Mentors</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Mentor">
                                    <div>
                                        <h6 class="mb-0">Rajesh Kumar</h6>
                                        <small class="text-muted">Ex-Infosys, 8+ years experience</small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Mentor">
                                    <div>
                                        <h6 class="mb-0">Priya Sharma</h6>
                                        <small class="text-muted">TCS Interview Panelist</small>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Mentor">
                                    <div>
                                        <h6 class="mb-0">Amit Patel</h6>
                                        <small class="text-muted">DSA Expert, 5+ years coaching</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i> Who Should Enroll?</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Final year engineering students</span>
                                    </li>
                                    <li class="list-group-item d-flex">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Basic Java knowledge required</span>
                                    </li>
                                    <li class="list-group-item d-flex">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Looking for campus placement prep</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Curriculum Tab -->
            <div class="tab-pane fade" id="curriculum" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mb-4"><i class="fas fa-book me-2"></i> Java & Spring Boot Modules</h3>
                        <div class="accordion mb-4" id="javaAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#java1">
                                        Module 1: Core Java (2 Weeks)
                                    </button>
                                </h2>
                                <div id="java1" class="accordion-collapse collapse show" data-bs-parent="#javaAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>OOPs Concepts Deep Dive</li>
                                            <li>Collections Framework</li>
                                            <li>Multithreading & Concurrency</li>
                                            <li>Exception Handling</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#java2">
                                        Module 2: Spring Boot Fundamentals (3 Weeks)
                                    </button>
                                </h2>
                                <div id="java2" class="accordion-collapse collapse" data-bs-parent="#javaAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>Spring IOC & Dependency Injection</li>
                                            <li>Building REST APIs with Spring MVC</li>
                                            <li>Spring Data JPA with Hibernate</li>
                                            <li>Validation & Exception Handling</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- More modules... -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-4"><i class="fas fa-project-diagram me-2"></i> System Design & Advanced Topics</h3>
                        <div class="accordion mb-4" id="advancedAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#advanced1">
                                        Module 3: Microservices (2 Weeks)
                                    </button>
                                </h2>
                                <div id="advanced1" class="accordion-collapse collapse show" data-bs-parent="#advancedAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>Spring Cloud Fundamentals</li>
                                            <li>Service Discovery with Eureka</li>
                                            <li>API Gateway Pattern</li>
                                            <li>Distributed Tracing</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#advanced2">
                                        Module 4: Deployment & DevOps (1 Week)
                                    </button>
                                </h2>
                                <div id="advanced2" class="accordion-collapse collapse" data-bs-parent="#advancedAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>Dockerizing Spring Boot Apps</li>
                                            <li>AWS EC2 Deployment</li>
                                            <li>CI/CD Pipelines</li>
                                            <li>Monitoring with Actuator</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- More modules... -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3><i class="fas fa-laptop-code me-2"></i> Hands-on Labs</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Week</th>
                                        <th>Lab Topic</th>
                                        <th>Hours</th>
                                        <th>Outcome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Building a Student Management System</td>
                                        <td>8</td>
                                        <td>Core Java Application</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>E-commerce REST API</td>
                                        <td>12</td>
                                        <td>Spring Boot + MySQL</td>
                                    </tr>
                                    <!-- More labs... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Placement Prep Tab -->
            <div class="tab-pane fade" id="placement" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mb-4"><i class="fas fa-code me-2"></i> DSA & Problem Solving</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>TCS/Infosys Pattern Focus</h5>
                                <div class="progress mt-3 mb-2">
                                    <div class="progress-bar bg-success" style="width: 70%">70% Pattern Coverage</div>
                                </div>
                                <ul class="mt-3">
                                    <li>Arrays & String Manipulation</li>
                                    <li>Number Theory Problems</li>
                                    <li>Tree & Graph Traversals</li>
                                    <li>Dynamic Programming Basics</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>Daily Coding Challenges</h5>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="badge bg-primary">100+ Problems</span>
                                    <span class="badge bg-success">LeetCode Curated</span>
                                </div>
                                <p>Daily problem assignments with mentor code reviews</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-4"><i class="fas fa-comments me-2"></i> Interview Preparation</h3>
                        <div class="card interview-card mb-4">
                            <div class="card-body">
                                <h5><i class="fas fa-user-tie me-2"></i> Technical Interviews</h5>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge bg-primary me-2">15+</span>
                                            <span>Mock Interviews</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-success me-2">1:1</span>
                                            <span>Feedback Sessions</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <ul>
                                            <li>Spring Boot Concepts</li>
                                            <li>Database Design</li>
                                            <li>Problem Solving</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card interview-card">
                            <div class="card-body">
                                <h5><i class="fas fa-users me-2"></i> HR & Managerial Rounds</h5>
                                <ul class="mt-3">
                                    <li>Common HR Questions</li>
                                    <li>Behavioral Interview Prep</li>
                                    <li>Salary Negotiation Tips</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <h3><i class="fas fa-file-alt me-2"></i> Resume & Profile Building</h3>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="fas fa-file-word me-2"></i> Resume Workshop</h5>
                                        <p class="mt-3">Tailored for freshers with project highlighting</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="fab fa-linkedin me-2"></i> LinkedIn Optimization</h5>
                                        <p class="mt-3">Profile makeover for recruiter visibility</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="fab fa-github me-2"></i> GitHub Portfolio</h5>
                                        <p class="mt-3">Showcase your projects professionally</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Tab -->
            <div class="tab-pane fade" id="projects" role="tabpanel">
                <h3 class="mb-4"><i class="fas fa-tasks me-2"></i> Course Projects</h3>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="https://via.placeholder.com/600x300?text=E-commerce+Backend" class="card-img-top" alt="Project">
                            <div class="card-body">
                                <h5>E-commerce Backend</h5>
                                <div class="d-flex flex-wrap gap-2 my-2">
                                    <span class="badge bg-primary">Spring Boot</span>
                                    <span class="badge bg-primary">JWT Auth</span>
                                    <span class="badge bg-primary">MySQL</span>
                                </div>
                                <p>Full-featured backend with product catalog, cart, and order management</p>
                                <ul>
                                    <li>REST API Design</li>
                                    <li>Role-based Access Control</li>
                                    <li>Payment Gateway Integration</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="https://via.placeholder.com/600x300?text=Job+Portal" class="card-img-top" alt="Project">
                            <div class="card-body">
                                <h5>Campus Placement Portal</h5>
                                <div class="d-flex flex-wrap gap-2 my-2">
                                    <span class="badge bg-primary">Microservices</span>
                                    <span class="badge bg-primary">Spring Cloud</span>
                                    <span class="badge bg-primary">MongoDB</span>
                                </div>
                                <p>Job portal connecting students with recruiters</p>
                                <ul>
                                    <li>Resume Parser Service</li>
                                    <li>Notification Service</li>
                                    <li>API Gateway</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h3 class="mt-5 mb-4"><i class="fas fa-star me-2"></i> Student Success Stories</h3>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Student">
                                <h5>Rahul Sharma</h5>
                                <p class="text-muted">Placed at TCS (₹5.5 LPA)</p>
                                <p>"The mock interviews prepared me perfectly for actual TCS technical rounds."</p>
                            </div>
                        </div>
                    </div>
                    <!-- More testimonials... -->
                </div>
            </div>
        </div>
    </div>

    <!-- Enrollment Modal -->
    <div class="modal fade" id="enrollModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enroll in Java Spring Boot Mastery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="enrollmentForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">WhatsApp Number</label>
                            <input type="tel" class="form-control" id="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="college" class="form-label">College/University</label>
                            <input type="text" class="form-control" id="college" required>
                        </div>
                        <div class="mb-3">
                            <label for="gradYear" class="form-label">Graduation Year</label>
                            <select class="form-select" id="gradYear" required>
                                <option value="">Select Year</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                            </select>
                        </div>
                        <button type="submit" class="btn apply-btn w-100">
                            <i class="fas fa-paper-plane me-2"></i> Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple form submission handler
        document.getElementById('enrollmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your application! We will contact you shortly.');
            var modal = bootstrap.Modal.getInstance(document.getElementById('enrollModal'));
            modal.hide();
        });

        // You would add more JavaScript here to load dynamic content
    </script>
</body>
</html>