CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    subject VARCHAR(255) NOT NULL,
    type ENUM('Встреча', 'Звонок', 'Совещание', 'Дело') NOT NULL,
    location VARCHAR(255),
    datetime DATETIME NOT NULL,
    duration INT,
    comment TEXT,
    status bit(1) NOT NULL DEFAULT b'0'
);