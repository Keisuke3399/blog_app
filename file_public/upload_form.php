<?php
require_once("../file_classes/img.php");

$img = new Img();
$images = $img->getAll();
// print_r($result);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UPLOAD FORM</title>
</head>
<style>
  body {
    padding: 30px;
    margin: 0 auto;
    width: 50%;
  }

  textarea {
    width: 98%;
    height: 60px;
  }

  .file-up {
    margin-bottom: 10px;
  }

  .submit {
    text-align: right;
  }

  .btn {
    display: inline-block;
    border-radius: 3px;
    font-size: 18px;
    background: #67c5ff;
    border: 2px solid #67c5ff;
    padding: 5px 10px;
    color: #fff;
    cursor: pointer;
  }
</style>

<body>
  <form enctype="multipart/form-data" action="../file_classes/file_upload.php" method="POST">
    <div class="file-up">
      <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
      <input name="img" type="file" accept="image/*" />
    </div>
    <div>
      <textarea name="caption" placeholder="キャプション（140文字以下）" id="caption"></textarea>
    </div>
    <div class="submit">
      <input type="submit" value="送信" class="btn" />
    </div>
  </form>
  <div>
    <?php foreach ($images as $image) { ?>
      <p><img src="<?= $img->h($image['file_path']) ?>" alt=""></p>
      <p><?= $img->h($image['caption']) ?></p>
    <?php } ?>
  </div>
</body>

</html>