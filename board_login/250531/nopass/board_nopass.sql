CREATE DATABASE board_nopass;
USE board_nopass;

CREATE TABLE board (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(20) NOT NULL,
    subject CHAR(20) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
