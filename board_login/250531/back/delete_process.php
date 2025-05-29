<?php
    //📇データベース指定
    include ("db_connect_nopass.php");

    //🔄️フォームから送られてきたデータを変数で受け取る
    $id = $_GET['id'];
    $sql = "SELECT * FROM board WHERE id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("i", $id);    //i: int
    $stmt -> execute();
    $result = $stmt -> get_result();
    $row = $result -> fetch_assoc();

    //❌投稿が存在しない場合は処理を中断
    if(!$row){
    die("게시글을 찾을 수 없습니다.");
    }

    //🛍️投稿を削除するSQLを準備
    $sql = "DELETE FROM board WHERE id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("i", $id);

    //🏃実行・結果表示
    if ($stmt -> execute()){
        echo "삭제가 완료되었습니다. <a href='../front/list.php'>복록으로</a>";
    } else {
        echo "삭제 실패: " .$conn -> error;
    }

    //🚪データベースから出る
    $conn -> close();
?>