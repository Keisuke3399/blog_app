<?php

require_once("blog.php");

$blog = new Blog();
$blog->blogValidate();
$blog->newBlog();

?>
<p><a href="../public/index.php">戻る</a></p>
