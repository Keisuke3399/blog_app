<?php
require_once("../classes/blog.php");

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
  <h3>タイトル：<?= h($result['title']) ?></h3>
  <p>投稿日時：<?= h($result['post_at']) ?></p>
  <p>カテゴリ：<?= h($blog->setCategoryName($column['category'])) ?></p>
  <hr>
  <p>本文：<?= h($result['content']) ?></p>
  <p><a href="index.php">戻る</a></p>
</body>
</html>