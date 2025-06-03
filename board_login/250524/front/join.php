<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
</head>
<body>
    <h3>회원가입</h3>
    <!-- 会員登録フォーム -->
    <!-- サーバー側の処理ファイルに送信 -->
    <form action="../back/db_account.php" method="post">
        <p>아이디 : <input type="email" name="id" placeholder="아이디를 입력하세요."></p>
        <!-- 이메일形式でバリデーション（例: xxxx@yyy.com） -->
        <p>비밀번호 : <input type="password" name="pass" placeholder="비밀번호를 입력하세요."></p>
        <p>비밀번호 확인 : <input type="password" name="pass_check" placeholder="비밀번호를 확인합니다."></p>
        <p>
            <!-- 登録送信 -->
            <button type="submit">회원가입</button>
            <!-- 入力初期化 -->
            <button type="reset">초기화</button>
        </p>
        <hr>
    </form>
    <!-- 로그인 창 폼 돌아가기 -->
    로그인 페이지로 돌아가시겠습니까? <a href="login.php">돌아가기</a>
</body>
</html>