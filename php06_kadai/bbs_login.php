<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css" />
  <title>todoリストログイン画面</title>
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>ログインする</h1>
  </div>
  <div id="content">
    <div id="lead">
      <p>メールアドレスとパスワードを記入してログインしてください。</p>
      <p>入会手続きがまだの方はこちらからどうぞ。</p>
      <p>&raquo;<a href="bbs_register.php">入会手続きをする</a></p>
    </div>
    <form action="bbs_login_act.php" method="post">
      <dl>
        <dt>ニックネーム</dt>
        <dd>
          <input type="text" name="username" size="35" maxlength="255">
        </dd>
        <dt>パスワード</dt>
        <dd>
          <input type="password" name="password" size="35" maxlength="255">
        </dd>
      </dl>
      <div>
        <input type="submit" value="ログイン" />
      </div>
    </form>
  </div>
</div>
</body>

</html>
