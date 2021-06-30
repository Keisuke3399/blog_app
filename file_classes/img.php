<?php
require_once("../blog_classes/dbc.php");
// var_dump(get_included_files());gf cx
// die("debug");
# 画像アップロード専用クラス
class Img extends Dbc
{
  # Class Dbc からメソッドを継承 テーブル名をfile_tableに定義
  protected $table_name = "file_table";

  /**
   * ファイルデータを保存(INSERT)
   * @param string $filename ファイル名
   * @param string $save_path 保存先のパス
   * @param string $caption 投稿の説明
   * @return bool $result
   */
  function fileSave($filename, $save_path, $caption)
  {
    $result = false;

    $pdo = $this->new_pdo();
    $pdo->beginTransaction();
    $sql = "insert into $this->table_name (file_name, file_path, caption) values(?, ?, ?)";
    try {
      $ps = $pdo->prepare($sql);
      $ps->bindValue(1, $filename);
      $ps->bindValue(2, $save_path);
      $ps->bindValue(3, $caption);
      $result = $ps->execute();
      $pdo->commit();
      // header("Location ../file_public/upload_form.php");
      return $result;
    } catch (PDOException $e) {
      $pdo->rollBack();
      error_log("PDOException: " . $e->getMessage());
      return $result;
    }
  }
}
