<?php
    //📇データベース指定
    include ("db_connect_pass.php");

    //📥POSTデータ受け取り
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';

    //🚫未入力チェック
    if ($post_id <= 0 || empty($name) || empty($password) || empty($content)){
        echo "<script>alert('❗모든 필드를 입력해주세요.'); history.back(); </script>";
        exit;
    }

    //💾コメント登録
    $sql = "INSERT INTO comments (post_id, name, password, content) VALUE (?, ?, ?, ?)";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("isss", $post_id, $name, $password, $content);

    //🎯実行と戻る
    if ($stmt -> execute()){
        header("Location: ../front/read.php?id=$post_id");
        exit;
    } else {
        echo "<script>alert('❗댓글 저장에 실패했습니다.'); history.back(); </script>";
    }

    $conn -> close();
?>