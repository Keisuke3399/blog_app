<?php
require_once("img.php");
// var_dump(get_included_files());
// die("debug");
$img = new Img();

//ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = "../file_public/images";
$save_filename = date("Ymd-His-") . $filename;
$err_msgs = [];
$save_path = $upload_dir . $save_filename;
//キャプション(説明文)を取得
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);

//キャプション(説明文)のバリデーション
//未入力
if (empty($caption)) {
  array_push($err_msgs, "キャプションを入力してください。");
  echo "<br>";
}
//140文字か
if (strlen($caption) > 140) {
  array_push($err_msgs, "キャプションは140文字以内で入力してください");
  echo "<br>";
}
//ファイルのバリデーション
//ファイルサイズが1MB未満か
if ($filesize > 1048576 || $file_err == 2) {
  array_push($err_msgs, "ファイルサイズは1MB未満にしてください");
  echo "<br>";
}
//拡張は画像形式か
$allow_ext = ['jpg', 'jpeg', 'png'];
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);
if (!in_array(strtolower($file_ext), $allow_ext)) {
  array_push($err_msgs, "画像ファイルを添付してください");
  echo "<br>";
}

if (count($err_msgs) === 0) {
  //ファイルはあるかどうか？
  if (is_uploaded_file($tmp_path)) {
    //ファイルをディレクトリに保存
    if (move_uploaded_file($tmp_path, $upload_dir . $save_filename)) {
      echo $filename . 'を' . $upload_dir . 'にアップしました。';
      //DBに保存（ファイル名、ファイルパス、キャプション）
      $result = $img->fileSave($filename, $save_path, $caption);
      if ($result) {
        echo "データベースに保存しました。";
      } else {
        echo "データベースに保存できませんでした。";
      }
    } else {
      echo "ファイルが保存できませんでした。";
    }
  } else {
    echo "ファイルが選択されていません";
    echo "<br>";
  }
} else {
  foreach ($err_msgs as $msg) {
    echo $msg;
    echo "<br>";
  }
}
?>
<a href="../file_public/upload_form.php">BACK</a>