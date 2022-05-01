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
    $user = trim($_POST['user']);
    $pass = trim($_POST['pass']);
    $conpass = trim($_POST['conpass']);
    $email = trim($_POST['email']);
    $key = trim($_POST['key']);

    $secret = $_CONFIG['secretkey'];
    $response = $_POST["captcha"];
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
    $captcha_success = json_decode($verify);
    if ($captcha_success->success==false) {
      dd_return(false, "กรุณายืนยันตัวตน");
    }else if ($captcha_success->success==true) {
  //================================================================
      if ($user != "" AND $pass != "" AND $conpass != "" AND $email != "" AND $key != "") {
        if (preg_match('/^[a-zA-Z0-9]+$/', $pass) AND preg_match('/^[a-zA-Z0-9]+$/', $conpass) AND preg_match('/^[a-zA-Z0-9]+$/', $user) AND preg_match('/^[0-9]+$/', $key)) {
          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $q_1 = dd_q('SELECT * FROM user_tb WHERE (u_name = ? OR u_email = ?) AND u_type = ?', [$user,$email,"w"]);
            if ($q_1->rowCount() < 1) {

                if (strlen($key) == 4) {
                  if ($pass == $conpass) {
                    $hash = password_hash($pass, PASSWORD_DEFAULT);
                    $q_2= dd_q('INSERT INTO user_tb (u_name, u_email, u_password, u_point, u_youbuy, u_type, u_key, u_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
                      $user,
                      $email,
                      $hash,
                      0,
                      0,
                      "w",
                      $key,
                      date("Y-m-d H:i:s")
                    ]);
                    if ($q_2 == true) {
                          $last_id = $conn->lastInsertId();
                          $_SESSION['id'] = $last_id;
                          dd_return(true, "สมัครสมาชิกสำเร็จ");
                    }else{
                      dd_return(false, "เกิดข้อผิดพลาดทางระบบ");
                    }
                  }else{
                    dd_return(false, "รหัสผ่านไม่ตรงกัน");
                  }
                }else{
                  dd_return(false, "KEY กรอกเลข 4 ตัวเท่านั้น");
                }

            }
            dd_return(false, "ไม่สามารถใช้ อีเมล์ / ชื่อผู้ใช้ได้");
          }
          dd_return(false, "อีเมล์ของคุณไม่ถูกต้อง");
        }
        dd_return(false, "กรุณากรอก ภาษาอังกฤษ / ตัวเลข เท่านั้น [KEY ตัวเลขเท่านั้น]");
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
