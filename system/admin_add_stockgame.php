<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config.php';

function dd_return($status, $message) {
    $json = ['message' => $message];
    if ($status) {
        http_response_code(200);
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

    if ($_POST['txt_gameadd'] != "" AND $_POST['txt_gameadd'] != null AND $_POST['txt_gamesel'] != null AND $_POST['txt_gamesel'] != "") {
      if (preg_match('/^[0-9]+$/', (int)$_POST['txt_gamesel'])) {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_id = ?', [$_SESSION['backend']]);
            if ($q_1->rowCount() >= 1) {
              //==============================================================//
                    $q_2 = dd_q('INSERT INTO random_stock (type,contents,owner_id) VALUES (?, ?, ?)', [
                      $_POST['txt_gamesel'],
                      $_POST['txt_gameadd'],
                      0
                    ]);
                    if ($q_2 == true) {
                      dd_return(true, "เพิ่มรางวัลสำเร็จ");
                    }else{
                      dd_return(false, "เกิดข้อผิดพลาด");
                    }
              //==============================================================//
          }
          dd_return(false, "ไม่พบข้อมูล");
      }
      dd_return(false, "ตัวเลข เท่านั้น");
    }
    dd_return(false, "กรุณากรอกข้อมูลให้ครบ");
  }
  dd_return(false, "เข้าสู่ระบบก่อน");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
 ?>
