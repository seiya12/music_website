
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>HALlow Music</title>
  <meta name="description" content="サイトキャプションを入力">
  <meta name="keywords" content="サイトキーワードを,で区切って入力">
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/point.css">
</head>

<body>
  <div id="contents">
  <form action="" method="post" autocomplete="off">
    <h2><img src="img/logo1.png"></h2>
    <table>
      <tr>
        <td colspan="2">ポイント購入</td>
      </tr>
      <tr>
        <th>購入するポイント<br>
        <td class="num1"><input type="number" name="point" size="5">P</td>
      </tr>
      <tr>
        <th>カード番号</th>
        <!-- ログイン状態のユーザに紐づいたクレジット番号表示 -->
        <!-- ログインした時に$_SESSION['user']にuserテーブルの列入ってるイメージ（任せます） -->
        <td><?php echo $row['credit']; ?></td>
      </tr>
      <tr>
        <th>セキュリティコード</th>
        <!-- 合ってたら購入できる -->
        <td class="num2"><input type="number" name="security_use"></td>
      </tr>
      <tr class="err">
        <td colspan="2"><?php echo $err['security_use']; ?></td>
      </tr>
    </table>
    <ul>
      <li><a href="index.php">キャンセル</a></li>
      <li><button type="submit" value="buy_point" name="buy">購入</button></li>
    </ul>
  </form>
  </div>
</body>

</html>