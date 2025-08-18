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
