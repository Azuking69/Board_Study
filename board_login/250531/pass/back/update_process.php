<?php
    //📇データベース指定
    include ("db_connect_pass.php");

    //📥フォームから送られてきたデータを変数で受け取る
    $id = $_GET['id'];
    $name = $_GET['name'];
    $subject = $_GET['subject'];
    $content = $_GET['content'];

    //🔄️SQLで更新処理
    $sql = "UPDATE board SET name=?, subject=?, content=? WHERE id=?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("sssi", $name, $subject, $content, $id);

    if ($stmt -> execute()){
        header("Location: ../front/list.php");
        exit();
    } else {
        echo "수정 실페: " .$conn -> $error;
    }

    $conn -> close();
?>