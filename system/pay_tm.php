<?php
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
//
// //////////////////////////////////////////////////////////////////////////
//
header('Content-Type: application/json; charset=utf-8;');
//
if (isset($_POST['txt_paytm_ref'])) {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $q_0 = dd_q('SELECT * FROM setting_tb WHERE st_set != ? AND st_type = ?', ["on","tm_button"]);
    if ($q_0->rowCount() <= 0) {
    if (isset($_SESSION['id'])) {
      $secret = $_CONFIG['secretkey'];
      $response = $_POST["captcha"];
      $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
      $captcha_success = json_decode($verify);
      if ($captcha_success->success==false) {
        dd_return(false, "กรุณายืนยันตัวตน");
      }else if ($captcha_success->success==true) {
    //================================================================
     if (preg_match('/^[0-9]+$/', $_POST['txt_paytm_ref'])) {
          $q_1 = dd_q('SELECT * FROM user_tb WHERE u_id = ?', [$_SESSION['id']]);
          if ($q_1->rowCount() >= 1) {

                    $tmpayid = $_CONFIG['tmpay_id'];
                    if(function_exists('curl_init')) {
                      $curl = curl_init('https://www.tmpay.net/TPG/backend.php?merchant_id=' . $tmpayid . '&password=' . $_POST['txt_paytm_ref'] . '&resp_url='. base_url() .'/system/res_tmpay.php');
                      curl_setopt($curl, CURLOPT_TIMEOUT, 10);
                      curl_setopt($curl, CURLOPT_HEADER, FALSE);
                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                      $curl_content = curl_exec($curl);
                      curl_close($curl);
                    }else{
                      $curl_content = file_get_contents("http://www.tmpay.net/TPG/backend.php?merchant_id=" . $tmpayid ."&password=" . $_POST['txt_paytm_ref'] ."&resp_url=". base_url() ."/system/res_tmpay.php");
                    }
                    if(strpos($curl_content,'SUCCEED') !== FALSE) {
                      $sub = substr($curl_content,8);

                      $q_2= dd_q('INSERT INTO logtopup (transaction_id, username, password, real_amount, youpoint, status, date) VALUES (?, ?, ?, ?, ?, ?, ?)', [
                        $sub,
                        $_SESSION['id'],
                        (int)$_POST['txt_paytm_ref'],
                        0.00,
                        0.00,
                        0,
                        date("Y-m-d H:i:s")
                      ]);
                      if ($q_2 == true) {
                        dd_return(true, "รอตรวจสอบ สักครู่... กดยืนยัน");
                      }else{
                        dd_return(false, "เกิดข้อผิดพลาดทางระบบ");
                      }

                    }else{
                      dd_return(false, "ไม่สามารถเติมเงินได้");
                    }

          }else{
          dd_return(false, "ไม่พบชื่อผู้ใช้งาน");
          }
      }else{
      dd_return(false, "กรุณากรอก ตัวเลข เท่านั้น");
      }
      //================================================================
      }else{
      dd_return(false, "ไม่สามารถใช้งานได้");
      }


    }else{
    dd_return(false, "เข้าสู่ระบบก่อนทำรายการ");
    }
    }else{
    dd_return(false, "ปิดปรับปรุงระบบ");
    }
  }else{
  dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
  }
}else{
  dd_return(false, "ระบบไม่สามารถทำงานได้ |ERR:1|");
}








?>
