<?php
$account['login_id']   = '';
$account['pass1']      = '';
$account['pass2']      = '';
$account['credit']     = '';
$account['expiration'] = '';
$account['security']   = '';

$err['login_id']   = '';
$err['pass']       = '';
$err['credit']     = '';
$err['expiration'] = '';
$err['security']   = '';

//ボタンが押されたとき
if (isset($_POST['submit'])) {
  $account['login_id']   = $_POST['login_id'];
  $account['pass1']      = $_POST['pass1'];
  $account['pass2']      = $_POST['pass2'];
  $account['credit']     = $_POST['credit'];
  $account['expiration'] = $_POST['expiration'];
  $account['security']   = $_POST['security'];

  //ログインIDのエラーチェック
  if (empty($account['login_id'])) {
    $err['login_id'] = 'ログインIDが入力されていません';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $account['login_id'])) {
    $err['login_id'] = 'ログインIDは半角英数で入力して下さい';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  } elseif (mb_strlen($account['login_id']) < 3) {
    $err['login_id'] = 'ログインIDは3文字以上で入力して下さい';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  } elseif (mb_strlen($account['login_id']) > 30) {
    $err['login_id'] = 'ログインIDは30文字以内で入力して下さい';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  } else {
    //ログインIDの重複チェック
    //データベースに接続する
    $cn = new mysqli(HOST, DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }
    //文字コードをセット
    $cn->set_charset("utf-8");
    //SQLを指定
    $login_id = $cn->real_escape_string($account['login_id']);
    $query = "SELECT login_id FROM user WHERE login_id LIKE '" . $login_id . "'";
    //SQLを実行
    $result = $cn->query($query);
    //重複チェック
    if ($row = $result->fetch_assoc()) {
      $err['login_id'] = 'そのログインIDは既に使用されています';
      $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
    }
    //データベースを切断
    $cn->close();
  }

  //パスワードのエラーチェック
  if ($account['pass1'] !== $account['pass2']) {
    $err['pass'] = 'パスワードが同じではありません';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  }

  if (empty($account['pass1'])) {
    $err['pass'] = 'パスワードが入力されていません';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  } elseif (!preg_match("/^[a-zA-Z0-9]+$/", $account['pass1'])) {
    $err['pass'] = 'パスワードは半角英数で入力して下さい';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  } elseif (mb_strlen($account['pass1']) < 6) {
    $err['pass'] = 'パスワードは6文字以上で入力して下さい';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  }

  //クレジットカードのエラーチェック
  if (empty($account['credit'])) {
    $err['credit'] = 'カード番号が入力されていません';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  } 
  if (empty($account['expiration'])) {
    $err['expiration'] = '有効期限が入力されていません';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  }

  if (empty($account['security'])) {
    $err['security'] = 'セキュリティコードが入力されていません';
    $err['top'] = '会員登録できませんでした。入力内容をお確かめください。';
  }



  //エラーがなかった場合
  if (array_search(!'', $err) === false) {
    foreach ($account as $key => $value) {
      $_SESSION[$key] = $value;
    }
    $_SESSION['account'] = '';

    header('location: confirmation.php');
    exit();
  }
}

//次のページから戻ってきた場合
if (!empty($_SESSION['back'])) {
  $account = $_SESSION;
  session_destroy();
}
