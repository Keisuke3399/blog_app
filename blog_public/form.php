<?php
require_once("../category_classes/category.php");

# SELECTタグにカテゴリーを記述する為、クラスCategory呼び出し
$category = new Category;
$categories = $category->getAll();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>Blog NEW</title>
</head>

<body>
  <h2>BLOG NEW</h2>
  <hr>
  <form action="../blog_classes/blog_create.php" method="POST">
    <p>BLOG ID：</p>
    <input type="number" name="id">
    <p>BLOG TITLE：</p>
    <input type="text" name="title">
    <p>BLOG CONTENT：</p>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
    <p>CATEGORY：</p>
    <select name="category_id">
      <option value="">---</option>
      <?php foreach ($categories as $category) { ?>
        <option value="<?= htmlspecialchars($category['id']) ?>">
          <?= htmlspecialchars($category['title']) ?>
        </option>
      <?php } ?>
    </select>
    <p>
      <input type="radio" name="publish_status" value="1" checked>Release
      <input type="radio" name="publish_status" value="2">Private
    </p>
    <p><input type="submit" value="SEND"></p>
  </form>
  <p><a href="index.php">BACK</a></p>
</body>

</html>