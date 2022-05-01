<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config.php';

function dd_return($status, $message, $id) {
    $json = ['message' => $message];
    if ($status) {
        http_response_code(200);
        if (isset($id)) $json['id'] = $id;
        die(json_encode($json));
    }else{
        http_response_code(400);
        die(json_encode($json));
    }
}

//////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_SESSION['backend'])) {

    if ($_POST['type'] != "" AND $_POST['type'] != null AND $_POST['type'] != 0 AND $_POST['code'] != "" AND $_POST['code'] != null) {
      if (preg_match('/^[0-9]+$/', $_POST['type'])) {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_id = ?', [$_SESSION['backend']]);
            if ($q_1->rowCount() >= 1) {
              //==============================================================//
                $q_2 = dd_q('SELECT * FROM cardoption_tb WHERE co_id = ?', [$_POST['type']]);
                if ($q_2->rowCount() >= 1) {
                  $q_3 = dd_q('SELECT * FROM cardstock_tb WHERE cs_coid = ? AND cs_code = ?', [$_POST['type'],$_POST['code']]);
                  if ($q_3->rowCount() <= 0) {
                        $q_4 = dd_q('INSERT INTO cardstock_tb (cs_coid,cs_code,cs_date,cs_userid) VALUES (?, ?, ?, ?)', [
                          $_POST['type'],
                          $_POST['code'],
                          date("Y-m-d H:i:s"),
                          0
                        ]);
                        if ($q_4 == true) {
                          dd_return(true, "เพิ่มข้อมูลสำเร็จ","{$_POST['id']}");
                        }else{
                          dd_return(false, "เกิดข้อผิดพลาด","{$_POST['id']}");
                        }
                  }
                  dd_return(false, "ข้อมูลซ้ำ","{$_POST['id']}");
                }
                dd_return(false, "ไม่พบข้อมูล","{$_POST['id']}");
              //==============================================================//
          }
          dd_return(false, "ไม่พบข้อมูล","{$_POST['id']}");
      }
      dd_return(false, "ID ตัวเลข เท่านั้น","{$_POST['id']}");
    }
    dd_return(false, "กรุณากรอกข้อมูลให้ครบ","{$_POST['id']}");
  }
  dd_return(false, "เข้าสู่ระบบก่อน","{$_POST['id']}");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!","");
 ?>
