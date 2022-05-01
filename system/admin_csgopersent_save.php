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

      if (preg_match('/^[0-9]+$/', $_POST['txt_gamecsgo_1']) AND preg_match('/^[0-9]+$/', $_POST['txt_gamecsgo_2']) AND preg_match('/^[0-9]+$/', $_POST['txt_gamecsgo_3'])
    AND preg_match('/^[0-9]+$/', $_POST['txt_gamecsgo_4']) AND preg_match('/^[0-9]+$/', $_POST['txt_gamecsgo_5']) AND preg_match('/^[0-9]+$/', $_POST['txt_gamecsgo_6'])
     AND preg_match('/^[0-9]+$/', $_POST['txt_gamecsgo_7']) AND preg_match('/^[0-9]+$/', $_POST['txt_gamecsgo_8']) AND preg_match('/^[0-9]+$/', $_POST['txt_gamecsgo_9'])) {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_id = ?', [$_SESSION['backend']]);
            if ($q_1->rowCount() >= 1) {
              //==============================================================//
                $q_2 = dd_q('UPDATE csgo_chance SET chance = ? WHERE id = ? LIMIT 1', [
                  $_POST['txt_gamecsgo_1'],1
                ]);
                if ($q_2 == true) {
                  $q_3 = dd_q('UPDATE csgo_chance SET chance = ? WHERE id = ? LIMIT 1', [
                    $_POST['txt_gamecsgo_2'],2
                  ]);
                  if ($q_3 == true) {
                    $q_4 = dd_q('UPDATE csgo_chance SET chance = ? WHERE id = ? LIMIT 1', [
                      $_POST['txt_gamecsgo_3'],3
                    ]);
                    if ($q_4 == true) {
                      $q_5 = dd_q('UPDATE csgo_chance SET chance = ? WHERE id = ? LIMIT 1', [
                        $_POST['txt_gamecsgo_4'],4
                      ]);
                      if ($q_5 == true) {
                        $q_6 = dd_q('UPDATE csgo_chance SET chance = ? WHERE id = ? LIMIT 1', [
                          $_POST['txt_gamecsgo_5'],5
                        ]);
                        if ($q_6 == true) {
                          $q_7 = dd_q('UPDATE csgo_chance SET chance = ? WHERE id = ? LIMIT 1', [
                            $_POST['txt_gamecsgo_6'],6
                          ]);
                          if ($q_7 == true) {
                            $q_8 = dd_q('UPDATE csgo_chance SET chance = ? WHERE id = ? LIMIT 1', [
                              $_POST['txt_gamecsgo_7'],7
                            ]);
                            if ($q_8 == true) {
                              $q_9 = dd_q('UPDATE csgo_chance SET chance = ? WHERE id = ? LIMIT 1', [
                                $_POST['txt_gamecsgo_8'],8
                              ]);
                              if ($q_9 == true) {
                                $q_10 = dd_q('UPDATE csgo_chance SET chance = ? WHERE id = ? LIMIT 1', [
                                  $_POST['txt_gamecsgo_9'],9
                                ]);
                                if ($q_10 == true) {
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
                }
                dd_return(false, "เกิดข้อผิดพลาด");
              //==============================================================//
          }
          dd_return(false, "ไม่พบข้อมูล");
      }
      dd_return(false, "ตัวเลข เท่านั้น");
  }
  dd_return(false, "เข้าสู่ระบบก่อน");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
 ?>
