<?php
// データベース연결
$servername = "mysql";
$username = "root";
$password = "12345678";
// MySQL中のboard_loginに貯蔵する
$database = "board_login";

//MySQL（データベース）とPHPをつなぐ「接続オブジェクト」
$conn = new mysqli($servername, $username, $password, $database);

//MySQLとの接続に失敗してたら、エラーを出して処理を止める
if ($conn->connect_error){
    die("연결 실패: ". $conn->connect_error);
}
?>