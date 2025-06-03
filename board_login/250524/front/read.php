<?php
// データベース接続ファイルを読み込む（相対パスで back フォルダにある）
include("../back/db_connect.php");
// クエリパラメータで id が渡されていない場合（不正アクセスの対処）
if (!isset($_GET['id'])) {
    echo "잘못된 접근입니다.";
    exit();
}

// GETで渡された id を取得
$id = $_GET['id'];
// SQL文を準備（安全なプリペアドステートメントを使用）
$sql = "SELECT * FROM board WHERE id = ?";
// SQLを準備
$stmt = $conn->prepare($sql);
// プレースホルダに整数型として $id をバインド
$stmt->bind_param("i", $id);
// SQL実行
$stmt->execute();
// 結果取得
$result = $stmt->get_result();
// 結果から1行取り出す（連想配列）
$row = $result->fetch_assoc();

// 指定した ID の投稿が存在しなかった場合
if (!$row) {
    echo "해당 게시글이 존재하지 않습니다.";
    exit();
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
    <!-- タイトルをHTMLエスケープして表示 -->
    <h1><?php echo htmlspecialchars($row['subject']); ?></h1>
    <!-- 投稿者 -->
    <p><strong>작성자: </strong><?php echo htmlspecialchars($row['name']); ?></p>
    <!-- 投稿日時 -->
    <p><strong>작성일: </strong><?php echo $row['created_at']; ?></p>
    <br>
    <!-- 内容・改行を<br>に変換 -->
    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
    <br>

    <table>
        <tr>
            <td>
                <!-- 수정（編集）パスワード入力フォームへ -->
                <form action="update_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <!-- 編集ボタン -->
                    <button type="submit">수정</button>
                </form>
            </td>

            <td>
                <!-- 삭제（削除）パスワード入力フォームへ -->
                <form action="delete_pass.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <!-- 削除ボタン -->
                    <button type="submit">삭제</button>
                </form>
            </td>
        </tr>
    </table>
    <!-- ▼ 一覧に戻るリンク -->
    <p>게시판 목록으로 돌아가시곘습니까? <a href="list.php">돌아가기</a></p>
</body>

</html>