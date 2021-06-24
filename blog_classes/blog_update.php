<?php

require_once("blog.php");

$blog = new Blog();
$blog->blogValidate();
$blog->blogUpdate();

?>
<p><a href="../blog_public/index.php">戻る</a></p>