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
  <title>BLOG EDIT</title>
</head>

<body>
  <h2>BLOG EDIT</h2>
  <hr>
  <form action="../blog_classes/blog_update.php" method="POST">
    BLOG ID：
    <input type="hidden" name="id" value="<?= $blog->h($blog_data['id']) ?>">
    <?= $blog->h($blog_data['id']) ?>
    <p>BLOG TITLE：</p>
    <input type="text" name="title" value="<?= $blog->h($blog_data['title']) ?>">
    <p>BLOG CONTENT：</p>
    <textarea name="content" id="content" cols="30" rows="10">
    <?= $blog->h($blog_data['content']) ?></textarea>
    <p>CATEGORY：</p>
    <select name="category_id">
      <?php foreach ($categories as $category_value) { ?>
        <!-- 三項演算子 -->
        <option value="<?= $blog->h($category_value['id']) ?>" 
          <?= $blog->h($category_value["id"]) === $blog->h($blog_data["category_id"]) ? "selected" : "" ?>>
          <?= $blog->h($category_value['title']) ?>
        </option>
      <?php } ?>
    </select>
    <p>
      <input type="radio" name="publish_status" value="1"
          <?php if ($blog_data['publish_status'] === 1) echo "checked" ?>>Release
      <input type="radio" name="publish_status" value="2"
          <?php if ($blog_data['publish_status'] === 2) echo "checked" ?>>Private
    </p>
    <p><input type="submit" value="SAVE"></p>
  </form>
  <p><a href="index.php">BACK</a></p>
</body>

</html>