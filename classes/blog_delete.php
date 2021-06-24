<?php

require_once("blog.php");

$blog = new Blog();
$result = $blog->delete($id);

?>
<p><a href="../public/index.php">戻る</a></p>