<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔥 Premium Coding Courses - Spring Boot & ReactJS</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        
        
        h2 {
            color: #3498db;
            font-size: 1.5rem;
            margin-bottom: 40px;
        }
        
        /* Pricing Plans */
        .pricing-plans {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            margin-top: 40px;
        }
        
        .plan {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 320px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .plan:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .plan.pro {
            border: 3px solid #e74c3c;
        }
        
        .plan.pro::before {
            content: "MOST POPULAR";
            position: absolute;
            top: 15px;
            right: -30px;
            background: #e74c3c;
            color: white;
            padding: 5px 30px;
            transform: rotate(45deg);
            font-size: 12px;
            font-weight: bold;
        }
        
        .plan h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .price {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        
        .price span {
            font-size: 16px;
            color: #7f8c8d;
        }
        
        .features {
            list-style: none;
            margin-bottom: 30px;
            text-align: left;
        }
        
        .features li {
            padding: 12px 0;
            border-bottom: 1px dashed #eee;
            display: flex;
            align-items: center;
        }
        
        .features li i {
            margin-right: 10px;
            color: #3498db;
            font-size: 18px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s;
            margin-top: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        
        .btn:hover {
            background: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(52, 152, 219, 0.4);
        }
        
        .pro .btn {
            background: #e74c3c;
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }
        
        .pro .btn:hover {
            background: #c0392b;
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.4);
        }
        
        /* Testimonials */
        .testimonials {
            margin-top: 60px;
            text-align: center;
        }
        
        .testimonial-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .testimonial-card i {
            color: #f39c12;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        /* Urgency Banner */
        .urgency-banner {
            background: #e74c3c;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            margin: 30px 0;
            font-weight: bold;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .pricing-plans {
                flex-direction: column;
                align-items: center;
            }
            
            .plan {
                width: 90%;
                margin-bottom: 30px;
            }
            
            .plan.pro::before {
                right: -25px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container" id="chooseplan">
        
       
        
        
        <h2>Choose Your Plan & Start Your Coding Journey Today!</h2>
        
        <!-- Urgency Banner -->
        <div class="urgency-banner">
            ⏳ Limited Seats! Enroll Now & Get 10% OFF (Use Code <strong>LEARN10</strong>)
        </div>
        
        <div class="pricing-plans" >
            <!-- Basic Plan -->
             <div class="plan">
                <h3><i class="fas fa-star"></i> Basic</h3>
                <div class="price">₹1,000 <span>/ 15 Days</span></div>
                <ul class="features">
                    <li><i class="fas fa-check"></i> Live Meetings</li>
                    <li><i class="fas fa-check"></i> Learning: Quick exposure Projects</li>
                    <li><i class="fas fa-check"></i> 2 hands-on projects</li>
                    <li><i class="fas fa-check"></i> Email support</li>
                    <li><i class="fas fa-check"></i> Certificate of completion</li>
                </ul>
                
                <button class="btn btn-light btn-lg apply-btn" onclick="applyNow('1,000/-','Basic','15 Days')">Apply Now</button>
                
            </div>
            <div class="plan">
                <h3><i class="fas fa-star"></i> Advanced</h3>
                <div class="price">₹2,000 <span>/ 1 Month</span></div>
                <ul class="features">
                    <li><i class="fas fa-check"></i> Self-paced video lectures</li>
                    <li><i class="fas fa-check"></i> Learning: Intensive Learning</li>
                    <li><i class="fas fa-check"></i> 2 hands-on projects</li>
                    <li><i class="fas fa-check"></i> Email support</li>
                    <li><i class="fas fa-check"></i> Certificate of completion</li>
                </ul>
                
                <button class="btn btn-light btn-lg apply-btn" onclick="applyNow('2,000/-','Advanced','1 Month')">Apply Now</button>
                
            </div>
            
            <!-- Premium Plan -->
            <div class="plan">
                <h3><i class="fas fa-rocket"></i> Professional</h3>
                <div class="price">₹5,000 <span>/ 3 months</span></div>
                <ul class="features">
                    
                    <li><i class="fas fa-check"></i> 5+ mentor-guided projects</li>
                    <li><i class="fas fa-check"></i> Learning: Structured Learning</li>
                    <li><i class="fas fa-check"></i> 24/7 doubt-solving</li>
                    <li><i class="fas fa-check"></i> Resume & LinkedIn review</li>
                    <li><i class="fas fa-check"></i> Job assistance</li>
                </ul>
                <button class="btn btn-light btn-lg apply-btn" onclick="applyNow('5,000/-','Professional','3 Months')">Apply Now</button>
            </div>
            
            <!-- Pro Plan (Most Popular) -->
            <div class="plan pro">
                <h3><i class="fas fa-crown"></i> Elite</h3>
                <div class="price">₹8,000 <span>/ 6 months</span></div>
                <ul class="features">
                    <li><i class="fas fa-check"></i> 1:1 mentorship</li>
                    <li><i class="fas fa-check"></i> Learning: Deep Learning</li>
                    <li><i class="fas fa-check"></i> Real-world industry projects</li>
                    
                    <li><i class="fas fa-check"></i> Real Time AI Project</li>
                    <li><i class="fas fa-check"></i> Placement assistance</li>
                </ul>
                <button class="btn btn-light btn-lg apply-btn" onclick="applyNow('8000/-','Elite','6 Months')">Apply Now</button>
                
            </div>
        </div>
        
        <!-- Testimonials -->
        <div class="testimonials">
            <h2>💡 What Our Students Say</h2>
            <div class="testimonial-card">
                <i class="fas fa-quote-left"></i>
                <p>"This course transformed my career! I landed a ₹12 LPA job after completing the Pro plan. The mentorship was exceptional!"</p>
                <p><strong>- Rahul K., Full-Stack Developer</strong></p>
            </div>
        </div>
    </div>
</body>
</html>