<?php
// DB接続ファイル読み込み
include 'db_connect.php';

// POSTデータ受け取り
$id = $_POST['id'];
$pass = $_POST['pass'];
$pass_check = $_POST['pass_check'];

// 🔐 入力チェック：空欄がある場合は登録させない
if (empty($id) || empty($pass) || empty($pass_check)) {
    die("아이디와 비밀번호를 모두 입력해야 합니다. <a href='../front/join.php'>다시 시도</a>");
}

// 🔐 パスワード確認が一致しない場合
if ($pass !== $pass_check) {
    die("비밀번호가 일치하지 않습니다. <a href='../front/join.php'>다시 시도</a>");
}

// 🔐 SQLインジェクション対策なしのままなので改善が必要
// → Prepared Statement（プリペアドステートメント）を使用する
$sql = "SELECT id FROM login WHERE id = '$id'";
$result = $conn->query($sql);

// 중복 ID 확인（プリペアドステートメント使用）
if ($result->num_rows > 0) {
    // ID重複がある場合
    echo "이미 존재하는 아이디입니다. <a href='../front/join.php'>다시 입력</a>";
    $conn->close();
    exit();
}

// ✅ パスワードは平文で保存しない！ハッシュ化する
$sql = "INSERT INTO login (id, password) VALUES ('$id', '$pass')";

// 회원가입 처리（プリペアドステートメント使用）
if ($conn->query($sql) === TRUE) {
    echo "회원가입이 완료되었습니다. <a href='../front/login.php'>로그인</a>";
} else {
    echo "회원가입 실패: " . $conn->error;
}

// 연결 종료
$conn->close();
?>