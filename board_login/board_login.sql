CREATE DATABASE board_login;

USE board_login;

CREATE TABLE board (
    id INT AUTO_INCREMENT PRIMARY key,
    name char(20) NOT NULL,
    password char(20) NOT NULL,
    subject char(20) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE login (
    id char(20) NOT NULL,
    password CHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS board (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(20) NOT NULL,
  password CHAR(20) NOT NULL,
  subject CHAR(20) NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);