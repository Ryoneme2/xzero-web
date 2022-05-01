<?php

require_once '../config.php';


$transaction_id = $_GET['transaction_id'];
$password = $_GET['password'];
$amount = $_GET['real_amount'];
$status = $_GET['status'];
$id = $_SESSION['id'];
if($status == 1 ) {
      if($amount == 50){
          $new_amount = $_CONFIG['truemoney_50'];
      }elseif($amount == 90){
          $new_amount = $_CONFIG['truemoney_90'];
      }elseif($amount == 150){
          $new_amount = $_CONFIG['truemoney_150'];
      }elseif($amount == 300){
          $new_amount = $_CONFIG['truemoney_300'];
      }elseif($amount == 500){
          $new_amount = $_CONFIG['truemoney_500'];
      }elseif($amount == 1000){
          $new_amount = $_CONFIG['truemoney_1000'];
      }

      $q_1 = dd_q('UPDATE logtopup SET transaction_id = ?,real_amount = ?,youpoint = ?,status = ? WHERE password = ? AND status = ?', [$transaction_id,$amount,$new_amount,$status,$password,0]);
      if ($q_1 == true) {
        $q = dd_q('SELECT * FROM logtopup WHERE password = ? AND transaction_id = ?', [$password,$transaction_id]);
        $row = $q->fetch(PDO::FETCH_ASSOC);
          $q_2 = dd_q('UPDATE user_tb SET u_point = u_point + ? WHERE u_id = ?', [$new_amount,$row['username']]);
          if ($q_2 == true) {
            echo "สำเร็จ";
          }
      }else{
        echo "เกิดข้อผิดพลาดทางระบบ";
      }
}elseif ($status == 3) {
    $q_3 = dd_q('UPDATE logtopup SET transaction_id = ?,status = ? WHERE password = ? AND status = ?', [$transaction_id,$status,$password,0]);
    if ($q_3 == true) {
      echo 'บัตรเงินสดถูกใช้ไปแล้ว';
    }
}elseif ($status == 4) {
    $q_4 = dd_q('UPDATE logtopup SET transaction_id = ?,status = ? WHERE password = ? AND status = ?', [$transaction_id,$status,$password,0]);
    if ($q_4 == true) {
      echo 'บัตรเงินสดไม่ถูกต้อง';
    }
}elseif ($status == 5) {
    $q_5 = dd_q('UPDATE logtopup SET transaction_id = ?,status = ? WHERE password = ? AND status = ?', [$transaction_id,$status,$password,0]);
    if ($q_5 == true) {
      echo 'เป็นบัตรทรูมฟู (ไม่ใช่บัตรทรูมันนี่)';
    }
}else{
  echo 'ERROR||FU*K->YOU';
}

 ?>
