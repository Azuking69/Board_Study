<?php
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    exit();
}

// POSTデータ取得
$id = $_POST['id'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$content = $_POST['content'];

// SQLで更新処理（prepared statementを使うと安全）
$sql = "UPDATE board SET name=?, subject=?, content=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $subject, $content, $id);

if ($stmt->execute()) {
    // 成功 → リストに戻る
    header("Location: ../front/list.php");
    exit();
} else {
    echo "수정 실패: " . $conn->error;
}

$conn->close();
?>
