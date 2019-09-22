<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>HALlow Music</title>
  <meta name="description" content="サイトキャプションを入力">
  <meta name="keywords" content="サイトキーワードを,で区切って入力">
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="css/buy.css">
  </head>
<body>
  <div id="back">
    <div id="contents">
      <h2><img src="<?php echo UPLOAD_PATH.$buy_music['music_id']; ?>.jpg" alt="曲画像"></h2>
      <ul class="title">
        <li><?php echo $buy_music['music_name']; ?></li>
        <li><a href="./index.php?artist_link=<?php echo $buy_music['artist_id']; ?>">(<?php echo $buy_music['artist_name']; ?>)</a></li>
      </ul>
      <ul class="point">
        <li>ポイント残高</li>
        <li><?php echo $user['point']; ?>P</li>
      </ul>
      <ul class="value">
        <li>価格</li>
        <li><?php echo $buy_music['price']; ?>P</li>
      </ul>
    <!-- javascriptよろしく -->
      <ul class="after">
        <li>購入後のポイント</li>
        <li><?php echo $user['point'] - $buy_music['price']; ?>P</li>
      </ul>
      <ul class="category">
        <li><a href="./index.php?music_link=<?php echo $buy_music['music_id']; ?>">キャンセル</a></li>
        <li><a href="./index.php?buy_complete=<?php echo $buy_music['music_id']; ?>">購入</a></li>
      </ul>
    </div>
  </div>
</body>

</html>
