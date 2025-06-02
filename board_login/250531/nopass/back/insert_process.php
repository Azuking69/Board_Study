<?php
    //📇データベース指定
    include ("db_connect_nopass.php");

    //🔄️フォームから送られてきたデータを変数で受け取る
    $name = $_GET['name'];
    $subject = $_GET['subject'];
    $content = $_GET['content'];

    //📥VALUESの中身をboardに書き込む
    $sql = "INSERT INTO board (name, subject, content)
    VALUES ('$name', '$subject', '$content')";

    if ($conn -> query($sql) === TRUE){
        header("Location: ../front/list.php");
    } else {
        echo "글 등록 실패: " .$conn -> error;
    }

    $conn -> close();
?>