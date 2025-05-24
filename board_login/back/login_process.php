<?php
//　出力バッファリングを有効化（重要！）
ob_start();
// DB接続ファイルの読み込み
include("db_connect.php");
// セッションを開始（ログイン情報の保持に必要）
session_start();

// フォームからPOSTで送信されたときのみ処理を実行
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 入力されたIDとパスワードを取得
    $id = $_POST['id'];
    $password = $_POST['password'];

    // DBに同じIDとパスワードの組み合わせがあるか確認
    $sql = "SELECT * FROM login WHERE id='$id' AND password='$password'";
    $result = $conn->query($sql);

    // ユーザーが存在すればログイン成功
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $id;
        // セッションにログイン情報を保存
        header("Location: ../front/insert.php"); // 成功したら insert.php へ
        // 処理終了
        exit();
    } else {
        // ログイン失敗：アラートを出して前のページに戻る
        echo "<script>alert('아이디 또는 비밀번호가 틀렸습니다.'); history.back();</script>";
    }
} else {
    // POST以外のリクエスト（例：URL直打ち）の場合、ログインページにリダイレクト
    header("Location: ../front/login.php"); // POSTじゃなければログインフォームへ戻す
    exit();
}
