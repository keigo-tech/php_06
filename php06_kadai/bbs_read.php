<?php
// session_start();
// include("functions.php");
// check_session_id();
// var_dump($_GET);
// exit();

// DB接続
$pdo = connect_to_db();

$user_id = $_SESSION['id'];
// $maxdeta = count($value);
// $maxPage = ceil($maxdeta / 5);

// GETで現在のページ数を取得する（未入力の場合は1を挿入）
if (isset($_GET['page'])) {
	$page = (int)$_GET['page'];
} else {
	$page = 1;
}

// スタートのポジションを計算する
if ($page > 1) {
	// 例：２ページ目の場合は、『(2 × 10) - 10 = 10』
	$start = ($page * 5) - 5;
} else {
	$start = 0;
}





// データ取得SQL作成
// $sql = "SELECT * FROM messages ORDER BY id DESC LIMIT {$start},5";
$sql = "SELECT * FROM messages LEFT OUTER JOIN (SELECT todo_id, COUNT(id) AS cnt FROM like_table GROUP BY todo_id) AS likes ON messages.id = likes.todo_id ORDER BY id DESC LIMIT {$start},5";
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();




// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<div class='msg'>";
    $output .= "<div class='user'>";
    $output .= "<p><span class='name'>{$record['post_user']}</span></p>";
    $output .= "<image src='{$record["userimage"]}' height=50px>";
    $output .= "</div>";
    $output .= "<p>{$record['message']}</p>";
    $output .= "<p class='day'><a href='bbs_read.php?id={$record["id"]}'></a><a href='bbs_delete.php?id={$record["id"]}'style='color:#F33;'>削除</></p>";
    $output .= "<td><a href='like_create.php?user_id={$user_id}&todo_id={$record["id"]}'><i class='fas fa-star'></i>{$record["cnt"]}</a></td>";
    $output .= "</div>";
    // edit deleteリンクを追加
    // $output .= "<td><a href='like_create.php?user_id={$user_id}&todo_id={$record["id"]}'>like{$record["cnt"]}</a></td>";
    // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
    // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
    // $output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}
$_SESSION['page'] = $_GET['page'];
?>
