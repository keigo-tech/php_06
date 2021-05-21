<?php

session_start();
include('functions.php');
include('bbs_read.php');
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM users_table';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ひとこと掲示板</title>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>ひとこと掲示板</h1>
  </div>
  <div id="content">
  	<div style="text-align: right"><a href="bbs_logout.php">ログアウト</a></div>
    <form action="bbs_create.php" method="post">
      <div><input type="text" name="post_user" hidden  value="<?=$_SESSION['username']?>"></div>
      <div><input type="text" name="userimage" hidden  value="<?=$_SESSION['userimage']?>"></div>
      <dl>
        <dt><?=$_SESSION['username']?>さん、メッセージをどうぞ</dt>
        <dt></dt>
        <dd>
          <textarea name="message" cols="50" rows="5"></textarea>
          <!-- <input type="hidden" name="reply_post_id" value="" /> -->
        </dd>
      </dl>
      <div>
        <p>
          <input type="submit" value="投稿する"  />
        </p>
      </div>
    </form>
    <?= $output?>
<ul class="paging">
  <?php if($page > 1):?>
<li><a href="bbs_input.php?page=<?=$page - 1?>">前のページへ</a></li>
  <?php endif;?>
<li><a href="bbs_input.php?page=<?=$page + 1?>">次のページへ</a></li>
</ul>
  </div>
</div>
</body>
</html>
