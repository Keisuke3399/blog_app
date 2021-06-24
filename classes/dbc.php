<?php
require_once("env.php");

class Dbc
{
  # テーブル名 プロパティー
  protected $table_name;

  # DB接続 メソッド
  protected function new_pdo()
  {
    $host   = DB_HOST;
    $dbname = DB_NAME;
    $user   = DB_USER;
    $pass   = DB_PASS;
    try {
      $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
      ];
      $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass", $options);
    } catch (PDOException $e) {
      error_log("PDOException: " . $e->getMessage());
      exit();
    }
    return $pdo;
  }

  # htmlspecialchars の省略 method
  public function h($str)
  {
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
  }

  # 全データ取得 (SELECT)
  public function getAll()
  {
    $pdo = $this->new_pdo();

    // SQL準備
    $sql = "select * from $this->table_name";
    // SQL実行
    $st = $pdo->query($sql);
    // SQL結果受け取る
    $result = $st->fetchAll();
    return $result;
    exit();
  }

  # IDを元にデータ1件取得 (SELECT) 「プリペアドステートメント」詳細
  public function getById($id)
  {
    $id = (int)filter_input(INPUT_GET, "id");
    if ($id === 0) {
      exit("IDが不正です");
    }
    // DB接続
    $pdo = $this->new_pdo();
    // SQL準備 (プリペアドステートメント)
    $sql = "select * from $this->table_name where id = :id";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(":id", $id, PDO::PARAM_INT);
    // SQL実行
    $ps->execute();
    // 結果を取得
    $result = $ps->fetch();
    if ($result === false) {
      exit('ブログがありません。');
    }
    return $result;
    exit();
  }

  # IDを元にデータ1件削除 (DELETE) 「プリペアドステートメント」詳細
  public function delete($id)
  {
    $id = (int)filter_input(INPUT_GET, "id");
    if ($id === 0) {
      exit("IDが不正です");
    }
    // DB接続
    $pdo = $this->new_pdo();
    // SQL準備 (プリペアドステートメント)
    $sql = "delete from $this->table_name where id = :id";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(":id", $id, PDO::PARAM_INT);
    // SQL実行
    $result = $ps->execute();
    echo "ブログを削除しました";
    return $result;
  }

}
