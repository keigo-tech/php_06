<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>

	<link rel="stylesheet" href="style.css" />
</head>
<body>
<div id="wrap">
<div id="head">
<h1>会員登録</h1>
</div>

<div id="content">
<p>次のフォームに必要事項をご記入ください。</p>
<form action="bbs_register_act.php" method="post" enctype="multipart/form-data">
	<dl>
		<dt>ニックネーム<span class="required">必須</span></dt>
		<dd>
          <input type="text" name="username" size="35" maxlength="255"/>
		</dd>
		<dt>パスワード<span class="required">必須</span></dt>
		<dd>
          <input type="password" name="password" size="10" maxlength="20" value="" />
        </dd>
		<dd>
		<input type="file" name="upfile" accept="image/*"capture="camera">
        </dd>
	</dl>
	<div><input type="submit" value="新規登録" /></div>
</form>
<div>
      <p>&raquo;<a href="bbs_login.php">登録済みの方はこちら</a></p>
    </div>
</div>
</body>
</html>
