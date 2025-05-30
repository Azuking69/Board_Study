<?php
//Pythonでいうimport
include 'header.php';
//現在のファイルが存在するディレクトリの絶対パス
include(__DIR__ . '/../back/db_connect.php');

//変数宣言
//$_GET: 「?以降のクエリパラメータ」を受け取るための連想配列
//クエリパラメータ: URLの末尾にくっつけてデータを渡す仕組み
//isset(): 指定した変数が 存在していてNULLじゃないかをチェック
$serch_type = isset($_GET['search_type']) ? $_GET['search_type'] : "subject";
//trim(): 前後の空白・改行を除去
$serch_query = isset($_GET['search_query']) ? trim($_GET['search_query']) : "";

//１ページの表示数
$limit = 5;
//もしURLにpageがついてたら→それを使ってページ番号に。なかったら→1ページ目から表示
$page = isset($_GET['page']) ? (int)$_GET['page']: 1;
//どこから投稿を取ってくるか
$offset = ($page -1) * $limit;

//検索キーワードがあるときだけ、SQLに検索条件（WHERE句）を追加
//最初は空にしておく
$where = "";
//empty() は「中身が空だったら true」
//!empty() は「空じゃなければ true」＝検索
if (!empty($search_query)){
    $where = "WHERE $search_type LIKE '%$search_query%'";
}

//1ページに5件ずつ表示するなら、何ページ必要か計算
$totalQuery = "SELECT COUNT(*) AS total FROM board $where";
//SQL실행
//->は必ず必要
$totalResult = $conn->query($totalQuery);
//結果を「連想配列（辞書）」として取り出す
//返ってきた結果（表）から、1行目を配列で取り出すのが fetch_assoc()
$totalRow = $totalResult->fetch_assoc();
//「投稿の合計件数」を変数に入れる
$total = $totalRow['total'];
//ページ数を求める式
$total_pages = ceil($total / $limit);

//どの列を取ってくるかを決める
$sql = "SELECT id, name, subject, created_at FROM board $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
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

    <!-- 🔍 検索フォーム -->
    <form method="get" action="" style="margin-bottom: 10px;">
        <select name="search_type">
            <option value="subject" <?= $serch_type == "subject" ? "selected" : "" ?>>제목</option>
            <option value="name" <?= $serch_type == "name" ? "selected" : "" ?>>이름</option>
            <option value="content" <?= $serch_type == "content" ? "selected" : "" ?>>내용</option>
        </select>

        <input type="text" name="search_query" value="<?= htmlspecialchars($serch_query) ?>" placeholder="검색어 입력" required>
        <input type="submit" value="검색">
    </form>

    <!-- 枠線付きのHTMLテーブル -->
    <table border="1">
        <tr>
            <th>번호</th>
            <th>이름</th>
            <th>제목</th>
            <th>작성일</th>
        </tr>
        <?php
        $count = $total - ($page - 1) * $limit;
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                echo "<tr>";
                //番号（ID）
                echo "<td>{$count}</td>";
                //投稿者の名前
                echo "<td>{$row['name']}</td>";
                //投稿タイトル（クリックで詳細へ）
                echo "<td><a href='read.php?id={$row['id']}'>{$row['subject']}</a></td>";
                //投稿日時
                echo "<td>{$row['created_at']}</td>";
                echo "</tr>";
                $count--;
            }
        } else{
            // 検索結果がないときの表示
            echo "<tr><td colspan='4'>검색 결과가 없습니다.</td></tr>";
        }
        ?>
    </table>

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

    <a href="insert.php"><button type="button">글쓰기</button></a>

</body>

</html>