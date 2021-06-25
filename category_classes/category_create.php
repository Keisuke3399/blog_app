<?php
require_once("category.php");

$Category = new Category();
$Category->CategoryValidate();
$Category->newCategory();

?>