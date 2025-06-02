<?php
    //📇database指定
    include ("../back/db_connect_pass.php");

    //🧾1ページあたりの表示件数
    $perpage = 5;
    
    //🧭現在のページ番号（未指定なら1ページ目）
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;


    //🧮OFFSETを計算
    $start = ($page - 1) * $perpage;


    //📦データ取得（ページ分だけ）
    $sql = "SELECT * FROM board ORDER BY id DESC LIMIT $perpage OFFSET $start";
    $result = $conn -> query($sql);

    //📊全件数取得
    $total_sql = "SELECT COUNT(*) AS total FROM board";
    $total_result = $conn->query($total_sql);
    $total_row = $total_result->fetch_assoc();
    $total_posts = $total_row['total'];
    $total_pages = ceil($total_posts / $perpage);
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
        $count = $total_posts - ($page - 1) * $perpage;
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $count-- . "</td>";
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

    <!--📄Pagenation-->
    <?php
    $pageRange = 5;  //１セットの表示数
    $startPage = floor(($page - 1) / $pageRange) * $pageRange + 1;
    $endPage = min($startPage + $pageRange - 1, $total_pages);

    // <<: 最初のページ
    if ($startPage > 1) {
        echo "<a href='?page=1'>&laquo;</a> ";
    }

    // <: 前のページグループ
    if ($startPage > 1) {
        $prevSet = $startPage - 1;
        echo "<a href='?page=$prevSet'>&lt;</a> ";
    }

    // ページ番号表示
    for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $page) {
            echo "<strong>$i</strong> ";
        } else {
            echo "<a href='?page=$i'>$i</a> ";
        }
    }

    // >: 次のページグループ
    if ($endPage < $total_pages) {
        $nextSet = $endPage + 1;
        echo "<a href='?page=$nextSet'>&gt;</a> ";
    }

    // >>: 最後のページ
    if ($endPage < $total_pages) {
        echo "<a href='?page=$total_pages'>&raquo;</a>";
    }
    ?>
    </div>
    <br>
    <br>


    <a href="insert.php">
        <button type="type">글쓰기</button>
    </a>
   
</body>

</html>