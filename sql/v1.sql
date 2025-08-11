ALTER TABLE users
ADD skills VARCHAR(100);
ALTER TABLE users
ADD image_path VARCHAR(100);
ALTER TABLE users
ADD experience VARCHAR(100);
CREATE TABLE enquiry (
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


