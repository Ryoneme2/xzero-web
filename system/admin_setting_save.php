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

    if ($_POST['tel'] != "" AND $_POST['email'] != "" AND $_POST['passemail'] != "" AND $_POST['tmpay'] != "" AND $_POST['namebank'] != "" AND $_POST['numberbank'] != ""
    AND $_POST['userbank'] != "" AND $_POST['passbank'] != "") {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_id = ?', [$_SESSION['backend']]);
            if ($q_1->rowCount() >= 1) {
              //==============================================================//

                    $q_2 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                      $_POST['tel'],
                      "tel_contact"
                    ]);
                    if ($q_2 == true) {
                      $q_3 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                        $_POST['email'],
                        "gmail_user"
                      ]);
                      if ($q_3 == true) {
                        $q_4 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                          $_POST['passemail'],
                          "gmail_pass"
                        ]);
                        if ($q_4 == true) {
                          $q_5 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                            $_POST['tmpay'],
                            "tmpay_id"
                          ]);
                          if ($q_5 == true) {
                            $q_6 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                              $_POST['namebank'],
                              "kb_name"
                            ]);
                            if ($q_6 == true) {
                              $q_7 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                                $_POST['numberbank'],
                                "kb_number"
                              ]);
                              if ($q_7 == true) {
                                $q_8 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                                  $_POST['userbank'],
                                  "kb_user"
                                ]);
                                if ($q_8 == true) {
                                  $q_9 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                                    $_POST['passbank'],
                                    "kb_pass"
                                  ]);
                                  if ($q_9 == true) {
                                    dd_return(true, "บันทึกข้อมูลสำเร็จ");
                                  }
                                  dd_return(false, "เกิดข้อผิดพลาด");
                                }
                                dd_return(false, "เกิดข้อผิดพลาด");
                              }
                              dd_return(false, "เกิดข้อผิดพลาด");
                            }
                            dd_return(false, "เกิดข้อผิดพลาด");
                          }
                          dd_return(false, "เกิดข้อผิดพลาด");
                        }
                        dd_return(false, "เกิดข้อผิดพลาด");
                      }
                      dd_return(false, "เกิดข้อผิดพลาด");
                    }
                    dd_return(false, "เกิดข้อผิดพลาด");
              //==============================================================//
          }
          dd_return(false, "ไม่พบข้อมูล");
    }
    dd_return(false, "กรุณากรอกข้อมูลให้ครบ");
  }
  dd_return(false, "เข้าสู่ระบบก่อน");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
 ?>
