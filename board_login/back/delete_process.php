<?php
// データベース接続を読み込む
include 'db_connect.php';

// フォームから送信されたデータ（投稿IDとパスワード）を取得
$id = $_POST['id'];
$password = $_POST['password'];

// 指定されたIDの投稿が存在するか確認する
$sql = "SELECT * FROM board WHERE id =?";
// プリペアドステートメントを準備
$stmt = $conn->prepare($sql);
// プレースホルダーにIDをバインド
$stmt->bind_param("i", $id);
// クエリ実行
$stmt->execute();
// 結果取得
$result = $stmt->get_result();
// 結果を連想配列で取得
$row = $result->fetch_assoc();

// 投稿が存在しない場合は処理を中断
if(!$row){
    die("게시글을 찾을 수 없습니다.");
}

// パスワードが一致するか確認（※ 現在は平文チェック。今後は暗号化推奨）
if($row['password'] !== $password){
    die("비밀번호가 일치하지 않습니다. <a href='../front/delete_pass.php?id=$id'>다시 시도</a>");
}

// 投稿を削除するSQLを準備
$sql = "DELETE FROM board WHERE id = ?";
$stmt = $conn->prepare($sql);
// IDをバインド
$stmt->bind_param("i", $id);

// 削除実行＆結果表示
if($stmt->execute()){
    echo "삭제가 완료되었습니다. <a href='../front/list.php'>복록으로</a>";
} else {
    echo "삭제 실패: " .$conn->error;
}

// データベース接続を閉じる
$conn->close();
?>