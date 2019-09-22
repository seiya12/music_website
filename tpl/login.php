<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>HALlow Music</title>
  <meta name="description" content="サイトキャプションを入力">
  <meta name="keywords" content="サイトキーワードを,で区切って入力">
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/login.css">
</head>
<body>
  <div id="login">
      <form action="" method="post" autocomplete="off">
        <table>
          <tr class="l_logo">
            <th colspan="2">logo</th>
          </tr>
          <tr class="form">
            <th>ID</th>
            <td><input type="text" name="login_id_use" value="<?php echo $_POST['login_id_use']; ?>"></td>
          </tr>
          <tr class="form">
            <th>パスワード</th>
            <td><input type="password" name="pass_use"></td>
          </tr>
          <tr class="err">
            <td colspan="2"><?php echo $err['login']; ?></td>
          </tr>
          <tr class="btn">
            <td class="cansel"><a href="#">キャンセル</a></td>
            <td><button type="submit" value="login">ログイン</button></td>
          </tr>
        </table>
      </form>
    </div>
</body>
</html>