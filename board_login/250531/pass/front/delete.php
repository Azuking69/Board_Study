<?php
    if (!isset($_GET['id'])){
        echo "잘못된 접근입니다.";
        exit;
    }
    $id = $_GET['id'];
?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 삭제</title>
</head>

<body>
    <h1>게시판 > 삭제</h1>

    <!--✂️削除処理-->
    <form action = "../back/delete_process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        비밀번호 : <br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="삭제하기">
        <a href="list.php">
            <button type="button">취소</button>
        </a>
    </form>
</body>

</html>