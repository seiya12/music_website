<?php
//ログインしていない場合
if (!isset($_SESSION['login'])) {
  header('location:index.php');
  exit();
}

$err['point']        = '';
$err['security_use'] = '';

if (isset($_POST['buy'])) {
  $point        = $_POST['point'];
  $security_use = $_POST['security_use'];

  if (empty($point)) {
    $err['point'] = '購入したいポイントが入力されていません';
  } elseif (strval($point) != strval(intval($point))) {
    $err['point'] = '購入したいポイントは数字で入力して下さい';
  }

  if (empty($security_use)) {
    $err['security_use'] = 'セキュリティコードが入力されていません';
  }

  if (array_search(!'', $err) === false) {
    //データベースに接続する
    $cn = new mysqli(HOST, DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }
    //文字コードをセット
    $cn->set_charset("utf-8");
    $id = $cn->real_escape_string($_SESSION['login']);
    $query = "SELECT security_code FROM user WHERE id = $id";
    $result = $cn->query($query);
    $row = $result->fetch_assoc();
    if ($row['security_code'] === $security_use) {
      $_SESSION['point'] = $point;
      //データベースを切断
      $cn->close();
      header('location:point_confirmation.php');
      exit();
    } else {
      $err['security_use'] = 'セキュリティコードが間違えています';
    }
    //データベースを切断
    $cn->close();
  }
}



//データベースに接続する
$cn = new mysqli(HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
//文字コードをセット
$cn->set_charset("utf-8");
$id = $cn->real_escape_string($_SESSION['login']);
$query = "SELECT credit FROM user WHERE id = $id";
$result = $cn->query($query);
$row = $result->fetch_assoc();
//データベースを切断
$cn->close();





require_once 'tpl/point.php';
