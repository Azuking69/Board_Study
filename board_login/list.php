<?php
//Pythonでいうimport
//include 'header.php';
include 'db_connect.php';

//変数宣言
$serch_type = isset($_GET['search_type']) ? $_GET['search_type'] : "subject";
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
$totalPages = ceil($total / $limit);

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
    <table border="1">
        <tr>
            <th>번호</th>
            <th>이름</th>
            <th>제목</th>
            <th>작성일</th>
        </tr>
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
        } else{
            echo "<tr><td colspan='4'>검색 결과가 없습니다.</td></tr>";
        }
        ?>
    </table>

    <br>

    <button><a href="read.php">글쓰기</a></button>

</body>

</html>