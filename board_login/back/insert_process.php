<?php
// データベース接続の読み込み
include 'db_connect.php';

// POSTで送られてきたフォームデータを受け取る
// 投稿者の名前
$name = $_POST['name'];
// 投稿用パスワード
$password = $_POST['password'];
// 投稿のタイトル
$subject = $_POST['subject'];
// 投稿の内容
$content = $_POST['content'];

// SQL文を作成（受け取ったデータを board テーブルに挿入）
$sql = "INSERT INTO board(name, password, subject, content)
        VALUES ('$name', '$password', '$subject', '$content')";

// SQL実行 → 成功したら投稿一覧ページへリダイレクト
if ($conn -> query($sql) === TRUE){
    // 成功時：投稿一覧に移動
    header("Location: ../front/list.php");
    // 処理終了
} else {
    // 失敗時：エラーメッセージを表示
    echo "글 등록 실패: " .$conn -> error;

}

// データベース接続を閉じる
$conn -> close();
?>