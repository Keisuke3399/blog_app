<?php
require_once("../blog_classes/blog.php");

$blog = new Blog();
$result = $blog->getById($id);

# SELECTタグのカテゴリを表示するためBloc classにメソッド追加
$categories = $blog->getCategoryAll();

// print_r($result);
// print_r($categories);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>BLOG DETAIL</title>
</head>

<body>
  <h3>BLOG DETAIL</h3>
  <hr>
  <p>ID: <?= $blog->h($result['id']) ?></p>
  <h3>TITLE：<?= $blog->h($result['title']) ?></h3>
  <p>投稿日時：<?= $blog->h($result['post_at']) ?></p>
  <p>CATEGORY：
    <select name="category_id">
      <?php foreach ($categories as $category) { ?>
        <!-- 三項演算子 -->
        <option value="<?= $blog->h($category['id']) ?>"
        <?= $blog->h($category["id"]) ===
        $blog->h($result["category_id"]) ? "selected" : "" ?> hidden>
          <?= $blog->h($category['title']) ?>
        </option>
      <?php } ?>
    </select>
    <hr>
  <p>本文：<?= $blog->h($result['content']) ?></p>
  <hr>
  <p><a href="./index.php">BACK</a></p>
</body>

</html>