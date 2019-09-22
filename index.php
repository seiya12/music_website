<?php
session_start();
ini_set('session.entropy_file', '/dev/urandom');
ini_set('session.entropy_length', '32');
require_once 'config.php';
require_once 'func.php';

$err['top'] = '';

//  初期化

// $_POST['login_id'] = '';
// $_POST['name'] = '';
// $_POST['tel'] = '';
// $_POST['mail'] = '';
// $_POST['credit'] = '';
// $_POST['expiration'] = '';
// $_POST['security'] = '';
// $_POST['login_id_use'] = '';

// $err['login_id'] = '';
// $err['pass'] = '';
// $err['name'] = '';
// $err['tel'] = '';
// $err['mail'] = '';
// $err['credit'] = '';
// $err['expiration'] = '';
// $err['security'] = '';
// $err['login'] = '';
// loginチェック用
// $_SESSION['login'] = 3;

// ログイン状態チェック
if (empty($_SESSION['login'])) {
  // ログインしていないトップ
  require 'login.php';
  require 'signup.php';
}

//検索結果を表示
if(!empty($_GET['search'])){
  $music_list = [];
  $category = '検索結果';
  //データベースに接続する
  $cn = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  //文字コードをセット
  mysqli_set_charset($cn, 'utf8');
  //SQL
  $sql = "SELECT artist.name AS artist_name,artist.id AS artist_id,music.id AS music_id,music.name AS music_name
  FROM artist
  INNER JOIN author ON artist.id = author.artist_id
  INNER JOIN music ON author.music_id = music.id
  WHERE artist.name LIKE '%".$_GET['search']."%' OR music.name LIKE '%".$_GET['search']."%'";
  $result = mysqli_query($cn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $music_list[] = $row;
  }
  //データベースを切断
  mysqli_close($cn);
  require 'tpl/category.php';
  exit;

}

// トップページとナビのカテゴリー検索
if (!empty($_GET['link'])) {
  $link = $_GET['link'];
  $music_list = [];
  $sql =
    "SELECT artist.name AS artist_name,artist.id AS artist_id,music.id AS music_id,music.name AS music_name
    FROM artist
    INNER JOIN author ON artist.id = author.artist_id
    INNER JOIN music ON author.music_id = music.id ";
  if ($link != 'new' && $link != 'popular' && $link != 'recommend') {
    $sql .=
      "WHERE category = '" . $link . "';";
    $category = $link;
  } elseif ($link == 'new') {
    $sql .=
      "ORDER BY release_date DESC
    LIMIT 18;";
    $category = '新作';
  } elseif ($link == 'popular') {
    $sql .=
      "INNER JOIN buy ON music.id = buy.music_id
    GROUP BY buy.music_id
    ORDER BY COUNT(*) DESC
    LIMIT 18;";
    $category = '人気';
  } elseif ($link == 'recommend') {
    $sql .=
      "ORDER BY RAND()
    LIMIT 18;";
    $category = 'おすすめ';
  }
  $cn = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
  mysqli_set_charset($cn, 'utf8');
  $result = mysqli_query($cn, $sql);
  mysqli_close($cn);

  while ($row = mysqli_fetch_assoc($result)) {
    $music_list[] = $row;
  }
  require 'tpl/category.php';
  exit;
}

if(!empty($_GET['logout'])){
  session_destroy();
  header('location:index.php');
  exit();
}

// アーティストページ表示
if (!empty($_GET['artist_link'])) {
  $id = $_GET['artist_link'];

  $cn = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
  mysqli_set_charset($cn, 'utf8');
  // アーティスト情報
  $sql =
    "SELECT name,profile
  FROM artist
  WHERE id = " . $id . ";";
  $result = mysqli_query($cn, $sql);
  $artist = mysqli_fetch_assoc($result);
  // アーティストの曲一覧
  $sql =
    "SELECT artist.name AS artist_name,music.id AS music_id,music.name AS music_name
  FROM artist
  INNER JOIN author ON artist.id = author.artist_id
  INNER JOIN music ON author.music_id = music.id
  WHERE artist.id = " . $id . ";";
  $result = mysqli_query($cn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $artist_music[] = $row;
  }

  mysqli_close($cn);
  require 'tpl/artist.php';
  exit;
}


// ミュージックページ表示
if (!empty($_GET['music_link'])) {
  $id = $_GET['music_link'];

  $cn = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
  mysqli_set_charset($cn, 'utf8');
  // 曲情報
  $sql =
    "SELECT artist.name AS artist_name,artist.id AS artist_id,music.id AS music_id,music.name AS music_name,category,time,price,release_date
  FROM artist
  INNER JOIN author ON artist.id = author.artist_id
  INNER JOIN music ON author.music_id = music.id
  WHERE music_id = " . $id . ";";
  $result = mysqli_query($cn, $sql);
  $music_data = mysqli_fetch_assoc($result);
  mysqli_close($cn);
  require 'tpl/music.php';
  exit;
}

// マイミュージックページ表示
// ログインチェック
if (!empty($_SESSION['login'])) {
 if (!empty($_GET['my_music'])) {
   // ログイン状態のID
   $id = $_SESSION['login'];
   $cn = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
   mysqli_set_charset($cn, 'utf8');
   // ユーザが購入した曲
   $sql =
     "SELECT artist.name AS artist_name,artist.id AS artist_id,music.id AS music_id,music.name AS music_name
   FROM artist
   INNER JOIN author ON artist.id = author.artist_id
   INNER JOIN music ON author.music_id = music.id
   INNER JOIN buy ON music.id = buy.music_id
   INNER JOIN user ON buy.user_id = user.id
   WHERE user_id = ".$id.";";
   $result = mysqli_query($cn, $sql);
   $my_music = array();
   while ($row = mysqli_fetch_assoc($result)) {
     $my_music[] = $row;
   }
   // 曲選択されていた場合
   if ($_GET['my_music'] != '') {
     $sql =
       "SELECT artist.name AS artist_name,artist.id AS artist_id,music.id AS music_id,music.name AS music_name
       FROM artist
       INNER JOIN author ON artist.id = author.artist_id
       INNER JOIN music ON author.music_id = music.id
       WHERE music_id = ".$_GET['my_music'].";";

     $result = mysqli_query($cn, $sql);
     $select_music = mysqli_fetch_assoc($result);
   }
   mysqli_close($cn);
   require 'tpl/mymusic.php';
   exit;
 }
}



//　購入ページ表示
if (!empty($_SESSION['login'])) {
  // ログインしてたらbuy.phpに
  if (!empty($_GET['buy_link'])) {
    $cn = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
    mysqli_set_charset($cn, 'utf8');

    $sql ="SELECT artist.name AS artist_name,artist.id AS artist_id,music.id AS music_id,music.name AS music_name,price
    FROM artist
    INNER JOIN author ON artist.id = author.artist_id
    INNER JOIN music ON author.music_id = music.id
    WHERE music_id = ".$_GET['buy_link'].";";

    $result = mysqli_query($cn, $sql);
    $buy_music = mysqli_fetch_assoc($result);

    $sql = "SELECT point
    FROM user
    WHERE id = ".$_SESSION['login'].";";

    $result = mysqli_query($cn, $sql);
    $user = mysqli_fetch_assoc($result);

    mysqli_close($cn);

    require 'tpl/buy.php';
    exit;
  }
}
else {
  $err['top'] = '購入するにはログインしてください。';
}

if(!empty($_SESSION['login'])){
  require 'music_buy.php';
}

// ポイント購入表示
if (!empty($_GET['point'])) {
 if (!empty($_SESSION['login'])) {
   require 'point.php';
   exit;
 }
}

// トップページ表示
$err['top'] = '';
$cate = ['ニューリリース', '人気', 'おすすめ'];
$more = ['new', 'popular', 'recommend'];
// SQLテンプレ
$sql =
  "SELECT artist.name AS artist_name,artist.id AS artist_id,music.id AS music_id,music.name AS music_name
FROM artist
INNER JOIN author ON artist.id = author.artist_id
INNER JOIN music ON author.music_id = music.id ";

// それぞれの項目の$listに格納していく
$cn = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($cn, 'utf8');

// 新作
$sqln = $sql .
  "ORDER BY release_date DESC
LIMIT 6;";

$result = mysqli_query($cn, $sqln);
while ($row = mysqli_fetch_assoc($result)) {
  $list['ニューリリース'][] = $row;
}

// 人気
$sqlp = $sql .
  "INNER JOIN buy ON music.id = buy.music_id
GROUP BY buy.music_id
ORDER BY COUNT(*) DESC
LIMIT 6;";

$result = mysqli_query($cn, $sqlp);
while ($row = mysqli_fetch_assoc($result)) {
  $list['人気'][] = $row;
}

// おすすめ
$sqlr = $sql .
  "ORDER BY RAND()
LIMIT 6;";

$result = mysqli_query($cn, $sqlr);
while ($row = mysqli_fetch_assoc($result)) {
  $list['おすすめ'][] = $row;
}
mysqli_close($cn);
// ログイン状態チェック
if (!empty($_SESSION['login'])) {
  require 'tpl/after.php';
  exit;
} else {
  // ログインしていないトップ
  require 'tpl/before.php';
  exit;
}
