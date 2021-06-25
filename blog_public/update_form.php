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
  <title>BLOG EDIT</title>
</head>

<body>
  <h2>BLOG EDIT</h2>
  <hr>
  <form action="../blog_classes/blog_update.php" method="POST">
    BLOG ID：
    <input type="hidden" name="id" value="<?= $blog->h($result['id']) ?>">
    <?= $blog->h($result['id']) ?>
    <p>BLOG TITLE：</p>
    <input type="text" name="title" value="<?= $blog->h($result['title']) ?>">
    <p>BLOG CONTENT：</p>
    <textarea name="content" id="content" cols="30" rows="10">
    <?= $blog->h($result['content']) ?></textarea>
    <p>CATEGORY：</p>
    <select name="category_id">
      <?php foreach ($categories as $category) { ?>
        <!-- 三項演算子 -->
        <option value="<?= $blog->h($category['id']) ?>" 
          <?= $blog->h($category["id"]) === $blog->h($result["category_id"]) ? "selected" : "" ?>>
          <?= $blog->h($category['title']) ?>
        </option>
      <?php } ?>
    </select>
    <p>
      <input type="radio" name="publish_status" value="1"
          <?php if ($result['publish_status'] === 1) echo "checked" ?>>Release
      <input type="radio" name="publish_status" value="2"
          <?php if ($result['publish_status'] === 2) echo "checked" ?>>Private
    </p>
    <p><input type="submit" value="SAVE"></p>
  </form>
  <p><a href="index.php">BACK</a></p>
</body>

</html>