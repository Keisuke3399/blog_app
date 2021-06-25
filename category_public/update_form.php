<?php
require_once("../category_classes/category.php");

$category = new Category();
$result = $category->getById($id);

// print_r($result);
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
    <input type="hidden" name="id" value="<?= $category->h($result['id']) ?>">
    <p>ID: <?= $category->h($result['id']) ?></p>
    <p>CATEGORY: <input type="text" name="title" value="<?= $category->h($result['title']) ?>"></p>
    <p><input type="submit" value="SAVE"></p>
  </form>
  <hr>
  <a href="index.php">BACK</a>
</body>

</html>