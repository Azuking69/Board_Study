<?php
//フォームから POST リクエストでアクセスされなければ、アクセスを拒否
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("잘못된 접근입니다.");
}

$name = $_POST['name'];
$password = $_POST['password'];
$subject = $_POST['subject'];
$content = $_POST['content'];

$conn = new mysqli('mysql', 'root', '12345678', 'board_login');
if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

$sql = "INSERT INTO board (name, password, subject, content)
        VALUES ('$name', '$password', '$subject', '$content')";

if ($conn->query($sql) === TRUE) {
    header("Location: list.php"); // 저장 후 목록으로 이동
    exit();
} else {
    echo "글 등록 실패: " . $conn->error;
}

$conn->close();
?>
