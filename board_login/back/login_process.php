<?php
ob_start(); // ← 出力バッファリングを有効化（重要！）
include("db_connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE id='$id' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $id;
        header("Location: ../front/insert.php"); // 成功したら insert.php へ
        exit();
    } else {
        echo "<script>alert('아이디 또는 비밀번호가 틀렸습니다.'); history.back();</script>";
    }
} else {
    header("Location: ../front/login.php"); // POSTじゃなければログインフォームへ戻す
    exit();
}
