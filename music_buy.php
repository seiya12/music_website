<?php
if (isset($_GET['buy_complete'])) {
  //データベースに接続する
  $cn = new mysqli(HOST, DB_USER, DB_PASS, DB_NAME);

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  //文字コードをセット
  $cn->set_charset("utf-8");
  $user_id = $cn->real_escape_string($_SESSION['login']);
  $music_id = $cn->real_escape_string($_GET['buy_complete']);

  $query = "SELECT point FROM user WHERE id = $user_id";
  $result = $cn->query($query);
  $row = $result->fetch_assoc();
  $user_point = $row['point'];

  $query = "SELECT price FROM music WHERE id = " . $music_id;
  $result = $cn->query($query);
  $row = $result->fetch_assoc();
  $music_price = $row['price'];

  if ($music_price < $user_point) {
    $query = "INSERT INTO buy(user_id,music_id) VALUES(" . $user_id . "," . $music_id . ")";
    $result = $cn->query($query);
    $query = "UPDATE user SET point = point-$music_price WHERE id = $user_id";
    $result = $cn->query($query);
    //データベースを切断
    $cn->close();
    header('location:index.php');
    exit();
  } else {
    header('location:point.php');
    exit();
  }
}
