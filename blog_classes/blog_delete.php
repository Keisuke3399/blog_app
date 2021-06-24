<?php

require_once("blog.php");

$blog = new Blog();
$result = $blog->delete($id);

?>
<p><a href="../blog_public/index.php">戻る</a></p>