<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 상세보기</title>
</head>

<body>
    <h1>게시판 > 상세보기</h1>
    <h2>아이스크림</h2>
    <p><strong>작성자:</strong> 김효찬</p>
    <p><strong>작성일:</strong> 2025-05-20 11:50:30</p>
    <br>
    <p>맛있다다</p>
    <br>

    <table>
        <td>
            <form action="update.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">수정</button>

            <form action="deleat_pass.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button><a href="">삭제</a></button>
        </td>
    </table>

    <p>게시판 목록으로 돌아가시겠습니까? <a href="list.php">돌아가기</a></p>
</body>

</html>