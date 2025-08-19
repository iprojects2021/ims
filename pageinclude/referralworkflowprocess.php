<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referral Workflow Visualization</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
       
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        h1 {
            font-size: 2.8rem;
            margin-bottom: 15px;
            font-weight: 700;
        }
        
        .description {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
            opacity: 0.9;
        }
        
        .workflow-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 50px;
        }
        
        .workflow-diagram {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 40px;
            position: relative;
        }
        
        .phase {
            background: white;
            border-radius: 12px;
            padding: 25px;
            width: 220px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            z-index: 2;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .phase:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }
        
        .phase-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .phase-1 .phase-icon { color: #6a11cb; }
        .phase-2 .phase-icon { color: #2575fc; }
        .phase-3 .phase-icon { color: #4cc9f0; }
        .phase-4 .phase-icon { color: #00c853; }
        .phase-5 .phase-icon { color: #ff9800; }
        
        .phase-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2d3436;
        }
        
        .phase-content {
            color: #636e72;
            font-size: 0.95rem;
        }
        
        .connector {
            position: absolute;
            top: 50%;
            width: 80px;
            height: 3px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            z-index: 1;
        }
        
        .connector-1 { left: 220px; }
        .connector-2 { left: 530px; }
        .connector-3 { left: 840px; }
        .connector-4 { left: 1150px; }
        
        .connector::after {
            content: "→";
            position: absolute;
            right: -12px;
            top: -12px;
            color: #2575fc;
            font-size: 20px;
            background: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .details-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 1.8rem;
            color: #2d3436;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
            text-align: center;
        }
        
        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .step {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            border-left: 4px solid #6a11cb;
        }
        
        .step-number {
            display: inline-block;
            background: #6a11cb;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            margin-right: 10px;
            font-weight: bold;
        }
        
        .step-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #2d3436;
        }
        
        .step-content {
            color: #636e72;
        }
        
        .simulation {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .simulation-controls {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        button {
            padding: 12px 25px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(38, 117, 252, 0.4);
        }
        
        .simulation-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        
        .simulation-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            display: none;
        }
        
        .simulation-card.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .card-content {
            color: #636e72;
            line-height: 1.6;
        }
        
        .card-content ul {
            padding-left: 20px;
            margin: 15px 0;
        }
        
        .card-content li {
            margin-bottom: 8px;
        }
        
        .highlight {
            background: #fff8e1;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        
       
        
        @media (max-width: 1200px) {
            .workflow-diagram {
                flex-direction: column;
                align-items: center;
            }
            
            .connector {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2.2rem;
            }
            
            .description {
                font-size: 1rem;
            }
            
            .phase {
                width: 100%;
                max-width: 300px;
            }
            
            .simulation-controls {
                flex-direction: column;
                align-items: center;
            }
            
            button {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
            
        }
         .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
        }
         @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
            }
            
            .cta-buttons {
                flex-direction: column;
            }
            
            h1 {
                font-size: 2.2rem;
            }
            
            .description {
                font-size: 1rem;
            }
        }
         .footer-cta {
            background: linear-gradient(135deg, #8537d8ff 0%, #a5b9f6ff 100%);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
        }
        
        .footer-cta h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .footer-cta p {
            margin-bottom: 20px;
            opacity: 0.9;
        }
         .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Referral Workflow Process</h1>
            <p class="description">From code generation to enrollment and payment - a complete visualization of the referral process</p>
        </header>
        
        <div class="workflow-container">
            <div class="workflow-diagram">
                <div class="phase phase-1">
                    <div class="phase-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3 class="phase-title">Code Generation</h3>
                    <p class="phase-content">Unique referral code is created for each student</p>
                </div>
                
                <div class="connector connector-1"></div>
                
                <div class="phase phase-2">
                    <div class="phase-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h3 class="phase-title">Sharing</h3>
                    <p class="phase-content">Student shares their referral code with friends</p>
                </div>
                
                <div class="connector connector-2"></div>
                
                <div class="phase phase-3">
                    <div class="phase-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3 class="phase-title">Registration</h3>
                    <p class="phase-content">Friend registers using the referral code</p>
                </div>
                
                <div class="connector connector-3"></div>
                
                <div class="phase phase-4">
                    <div class="phase-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="phase-title">Enrollment</h3>
                    <p class="phase-content">Friend enrolls in a program</p>
                </div>
                
                <div class="connector connector-4"></div>
                
                <div class="phase phase-5">
                    <div class="phase-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="phase-title">Payment</h3>
                    <p class="phase-content">Student receives referral reward</p>
                </div>
            </div>
        </div>
        
        <div class="details-section">
            <h2 class="section-title">Step-by-Step Process Details</h2>
            
            <div class="steps">
                <div class="step">
                    <h3 class="step-title"><span class="step-number">1</span>Code Generation</h3>
                    <p class="step-content">The system automatically generates a unique referral code for each student upon account creation. This code is typically a combination of letters and numbers, often including the student's name or initials for personalization.</p>
                </div>
                
                <div class="step">
                    <h3 class="step-title"><span class="step-number">2</span>Code Sharing</h3>
                    <p class="step-content">Students share their unique referral code through various channels: email, social media, direct messaging, or in-person. The system may provide shareable links or pre-formatted messages to make sharing easier.</p>
                </div>
                
                <div class="step">
                    <h3 class="step-title"><span class="step-number">3</span>Registration</h3>
                    <p class="step-content">When a friend uses the referral code during registration, the system records this connection. The referring student receives a notification that their code has been used.</p>
                </div>
                
                <div class="step">
                    <h3 class="step-title"><span class="step-number">4</span>Enrollment</h3>
                    <p class="step-content">The referred friend enrolls in a program. The system verifies the enrollment and updates the status of the referral from "pending" to "enrolled".</p>
                </div>
                
                <div class="step">
                    <h3 class="step-title"><span class="step-number">5</span>Verification</h3>
                    <p class="step-content">The system performs checks to ensure the enrollment is legitimate and meets all program requirements. This may include verifying payment or completion of necessary documentation.</p>
                </div>
                
                <div class="step">
                    <h3 class="step-title"><span class="step-number">6</span>Payment Processing</h3>
                    <p class="step-content">Once verified, the system processes the referral reward. The amount is calculated based on the program type and current referral incentives.</p>
                </div>
                
                <div class="step">
                    <h3 class="step-title"><span class="step-number">7</span>Reward Distribution</h3>
                    <p class="step-content">The reward is distributed to the student through their preferred payment method. This could be a direct bank transfer, digital wallet, or credit to their account.</p>
                </div>
                
                <div class="step">
                    <h3 class="step-title"><span class="step-number">8</span>Tracking & Analytics</h3>
                    <p class="step-content">Students can track their referrals, earnings, and performance through a dashboard. The system provides analytics on which referral methods are most effective.</p>
                </div>
            </div>
        </div>
        
        <div class="simulation">
            <h2 class="section-title">Interactive Workflow Simulation</h2>
            
            <div class="simulation-controls">
                <button onclick="showStep(1)"><i class="fas fa-play"></i> Start Simulation</button>
                <button onclick="showStep(2)"><i class="fas fa-share-alt"></i> Sharing Process</button>
                <button onclick="showStep(3)"><i class="fas fa-user-plus"></i> Registration</button>
                <button onclick="showStep(4)"><i class="fas fa-graduation-cap"></i> Enrollment</button>
                <button onclick="showStep(5)"><i class="fas fa-money-bill-wave"></i> Payment</button>
            </div>
            
            <div class="simulation-content">
                <div class="simulation-card" id="step1">
                    <h3 class="card-title">Code Generation Process</h3>
                    <div class="card-content">
                        <p>When a student account is created, the system automatically generates a unique referral code. This process involves:</p>
                        <ul>
                            <li>Combining student initials with a unique identifier</li>
                            <li>Ensuring the code is easy to remember and share</li>
                            <li>Checking database to guarantee uniqueness</li>
                            <li> Associating the code with the student's account</li>
                        </ul>
                        <div class="highlight">
                            <p><strong>Example:</strong> Student "John Smith" might receive code "JSMITH-5A2B" or a shorter variant like "JOHN25".</p>
                        </div>
                    </div>
                </div>
                
                <div class="simulation-card" id="step2">
                    <h3 class="card-title">Sharing Process</h3>
                    <div class="card-content">
                        <p>Students can share their referral codes through multiple channels:</p>
                        <ul>
                            <li><strong>Direct Link:</strong> A personalized URL that tracks clicks and registrations</li>
                            <li><strong>Email:</strong> Pre-formatted emails that students can send to friends</li>
                            <li><strong>Social Media:</strong> Easy sharing to platforms like Facebook, Twitter, and WhatsApp</li>
                            <li><strong>QR Code:</strong> Scannable code for in-person sharing</li>
                        </ul>
                        <div class="highlight">
                            <p><strong>Tip:</strong> The most successful referrals often come from personal messages rather than public posts.</p>
                        </div>
                    </div>
                </div>
                
                <div class="simulation-card" id="step3">
                    <h3 class="card-title">Registration Process</h3>
                    <div class="card-content">
                        <p>When a friend uses the referral code during registration:</p>
                        <ul>
                            <li>The system validates the code format and checks if it's active</li>
                            <li>It records the connection between the referrer and referee</li>
                            <li>The referring student receives a notification</li>
                            <li>The status is set to "Pending Enrollment"</li>
                        </ul>
                        <div class="highlight">
                            <p><strong>Note:</strong> Most programs require the referred friend to complete enrollment before the reward is granted.</p>
                        </div>
                    </div>
                </div>
                
                <div class="simulation-card" id="step4">
                    <h3 class="card-title">Enrollment Verification</h3>
                    <div class="card-content">
                        <p>Once the referred friend enrolls in a program:</p>
                        <ul>
                            <li>The system verifies the enrollment is complete</li>
                            <li>It checks if any minimum requirements are met (e.g., payment completed)</li>
                            <li>The status changes from "Pending" to "Enrolled"</li>
                            <li>The referring student receives another notification</li>
                        </ul>
                        <div class="highlight">
                            <p><strong>Important:</strong> Some programs have a cooling-off period during which enrollment can be canceled, delaying the reward.</p>
                        </div>
                    </div>
                </div>
                
                <div class="simulation-card" id="step5">
                    <h3 class="card-title">Payment Process</h3>
                    <div class="card-content">
                        <p>After successful enrollment verification:</p>
                        <ul>
                            <li>The system calculates the reward amount based on the program</li>
                            <li>It processes the payment through the student's preferred method</li>
                            <li>The status changes to "Paid"</li>
                            <li>Both students receive confirmation notifications</li>
                        </ul>
                        <div class="highlight">
                            <p><strong>Note:</strong> Payment processing times vary depending on the method chosen (e.g., bank transfers may take 3-5 business days).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
<div class="footer-container">
            <div class="footer-cta">
                <h3>Ready to Start Earning?</h3>
                <p>Join our referral program today and start earning rewards for sharing with friends</p>
                <div class="cta-buttons">
                     <button onclick="showStep(1)"><i class="fas fa-play"></i> Get Your Referral Code</button>
                    
                </div>
            </div>
        </div>
    <script>
        // Show specific step in simulation
        function showStep(stepNumber) {
            // Hide all cards first
            document.querySelectorAll('.simulation-card').forEach(card => {
                card.classList.remove('active');
            });
            
            // Show the selected card
            document.getElementById('step' + stepNumber).classList.add('active');
        }
        
        // Show the first step by default
        document.addEventListener('DOMContentLoaded', function() {
            showStep(1);
        });
    </script>
</body>
</html>