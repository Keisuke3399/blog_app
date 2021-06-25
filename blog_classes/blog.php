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
      $sql = "insert into $this->table_name( id, title, content, category_id, publish_status)
   values(:id, :title, :content, :category_id, :publish_status)";

      $ps = $pdo->prepare($sql);
      $ps->bindValue(":id", $id, PDO::PARAM_INT);
      $ps->bindValue(":title", $title, PDO::PARAM_STR);
      $ps->bindValue(":content", $content, PDO::PARAM_STR);
      $ps->bindValue(":category_id", $category_id, PDO::PARAM_INT);
      $ps->bindValue(":publish_status", $publish_status, PDO::PARAM_INT);

      $ps->execute();
      $pdo->commit();
      header("Location: ../blog_public/index.php");
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
      header("Location: ../blog_public/index.php");
    } catch (PDOException $e) {
      $pdo->rollBack();
      error_log("PDOException: " . $e->getMessage());
      exit();
    }
  }

  # 全データ取得 (SELECT) 結合
  public function getBlogAll()
  {
    $pdo = $this->new_pdo();
    try {
      // SQL準備 (blogテーブルとcategoriesテーブルを結合)
      $sql = "select bl.id, bl.title, ca.title category_title, bl.post_at from blog bl left join categories ca on bl.category_id = ca.id order by bl.id";
      // SQL実行
      $st = $pdo->query($sql);
      // SQL結果受け取る
      $result = $st->fetchAll();
      return $result;
      exit();
    } catch (PDOException $e) {
      error_log("PDOException: " . $e->getMessage());
      exit();
    }
  }

  # SELECTタグのカテゴリを表示するためBlog classにメソッド追加
  public function getCategoryAll()
  {
    try {
      $pdo = $this->new_pdo();
      $sql = "select id, title from categories order by id";
      $st = $pdo->query($sql);
      $categories = $st->fetchAll();
      return $categories;
    } catch (PDOException $e) {
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
