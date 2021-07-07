<?php
require_once("../blog_classes/blog.php");

# 取得したデータを表示
$blog = new Blog();
$all_blog_data = $blog->getBlogAll();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>BLOG LIST</title>
</head>

<body>
  <h3>BLOG LIST</h3>
  <hr>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>TITLE</th>
      <th>CATEGORY</th>
      <th>DATE_AND_TIME</th>
      <th>DETAIL</th>
      <th>EDIT</th>
      <th>DELETE</th>
    </tr>
    <?php foreach ($all_blog_data as $blog_data) { ?>
      <tr>
        <td><?= $blog->h($blog_data['id']) ?></td>
        <td><?= $blog->h($blog_data['title']) ?></td>
        <td><?= $blog->h($blog_data['category_title']) ?></td>
        <td><?= $blog->h($blog_data['post_at']) ?></td>
        <td><a href="detail.php?id=<?= $blog->h($blog_data['id']) ?>">DETAIL</a></td>
        <td><a href="update_form.php?id=<?= $blog->h($blog_data['id']) ?>">EDIT</a></td>
        <td><a href="../blog_classes/blog_delete.php?id=<?= $blog->h($blog_data['id']) ?>" onclick="return confirm('削除しても宜しいですか ?')">DELETE</a></td>
      </tr>
    <?php } ?>
  </table>
  <hr>
  <a href="./form.php">NEW</a>
</body>

</html>