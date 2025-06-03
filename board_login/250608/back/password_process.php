<?php
    //📇データベース指定
    include ("db_connect_pass.php");

    //📥 POSTデータ受け取り
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    //🚫入力チェック
    if($id <= 0 || empty($password)){
        echo "<script>alert('잘못된 접근입니다.'); history.back(); </script>";
        exit;
    }

    //🔐パスワード確認
    $sql = "SELECT * FROM board WHERE id = ? AND password = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("is", $id, $password);
    $stmt -> execute();
    $result = $stmt -> get_result();

    //🎯成功時、修正・削除ページへの移動
    if($result && $result -> num_rows > 0){
        echo "
        <form id = 'passForm' action='../front/update_delete.php' method='POST'>
            <input type='hidden' name='id' value='{$id}'>
            <input type='hidden' name='password' value='{$password}'>
        </form>
        <script>document.getElementById('passForm').submit();</script>
        ";
    } else {
        echo "<script>alert('비밀번호가 틀렸습니다. 다시 시도해주세요.'); history.back();</script>";
    }

    $conn -> close();
?>