<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>HALlow Music</title>
  <meta name="description" content="サイトキャプションを入力">
  <meta name="keywords" content="サイトキーワードを,で区切って入力">
  <link rel="stylesheet" href="../css/reset.css">
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/artist.css">
  <link rel="stylesheet" href="css/flame.css">
  <script src="js/jquery-3.4.1.min.js" defer></script>
  <script src="js/artist.js" defer></script>
  <?php if (empty($_SESSION['login'])) : ?>
    <script src="js/before.js" defer></script>
  <?php else : ?>
    <script src="js/after.js" defer></script>
  <?php endif; ?>
  <style type="text/css">
  </style>
</head>

<body>
  <div class="all">
    <ul class="serch">
      <form action="" method="get" autocomplete="off">
        <li><input type="text" name="search"></li>
        <li><button type="submit">🔍</button></li>
      </form>
    </ul>
    <div class="logo">
      <p><img src="<?php echo UPLOAD_PATH; ?>" height="" width="" alt="ロゴ画像"></p>
    </div>
    <div id="nav_2">
      <p></p>
      <ul class="flex">
        <li class="down"><a href="#">カテゴリ👇</a></li>
        <li><a href="index.php">ホーム</a></li>
        <li><a href="./index.php?link=new">新作</a></li>
        <li><a href="./index.php?link=popular">人気の曲</a></li>
      </ul>
      <ul class="category">
        <li><a href="./index.php?link=HAL">HAL music</a></li>
        <li><a href="./index.php?link=J-POP">JPOP</a></li>
        <li><a href="./index.php?link=K-POP">KPOP</a></li>
        <li><a href="./index.php?link=Rock">Rock</a></li>
        <li><a href="./index.php?link=EDM">EDM</a></li>
      </ul>
    </div>
    <div id="nav">
      <p><img src="img/logo.png"></p>
      <ul>
        <?php if (empty($_SESSION['login'])) : ?>
          <li class="login_btn"><a href="#">ログイン ></a></li>
          <li class="sign_link"><a href="#">新規会員 ></a></li>
        <?php else : ?>
          <li><a href="./index.php?my_music=''">マイミュージック ></a></li>
          <li><a href="./index.php?point=''">ポイント購入 ></a></li>
          <li><a href="#" class="logout_btn">ログアウト ></a></li>
        <?php endif; ?>
      </ul>
    </div>
    <div id="contents">
      <!-- $artist[] = リンク押してGETで飛ばしたartistIDのレコード配列 -->
      <div class="artist_img">
        <p><img src="<?php echo UPLOAD_PATH . $artist['name']; ?>.jpg" alt="アーティスト画像"></p>
        <div class="bg">
          <div class="name">
            <p><?php echo $artist['name']; ?></p>
          </div>
          <div class="profile">
            <p><?php echo $artist['profile']; ?></p>
          </div>
        </div>
      </div>
      <div class="left">
        <p><a href="#">
            <</a> </p> </div> <div class="right">
              <p><a href="#">></a></p>
      </div>
      <div class="hot">
        <p class="hot_music">人気曲</p>
        <ul class="music">
          <?php foreach ($artist_music as $foreach) : ?>
            <li><a href="./index.php?music_link=<?php echo $foreach['music_id']; ?>"><?php echo $foreach['music_name']; ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="b_tri">
      </div>
      <div class="tri">
      </div>
      <div class="box">
      </div>
    </div>

    <div id="login">
      <form action="" method="post" autocomplete="off">
        <table>
          <tr class="l_logo">
            <th colspan="2"><img src="img/logo1.png"></th>
          </tr>
          <tr class="form">
            <th class="a">ID</th>
            <td><input type="text" name="login_id_use" value="<?php echo $login_id_use; ?>"></td>
          </tr>
          <tr class="form">
            <th class="a">パスワード</th>
            <td><input type="password" name="pass_use"></td>
          </tr>
          <tr class="err">
            <td colspan="2"><?php echo $err['login']; ?></td>
          </tr>
          <tr class="btn">
            <td class="cansel"><a href="#">キャンセル</a></td>
            <td><button type="submit" value="login" name="login">ログイン</button></td>
          </tr>
        </table>
      </form>
    </div>
    <div id="signup">
      <form action="" method="post" autocomplete="off">
        <p class="sign_logo"><img src="img/logo1.png"></p>
        <table>
          <tr>
            <th>ID</th>
            <td><input type="text" name="login_id" value="<?php echo $account['login_id']; ?>"></td>
          </tr>
          <tr>
            <td class="err"><?php echo $err['login_id']; ?></td>
          </tr>
          <tr>
            <th>パスワード</th>
            <td><input type="password" name="pass1"></td>
          </tr>
          <tr>
            <td class="err"><?php echo $err['pass']; ?></td>
          </tr>
          <tr>
            <th>パスワード(再確認)</th>
            <td><input type="password" name="pass2"></td>
          </tr>
          <tr class="title">
            <td colspan="2">クレジットカード登録</td>
          </tr>
          <tr>
            <th>カード番号</th>
            <td><input type="text" name="credit" value="<?php echo $account['credit']; ?>"></td>
          </tr>
          <tr>
            <td class="err"><?php echo $err['credit']; ?></td>
          </tr>
          <tr>
            <th>有効期限</th>
            <td><input type="text" name="expiration" value="<?php echo $account['expiration']; ?>"></td>
          </tr>
          <tr>
            <td class="err"><?php echo $err['expiration']; ?></td>
          </tr>
          <tr>
            <th>セキュリティコード</th>
            <td><input type="text" name="security" value="<?php echo $account['security']; ?>"></td>
          </tr>
          <tr>
            <td class="err"><?php echo $err['security']; ?></td>
          </tr>
        </table>
        <ul class="sign_btn">
          <li class="cansel_btn"><a href="#">キャンセル</a></li>
          <li><button type="submit" value="confirmation" name="submit">次へ</button></li>
        </ul>
      </form>
    </div>
    <div class="logout">
      <div class="logout_flame">
        <div class="logout_text">
          <h2>ログアウトしますか？</h2>
          <ul>
            <li class="logout_cancel"><a href="#">いいえ</a></li>
            <li><a href="./index.php?logout=''">はい</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</body>

</html>