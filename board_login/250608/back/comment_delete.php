<?php
    //📇データベース指定
    include ("db_connect_pass.php");

    //📥POSTデータ受け取り
    $comment_id = isset($_POST['comment_id']) ? intval($_POST['comment_id']) : 0;
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : 0;

    //🚫入力チェック
    if ($comment_id <= 0 || empty($password)){
        echo "<script>alert('잘못된 접근입니다.'); history.back(); </script>";
        exit;
    }

    //🔐パスワード確認
    $sql = "SELECT password FROM comments WHERE id = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("i", $comment_id);
    $stmt -> execute();
    $result = $stmt -> get_result();

    if ($result && $row = $result -> fetch_assoc()){
        if ($row['password'] === $password){
            $del_sql = "DELETE FROM comments WHERE id =?";
            $del_stmt = $conn -> prepare($del_sql);
            $del_stmt -> bind_param("i", $comment_id);
            $del_stmt -> execute();

            header("Location: ../front/read.php?id=$post_id");
            exit;
        } else {
            echo "<script>alert('❗비밀번호가 틀렸습니다.'); history.back(); </script>";
            exit;
        }
    } else {
        echo "<script>alert('❗해당 댓글이 존재하지 않습니다.'); history.back(); </script>";
        exit;
    }

    $conn -> close();
?>