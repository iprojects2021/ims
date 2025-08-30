



<!DOCTYPE html>


<html lang="en">
<head><link rel="shortcut icon" href="favico.png" type="image/x-icon" />
  <meta charset="UTF-8">
  <title>Program Payment | INDSAC SOFTECH</title>
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      background-color: #fff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .logo {
      font-weight: bold;
      font-size: 24px;
      color: rgb(43, 40, 188);
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    .nav-links li a {
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }

    .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-top: 30px;
        }
        .form-title {
            color: #0d6efd;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-submit {
            width: 100%;
            padding: 10px;
            font-weight: bold;
        }

    /* Footer */
    .footer {
      background-color: #222;
      color: #fff;
      padding: 40px 20px;
      margin-top: 40px;
    }

    .footer-content {
      max-width: 1200px;
      margin: auto;
    }

    .footer-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .footer-col ul {
      list-style: none;
    }

    .footer-col ul li {
      margin-bottom: 10px;
    }

    .footer-col ul li a {
      color: #ccc;
      text-decoration: none;
    }

    .footer-col ul li a:hover {
      text-decoration: underline;
    }

    .footer-bottom-row {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 30px;
    }

    .app-badges img {
      width: 140px;
      margin: 0 10px;
    }

    .social-icons {
      display: flex;
      gap: 15px;
    }

    .social-icons a {
      color: white;
      font-size: 20px;
      text-decoration: none;
    }

    .footer-underline {
      border-top: 1px solid #444;
      margin: 20px 0;
    }

    .footer-copyright {
      text-align: center;
      font-size: 14px;
      color: #aaa;
    }

    @media screen and (max-width: 768px) {
      .hero {
        background-size: cover;
        height: auto;
        padding: 30px 0;
      }

      .footer-row {
        flex-direction: column;
        gap: 20px;
      }

      .footer-bottom-row {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

  <!-- ✅ Navbar -->
  <nav class="navbar">
    <div class="logo">INDSAC SOFTECH</div>
    <ul class="nav-links">
      <li><a href="">Home</a></li>
      <li><a href="student/register.php">Register</a></li>
      <li><a href="student/login.php">Login</a></li>
    </ul>
  </nav>
   <div class="container">
    <br>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS - Payment Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --danger: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

      
       
        .header {
            background: var(--primary);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            font-size: 2rem;
        }

        .logo h1 {
            font-size: 1.8rem;
        }

        .nav {
            display: flex;
            gap: 20px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
        }

        .payment-details {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            background: white;
        }

        .payment-summary {
            flex: 1;
            min-width: 300px;
            padding: 30px;
            background: #f9fafc;
            border-left: 1px solid #e2e8f0;
        }

        h2 {
            color: var(--dark);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: var(--primary);
            outline: none;
        }

        .row {
            display: flex;
            gap: 15px;
        }

        .row .form-group {
            flex: 1;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .summary-item p {
            color: var(--gray);
        }

        .summary-item .value {
            font-weight: 600;
            color: var(--dark);
        }

        .total {
            display: flex;
            justify-content: space-between;
            margin: 25px 0;
            padding: 15px;
            background: var(--light);
            border-radius: 8px;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .payment-methods {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .payment-method {
            flex: 1;
            text-align: center;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-method:hover {
            border-color: var(--primary);
        }

        .payment-method.selected {
            border-color: var(--primary);
            background: rgba(67, 97, 238, 0.1);
        }

        .payment-method i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .btn {
            display: block;
            width: 100%;
            background: var(--primary);
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: var(--secondary);
        }

        .secure {
            text-align: center;
            margin-top: 20px;
            color: var(--gray);
            font-size: 0.9rem;
        }

        .secure i {
            color: var(--success);
            margin-right: 5px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: var(--gray);
            font-size: 0.9rem;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }
            
            .payment-summary {
                border-left: none;
                border-top: 1px solid #e2e8f0;
            }
            
            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .nav {
                justify-content: center;
            }
            
            .row {
                flex-direction: column;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .payment-methods {
                flex-direction: column;
            }
            
            .logo h1 {
                font-size: 1.5rem;
            }
            
            h2 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="content">
            <div class="payment-details">
                <h2>Program Details</h2>
                
                <form id="payment-form">
                    <div class="form-group">
                        <label for="card-name">Name</label>
                        <input type="text" id="card-name" placeholder="Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="card-number">Email</label>
                        <input type="text" id="card-number" placeholder="Email" required>
                    </div>
                    
                    
                    
                    <div class="form-group">
                        <label for="billing-address">Mobile</label>
                        <input type="text" id="billing-address" placeholder="Mobile" required>
                    </div>
                      <div class="row">
                        <div class="form-group">
                            <label for="city">Program</label>
                            <input type="text" id="city" placeholder="Program" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="zip">Duration</label>
                            <input type="text" id="zip" placeholder="Duration" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="expiry">Program Start Date</label>
                            <input type="text" id="expiry" placeholder="MM/YY" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="cvv">College Passing Month</label>
                            <input type="text" id="expiry" placeholder="MM/YY" required>
                        </div>
                    </div>
                  
                    
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" required>
                            <option value="">Select Country</option>
                            <option value="usa">United States</option>
                            <option value="uk">United Kingdom</option>
                            <option value="canada">Canada</option>
                            <option value="australia">Australia</option>
                            <option value="india">India</option>
                        </select>
                    </div>
                </form>
            </div>
            
            <div class="payment-summary">
                <h2>Program Summary</h2>
                
                <div class="summary-item">
                    <p>Program Amount</p>
                    <p class="value">₹3000.00</p>
                </div>
                
                
                                
                <div class="total">
                    <p>Total</p>
                    <p>₹3000.00</p>
                </div>
                
                <h2>Payment Method Available</h2>
                
                <div class="payment-methods">
                    <div class="payment-method">
                        <i class="fas fa-credit-card"></i>
                        <p>Credit Card</p>
                    </div>
                    
                    <div class="payment-method">
                        <i class="fab fa-paypal"></i>
                        <p>PayPal</p>
                    </div>
                    
                    <div class="payment-method">
                        <i class="fas fa-university"></i>
                        <p>Bank Transfer</p>
                    </div>
                </div>
                <form><script src="https://checkout.razorpay.com/v1/payment-button.js" data-payment_button_id="pl_RBcBgFQx5N2HsF" async> </script> </form>

               
                <div class="secure">
                    <p><i class="fas fa-lock"></i> Your payment is secure and encrypted</p>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>© 2023 Inventory Management System. All rights reserved.</p>
            <p>Need help? Contact support at support@ims.com or call +1 (800) 123-4567</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method selection
            const paymentMethods = document.querySelectorAll('.payment-method');
            
            paymentMethods.forEach(method => {
                method.addEventListener('click', function() {
                    paymentMethods.forEach(m => m.classList.remove('selected'));
                    this.classList.add('selected');
                });
            });
            
            // Format card number input
            const cardNumberInput = document.getElementById('card-number');
            
            cardNumberInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 16) value = value.slice(0, 16);
                
                // Format with spaces every 4 characters
                let formattedValue = '';
                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) formattedValue += ' ';
                    formattedValue += value[i];
                }
                
                this.value = formattedValue;
            });
            
            // Format expiry date input
            const expiryInput = document.getElementById('expiry');
            
            expiryInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 4) value = value.slice(0, 4);
                
                if (value.length > 2) {
                    this.value = value.slice(0, 2) + '/' + value.slice(2);
                } else {
                    this.value = value;
                }
            });
            
            // Form submission
            const paymentForm = document.getElementById('payment-form');
            
            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // In a real application, you would process the payment here
                alert('Payment processed successfully!');
                
                // You would typically redirect to a success page here
                // window.location.href = "/payment-success.html";
            });
        });
    </script>
</body>
</html>
</div>

    <!-- Bootstrap 5 JS (Optional, for form validation) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Form Submission Handling (Example) -->
    <!--<script>
        document.gemobileementById('projectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Enquiry submitted successfully! We will contact you soon.');
            // You can add AJAX/fetch() here to send data to a server
        });
    </script>-->


  <!-- 🔻 Footer -->
  <div class="footer">
    <div class="footer-content">
      <div class="footer-row">
        <div class="footer-col">
          <ul>
            <li><a href="#">About us</a></li>
            <li><a href="#">We're hiring</a></li>
            <li><a href="referralworkflow.php">Referral Program</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <ul>
            <li><a href="#">Team Diary</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Our Services</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <ul>
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Contact us</a></li>
          </ul>
        </div>
      </div>

      <!-- Bottom -->
      <div class="footer-bottom-row">
        <div class="app-badges">
          <img src="assets/images/play-store.png" alt="Play Store">
          <img src="assets/images/app-store.png" alt="App Store">
        </div>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>

      <div class="footer-underline"></div>
      <p class="footer-copyright">
        © 2025 <a href="https://indsac.com" style="color: inherit; text-decoration: none;">INDSAC SOFTECH</a>
      </p>
    </div>
  </div>

</body>
</html>
