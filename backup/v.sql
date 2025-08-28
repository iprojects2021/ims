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
