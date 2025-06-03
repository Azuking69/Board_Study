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
    <p><?php echo $row['content']; ?></p><br>

    <!--📝パスワード入力フォームへ-->
    <button type="button" onclick="location.href='password.php?id=<?php echo $id; ?>'">변경</button>
    <br><br><hr>

    <!--コメント表示-->
    <h3>댓글</h3>
    <?php
    $comment_sql = "SELECT * FROM comments WHERE post_id = $id ORDER BY created_at ASC";
    $comment_result = $conn->query($comment_sql);

    // コメントがないときのメッセージ
    if ($comment_result->num_rows === 0) {
        echo "<p>등록된 댓글이 없습니다.</p>";
    }
    // コメントがある場合表示
    while ($comment = $comment_result->fetch_assoc()) {
    echo "<div style='border-bottom:1px solid #ccc; padding:10px;'>";
    echo "<p><strong>{$comment['name']}</strong> ({$comment['created_at']})</p>";
    echo "<p>" . nl2br($comment['content']) . "</p>";

    // 수정ボタン付き削除フォーム（パスワード必要）
    echo "<form action='../back/comment_delete.php' method='post'>";
    echo "<input type='hidden' name='post_id' value='$id'>";
    echo "<input type='hidden' name='comment_id' value='{$comment['id']}'>";
    echo "비밀번호 입력 후 삭제: ";
    echo "<input type='password' name='password' required>";
    echo "<button type='submit'>삭제</button>";
    echo "</form>";

    echo "</div>";
}
    ?>
    <br><br><hr>

    <!--✏️コメント機能-->
    <h3>댓글 작성</h3>
    <form action="../back/comment_process.php" method="post">
        <input type="hidden" name="post_id" value="<?=$id ?>">
        <p>이름: <input type="text" name="name" placeholder="이름을 입력하세요" required></p>
        <p>비밀번호: <input type="password" name="password" placeholder="비밀번호를 입력하세요" required></p>
        <p>내용: </p>
        <p><textarea name="content" rows="5" cols="40" required></textarea></p>

        <button type="submit">작성</button>
    </form>

    <!--🏃最初の画面に戻る-->
    <p>게시판 목록으로 돌아가시곘습니까?  <a href="list.php">돌아가기</a></p>
</body>

</html>