<?php
include 'db_connect.php';

$name = $_POST['name'];
$password = $_POST['password'];
$subject = $_POST['subject'];
$content = $_POST['content'];

$sql = "INSERT INTO board(name, password, subject, content)
        VALUES ('$name', '$password', '$subject', '$content')";

if ($conn -> query($sql) === TRUE){
    header("Location: ../front/list.php");
    exit();
} else {
    echo "글 등록 실패: " .$conn -> error;

}

$conn -> close();
?>