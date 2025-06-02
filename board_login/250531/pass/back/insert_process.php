<?php
    //📇データベース指定
    include ("db_connect_pass.php");

    //🔄️フォームから送られてきたデータを変数で受け取る
    $name = $_POST['name'];
    $password = $_POST['password'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];

    //📥VALUESの中身をboardに書き込む
    $sql = "INSERT INTO board (name, password, subject, content)
    VALUES ('$name', '$password', '$subject', '$content')";

    if ($conn -> query($sql) === TRUE){
        header("Location: ../front/list.php");
    } else {
        echo "글 등록 실패: " .$conn -> error;
    }

    $conn -> close();
?>