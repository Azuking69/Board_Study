<?php
// URLにidがついていない場合（不正アクセスなど）を防ぐためのチェック
if (!isset($_GET['id'])){
    // 「不正なアクセスです。」というメッセージを表示
    echo "잘못된 접근입니다.";
    // スクリプトの実行を中止
    exit();
}
// GETで渡された投稿IDを変数に保存
$id = $_GET['id'];
?>

<!DOCTYPE HTML>
<!--韓国語-->
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 삭제</title>
</head>

<body>
    <h1>게시판 > 삭제</h1>
     <!-- 削除処理を行うPHPファイルにPOST送信するフォーム -->
    <form action="../back/delete_process.php" method="post">
        <!-- 削除する投稿のIDを隠しフィールドとして送信 -->
        <input type="hidden" name="id" value="<?php echo $id ; ?>">
        <!-- 削除認証のためにパスワードを入力させるフィールド -->
        비밀번호 입력 : <input type="password" name="password" required>
        <br>
        <br>
        <!-- フォームの送信ボタン -->
        <input type="submit" value="삭제하기">
        <!-- 「キャンセル」ボタン：詳細ページ（read.php）に戻る -->
        <a href="read.php?id=<?php echo $id; ?>"><button type="button">취소</button></a>
    </form>
</body>

</html>