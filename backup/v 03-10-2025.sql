CREATE TABLE evaluationfeedbackanswer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid INT NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    type VARCHAR(50), 
    questionid INT,
    answer TEXT,
    attendance_score INT,
    quality_score INT,
    technical_score INT,
    communication_score INT,
    initiative_score INT,
    teamwork_score INT,
    overall_score INT,
    comments TEXT,
    improvement_suggestions TEXT,
    createdat TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
