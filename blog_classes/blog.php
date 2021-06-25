<?php
require_once("dbc.php");
// ini_set('display_errors', "On");

# ブログ専用クラス
class Blog extends Dbc
{
  # Class Dbc からメソッドを継承 テーブル名をblogに定義
  protected $table_name = "blog";

  # ブログ新規作成 (INSERT)
  public function newBlog()
  {
    $id = (int)filter_input(INPUT_POST, "id");
    $title = (string)filter_input(INPUT_POST, "title");
    $content = (string)filter_input(INPUT_POST, "content");
    $category_id = (int)filter_input(INPUT_POST, "category_id");
    $publish_status = (int)filter_input(INPUT_POST, "publish_status");

    $pdo = $this->new_pdo();
    $pdo->beginTransaction();
    try {
      $sql = "insert into $this->table_name(title, content, category_id, publish_status)
   values(:title, :content, :category_id, :publish_status)";

      $ps = $pdo->prepare($sql);
      $ps->bindValue(":title", $title, PDO::PARAM_STR);
      $ps->bindValue(":content", $content, PDO::PARAM_STR);
      $ps->bindValue(":category_id", $category_id, PDO::PARAM_INT);
      $ps->bindValue(":publish_status", $publish_status, PDO::PARAM_INT);

      $ps->execute();
      $pdo->commit();
      echo "ブログを投稿しました。";
    } catch (PDOException $e) {
      $pdo->rollBack();
      error_log("PDOException: " . $e->getMessage());
      exit();
    }
  }

  # ブログのバリデーション
  public function blogValidate()
  {
    $title = (string)filter_input(INPUT_POST, "title");
    $content = (string)filter_input(INPUT_POST, "content");
    $category_id = (int)filter_input(INPUT_POST, "category_id");
    $publish_status = (int)filter_input(INPUT_POST, "publish_status");

    if ($title === "") {
      exit("タイトルを入力して下さい");
    }
    if (mb_strlen($title) > 191) {
      exit("タイトルを191文字以下にして下さい");
    }

    if ($content === "") {
      exit("本文を入力して下さい");
    }
    if ($category_id === 0) {
      exit("カテゴリーは必須です");
    }
    if ($publish_status === 0) {
      exit("公開ステータスは必須です");
    }
  }

  # ブログを更新 (UPDATE)
  public function blogUpdate()
  {
    $title = (string)filter_input(INPUT_POST, "title");
    $content = (string)filter_input(INPUT_POST, "content");
    $category_id = (int)filter_input(INPUT_POST, "category_id");
    $publish_status = (int)filter_input(INPUT_POST, "publish_status");
    $id = (int)filter_input(INPUT_POST, "id");

    $pdo = $this->new_pdo();
    $pdo->beginTransaction();
    try {
      $sql = "update $this->table_name set title = :title, content = :content, category_id = :category_id, publish_status = :publish_status where id = :id";

      $ps = $pdo->prepare($sql);

      $ps->bindValue(":title", $title, PDO::PARAM_STR);
      $ps->bindValue(":content", $content, PDO::PARAM_STR);
      $ps->bindValue(":category_id", $category_id, PDO::PARAM_INT);
      $ps->bindValue(":publish_status", $publish_status, PDO::PARAM_INT);
      $ps->bindValue(":id", $id, PDO::PARAM_INT);

      $ps->execute();
      $pdo->commit();
      echo "ブログを更新しました。";
    } catch (PDOException $e) {
      $pdo->rollBack();
      error_log("PDOException: " . $e->getMessage());
      exit();
    }
  }
}
