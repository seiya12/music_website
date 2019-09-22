<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>HALlow Music</title>
  <meta name="description" content="サイトキャプションを入力">
  <meta name="keywords" content="サイトキーワードを,で区切って入力">
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="css/flame.css">
  <link rel="stylesheet" href="css/mymusic.css">
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
      <!-- $my_music[] = ログインしてるユーザの購入した曲 -->
      <h2>マイミュージック</h2>
      <div class="content">
        <?php foreach ($my_music as $music) : ?>
          <div class="box">
            <p class="juket"><img src="<?php echo UPLOAD_PATH . $music['music_id']; ?>.jpg"></p>
            <ul class="art">
              <li><a href="./index.php?music_link=<?php echo $music['music_id']; ?>"><?php echo $music['music_name']; ?></a></li>
              <li><a href="./index.php?artist_link=<?php echo $music['artist_id']; ?>"><?php echo $music['artist_name']; ?></a></li>
            </ul>
            <div class="hover"><a href="./index.php?my_music=<?php echo $music['music_id']; ?>"></a></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="play_music">
      <?php if (!is_numeric($_GET['my_music'])) : ?>
        <!-- なんも指定されてない状態 -->
        <p><img src="img/none_music.png"></p>
        <ul class="play_text">
          <li>-----</li>
          <li>-----</li>
        </ul>
      <?php else : ?>
        <p><img src="<?php echo UPLOAD_PATH . $select_music['music_id']; ?>.jpg"></p>
        <p><audio src="<?php echo MUSIC_PATH . $select_music['music_id']; ?>.mp3" controls></audio></p>
        <ul class="play_text">
          <li><?php echo $select_music['music_name']; ?></li>
          <li><?php echo $select_music['artist_name']; ?></li>
        </ul>
      <?php endif; ?>
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