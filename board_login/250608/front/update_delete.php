<?php
    //📇database指定
    include ("../back/db_connect_pass.php");

    $id = isset($_POST['id']) ? intval($_POST['id']): 0;
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    if ($id > 0){
        $sql = "SELECT name, subject, content FROM board WHERE id = $id";
        $result = $conn -> query($sql);

        if ($result -> num_rows > 0){
            $row = $result -> fetch_assoc();
        } else {
            echo "게시글이 존재하지 않습니다.";
            exit;
        }
    } else {
        echo "<script> alert ('잘못된 접근입니다.'); history.back();</script>";
    }
    //$conn: 接続の窓口 -> 接続終了
    $conn -> close();

?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 게시글</title>
</head>

<body>
    <h1>게시판 > 게시글</h1>
    <table>
        <tr>
        <!--📝フォーム作成-->
        <form action="../back/update_process.php" method='POST'>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <p>이름: <input type="text" name="name" value="<?php echo $row['name'] ?>"></p>
            <p>제목: <input type="text" name="subject" value="<?php echo $row['subject'] ?>" ?></p>
            <p>내용:<br>
            <textarea name="content" rows="5" cols="40"><?php echo $row['content'] ?></textarea></p>

            <button type="submit">수정</button>
        </form>

        <br><br><bh>

        <form action="../back/delete_process.php" method='POST'>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="password" value="<?php echo $password; ?>">
            <button type="submit">삭제</button>
        </form>

        </tr>
    </table>
</body>

</html>