<?php
//  $err['login_id'] = 'aaaaaa';
//  $err['pass'] = 'ああああああ';
////  $err['pass'] = 'ああああああ';
//  $err['credit'] = 'ああああああ';
//  $err['expiration'] = 'ああああああ';
//  $err['security'] = 'ああああああ';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>HALlow Music</title>
  <meta name="description" content="サイトキャプションを入力">
  <meta name="keywords" content="サイトキーワードを,で区切って入力">
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700&display=swap" rel="stylesheet">
<!--  <link rel="stylesheet" href="css/reset.css">-->
  <link rel="stylesheet" href="css/before.css">
  <link rel="stylesheet" href="css/flame.css">
  <script src="js/jquery-3.4.1.min.js" defer></script>
  <script src="js/home.js" defer></script>
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
          <li><a href="#">ホーム</a></li>
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
          <li class="login_btn"><a href="#">ログイン ></a></li>
          <li class="sign_link"><a href="#">新規会員 ></a></li>
        </ul>
      </div>
      <div id="contents">
        <!-- エラー文 -->
        <p class="error"><?php echo $err['top']; ?></p>
        <div class="navBox">
          <p><img src="img/0.jpg"></p>
          <ul>
            <li>HALLow World!!</li>
            <li>ようこそ！<span>音楽</span>の新世界へ！</li>
          </ul>
        </div>
        <?php for($i = 0;$i < 3;$i++){ ?>
          <h2><?php echo $cate[$i]; ?></h2>
          <div class="content">
            <?php for($j = 0;$j < 6;$j++){ ?>
              <div class="box">
                <!-- $ist[$cate[$i]][$j]['id'] = $list['人気'][0]['id'] = $list['人気']の0~6番目に入ってるレコードの['id'] -->
                <p class="juket"><img src="<?php echo UPLOAD_PATH.$list[$cate[$i]][$j]['music_id']; ?>.jpg"></p>
                <ul class="art">
                  <li><a href="./index.php?music_link=<?php echo $list[$cate[$i]][$j]['music_id']; ?>"><?php echo $list[$cate[$i]][$j]['music_name']; ?></a></li>
                  <li><a href="./index.php?artist_link=<?php echo $list[$cate[$i]][$j]['artist_id']; ?>"><?php echo $list[$cate[$i]][$j]['artist_name']; ?></a></li>
                </ul>
                <div class="hover"><a href="./index.php?music_link=<?php echo $list[$cate[$i]][$j]['music_id']; ?>"></a></div>
              </div>
            <?php } ?>
            <div class="more">
              <!-- $more = [new,popular,recommend] -->
              <p><a href="./index.php?link=<?php echo $more[$i]; ?>">></a></p>
            </div>
          </div>
        <?php } ?>
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
<!--
            <tr>
              <td class="err"><?php //echo $err['pass']; ?></td>
            </tr>
-->
            <tr class="title">
              <td colspan="2">クレジットカード登録</td>
            </tr>
            <tr>
              <th>カード番号</th>
              <td><input type="number" maxlength="4" name="credit" value="<?php echo $account['credit']; ?>"></td>
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
              <td><input type="text" name="security"></td>
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

    </div>
  </body>
</html>
