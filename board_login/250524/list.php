<?php
include 'db_connect.php';
$sql = "SELECT id, name, subject, created_at FROM board ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<h1>게시판 > 리스트</h1>
<table border="1">
  <tr><th>번호</th><th>이름</th><th>제목</th><th>작성일</th></tr>
  <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><a href="read.php?id=<?= $row['id'] ?>"><?= htmlspecialchars($row['subject']) ?></a></td>
      <td><?= $row['created_at'] ?></td>
    </tr>
  <?php } ?>
</table>