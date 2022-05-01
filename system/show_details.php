<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config.php';

function dd_return($status, $message, $pd_pass, $pd_tel, $pd_email) {
    $json = ['message' => $message];
    if ($status) {
        http_response_code(200);
        if (isset($pd_pass)) $json['pd_pass'] = $pd_pass;
        if (isset($pd_tel)) $json['pd_tel'] = $pd_tel;
        if (isset($pd_email)) $json['pd_email'] = $pd_email;
        die(json_encode($json));
    }else{
        http_response_code(400);
        die(json_encode($json));
    }
}

//////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_SESSION['id'])) {
    if ($_POST['txt_id'] != "" AND $_POST['txt_type'] != "") {

      if ($_POST['txt_type'] == "idgame") {
        $q_1 = dd_q('SELECT * FROM product_tb WHERE pd_id = ? AND pd_usid = ?', [$_POST['txt_id'],$_SESSION['id']]);
        if ($q_1->rowCount() >= 1) {
          $row = $q_1->fetch(PDO::FETCH_ASSOC);
          dd_return(true, "{$row['pd_user']}","{$row['pd_pass']}","{$row['pd_tel']}","{$row['pd_email']}");
        }else{
          dd_return(false, "ไม่พบข้อมูล (-.-)", "", "", "");
        }

      }elseif ($_POST['txt_type'] == "code") {

        $q_2 = dd_q('SELECT * FROM stockcode_tb WHERE sc_id = ? AND sc_userid = ?', [$_POST['txt_id'],$_SESSION['id']]);
        if ($q_2->rowCount() >= 1) {
          $row2 = $q_2->fetch(PDO::FETCH_ASSOC);
          dd_return(true, "{$row2['sc_code']}", "", "", "");
        }else{
          dd_return(false, "ไม่พบข้อมูล (-.-)", "", "", "");
        }

      }else{
        dd_return(false, "ไม่พบข้อมูล olo", "", "", "");
      }

    }
    dd_return(false, "กรุณากรอกข้อมูลให้ครบ", "", "", "");
  }
  dd_return(false, "เข้าสู่ระบบก่อน", "", "", "");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!", "", "", "");
 ?>
