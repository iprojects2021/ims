CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid INT NOT NULL,
    question VARCHAR(1000) NOT NULL,
    questiontype VARCHAR(100) NOT NULL,
    category VARCHAR(100),
    ans1 VARCHAR(500),
    ans2 VARCHAR(500),
    ans3 VARCHAR(500),
    ans4 VARCHAR(500),
    textans VARCHAR(1000),
    status VARCHAR(50) DEFAULT 'active',
    createdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
