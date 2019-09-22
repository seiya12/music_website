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
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="css/flame.css">
  <link rel="stylesheet" href="css/after.css">  
  <script src="js/jquery-3.4.1.min.js" defer></script>
  <script src="js/mymusic.js" defer></script>
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
          <li><a href="./index.php?my_music=''">マイミュージック</a></li>
          <li><a href="./index.php?point=''">ポイント購入 ></a></li>
          <li class="logout_btn"><a href="#">ログアウト ></a></li>
        </ul>
      </div>
      <div id="contents">
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
      <div class="logout">
      <div class="logout_flame">
        <div class="logout_text">
          <h2>ログアウトしますか？</h2>
          <ul>
            <li  class="logout_cancel"><a href="#">いいえ</a></li>
            <li><a href="./index.php?logout=''">はい</a></li>
          </ul>
        </div>
      </div>
    </div>
    </div>
  </body>
</html>
