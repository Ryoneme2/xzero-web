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
  if (!isset($_SESSION['backend'])) {
    $user_login = trim($_POST['user']);
    $pass_login = trim($_POST['pass']);

    if ($user_login != "" AND $pass_login != "") {
      if (preg_match('/^[a-zA-Z0-9]+$/', $user_login) AND preg_match('/^[a-zA-Z0-9]+$/', $pass_login)) {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_user = ?', [$user_login]);
            if ($q_1->rowCount() >= 1) {
              $row = $q_1->fetch(PDO::FETCH_ASSOC);
              if (password_verify($pass_login, $row['ad_pass'])) {
                  $_SESSION['backend'] = $row['ad_id'];
                  dd_return(true, "เข้าสู่ระบบสำเร็จ");
              } else {
                  dd_return(false, "ไม่พบข้อมูล");
              }
            }
            dd_return(false, "ไม่พบข้อมูล");
      }
      dd_return(false, "กรุณากรอก ภาษาอังกฤษ / ตัวเลข เท่านั้น");
    }
    dd_return(false, "กรุณากรอกข้อมูลให้ครบ");

  }
  dd_return(false, "ออกจากระบบก่อน");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
 ?>
