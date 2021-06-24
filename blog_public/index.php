<?php
require_once("../blog_classes/blog.php");

# 取得したデータを表示
$blog = new Blog();
$blog_data = $blog->getAll();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ブログ一覧</title>
</head>
<body>
  <h3>ブログ一覧</h3>
  <hr>
	<p><a href="./form.html">新規作成</a></p>
  <table border="1">
    <tr>
      <th>TITLE</th>
      <th>CATEGORY</th>
			<th>投稿日時</th>
      <th>DETAIL</th>
      <th>EDIT</th>
      <th>DELETE</th>
    </tr>
    <?php foreach ($blog_data as $column) { ?>
      <tr>
        <td><?= $blog->h($column['title']) ?></td>
        <td><?= $blog->h($blog->setCategoryName($column['category_id'])) ?></td>
				<td><?= $blog->h($column['post_at']) ?></td>
        <td><a href="detail.php?id=<?= $blog->h($column['id']) ?>">詳細</a></td>
        <td><a href="update_form.php?id=<?= $blog->h($column['id']) ?>">編集</a></td>
        <td><a href="../blog_classes/blog_delete.php?id=<?= $blog->h($column['id']) ?>">削除</a></td>
      </tr>
    <?php } ?>
  </table>
</body>

</html>