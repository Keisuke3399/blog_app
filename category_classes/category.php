<?php
require_once("../blog_classes/dbc.php");
// ini_set('display_errors', "On");

# カテゴリー専用クラス
class Category extends Dbc
{
  # Class Dbc からメソッドを継承 テーブル名をblogに定義
  protected $table_name = "categories";

  # ブログ新規作成 (INSERT)
  public function newCategory()
  {
    $id = (int)filter_input(INPUT_POST, "id");
    $title = (string)filter_input(INPUT_POST, "title");

    $pdo = $this->new_pdo();
    $pdo->beginTransaction();

    try {
      $sql = "insert into $this->table_name(id, title) values(:id, :title)";
      $ps = $pdo->prepare($sql);
      $ps->bindValue(":id", $id, PDO::PARAM_INT);
      $ps->bindValue(":title", $title, PDO::PARAM_STR);

      $ps->execute();
      $pdo->commit();
      header("Location: ../category_public/index.php");
    } catch (PDOException $e) {
      $pdo->rollBack();
      error_log("PDOException: " . $e->getMessage());
      exit();
    }
  }

  # カテゴリーのバリデーション
  public function categoryValidate()
  {
    $id = (int)filter_input(INPUT_POST, "id");
    $title = (string)filter_input(INPUT_POST, "title");

    if ($id === 0) {
      exit("IDは必須です");
    }
    if ($title === "") {
      exit("タイトルを入力して下さい");
    }
    if (mb_strlen($title) > 252) {
      exit("タイトルを252文字以下にして下さい");
    }
  }

  # カテゴリーを更新 (UPDATE)
  public function categoryUpdate()
  {
    $id = (int)filter_input(INPUT_POST, "id");
    $title = (string)filter_input(INPUT_POST, "title");

    $pdo = $this->new_pdo();
    $pdo->beginTransaction();
    try {
      $sql = "update $this->table_name set title = :title where id = :id";

      $ps = $pdo->prepare($sql);
      $ps->bindValue(":title", $title, PDO::PARAM_STR);
      $ps->bindValue(":id", $id, PDO::PARAM_INT);
      $ps->execute();
      $pdo->commit();

      header("Location: ../category_public/index.php");
    } catch (PDOException $e) {
      $pdo->rollBack();
      error_log("PDOException: " . $e->getMessage());
      exit();
    }
  }

  # カテゴリー名を表示
  // public function setCategoryName($category_id)
  // {
  //   if ($category_id === 1) {
  //     return "日常";
  //   } elseif ($category_id === 2) {
  //     return "プログラミング";
  //   } else {
  //     return "その他";
  //   }
  // }

}
