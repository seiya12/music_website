<?php
session_start();
ini_set('session.entropy_file', '/dev/urandom');
ini_set('session.entropy_length', '32');
require_once 'config.php';

if (!isset($_SESSION['point']) || !isset($_SESSION['login'])) {
  header('location:index.php');
  exit();
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
$point = $cn->real_escape_string($_SESSION['point']);
$query = "UPDATE user SET point = point+$point WHERE id = $id";
$result = $cn->query($query);
header('location:index.php');
exit();
