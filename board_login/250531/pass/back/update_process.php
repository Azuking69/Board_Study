<?php
    //📇データベース指定
    include ("db_connect_pass.php");

    //📥フォームから送られてきたデータを変数で受け取る
    $id = $_POST['id'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

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