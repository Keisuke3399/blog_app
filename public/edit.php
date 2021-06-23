<?php
require_once("./blog.php");

$blog = new Blog();
$result = $blog->getById($id);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BlogForm</title>
</head>
<body>
    <h2>ブログ更新フォーム</h2>
    <hr>
    <form action="update.php" method="POST">
        <p>ブログタイトル：</p>
        <input type="hidden" name="id" value="<?= $result['id'] ?>">
        <input type="text" name="title" value="<?= $result['title'] ?>">
        <p>ブログ本文：</p>
        <textarea name="content" id="content" cols="30" rows="10"><?= $result['content'] ?></textarea>
        <p>カテゴリ：</p>
        <select name="category" required>
            <option value="1" <?php if($result['category'] === 1) echo "selected" ?>>日常</option>
            <option value="2" <?php if($result['category'] === 2) echo "selected" ?>>プログラミング</option>
        </select>
				<p>
        <input type="radio" name="publish_status" value="1" <?php if($result['publish_status'] === 1) echo "checked" ?>>公開
        <input type="radio" name="publish_status" value="2" <?php if($result['publish_status'] === 2) echo "checked" ?>>非公開
				</p>
        <p><input type="submit" value="送信"></p>
    </form>
</body>
