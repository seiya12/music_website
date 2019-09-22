<?php
$login_id_use = '';
$pass         = '';
$err['login'] = '';
//ログインが押されたとき
if (isset($_POST['login'])) {
  $login_id_use = $_POST['login_id_use'];
  $pass         = $_POST['pass_use'];

  //データベースに接続する
  $cn = new mysqli(HOST, DB_USER, DB_PASS, DB_NAME);

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  //文字コードをセット
  $cn->set_charset("utf-8");
  $login_id = $cn->real_escape_string($login_id_use);
  $query = "SELECT id,password FROM user WHERE login_id = '" . $login_id . "' AND password = '" . $pass . "'";
  $result = $cn->query($query);

  //エラーチェック
  if (empty($login_id)) {
    $err['login'] = 'ログインIDが入力されていません';
    $err['top'] = 'ログインできませんでした';
  } elseif (empty($pass)) {
    $err['login'] = 'パスワードが入力されていません';
    $err['top'] = 'ログインできませんでした';
  } elseif (!$row = $result->fetch_assoc()) {
    $err['login'] = 'IDまたはパスワードが違います';
    $err['top'] = 'ログインできませんでした';
  } else {
    //ログイン成功
    $_SESSION['login'] = $row['id'];
    header('location:index.php');
    exit();
  }
}