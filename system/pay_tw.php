<?php

require_once './tw.class.php';
require_once '../config.php';

$username = $_CONFIG['user_wallet'];
$password = $_CONFIG['pass_wallet'];
$reftoken = $_CONFIG['ref_wallet'];

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
  $q_0 = dd_q('SELECT * FROM setting_tb WHERE st_set != ? AND st_type = ?', ["on","tw_button"]);
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

     if (preg_match('/^[0-9]+$/', $_POST['txt_ref'])) {
          $q_1 = dd_q('SELECT * FROM user_tb WHERE u_id = ?', [$_SESSION['id']]);
          if ($q_1->rowCount() >= 1) {
              $q = dd_q('SELECT * FROM logwallet_tb WHERE lw_ref = ?', [$_POST['txt_ref']]);
              if ($q->rowCount() <= 0) {
                function pay_wallet($check,$reftoken,$username,$password) {
                    $tw = new TrueWallet("$username", "$password","$reftoken");
                    $tw->Login();
                    $tw = new TrueWallet($tw->access_token);
                 $transactions = $tw->getTransaction(30);
                    foreach ($transactions["data"]["activities"] as $report) {
                      if ($report != NULL) {

                        $data = $tw->GetTransactionReport($report["report_id"]);

                        if ($data['data']['service_code'] == "creditor") {
                          $show = array();
                          $show['ref'] = $data['data']['section4']['column2']['cell1']['value'];
                          $show['datetime'] = $data['data']['section4']['column1']['cell1']['value'];
                          $show['amount'] = $data['data']['section3']['column1']['cell1']['value'];
                          $show['fullname'] = $data['data']['section2']['column1']['cell2']['value'];
                          $show['tel'] = $data['data']['ref1'];
                          $dateformat =  DateTime::createFromFormat('d/m/y H:i', $show['datetime']);
                          $dateformat = date_format($dateformat,"Y-m-d H:i:s");
                              if ($show['ref'] == $check) {
                                break;
                              }
                        }

                      }else{
                        dd_return(false, 'ไม่พบข้อมูล');
                      }

                    }

                       if ($show['ref'] == $check) {
                           $replace_comma = str_replace(',', '', $show['amount']);
                           $replace_float = floatval(number_format($replace_comma, 2, '.', ''));
                           $type_check = gettype($replace_float);
                           $q_2 = dd_q('UPDATE user_tb SET u_point = u_point + ? WHERE u_id = ?', [$replace_float,$_SESSION['id']]);
                           if ($q_2 == true) {
                             $q_3 = dd_q('INSERT INTO logwallet_tb (lw_ref, lw_name, lw_tel, lw_datetime, lw_amount,user_id) VALUES (?, ?, ?, ?, ?, ?)', [$show['ref'], $show['fullname'], $show['tel'], $dateformat, $replace_float,$_SESSION['id']]);
                             if ($q_3 == true) {
                               dd_return(true, 'เติมเงินสำเร็จ');
                             }else{
                               dd_return(false, 'ติดต่อแอดมิน||NOTADD');
                             }
                           }else{
                             dd_return(false, 'ติดต่อแอดมิน');
                           }
                       }else{
                         dd_return(false, 'ไม่พบข้อมูล');
                       }

                }
                pay_wallet($_POST['txt_ref'],$reftoken,$username,$password);
            }
            dd_return(false, 'ข้อมูลซ้ำ');
          }
          dd_return(false, "ไม่พบชื่อผู้ใช้งาน");
      }
      dd_return(false, "กรุณากรอก ตัวเลข เท่านั้น");
      //================================================================
      }else{
      dd_return(false, "ไม่สามารถใช้งานได้");
      }

    }
    dd_return(false, "เข้าสู่ระบบก่อนทำรายการ");
  }
  dd_return(false, "ปิดปรับปรุงระบบ");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");

 ?>
