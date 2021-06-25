<?php
require_once("category.php");

$category = new Category();
$category->categoryValidate();
$category->categoryUpdate();

?>
