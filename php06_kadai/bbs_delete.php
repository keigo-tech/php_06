<?php

// 送信データのチェック
session_start();
// 関数ファイルの読み込み
include("functions.php");
check_session_id();
// var_dump($_SESSION);
// exit();

// 送信データ受け取り
$id = $_GET["id"];

// DB接続
$pdo = connect_to_db();

// DELETE文を作成&実行
$sql = "DELETE FROM messages WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header('Location:bbs_input.php?page='.$_SESSION['page']);
  exit();
}
