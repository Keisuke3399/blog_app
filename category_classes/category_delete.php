<?php

require_once("category.php");

$category = new Category();
$result = $category->delete($id);

header("Location: ../category_public/index.php");

?>