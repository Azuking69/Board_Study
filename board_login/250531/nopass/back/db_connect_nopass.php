<?php
// 🔗データベース연결
$servername = "db_nopass";
$username = "root";
$password = "root"; 
$database = "board_nopass";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}
?>