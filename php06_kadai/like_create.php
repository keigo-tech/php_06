<?php
// var_dump($_GET);
// exit();

session_start();
include("functions.php");
check_session_id();

$user_id = $_GET['user_id'];
$todo_id = $_GET['todo_id'];

// DB接続
$pdo = connect_to_db();

//いいねしてるか確認する
$sql = 'SELECT COUNT(*) FROM like_table WHERE user_id=:user_id AND todo_id=:todo_id';
//SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_STR);
$status = $stmt->execute();
if($status = false){
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $like_count = $stmt->fetch();
  // var_dump($like_count[0]);
  // exit();
}

if($like_count[0] != 0){
  $sql = 'DELETE FROM like_table WHERE user_id=:user_id AND todo_id=:todo_id';
}else{
  $sql = 'INSERT INTO like_table(id,user_id,todo_id,created_at) VALUES(null,:user_id,:todo_id,sysdate())';
}

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_STR);
$status = $stmt->execute();

if($status == false){
   // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
   $error = $stmt->errorInfo();
   echo json_encode(["error_msg" => "{$error[2]}"]);
   exit();
 } else {
  header('Location:bbs_input.php?page='.$_SESSION['page']);
}

?>
