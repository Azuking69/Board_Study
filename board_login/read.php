<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 상세보기</title>
</head>

<body>
    <h1>게시판 > 상세보기</h1>
    
    <h1><?php echo htmlspecialchars($row['subject']); ?></h1>

    <p><strong>작성자: </strong><?php echo htmlspecialchars($row['name']); ?></p>
    <p><strong>작성일: </strong><?php echo $row['creatred_at']; ?></p>
    <br>
    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
    <br>


    <table>
        <tr>
            <td>
                <form action="update_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">수정</button>
                </form>
            </td>
            <td>
                <form action="delete_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">삭제</button>
                </form>
            </td>
        </tr>
    </table>

    <p>게시판 목록으로 돌아가시곘습니까? <a href="list.php">돌아가기</a></p>
</body>

</html>