<?php
    //📇database指定
    include ("../back/db_connect_nopass.php");
    //
    $sql = "SELECT * FROM board ORDER BY id DESC";
    $result = $conn->query($sql);
?>

<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>게시판 | 리스트</title>
</head>

<body>
    <h1>게시판 > 리스트</h1>
    <!--📇リスト化-->
    <table border="1">
        <tr>
            <th>번호</th>
            <th>이름</th>
            <th>제목</th>
            <th>작성일</th>
        </tr>

        <!--🔔databaseから呼び出し-->
        <?php
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td><a href='read.php?id={$row['id']}'>{$row['subject']}</a></td>";
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>검색 결과가 없습니다.</td></tr>";
        }
        ?>
    </table>

    <br>
    <br>

    <a href="insert.php">
        <button type="type">글쓰기</button>
    </a>

</body>

</html>