<?php
include("header.php");

// データベース接続
include("../back/db_connect.php");
// GETで受け取ったIDのバリデーション
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // SQL実行
    $sql = "SELECT name, subject, content FROM board WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 結果取り出し
        $row = $result->fetch_assoc();
    } else {
        echo "게시글이 존재하지 않습니다.";
        exit;
    }
} else {
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    exit;
}

$conn->close();
?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 게시글 수정</title>
</head>

<body>
    <h1>게시판 > 게시글</h1>

    <table>
        <tr>
            <!-- 投稿修正フォーム -->
            <form action="../back/update_process.php" method="post">
                <!-- 修正対象のIDを隠しフィールドで送る -->
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <p>이름 : <input type="text" name="name" value="<?php echo $row['name']; ?>"></p>
                <p>제목 : <input type="text" name="subject" value="<?php echo $row['subject']; ?>"></p>
                <p>내용 : <br>
                <textarea name="content" rows="5" cols="40"><?php echo $row['content'] ?></textarea></p>
                <button type="submit">수정</button>
                <a href="list.php"><button type="button">취소</button></a>
            </form>
        </tr>
    </table>
</body>

</html>