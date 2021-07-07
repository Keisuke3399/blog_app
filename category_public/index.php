<?php
require_once("../category_classes/category.php");

# 取得したデータを表示
$category = new Category();
$categories = $category->getAll();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>CATEGORIES</title>
</head>

<body>
  <h3>CATEGORIES</h3>
  <hr>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>TITLE</th>
      <th>EDIT</th>
      <th>DELETE</th>
    </tr>
    <?php foreach ($categories as $category_value) { ?>
      <tr>
        <td><?= $category->h($category_value['id']) ?></td>
        <td><?= $category->h($category_value['title']) ?></td>
        <td><a href="update_form.php?id=<?= $category->h($category_value['id']) ?>">EDIT</a></td>
        <td><a href="../category_classes/category_delete.php?id=<?= $category->h($category_value['id']) ?>" onclick="return confirm('削除しても宜しいですか ?')">DELETE</a></td>
      </tr>
    <?php } ?>
  </table>
  <hr>
  <a href="form.html">New</a>
</body>

</html>