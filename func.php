<?php
// 処理関数
function output($cn, $sql)
{
  $result = mysqli_query($cn, $sql);
  mysqli_close($cn);
  $rows = [];
  $new_rows = [];
  //データ取り出し
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  // reply並び替え
  foreach ($rows as $row) {
    $row['msg'] = indention($row['msg']);
    if (!$row['reply_id']) {
      $new_rows[$row['id']]['main'] = $row;
    } else {
      $new_rows[$row['reply_id']]['reply'][] = $row;
    }
  }
  return $new_rows;
}

// 削除フラグ関数
function delete_flag($cn, $table_name, $del_id)
{
  $sql = "UPDATE " . $table_name . " SET del_flg = 1 WHERE id = " . $del_id . ";";
  mysqli_query($cn, $sql);
  mysqli_close($cn);
  return;
}

// id割り当て関数
function id_allotment($cn, $table_name)
{
  $sql = "SELECT MAX(id) FROM " . $table_name . ";";
  $result = mysqli_query($cn, $sql);
  $row = mysqli_fetch_assoc($result);
  if (!empty($row['MAX(id)'])) {
    $idcnt = $row['MAX(id)'] + 1;
  } else {
    $idcnt = 1;
  }
  return $idcnt;
}

// function insert($cn,$table_name,$table_col,$insert_val){
//   $sql = "INSERT INTO ".$table_name."(".$table_col.")VALUES('".$idcnt."','" . $_POST['name'] . "','" . $_POST['msg'] . "','" . $_POST['genre'] . "','" . $_POST['reply'] . "',0,'" . date('Y-m-d H:i:s') . "');";
//   mysqli_query($cn, $sql);
//   mysqli_close($cn);
// }

function indention($text)
{
  $text = str_replace("\r\n", "<br>", $text);
  $text = str_replace("\r", "<br>", $text);
  $text = str_replace("\n", "<br>", $text);
  return $text;
}

function check_credit_card_no($prm)
{
  if (!empty($prm['credit'])) {
    $card = $prm['credit'];
    $check = 0;

    // 数値以外はエラーを返す。
    if (!is_numeric($card)) {
      return false;
    }
    // カード番号が偶数桁かどうか
    $is_even = strlen($card) % 2 == 0;
    // 文字列を配列に分解
    $card = str_split($card);

    // 数字の数だけループする
    for ($i = 0; $i < 16; $i++) {
      if ($card[$i]) {
        // 偶数桁の場合、奇数の場合のみ2倍する
        if ($is_even) {
          if ($i % 2 == 0) {
            $card[$i] = $card[$i] * 2;
          }
        } else {
          if ($i % 2 == 1) {
            $card[$i] = $card[$i] * 2;
          }
        }

        // 2桁の場合は分割して足す
        if (mb_strlen($card[$i]) != 1) {
          $split = str_split($card[$i]);
          $card[$i] = $split[0] + $split[1];
        }
        $check += $card[$i];
      }
    }

    if ($check % 10 == 0) {
      return true;
    } else {
      return false;
    }
  }
}
