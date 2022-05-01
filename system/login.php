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
  if (!isset($_SESSION['id'])) {
    $user_login = trim($_POST['user']);
    $pwd_login = trim($_POST['pass']);

    $secret = $_CONFIG['secretkey'];
    $response = $_POST["captcha"];
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
    $captcha_success = json_decode($verify);
    if ($captcha_success->success==false) {
      dd_return(false, "กรุณายืนยันตัวตน");
    }else if ($captcha_success->success==true) {
//================================================================
          if ($user_login != "" AND $pwd_login != "") {
            if (preg_match('/^[a-zA-Z0-9]+$/', $pwd_login) AND preg_match('/^[a-zA-Z0-9@.]+$/', $user_login)) {
                  $q_1 = dd_q('SELECT * FROM user_tb WHERE (u_name = ? OR u_email = ?) AND u_type = ?', [$user_login,$user_login,"w"]);
                  if ($q_1->rowCount() >= 1) {
                    $row = $q_1->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($pwd_login, $row['u_password'])) {
                        $_SESSION['id'] = $row['u_id'];
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
//================================================================
      }else{
      dd_return(false, "ไม่สามารถใช้งานได้");
      }
  }
  dd_return(false, "ออกจากระบบก่อน");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
 ?>
