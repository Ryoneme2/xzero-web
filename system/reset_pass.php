<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require_once '../config.php';

function encripitar($password) {
    $salt = '/x!a@r-$r%an¨.&e&+f*f(f(a)';
    $output = hash_hmac('md5', $password, $salt);
    return $output;
}

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
  if ($email != "" AND $key != "") {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $q_1 = dd_q('SELECT * FROM user_tb WHERE u_email = ? AND u_key = ? AND u_type = ?', [$email,$key,"w"]);
        if ($q_1->rowCount() >= 1) {
          $rand = mt_rand(100000,900000);
          $hash = password_hash($rand, PASSWORD_DEFAULT);;
          $q_2 = dd_q('UPDATE user_tb SET u_password = ? WHERE u_email = ? AND u_type = ? AND u_key = ? LIMIT 1', [$hash,$email,"w",$key]);
          if ($q_2 == true) {

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth   = true;
            $mail->Username   = $_CONFIG['you_email'];
            $mail->Password   = $_CONFIG['you_email_password'];
            $mail->Port       = 587;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($_CONFIG['you_email'], 'Admin');
            $mail->addAddress($email);
            $mail->addReplyTo($_CONFIG['you_email'], 'Admin');

            // Content
            $mail->isHTML(true);
            $mail->Subject = "รหัสผ่านใหม่ของคุณ";
            $mail->Body    = "รหัสผ่านใหม่ของคุณคือ <b>{$rand}</b>";

            if (!$mail->send()) {
              dd_return(false, "ส่งเมล์ไม่สำเร็จ");
            }else{
              dd_return(true, "ส่งรหัสผ่านใหม่ ไปที่อีเมล์สำเร็จ");
            }

          }else{
            dd_return(false, "เกิดข้อผิดพลาดทางระบบ");
          }
        }
        dd_return(false, "ไม่พบข้อมูล");
      }
      dd_return(false, "อีเมล์ของคุณไม่ถูกต้อง");
  }
  dd_return(false, "กรุณากรอกข้อมูลให้ครบ");
  //================================================================
  }else{
  dd_return(false, "ไม่สามารถใช้งานได้");
  }
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");



 ?>
