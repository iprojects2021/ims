CREATE TABLE ticket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    studentid INT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status VARCHAR(50) DEFAULT 'Open',
    assignedto INT DEFAULT NULL,
    filename VARCHAR(255),
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    createdby INT NOT NULL
);
CREATE TABLE TicketComment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ticketid INT NOT NULL,
    message TEXT,
    filename VARCHAR(255),
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    createdby VARCHAR(100)
);
CREATE TABLE ticketstatushistory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticketid INT NOT NULL,
    changed_by INT NOT NULL,
    previous_status VARCHAR(50) NOT NULL,
    new_status VARCHAR(50) NOT NULL,
    comment TEXT,
    changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (ticket_id) REFERENCES ticket(id),
    FOREIGN KEY (changed_by) REFERENCES users(id)  
);
<<<<<<< HEAD
ALTER TABLE users
ADD COLUMN referredby INT,       
ADD COLUMN refercode VARCHAR(50);  

ALTER TABLE users
MODIFY COLUMN referredby VARCHAR(50);

=======
CREATE TABLE documents (
    id INT(11) NOT NULL AUTO_INCREMENT,
    education_level VARCHAR(50) DEFAULT NULL,
    file_path VARCHAR(255) DEFAULT NULL,
    remark TEXT DEFAULT NULL,
    uploaded_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    studentid INT(11) NOT NULL,
    status VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);
>>>>>>> main
CREATE TABLE PaymentVerification (
    PaymentVerificationID INT PRIMARY KEY AUTO_INCREMENT,  -- Assuming this is the unique ID for verification records
    UserID INT NOT NULL,
    PaymentID VARCHAR(50) NOT NULL,
    BankRRN VARCHAR(50),
    OrderID VARCHAR(50),
    InvoiceID VARCHAR(50),
    PaymentMethod VARCHAR(50),
    Email VARCHAR(100),
    Phone VARCHAR(20),
    AmountPaid DECIMAL(15, 2),
    Status VARCHAR(50),
    Notes TEXT,
    Refund DECIMAL(15, 2) DEFAULT 0,
    VerifiedBy VARCHAR(100),
    VerificationStatus VARCHAR(50),
    CreateDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    VerificationDate DATETIME,
    VerifyNotes TEXT
);
CREATE TABLE userattendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid INT,
    logintime DATETIME,
    logouttime DATETIME,
    notes TEXT,
    createdat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userid) REFERENCES users(id)  -- Assuming there is a 'users' table with 'id' as primary key
);
CREATE TABLE userhourlytracker (
    it INT PRIMARY KEY,
    userid INT,
    start_time VARCHAR(255),
    end_time VARCHAR(255),
    notes TEXT,
    createdat TIMESTAMP,
    FOREIGN KEY (userid) REFERENCES users(id)  -- assuming there's a "users" table with a "userid" field
);
CREATE TABLE userdaytracker (
    it INT PRIMARY KEY,
    userid INT,
    notes TEXT,
    createdat TIMESTAMP,
    FOREIGN KEY (userid) REFERENCES users(id) -- Assuming there is a 'users' table with 'userid' as its PK
);
ALTER TABLE application
ADD COLUMN program_id INT;

ALTER TABLE paymentverification 
ADD COLUMN program_id INT;

CREATE TABLE notification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(22) NOT NULL  ,
    menu_item VARCHAR(255) NOT NULL,  -- e.g., 'tickets', 'reports','application','program','payment'
    isread BOOLEAN DEFAULT FALSE,
    message TEXT,
    createdBy INT,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP
   
);

CREATE TABLE task (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    studentid INT(11) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE,
    status VARCHAR(50),
    mentor_feedback TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE taskcommit (
    id INT(11) NOT NULL AUTO_INCREMENT,
    taskid INT(11) NOT NULL,
    message TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    createdby VARCHAR(100),
    PRIMARY KEY (id)
);
CREATE TABLE taskstatushistory (
    id INT(11) NOT NULL AUTO_INCREMENT,
    taskid INT(11) NOT NULL,
    changed_by INT(11) NOT NULL,
    previous_status VARCHAR(50) NOT NULL,
    new_status VARCHAR(50) NOT NULL,
    comment TEXT,
    changed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_taskid (taskid),
    INDEX idx_changed_by (changed_by)
);
