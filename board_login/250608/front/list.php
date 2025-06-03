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

    //🔍 検索機能
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
    $search_condition = "";

    if ($type && $keyword) {
        $keyword_esc = $conn->real_escape_string($keyword);
        if ($type === 'subject') {
            $search_condition = "WHERE subject LIKE '%$keyword_esc%'";
        } elseif ($type === 'content') {
            $search_condition = "WHERE content LIKE '%$keyword_esc%'";
        } elseif ($type === 'all') {
            $search_condition = "WHERE subject LIKE '%$keyword_esc%' OR content LIKE '%$keyword_esc%'";
        }
    }

    //📦データ取得（ページ分だけ）
    $sql = "SELECT * FROM board $search_condition ORDER BY id DESC LIMIT $perpage OFFSET $start";
    $result = $conn->query($sql);
    $total_sql = "SELECT COUNT(*) AS total FROM board $search_condition";


    //📊全件数取得
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

    <!--🔍 検索フォーム -->
    <form method="get" action="list.php" style="display: flex; gap: 10px; margin-bottom: 20px;">
        <select name="type">
            <option value="subject" <?php if(isset($_GET['type']) && $_GET['type'] === 'subject') echo 'selected'; ?>>제목</option>
            <option value="content" <?php if(isset($_GET['type']) && $_GET['type'] === 'content') echo 'selected'; ?>>내용</option>
            <option value="all" <?php if(isset($_GET['type']) && $_GET['type'] === 'all') echo 'selected'; ?>>제목+내용</option>
        </select>
        <input type="text" name="keyword" placeholder="검색어를 입력하세요" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
        <input type="submit" value="검색">
        <a href="list.php"><button type="button">초기화</button></a>
    </form>


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