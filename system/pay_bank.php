<?php
require_once "KasikornBank.class.php";
require_once '../config.php';

$username = $_CONFIG['user_bank'];
$password = $_CONFIG['pass_bank'];
$number_bank = $_CONFIG['number_bank'];

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

// dd_return(false, "555 $number_bank $password $username");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $q_0 = dd_q('SELECT * FROM setting_tb WHERE st_set != ? AND st_type = ?', ["on","bank_button"]);
  if ($q_0->rowCount() <= 0) {
    if (isset($_SESSION['id'])) {
      $q_01 = dd_q('SELECT * FROM user_tb WHERE u_id = ?', [$_SESSION['id']]);
      if ($q_01->rowCount() >= 1) {
      	$pay_point = $_POST['pay_point'];
        $pay_time = $_POST['pay_time'];
        $pay_date = $_POST['pay_date'];

        $secret = $_CONFIG['secretkey'];
        $response = $_POST["captcha"];
        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
        $captcha_success = json_decode($verify);
        if ($captcha_success->success==false) {
          dd_return(false, "กรุณายืนยันตัวตน");
        }else if ($captcha_success->success==true) {
      //================================================================
        if ($pay_point != "" AND $pay_date != "" AND $pay_time != "") {
          if (preg_match('/^[0-9.]*$/', $pay_point)) {

                  $pay_point = str_replace(",","",$pay_point);
                  $point_new = number_format((float)$pay_point,2,'.', '');
                  $dateTimech = DateTime::createFromFormat('Y-m-d', $pay_date);
                  $date_ch = $dateTimech->format('Y-d-m');
                  $q_1 = dd_q('SELECT * FROM logbank_tb WHERE lb_amount = ? AND lb_date = ? AND lb_time	= ?', [$point_new,$date_ch,$pay_time]);
                  if ($q_1->rowCount() <= 0) {


                          function BankAPI($username,$password,$number_bank) {
                            $kbank = new KasikornBank("$username", "$password", 'cookie.txt');
                            if (!$kbank->CheckSession()) {
                              $kbank->Login();
                            }
                            return json_encode($kbank->GetTodayStatement("$number_bank"));
                          }
                          function cBank($time,$amount,$username,$password,$number_bank) {
                              $data = json_decode(BankAPI($username,$password,$number_bank),true);
                              $amount = str_replace(",","",$amount);
                              $amount = number_format($amount,2,'.', '');
                              if (sizeof($data) == 0) {
                                dd_return(false, 'ไม่พบข้อมูล||1');
                              }else{

                                if(is_array($data)) {
                                  foreach($data as $i){
                                    if($i != NULL){
                                      $number = $i['A/C Number'];
                                      $b_time = $i['Date/Time'];
                                      $channel = $i['Channel'];
                                      $type = $i['Transaction Type'];
                                      $withdrawal = $i['Withdrawal (THB)'];
                                      $as = str_replace(",","",$i['Deposit (THB)']);
                                      $deposit = number_format((float)$as,2,'.', '');
                                      $details = $i['Details'];
                                      $b_time = explode(':',$b_time);
                                      $b_time = $b_time[0].':'.$b_time[1];
                                      if ($number == "") {
                                        $number = "promtpay";
                                      }
                                      if($b_time == $time && $deposit == $amount){
                                        break;
                                      }
                                    }else{
                                      dd_return(false, 'ไม่พบข้อมูล');
                                    }
                                  }
                                }else {
                                  dd_return(false, "No Array");
                                }

                              }
                              if($b_time == $time){
                                if($deposit == $amount) {
                                  if($b_time == $time AND $deposit == $amount) {
                                      $dateTime = DateTime::createFromFormat('d/m/y H:i', $b_time);
                                      $date_day = $dateTime->format('Y-d-m');
                                      $date_time = $dateTime->format('H:i');

                                      $q_log = dd_q('INSERT INTO logbank_tb (lb_date,lb_time,lb_amount,lb_account_number,lb_chanel,lb_added_time,lb_userid) VALUES (?, ?, ?, ?, ?, ?, ?)', [
                                        $date_day, $date_time, $deposit, $number, $channel, date("Y-m-d H:i:s"), $_SESSION['id']
                                      ]);
                                      if ($q_log == true) {
                                        $q_2 = dd_q('UPDATE user_tb SET u_point = u_point + ? WHERE u_id = ?', [(float)$deposit,$_SESSION['id']]);
                                        if ($q_2 == true) {
                                          dd_return(true, 'เติมเงินสำเร็จ');
                                        }else {
                                          dd_return(false, 'เติมเงินไม่สำเร็จ');
                                        }
                                      }else {
                                        dd_return(false, 'เติมเงินไม่สำเร็จ');
                                      }
                                  } else {
                                    dd_return(false, 'ไม่พบข้อมูล');
                                  }
                                } else {
                                  dd_return(false, '|ไม่พบข้อมูล|');
                                }
                            }else {
                                dd_return(false, "||ไม่พบข้อมูล||");
                            }
                          }
                            $dateTime1 = DateTime::createFromFormat('Y-m-d', $pay_date);
                            $dateTime2 = DateTime::createFromFormat('H:i', $pay_time);
                            $date_day = $dateTime1->format('d/m/y');
                            $date_time = $dateTime2->format('H:i');
                            $sss = $date_day." ".$date_time;
                            cBank($sss,$pay_point,$username,$password,$number_bank);

               }
               dd_return(false, 'ข้อมูลซ้ำ');
          }
          dd_return(false, "จำนวนเงินกรอกตัวเลขเท่านั้น");
        }
        dd_return(false, "กรอกข้อมูลไม่ครบ");
        //================================================================
        }else{
        dd_return(false, "ไม่สามารถใช้งานได้");
        }

      }
      dd_return(false, "ไม่พบชื่อผู้ใช้งาน");
    }
    dd_return(false, "เข้าสู่ระบบก่อนทำรายการ");
  }
  dd_return(false, "ปิดปรับปรุงระบบ");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");


 ?>
