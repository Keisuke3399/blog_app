<?php
require_once("./blog.php");

$blog = new Blog();
$result = $blog->getById($id);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>BLOG DETAIL</title>
</head>
<body>
  <h3>ブログ詳細</h3>
  <hr>
  <h3>タイトル：<?= $result['title'] ?></h3>
  <p>投稿日時：<?= $result['post_at'] ?></p>
  <p>カテゴリ：<?= $blog->setCategoryName($column['category']) ?></p>
  <hr>
  <p>本文：<?= $result['content'] ?></p>
</body>

</html>