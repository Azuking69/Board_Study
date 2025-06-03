<?php
ob_start(); // ✅ 出力バッファリング：header()を使うときはこれを先に書いておく
include("header.php"); // ✅ ログインチェック＋ユーザー表示など共通処理をまとめたファイル
?>


<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 작성</title>
</head>

<body>
    <h1>게시판 > 작성</h1>
    <!-- ✅ 投稿フォーム本体 -->
    <form action="../back/insert_process.php" method="post">
        이름 : <input type="text" name="name" placeholder="이름을 입력하세요"><br><br>
        비밀번호 : <input type="password" name="password" placeholder="비밀번호를 입력하세요"><br><br>
        제목 : <input type="text" name="subject" placeholder="내용을 입력하세요"><br><br>
        내용 : <br><textarea name="content" rows="5" cols="40" placeholder="내용을 입력하세요"></textarea><br>
        <!-- ✅ ボタン -->
        <!-- 送信 -->
        <input type="submit" value="저장">
        <!-- 入力リセット -->
        <input type="reset" value="초기화"><br><br><hr>
    </form>
    <!-- ✅ リストページへの戻るリンク -->
    <p>게시판 목록으로 돌아가시곘습니까? <a href="list.php">돌아가기</a></p>
</body>

</html>