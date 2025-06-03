<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 비밀번호 확인</title>
</head>

<body>
    <h1>게시판 > 비밀번호 확인</h1>

    <!--🧾パスワード確認フォーム-->
    <form action="../back/password_process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <p>비밀번호: <input type="password" name="password" placeholder="비밀번호를 입력하세요"></p><br>
        <input type="submit" value="확인">
    </form>
</body>

</html>