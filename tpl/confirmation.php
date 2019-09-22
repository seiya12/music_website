<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>HALlow Music</title>
  <meta name="description" content="サイトキャプションを入力">
  <meta name="keywords" content="サイトキーワードを,で区切って入力">
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/confirmation.css">
</head>
<body>
  <div id="signup">
  <form action="" method="post" autocomplete="off">
    <h2 class="sign_logo"><img src="img/logo1.png"></h2>
    <table>
      <tr class="text">
        <td colspan="2">以下の内容でよろしいですか？</td>
      </tr>
      <tr class="value">
        <td>ログインID</td>
        <td><?php echo $_SESSION['login_id']; ?></td>
      </tr>
      <!--
      <tr class="value">
        <td>パスワード</td>
        伏字とか任せます
        <td><?php //echo $_SESSION['pass']; ?></td>
      </tr>
-->
      <tr class="value">
        <td>カード番号</td>
        <td><?php echo $_SESSION['credit']; ?></td>
      </tr>
      <tr class="value">
        <td>有効期限</td>
        <td><?php echo $_SESSION['expiration']; ?></td>
      </tr>
      <tr class="value">
        <td>セキュリティコード</td>
        <td><?php echo $_SESSION['security']; ?></td>
      </tr>
    </table>
    <ul>
      <li class="sign_btn"><button type="submit" value="signup_back" name="back"><span>いいえ</span></button></li>
      <li class="sign_btn"><button type="submit" value="registration" name="submit"><span>はい</span></button></li>
    </ul>

  </form>
  </div>
</body>

</html>