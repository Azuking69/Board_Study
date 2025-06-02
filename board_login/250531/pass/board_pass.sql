CREATE DATABASE IF NOT EXISTS board_pass;
USE board_pass;

-- password付きテーブル定義
CREATE TABLE IF NOT EXISTS board (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(20) NOT NULL,
    password CHAR(20) NOT NULL,     -- 🔐 ここが新しく追加される
    subject CHAR(20) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);