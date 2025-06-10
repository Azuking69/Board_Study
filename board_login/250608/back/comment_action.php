<?php
    //📇データベース指定
    include ("db_connect_pass.php");

    //📥POSTデータ受け取り
    $comment_id = isset($_POST['comment_id']) ? intval($_POST['comment_id']) : 0;
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : 0;
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    //🚫入力チェック
    if ($comment_id <= 0 || $post_id <= 0 || empty($password) || empty($action)){
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

            if ($action === "update") {
                //✏️コメント修正処理
                if (empty($content)) {
                    echo "<script>alert('❗내용이 비어 있습니다.'); history.back();</script>";
                    exit;
                }
                $update_sql = "UPDATE comments SET content = ? WHERE id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("si", $content, $comment_id);
                $update_stmt->execute();

                header("Location: ../front/read.php?id=$post_id");
                exit;

            } elseif ($action === "delete"){
                // 🗑 コメント削除処理
                $delete_sql = "DELETE FROM comments WHERE id = ?";
                $delete_stmt = $conn->prepare($delete_sql);
                $delete_stmt->bind_param("i", $comment_id);
                $delete_stmt->execute();

                header("Location: ../front/read.php?id=$post_id");
                exit;

            } else {
                // "update"でも"delete"でもない未知のアクションが指定された場合
                echo "<script>alert('❗알 수 없는 작업입니다.'); history.back(); </script>";
                exit;
            }
        } else {
            echo "<script>alert('❗비밀번호가 틀렸습니다.'); history.back(); </script>";
            exit;
        }
    } else {
        // そもそも指定されたIDのコメントが存在しなかった場合
        echo "<script>alert('❗댓글을 찾을 수 없습니다.'); history.back(); </script>";
        exit;
    }

    $conn -> close();
?>