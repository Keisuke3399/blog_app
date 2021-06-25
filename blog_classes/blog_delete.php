<?php
require_once("blog.php");

$blog = new Blog();
$result = $blog->delete($id);

header("Location: ../blog_public/index.php");

?>
