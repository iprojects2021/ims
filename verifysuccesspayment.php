<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - Transaction Verification</title>
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

        body {
            background: linear-gradient(135deg, #f5f7fb 0%, #e3e6f0 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            width: 100%;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: var(--primary);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .success-alert {
            background: rgba(76, 201, 240, 0.1);
            border-left: 4px solid var(--success);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .success-alert i {
            font-size: 2rem;
            color: var(--success);
        }

        .transaction-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-card {
            background: var(--light);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .detail-card h3 {
            color: var(--gray);
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .detail-card p {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .amount {
            color: var(--success) !important;
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

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
        }

        .form-group input:read-only {
            background-color: #f8f9fa;
            color: var(--gray);
        }

        .instructions {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
        }

        .instructions h3 {
            margin-bottom: 15px;
            color: var(--dark);
        }

        .instructions ol {
            padding-left: 20px;
        }

        .instructions li {
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
        }

        .btn:hover {
            background: var(--secondary);
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: var(--gray);
            font-size: 0.9rem;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .transaction-details {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 1.8rem;
            }
            
            .header {
                padding: 20px;
            }
            
            .content {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            .detail-card p {
                font-size: 1.2rem;
            }
            
            .btn {
                padding: 12px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Payment Successful!</h1>
            <p>Thank you for your purchase. Please verify your transaction details below.</p>
        </div>

        <div class="content">
            <div class="success-alert">
                <i class="fas fa-check-circle"></i>
                <div>
                    <h2>Your payment was processed successfully</h2>
                    <p>A transaction ID has been sent to your email address.</p>
                </div>
            </div>

            <div class="transaction-details">
                <div class="detail-card">
                    <h3>Transaction Amount</h3>
                    <p class="amount" id="amount-display">-</p>
                </div>
                <div class="detail-card">
                    <h3>Transaction Status</h3>
                    <p id="status-display">-</p>
                </div>
            </div>

            <form id="transaction-form">
                <div class="form-group">
                    <label for="transaction-id">Transaction ID (from your email)</label>
                    <input type="text" id="transaction-id" placeholder="Enter transaction ID sent to your email" required>
                </div>

                <div class="form-group">
                    <label for="transaction-amount">Transaction Amount</label>
                    <input type="text" id="transaction-amount" readonly>
                </div>

                <div class="form-group">
                    <label for="transaction-status">Transaction Status</label>
                    <input type="text" id="transaction-status" readonly>
                </div>

                <div class="instructions">
                    <h3>Next Steps:</h3>
                    <ol>
                        <li>Check your email for the transaction confirmation message</li>
                        <li>Locate the transaction ID in the email</li>
                        <li>Enter the transaction ID in the field above</li>
                        <li>Verify that the amount and status match your records</li>
                        <li>Click the submit button to complete the verification process</li>
                    </ol>
                </div>

                <button type="submit" class="btn">
                    <i class="fas fa-check-circle"></i> Verify Transaction
                </button>
            </form>
        </div>

        <div class="footer">
            <p>If you have any questions, please contact our support team at support@indsac.com</p>
            <p>© 2025 INDSAC SOFTECH. All rights reserved.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to get URL parameters
            function getUrlParams() {
                const params = {};
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                
                params.amount = urlParams.get('amount');
                params.transaction = urlParams.get('transaction');
                
                return params;
            }
            
            // Get parameters from URL
            const urlParams = getUrlParams();
            
            // Prefill form fields with URL parameters
            if (urlParams.amount) {
                const formattedAmount = '₹' + parseInt(urlParams.amount).toLocaleString('en-IN') + '.00';
                document.getElementById('amount-display').textContent = formattedAmount;
                document.getElementById('transaction-amount').value = formattedAmount;
            }
            
            if (urlParams.transaction) {
                const status = urlParams.transaction.charAt(0).toUpperCase() + urlParams.transaction.slice(1);
                document.getElementById('status-display').textContent = status;
                document.getElementById('transaction-status').value = status;
            }
            
            // Form submission handler
            document.getElementById('transaction-form').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const transactionId = document.getElementById('transaction-id').value;
                
                if (!transactionId) {
                    alert('Please enter your transaction ID');
                    return;
                }
                
                // In a real application, you would send this to your server for verification
                alert(`Transaction verified successfully!\nTransaction ID: ${transactionId}`);
                
                // You would typically redirect to a success page or dashboard here
                // window.location.href = "/success-verified.html";
            });
        });
    </script>
</body>
</html>