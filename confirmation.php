<?php
session_start();
ini_set('session.entropy_file', '/dev/urandom');
ini_set('session.entropy_length', '32');
require_once 'config.php';

//登録画面以外からきた場合
if (!isset($_SESSION['account'])) {
  header('location:index.php');
  exit();
}

//登録が押されたとき
if (isset($_POST['submit'])) {
  //データベースに接続する
  $cn = new mysqli(HOST, DB_USER, DB_PASS, DB_NAME);

  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  //文字コードをセット
  $cn->set_charset("utf-8");
  //SQLを指定
  foreach ($_SESSION as $key => $val) {
    ${$key} = $cn->real_escape_string($val);
  }
  //SQL実行
  $query = "INSERT INTO user(id,login_id,password,point,credit,expiration_date,security_code) VALUES('','" . $login_id . "','" . $pass1 . "','','" . $credit . "','" . $expiration . "','" . $security . "')";
  $result = $cn->query($query);
  //データベースを切断
  $cn->close();
  session_destroy();
  header('location:tpl/registration.php');
  exit();
}

//戻るボタンを押した場合
if (isset($_POST['back'])) {
  $_SESSION['back'] = 'back';
  header('location: index.php');
  exit();
}

require_once 'tpl/confirmation.php';
