<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 작성</title>
</head>

<body>
    <h1>게시판 > 작성</h1>

    <!--📝項目作成フォーム-->
    <form action="../back/insert_process.php" method="get">
        이름 : <input type="text" name="name" placeholder="이름을 입력하세요"><br><br>
        제목 : <input type="text" name="subject" placeholder="제목을 입력하세요"><br><br>
        내용 : <br>
        <textarea name="content" rows="5" cols="40" placeholder="내용을 입력하세요"></textarea><br>

        <input type="submit" value="저장">
        <input type="reset" value="초기화">
        <br>
        <br>
        <bh>
    </form>
    <p>게시판 목록으로 돌아가시곘습니까?  <a href="list.php">돌아가기</a></p>
</body>

</html>