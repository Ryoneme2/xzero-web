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
  if (isset($_SESSION['id'])) {
    $pw_old = trim($_POST['txt_change_oldpass']);
    $pw_new = trim($_POST['txt_change_pass']);
    $pw_connew = trim($_POST['txt_change_conpass']);

    if ($pw_old != "" AND $pw_new != "" AND $pw_connew != "") {
      if (preg_match('/^[a-zA-Z0-9]+$/', $pw_old) AND preg_match('/^[a-zA-Z0-9]+$/', $pw_new) AND preg_match('/^[a-zA-Z0-9]+$/', $pw_connew)) {
            $q_1 = dd_q('SELECT * FROM user_tb WHERE u_id = ? AND u_type = ?', [$_SESSION['id'],"w"]);
            if ($q_1->rowCount() >= 1) {
              $row = $q_1->fetch(PDO::FETCH_ASSOC);
              if (password_verify($pw_old, $row['u_password'])) {
                  if ($pw_new == $pw_connew) {
                    $hash = password_hash($pw_new, PASSWORD_DEFAULT);
                    $q_2 = dd_q('UPDATE user_tb SET u_password = ? WHERE u_id = ? LIMIT 1', [$hash,$_SESSION['id']]);
                    if ($q_2 == true) {
                      dd_return(true, "เปลี่ยนรหัสผ่านสำเร็จ");
                    }else{
                      dd_return(false, "เกิดข้อผิดพลาด");
                    }
                  }else{
                    dd_return(false, "รหัสผ่านไม่ตรงกัน");
                  }
              } else {
                  dd_return(false, "รหัสผ่านไม่ถูกต้อง");
              }
            }
            dd_return(false, "เปลี่ยนรหัสผ่านไม่สำเร็จ");
      }
      dd_return(false, "กรุณากรอก ภาษาอังกฤษ / ตัวเลข เท่านั้น");
    }
    dd_return(false, "กรุณากรอกข้อมูลให้ครบ");
  }
  dd_return(false, "เข้าสู่ระบบระบบก่อน");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
 ?>
