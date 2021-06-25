<?php
require_once("blog.php");

$blog = new Blog();
$blog->blogValidate();
$blog->newBlog();

?>
