CREATE DATABASE IF NOT EXISTS manahil_interns CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE manahil_interns;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    start_time TIME NULL,
    end_time TIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    check_in_time DATETIME NULL,
    check_out_time DATETIME NULL,
    message TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_attendance_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_date (user_id, date)
);

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (email, password)
VALUES ('admin@manahil.com', '$2y$10$PqBLT/gRghOAqxCLv7sa52QfZqE8q5Z8SGvtQvECOH14R/2uOeGha')
ON DUPLICATE KEY UPDATE password = VALUES(password);


