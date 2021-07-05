<?php
require_once("../category_classes/category.php");

$category = new Category();
$category_value = $category->getById($id);

// print_r($category_value);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>CATEGORY EDIT</title>
</head>

<body>
  <h3>CATEGORY EDIT</h3>
  <hr>
  <form action="../category_classes/category_update.php" method="post">
    <input type="hidden" name="id" value="<?= $category->h($category_value['id']) ?>">
    <p>ID: <?= $category->h($category_value['id']) ?></p>
    <p>CATEGORY: <input type="text" name="title" value="<?= $category->h($category_value['title']) ?>"></p>
    <p><input type="submit" value="SAVE"></p>
  </form>
  <hr>
  <a href="index.php">BACK</a>
</body>

</html>