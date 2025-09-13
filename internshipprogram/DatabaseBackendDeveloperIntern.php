
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Program Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <h1 id="program-title">Database Backend Development Internship</h1>
                    <p class="lead" id="program-short-desc">3-month remote internship to build real Database Backend projects with mentorship</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="d-flex flex-column">
                        <span class="mb-2"><i class="fas fa-calendar-alt me-2"></i> <span id="program-duration">3 months</span></span>
                        <span class="mb-2"><i class="fas fa-play-circle me-2"></i> Starts: <span id="program-start-date">July 15, 2024</span></span>
                        <span class="mb-2"><i class="fas fa-money-bill-wave me-2"></i> Stipend: <span id="program-stipend">₹10,000/month</span></span>
                        <button class="btn btn-light mt-2 apply-btn" onclick="applyNow('₹ 8000/-','Elite','6 Months')">Apply Now</button>
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
                            <p>This internship focuses on designing, developing, and managing robust backend systems with strong database integration. Interns will gain hands-on experience in SQL/NoSQL databases, backend API development, query optimization, and data modeling. The program covers building RESTful APIs using Java/Spring Boot, integrating relational databases like MySQL/PostgreSQL, and ensuring performance, scalability, and security of backend systems.</p>
                            <p>You'll work directly with senior developers, participate in code reviews, and build portfolio-worthy projects that solve actual business problems.</p>
                        </div>

                        <h3 class="mt-5 mb-4">What You'll Do</h3>
                        <div id="responsibilities-list">
                            <div class="responsibility-item">
                                <h5><i class="fas fa-code me-2"></i> Develop and maintain Java-based applications.</h5>
                                <p>Build scalable backend systems using modern Java practices.</p>
                            </div>
                            <div class="responsibility-item">
                                <h5><i class="fas fa-bug me-2"></i> Debug and optimize existing Java applications.</h5>
                                <p>Learn to identify performance bottlenecks and security issues..</p>
                            </div>
                            <div class="responsibility-item">
                                <h5><i class="fas fa-database me-2"></i> Integrate MySQL databases with Core Java applications.</h5>
                                <p>Design database schemas and integrate with Java using JDBC.</p>
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
                                        <span>Basic Java + Spring Boot knowledge</span>
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

                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-clock me-2"></i> Application Deadline</h5>
                            </div>
                            <div class="card-body text-center">
                                <h4 id="program-deadline">Nov 03, 2025</h4>
                                <div class="progress mt-3">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 65%">65% seats filled</div>
                                </div>
                                <button class="btn apply-btn w-100 mt-3" onclick="applyNow('₹ 8000/-','Elite','6 Months')">
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
                                <h5>Database Fundamentals</h5>
                                <p>Understand relational database concepts, normalization, indexing, and query optimization.</p>
                            </div>
                            <div class="outcome-item mb-3">
                                <h5>Database Design & Modeling</h5>
                                <p>Design efficient database schemas, relationships, and entity-relationship models for real-world applications.</p>
                            </div>
                            <div class="outcome-item mb-3">
                                <h5>SQL & Advanced Queries</h5>
                                <p>Write complex SQL queries, stored procedures, joins, and transactions for backend systems.</p>
                            </div>
                            <div class="outcome-item mb-3">
                                <h5>Java Database Integration</h5>
                                <p>Integrate relational databases (MySQL/PostgreSQL) with Java applications using JDBC and JPA/Hibernate.</p>
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
                                <h5 class="card-title"> Campus Placement Management System </h5>
                                <h6 class="card-subtitle mb-2 text-muted">Spring Boot, MySQL</h6>
                                <p class="card-text">Backend application to manage campus recruitment drives.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Store student profiles, company details, and placement status.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Implement eligibility filters and job application tracking.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Generate placement statistics and reports for admins.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="https://via.placeholder.com/600x400?text=API+Migration" class="card-img-top" alt="Project Screenshot">
                            <div class="card-body">
                                <h5 class="card-title"> Inventory & Billing System </h5>
                                <h6 class="card-subtitle mb-2 text-muted">Spring Boot, Hibernate, MySQL</h6>
                                <p class="card-text">Develop a backend system for small businesses to track inventory and manage billing.</p>
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Maintain product stock, sales, and purchase records.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Generate invoices and transaction history.</li>
                                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> Implement low-stock alerts and daily/weekly sales reports.</li>
                                    
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
                    <h5 class="modal-title">Apply for <span id="modal-program-title">Database Backend Development Internship</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Plan details section -->
                    <form id="applicationForm" action="../programpayment.php" method="post">
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
                title: "Database Backend Development Internship",
                shortDesc: "3-month remote internship to build real Database Backend projects with mentorship",
                description: "This internship focuses on designing, developing, and managing robust backend systems with strong database integration. Interns will gain hands-on experience in SQL/NoSQL databases, backend API development, query optimization, and data modeling. The program covers building RESTful APIs using Java/Spring Boot, integrating relational databases like MySQL/PostgreSQL, and ensuring performance, scalability, and security of backend systems.\n\nYou'll work directly with senior developers, participate in code reviews, and build portfolio-worthy projects that solve actual business problems.",
                duration: "1 - 6 months",
                startDate: "Nov 7, 2025",
                stipend: "₹3000/- to ₹8000/-",
                format: "Remote",
                deadline: "Nov 3, 2025",
                responsibilities: [
                    { title: "Develop and maintain backend applications using Java and Spring Boot.", desc: "Build scalable and secure RESTful APIs for data-driven applications." },
                    { title: "Integrate MySQL/PostgreSQL databases with Java applications using JDBC/JPA.", desc: "Design and optimize database schemas, queries, and stored procedures." },
                    { title: "Debug and optimize backend code to improve performance and efficiency.", desc: "Learn to identify and fix database performance bottlenecks and security issues." }
                ],
                schedule: [
                    { time: "9:30 AM", activity: "Daily standup call with team" },
                    { time: "10 AM - 12 PM", activity: "Project development time" },
                    { time: "2 PM - 3 PM", activity: "Mentor session/code review" }
                ],
                outcomes: [
                    { title: "Database Fundamentals", desc: "Understand relational database concepts, normalization, indexing, and query optimization. " },
                    { title: "Database Design & Modeling", desc: "Design efficient database schemas, relationships, and entity-relationship models for real-world applications." },
                    { title: "SQL & Advanced Queries", desc: "Write complex SQL queries, stored procedures, joins, and transactions for backend systems." },
                    { title: "Java Database Integration", desc: "Integrate relational databases (MySQL/PostgreSQL) with Java applications using JDBC and JPA/Hibernate." }
                ],
                projects: [
                    { 
                        title: "Campus Placement Management System", 
                        tech: "Spring Boot, MySQL", 
                        desc: "Backend application to manage campus recruitment drives.",
                        features: [
                            "Store student profiles, company details, and placement status.",
                            "Implement eligibility filters and job application tracking.",
                            "Generate placement statistics and reports for admins."
                        ]
                    },
                    { 
                        title: "Smart Inventory & Billing System", 
                        tech: "Spring Boot, Hibernate, MySQL", 
                        desc: "Develop a backend system for small businesses to track inventory and manage billing.",
                        features: [
                             "Maintain product stock, sales, and purchase records.",
                            "Generate invoices and transaction history.",
                            "Implement real-time stock management and purchase order workflows. "
                            
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

        function applyNow(amount, planType, duration) {
    // Set the values in the modal text
    document.getElementById('modal-program-title').textContent = planType;
    document.getElementById('modal-plan-type').textContent = planType;
    document.getElementById('modal-amount').textContent = amount;
    document.getElementById('modal-duration').textContent = duration;

    // Also update the hidden input values (for form submission)
    document.getElementById('hidden-plan-type').value = planType;
    document.getElementById('hidden-amount').value = amount;
    document.getElementById('hidden-duration').value = duration;

    // Show the modal
    const applicationModal = new bootstrap.Modal(document.getElementById('applicationModal'));
    applicationModal.show();
}

       

        // Load program data when page loads
        window.addEventListener('DOMContentLoaded', loadProgramData);
    </script>
    
</body>
</html>