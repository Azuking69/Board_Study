<?php
// セッションの開始（必須）
session_start();
if (!isset($_SESSION['username'])) {
    // ログインしていない場合は login.php にリダイレクト
    header("Location: login.php");
    // スクリプトの実行を終了
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!--ブラウザタブに表示されるタイトル（あとで修正OK）-->
    <title>Document</title>
</head>
<body>
    <!-- セッションで保存されているユーザー名を表示 -->
    <h5>환영합니다, <?php echo $_SESSION['username']; ?>님! 
    <!--ログアウトリンク-->
    <a href="logout.php">로그아웃</a></h5>
</body>
</html>