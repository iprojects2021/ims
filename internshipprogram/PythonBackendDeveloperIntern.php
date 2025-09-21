<?php
include("../includes/db.php");
$sql = "SELECT * FROM programs WHERE title='Python Backend Developer Intern' AND status='upcoming'";
$stmt = $db->query($sql); // $db is your PDO connection

if ($stmt) {
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows into an array
  // echo "<pre>"; print_r($rows);die;
    if (count($rows) > 0) {
        foreach ($rows as $row) {
        if($row['amount']==='1000')
        {
            $programidbasic1000=$row['program_id'];
         }
         else if($row['amount']==='2000')
         {
            $programidadvance2000=$row['program_id'];
       
         } 
         else if($row['amount']==='5000')
         {
            $programidprofessional5000=$row['program_id'];
       
          }
         else if($row['amount']==='8000')
         {
            $programidelite8000=$row['program_id'];
       
         }
        }
    } else {
        echo "No results found";
    }
} else {
    echo "Query failed.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Program Details</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .program-hero {
            background: linear-gradient(135deg, #6e48aa 0%, #9d50bb 100%);
            color: white;
            border-radius: 10px;
        }
        .responsibility-item, .outcome-item {
            border-left: 3px solid #6e48aa;
            padding-left: 15px;
            margin-bottom: 10px;
        }
        .schedule-timeline {
            position: relative;
            padding-left: 30px;
        }
        .schedule-timeline::before {
            content: "";
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #6e48aa;
        }
        .schedule-item {
            position: relative;
            margin-bottom: 20px;
        }
        .schedule-item::before {
            content: "";
            position: absolute;
            left: -30px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #9d50bb;
            border: 2px solid white;
        }
        .apply-btn {
            background: #6e48aa;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
        }
        .apply-btn:hover {
            background: #9d50bb;
        }
        .nav-tabs .nav-link.active {
            color: #6e48aa;
            font-weight: bold;
            border-bottom: 3px solid #6e48aa;
        }
        .nav-tabs .nav-link {
            color: #495057;
        }
        .plan-details {
            background-color: #f0f5ff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .modal-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .plan-details h6 {
            color: #2575fc;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Program Header -->
        <div class="program-hero p-4 mb-4">
            <div class="row">
                <div class="col-md-8">
                    <h1 id="program-title">Python Backend Development Inrernship</h1>
                    <p class="lead" id="program-short-desc">1-6 months remote internship to build real Python Backend projects with mentorship</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="d-flex flex-column">
                        <span class="mb-2"><i class="fas fa-calendar-alt me-2"></i> <span id="program-duration">15 days to 6 months</span></span>
                        <span class="mb-2"><i class="fas fa-play-circle me-2"></i> Starts: <span id="program-start-date1"><?php echo htmlspecialchars($row['start_date']); ?></span></span>
                        <span class="mb-2"><i class="fas fa-money-bill-wave me-2"></i>Amount: <span id="program-stipend">₹1000 to ₹8000</span></span>
                        
                        <button class="btn btn-light mt-2 apply-btn" onclick="applyNow('₹ 8000/-','Elite','6 Months',<?php echo $programidelite8000 ?>)">Apply Now</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Program Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" id="programTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Overview</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab">Curriculum</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="projects-tab" data-bs-toggle="tab" data-bs-target="#projects" type="button" role="tab">Projects</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab">FAQ</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="programTabsContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="mb-4">About the Program</h3>
                        <div id="program-description">
                            <p>Gain hands-on experience in developing and maintaining backend systems using Python, Django, and REST APIs. Work with relational databases like MySQL/PostgreSQL, implement authentication and security, and optimize application performance. Learn to debug, test, and deploy APIs, while collaborating on real-world full-stack projects.</p>
                            <p>You'll work directly with senior developers, participate in code reviews, and build portfolio-worthy projects that solve actual business problems.</p>
            
                        </div>

                        <h3 class="mt-5 mb-4">What You'll Do</h3>
                        <div id="responsibilities-list">
                            <div class="responsibility-item">
                                <h5><i class="fas fa-code me-2"></i> Develop and maintain web applications using Python frameworks such as Django.</h5>
                                <p>Build scalable and efficient backend systems following modern Python practices.</p>
                            </div>
                            <div class="responsibility-item">
                                <h5><i class="fas fa-bug me-2"></i> Debug and optimize Python backend applications for better performance and reliability.</h5>
                                <p>Gain hands-on experience in building secure, reliable, and production-ready REST APIs.</p>
                            </div>
                            <div class="responsibility-item">
                                <h5><i class="fas fa-database me-2"></i>Integrate and manage MySQL/PostgreSQL databases with ORM tools.</h5>
                                <p>Design optimized database schemas and implement CRUD operations.</p>
                            </div>
                            <div class="responsibility-item">
                                <h5><i class="fas fa-users me-2"></i> Team Collaboration (Daily Scrum Meeting).</h5>
                                <p>Use Git/GitHub for version control. Work in a simulated Agile team environment.</p>
                            </div>
                        </div>

                        <h3 class="mt-5 mb-4">Daily Schedule</h3>
                        <div class="schedule-timeline" id="schedule-list">
                            <div class="schedule-item">
                                <h5>9:30 AM - Daily Standup</h5>
                                <p>15-minute team sync to plan the day's work</p>
                            </div>
                            <div class="schedule-item">
                                <h5>10 AM - 12 PM - Project Development</h5>
                                <p>Focused coding time with mentor support</p>
                            </div>
                            <div class="schedule-item">
                                <h5>2 PM - 3 PM - Mentor Session</h5>
                                <p>Deep dive into technical concepts and code reviews</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Quick Facts</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-laptop me-2"></i> Format</span>
                                        <span class="badge bg-primary rounded-pill" id="program-format">Remote</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-users me-2"></i> Cohort Size</span>
                                        <span class="badge bg-primary rounded-pill">20 interns</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-hourglass-start me-2"></i> Hours/Week</span>
                                        <span class="badge bg-primary rounded-pill">25-30</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-graduation-cap me-2"></i> Certificate</span>
                                        <span class="badge bg-success rounded-pill">Yes</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-clock me-2"></i> Work Time</span>
                                        <span class="badge bg-success rounded-pill">Flexible working time</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i> Eligibility</h5>
                            </div>
                            <div class="card-body">
                                <div id="eligibility-list">
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Basic Python knowledge</span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Familiarity with Git version control</span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Personal laptop with VS Code installed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i> Exciting Rewards</h5>
                            </div>
                            <div class="card-body">
                                <div id="eligibility-list">
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Certificates of Excellence</span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Gift Vouchers</span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Spotlight Feature</span>
                                    </div>
                                     <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Mentorship</span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Flexible Project Ownership</span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Swag & Goodies</span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Conference / Event Passes</span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Skill Badges</span>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <i class="fas fa-check text-success me-2 mt-1"></i>
                                        <span>Tech Gadgets (for top performers)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-clock me-2"></i> Application Deadline</h5>
                            </div>
                           <div class="card-body text-center">
                                
                                <div class="progress mt-3">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 65%">65% seats filled</div>
                                </div>
                                
                                <button class="btn apply-btn w-100 mt-3" onclick="applyNow('₹ 8000/-','Elite','6 Months',<?php echo $programidelite8000 ?>)">
                                    <i class="fas fa-paper-plane me-2"></i> Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Curriculum Tab -->
            <div class="tab-pane fade" id="curriculum" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mb-4"><i class="fas fa-graduation-cap me-2"></i> Learning Outcomes</h3>
                        <div id="outcomes-list">
                            <div class="outcome-item mb-3">
                                <h5>Python Backend Fundamentals</h5>
                                <p>Build production-ready backend applications quickly using Django.</p>
                            </div>
                            <div class="outcome-item mb-3">
                                <h5>REST API Development</h5>
                                <p>Develop scalable and reliable RESTful APIs with Django REST Framework or FastAPI.</p>
                            </div>
                            <div class="outcome-item mb-3">
                                <h5>Database Integration with ORM</h5>
                                <p>Design and manage databases and implement CRUD operations using Django ORM.</p>
                            </div>
                            <div class="outcome-item mb-3">
                                <h5>Security & Authentication</h5>
                                <p>Implement secure authentication and authorization in backend applications using JWT.</p>
                            </div>
                            <div class="outcome-item mb-3">
                                <h5>Ability to understand</h5>
                                <p>Monolith, Microservices, API, Refactoring, Technical Debt, Boilerplate Code, POC, Hotfix.</p>
                            </div>
                             <div class="outcome-item mb-3">
                                <h5>Expertise on</h5>
                                <p>Unit Test, End-to-End Test (E2E), Code Coverage, UAT (User Acceptance Testing), Sprint, Epic, Containerization, Monitoring & Observability.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-4"><i class="fas fa-chalkboard-teacher me-2"></i> Mentorship</h3>
                        <div class="card bg-light p-3 mb-3">
                            <div class="d-flex">
                                <i class="fas fa-user-tie text-primary me-3 fs-3"></i>
                                <div>
                                    <h5>1:1 Weekly Sessions</h5>
                                    <p class="mb-0">Personalized feedback and career guidance from senior developers</p>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light p-3 mb-3">
                            <div class="d-flex">
                                <i class="fas fa-code text-primary me-3 fs-3"></i>
                                <div>
                                    <h5>Code Reviews</h5>
                                    <p class="mb-0">Detailed feedback on your pull requests and architecture</p>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-light p-3">
                            <div class="d-flex">
                                <i class="fas fa-question-circle text-primary me-3 fs-3"></i>
                                <div>
                                    <h5>24/7 Support</h5>
                                    <p class="mb-0">Dedicated Slack channel for instant help</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Tab -->
            <div class="tab-pane fade" id="projects" role="tabpanel">
                <div class="row row-cols-1 row-cols-md-2 g-4" id="projects-list">
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="https://via.placeholder.com/600x400?text=Hotel+Booking+System" class="card-img-top" alt="Project Screenshot">
                            <div class="card-body">
                                <h5 class="card-title"> Fraud Detection API for Transactions </h5>
                                <h6 class="card-subtitle mb-2 text-muted">Django REST Framework, MySQL</h6>
                                <p class="card-text">Create an API that detects fraudulent transactions in real-time using pattern analysis.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Analyze transaction patterns to flag anomalies.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Store transaction data securely in MySQL.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Build REST endpoints for financial applications.</li>
                                     <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Implement role-based access for admins and auditors.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="https://via.placeholder.com/600x400?text=API+Migration" class="card-img-top" alt="Project Screenshot">
                            <div class="card-body">
                                <h5 class="card-title">Online Exam & Anti-Cheating Backend </h5>
                                <h6 class="card-subtitle mb-2 text-muted">Flask, PostgreSQL</h6>
                                <p class="card-text">Build a backend system for managing online exams with secure verification.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i>APIs for managing question banks and exam sessions.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Role-based access for students and instructors.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Integrate face/voice verification for anti-cheating.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Auto-grade exams and provide results through APIs.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Tab -->
            <div class="tab-pane fade" id="faq" role="tabpanel">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Is this internship remote?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, this is a fully remote position with flexible hours. All you need is a laptop and stable internet connection.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Can beginners apply?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! We accept motivated learners with basic programming knowledge. The first 2 weeks include intensive training to get everyone up to speed.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                What's the time commitment?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Expect to dedicate 25-30 hours per week. We schedule core hours for meetings but otherwise allow flexible timing.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Application Modal -->
    <div class="modal fade" id="applicationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apply for <span id="modal-program-title"> Python Backend Developer Internship</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Plan details section -->
                    <form id="applicationForm" action="../programpayment.php" method="post">
                    <input type="hidden" id="hidden-program_id" name="program_id" value="<?php echo htmlspecialchars($details[0]['program_id']); ?>" id="program_basic">
    <div class="plan-details">
        <h6>Program Details</h6>
        <div class="row">
            <div class="col-md-4">
                <p><strong>Program Type:</strong> <span id="modal-plan-type">Not specified</span></p>
                <input type="hidden" name="type" id="hidden-plan-type" value="">

            </div>
            <div class="col-md-4">
                <p><strong>Amount:</strong> <span id="modal-amount">0</span></p>
                <input type="hidden" name="amount" id="hidden-amount" value="">
            </div>
            <div class="col-md-4">
                <p><strong>Duration:</strong> <span id="modal-duration">0</span></p>
                <input type="hidden" name="duration" id="hidden-duration" value="">
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullname" required>
        </div>
        <div class="col-md-6">
            <label for="mobile" class="form-label">Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input class="form-control" type="email" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="expected_start_date" class="form-label">Expected Start Date</label>
        <input class="form-control" type="date" id="expected_start_date" name="expected_start_date" required>
    </div>
    <div class="mb-3">
        <label for="github" class="form-label">GitHub Profile (Optional)</label>
        <input type="url" class="form-control" id="github" name="github" >
    </div>
    <div class="mb-3">
        <label for="coverLetter" class="form-label">Why are you interested in this internship? (Max 300 words)</label>
        <textarea class="form-control" id="coverLetter" name="outcome" rows="4" required></textarea>
    </div>
    <div class="text-center">
        <button type="submit" class="btn apply-btn px-5">
            <i class="fas fa-paper-plane me-2"></i> Next
        </button>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // This would be replaced with actual data fetching from your backend
        function loadProgramData() {
            // In a real app, you would fetch this from your API
            const programData = {
                title: "Python Backend Development Internship",
                shortDesc: "1-6 months remote internship to build real Python Backend projects with mentorship",
                description: "Transform your academic knowledge into industry-ready skills with our flexible internship training program. Work on live projects with expert mentors.\n\n Gain hands-on experience in developing and maintaining backend systems using Python, Django, and REST APIs. Work with relational databases like MySQL/PostgreSQL, implement authentication and security, and optimize application performance. Learn to debug, test, and deploy APIs, while collaborating on real-world full-stack projects.\n\nYou'll work directly with senior developers, participate in code reviews, and build portfolio-worthy projects that solve actual business problems.",
                duration: "1 - 6 months",
                startDate: "Nov 7, 2025",
                stipend: "₹1000/- to ₹8000/-",
                format: "Remote",
                deadline: "Nov 3, 2025",
                responsibilities: [
                    { title: "Develop and maintain web applications using Python frameworks such as Django.", desc: "Build scalable and efficient backend systems following modern Python practices." },
                    { title: "Debug and optimize Python backend applications for better performance and reliability.", desc: "Gain hands-on experience in building secure, reliable, and production-ready REST APIs." },
                    { title: "Integrate and manage MySQL/PostgreSQL databases with ORM tools.", desc: "Design optimized database schemas and implement CRUD operations." }
                   
                ],
                schedule: [
                    { time: "9:30 AM", activity: "Daily standup call with team" },
                    { time: "10 AM - 12 PM", activity: "Project development time" },
                    { time: "2 PM - 3 PM", activity: "Mentor session/code review" }
                ],
                outcomes: [
                    { title: "Python Backend Fundamentals", desc: "Build production-ready backend applications quickly using Django." },
                    { title: "REST API Development", desc: "Develop scalable and reliable RESTful APIs with Django REST Framework or FastAPI." },
                    { title: "Database Integration with ORM ", desc: "Design and manage databases and implement CRUD operations using Django ORM." },
                     { title: "Security & Authentication", desc: "Implement secure authentication and authorization in backend applications using JWT." }
                ],
                projects: [
                    { 
                        title: "Fraud Detection API for Transactions", 
                        tech: "Django REST Framework, MySQL",
                        desc: "Create an API that detects fraudulent transactions in real-time using pattern analysis.",
                        features: [
                            "Analyze transaction patterns to flag anomalies.",
                            "Build REST endpoints for financial applications.",
                            "Store transaction data securely in MySQL.",
                            "Implement role-based access for admins and auditors."
                            
                        ]
                    },
                    { 
                        title: "Online Exam & Anti-Cheating Backend", 
                        tech: "Flask, PostgreSQL", 
                        desc: "Build a backend system for managing online exams with secure verification.",
                        features: [
                            "APIs for managing question banks and exam sessions.",
                            "Integrate face/voice verification for anti-cheating.",
                            "Auto-grade exams and provide results through APIs.",
                            "Role-based access for students and instructors."
                            
                        ]
                    }
                ],
                faqs: [
                    { question: "Is this internship remote?", answer: "Yes, this is a fully remote position with flexible hours. All you need is a laptop and stable internet connection." },
                    { question: "Can beginners apply?", answer: "Yes! We accept motivated learners with basic programming knowledge. The first 2 weeks include intensive training to get everyone up to speed." },
                    { question: "What's the time commitment?", answer: "Expect to dedicate 25-30 hours per week. We schedule core hours for meetings but otherwise allow flexible timing." }
                ]
            };

            // Populate the page with data
            document.getElementById('program-title').textContent = programData.title;
            document.getElementById('program-short-desc').textContent = programData.shortDesc;
            document.getElementById('program-description').innerHTML = programData.description.split('\n').map(p => `<p>${p}</p>`).join('');
            document.getElementById('program-duration').textContent = programData.duration;
            document.getElementById('program-start-date').textContent = programData.startDate;
            document.getElementById('program-stipend').textContent = programData.stipend;
            document.getElementById('program-format').textContent = programData.format;
            document.getElementById('program-deadline').textContent = programData.deadline;
            document.getElementById('modal-program-title').textContent = programData.title;

            // You would continue populating other sections similarly...
        }

        function applyNow(amount, planType, duration, programid) {
    // Set the values in the modal text
    document.getElementById('modal-program-title').textContent = planType;
    document.getElementById('modal-plan-type').textContent = planType;
    document.getElementById('modal-amount').textContent = amount;
    document.getElementById('modal-duration').textContent = duration;

    const numericAmount = amount.replace(/\D/g, '');

    // Also update the hidden input values (for form submission)
    document.getElementById('hidden-plan-type').value = planType;
    document.getElementById('hidden-amount').value = amount;
    document.getElementById('hidden-duration').value = duration;
    document.getElementById("hidden-program_id").value = programid;

    // Show the modal
    const applicationModal = new bootstrap.Modal(document.getElementById('applicationModal'));
    applicationModal.show();
}

       

        // Load program data when page loads
        window.addEventListener('DOMContentLoaded', loadProgramData);
    </script>
    
</body>
</html>