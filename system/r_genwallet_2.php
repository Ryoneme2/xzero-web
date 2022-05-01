<?php
  require_once '../config.php';
  require_once 'tw.class.php';
  if (isset($_POST['save']) AND isset($_SESSION['backend'])) {
    $tw = new TrueWallet($_POST['user'], $_POST['pass']);
    $data = $tw->SubmitLoginOTP($_POST['otp'], $_POST['tel'], $_POST['ref']);
    // print_r($tw->reference_token); // Reference Token
    // echo $data['data']['fullname'];
    // echo $data['data']['mobile_number'];
    // echo $data['data']['email'];
      $q_1 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
        $data['data']['fullname'],
        "tw_name"
      ]);
      if ($q_1 == true) {
          $q_2 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
            $data['data']['mobile_number'],
            "tw_tel"
          ]);
          if ($q_2 == true) {
            $q_3 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
              $_POST['user'],
              "tw_user"
            ]);
            if ($q_3 == true) {
              $q_4 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                $tw->reference_token,
                "tw_ref"
              ]);
              if ($q_4 == true) {
                $q_5 = dd_q('UPDATE setting_tb SET st_set = ? WHERE st_type = ? LIMIT 1', [
                  $_POST['pass'],
                  "tw_pass"
                ]);
                if ($q_5 == true) {
                  $link = base_url();
                  header("location: {$link}/backend/setting");
                }else{
                  echo "เกิดข้อผิดพลาด";
                }
              }else{
                echo "เกิดข้อผิดพลาด";
              }
            }else{
              echo "เกิดข้อผิดพลาด";
            }
          }else{
            echo "เกิดข้อผิดพลาด";
          }
      }else{
        echo "เกิดข้อผิดพลาด";
      }
  }else{
    echo "ERROR";
  }
?>
