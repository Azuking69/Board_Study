<?php
    //📇database指定
    include ("../back/db_connect_pass.php");
    //変数に受け取った'id'を入れる
    $id = $_GET['id'];

    //⚠️$id がなければエラー
    if (!$id) {
        echo "❗ ID가 지정되어 있지 않습니다.";
        exit;
    }

       $sql = "SELECT * FROM board WHERE id = $id";
       $result = $conn -> query($sql); //🔍データベースでの有無を確認
       
       //🚩結果が存在するかどうか
       if ($result && $result -> num_rows > 0){
            $row = $result -> fetch_assoc(); //⭕見つかったら
       } else {
        echo "❗포스트를 찾을 수 없습니다."; //❌見つからなければ
        exit;
    }
?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 상세보기</title>
</head>

<body>
    <h1>게시판 > 상세보기</h1>
    <!--🔔データベースから呼び出し-->
    <h2><?php echo $row['subject']; ?></h2>
    <p><strong>작성자: </strong><?php echo $row['name']; ?></p>
    <p><strong>작성일: </strong><?php echo $row['created_at']; ?></p><br>
    <p><?php echo $row['content']; ?></p><br><br>

    <table>
        <tr>
            <td>
                <!--📝수정（編集）入力フォームへ-->
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">수정</button>
                </form>
            </td>

            <td>
                <!--❌삭제（削除）入力フォームへ-->
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">삭제</button>
                </form>
            </td>
        </tr>
    </table>
    
    <p>게시판 목록으로 돌아가시곘습니까?  <a href="list.php">돌아가기</a></p>
</body>

</html>