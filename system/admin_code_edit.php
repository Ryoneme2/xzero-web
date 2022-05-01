<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config.php';

function dd_return($status, $message, $user, $des, $price, $id) {
    $json = ['message' => $message];
    if ($status) {
        http_response_code(200);
        if (isset($user)) $json['user'] = $user;
        if (isset($des)) $json['des'] = $des;
        if (isset($price)) $json['price'] = $price;
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

    if ($_POST['id'] != "" AND $_POST['id'] != null AND $_POST['id'] != 0) {
      if (preg_match('/^[0-9]+$/', $_POST['id'])) {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_id = ?', [$_SESSION['backend']]);
            if ($q_1->rowCount() >= 1) {
              //==============================================================//
                $q_2 = dd_q('SELECT * FROM code_tb WHERE c_id = ?', [$_POST['id']]);
                if ($q_2->rowCount() >= 1) {
                  $row = $q_2->fetch(PDO::FETCH_ASSOC);
                  dd_return(true, "ok", "{$row['c_name']}", "{$row['c_des']}", "{$row['c_price']}", "{$row['c_id']}");
                }
                dd_return(false, "ไม่พบข้อมูล");
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
