<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 게시글 수정</title>
    <style>.wide-input{width: 300px;}</style>
</head>

<body>
    <h1>게시판 > 게시글 수정</h1>
        <label for="username">이름:</label>
            <input type="text" id="username" name="username" placeholder="이름를 입력하세요" required>
            <br>
            <br>
        <label for="title">제목:</label>
            <input type="text" id="title" name="title" placeholder="제목을 입력하세요" required>
            <br>
            <br>
        <label for="contents">내용:</label>
            <br>
            <textarea id="contents" name="contents" placeholder="맛있다" class="wide-input" rows="5" required></textarea>
            <br>
            <br>

    <table>
        <td>
            <form action="update_pass.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">수정</button>

            <form action="deleat_pass.php" method="get">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">삭제</button>
        </td>
    </table>

</body>

</html>