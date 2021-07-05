<?php
require_once("../blog_classes/blog.php");

$blog = new Blog();
$blog_data = $blog->getById($id);

# SELECTタグのカテゴリを表示するためBloc classにメソッド追加
$categories = $blog->getCategoryAll();

// print_r($blog_data);
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
  <p>ID: <?= $blog->h($blog_data['id']) ?></p>
  <h3>TITLE：<?= $blog->h($blog_data['title']) ?></h3>
  <p>投稿日時：<?= $blog->h($blog_data['post_at']) ?></p>
  <p>CATEGORY：
    <select name="category_id">
      <?php foreach ($categories as $category) { ?>
        <!-- 三項演算子 -->
        <option value="<?= $blog->h($category['id']) ?>"
        <?= $blog->h($category["id"]) ===
        $blog->h($blog_data["category_id"]) ? "selected" : "" ?> hidden>
          <?= $blog->h($category['title']) ?>
        </option>
      <?php } ?>
    </select>
    <hr>
  <p>本文：<?= $blog->h($blog_data['content']) ?></p>
  <hr>
  <p><a href="./index.php">BACK</a></p>
</body>

</html>