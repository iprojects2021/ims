ALTER TABLE users
ADD skills VARCHAR(100);
ALTER TABLE users
ADD image_path VARCHAR(100);
ALTER TABLE users
ADD experience VARCHAR(100);
CREATE TABLE application (
    id INT PRIMARY KEY,           
    mobile VARCHAR(15),           
    email VARCHAR(255),           
    project VARCHAR(255),         
    outcome VARCHAR(255),         
    expected_start_date DATE,     
    expected_due_date DATE,       
    type VARCHAR(50),             
    status VARCHAR(50),          
    notes TEXT                    
);
ALTER TABLE application
ADD COLUMN createddata TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE application
CHANGE COLUMN createddata createddate TIMESTAMP;

CREATE TABLE referrals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid INT,
    referred_email VARCHAR(150),
    referred_phone VARCHAR(20),
    status ENUM('Pending', 'Enrolled', 'Paid') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userid) REFERENCES users(id)
);
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    referralid INT,
    amount DECIMAL(10, 2),
    payment_date DATE,
    status ENUM('Pending', 'Completed', 'Failed'),
    FOREIGN KEY (referralid) REFERENCES referrals(id)
);
CREATE TABLE enrollments (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    referralid INT(11) DEFAULT NULL,
    program VARCHAR(100) DEFAULT NULL,
    enrollmentdate DATE DEFAULT NULL,
    fee_paid DECIMAL(10, 2) DEFAULT NULL,
    INDEX (referralid)
);
CREATE TABLE students ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, email VARCHAR(150) UNIQUE NOT NULL, phone VARCHAR(20), referral_code VARCHAR(10) UNIQUE NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP );





