<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>로그인</title>
</head>

<body>
    <h1>로그인</h1>
    <!-- ▼ ログインフォーム開始。フォームの送信先は back フォルダ内の login_process.php -->
    <form action="../back/login_process.php" method="post">
        <!-- ユーザーID入力欄。type="email" はメールアドレス形式の入力に制限される -->
        <input type="email" name="id" placeholder="아이디를 입력하세요."><br>
        <!-- パスワード入力欄。type="password" なので入力内容は伏せられる -->
        <input type="password" name="password" placeholder="비밀번호를 입력하세요."><br>
        <!-- 送信ボタン -->
        <input type="submit" value="로그인"><br><br><hr>
    </form>
    <!-- ▼ アカウント未所持の人への案内文と、会員登録ページへのリンク -->
    <p>아직 계정이 없으십니까? <a href="join.php">회원가입</a></p>
</body>

</html>