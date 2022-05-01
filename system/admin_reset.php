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


    if ($_POST['oldpass'] != "" AND $_POST['newpass'] != "" AND $_POST['conpass'] != "") {
      if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['oldpass']) AND preg_match('/^[a-zA-Z0-9]+$/', $_POST['newpass']) AND preg_match('/^[a-zA-Z0-9]+$/', $_POST['conpass'])) {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_id = ?', [$_SESSION['backend']]);
            if ($q_1->rowCount() >= 1) {
                $row = $q_1->fetch(PDO::FETCH_ASSOC);
                if (password_verify($_POST['oldpass'], $row['ad_pass'])) {
                    if ($_POST['newpass'] == $_POST['conpass']) {
                      $hash = password_hash($_POST['newpass'], PASSWORD_DEFAULT);;
                      $q_2 = dd_q('UPDATE admin_tb SET ad_pass = ? WHERE ad_id = ? LIMIT 1', [$hash,$_SESSION['backend']]);
                      if ($q_2 == true) {
                        dd_return(true, "เปลี่ยนรหัสผ่านสำเร็จ");
                      }else{
                        dd_return(false, "เกิดข้อผิดพลาด");
                      }
                    }else{
                      dd_return(false, "รหัสผ่านไม่ตรงกัน");
                    }
                }else{
                    dd_return(false, "รหัสผ่านเก่าไม่ถูกต้อง");
                }
            }
            dd_return(false, "ไม่พบข้อมูล");
      }
      dd_return(false, "กรุณากรอก ภาษาอังกฤษ / ตัวเลข เท่านั้น");
    }
    dd_return(false, "กรุณากรอกข้อมูลให้ครบ");

  }
  dd_return(false, "เข้าสู่ระบบก่อน");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
 ?>
