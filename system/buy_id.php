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

// //////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $q_0 = dd_q('SELECT * FROM setting_tb WHERE st_set != ? AND st_type = ?', ["on","buy_item"]);
    if ($q_0->rowCount() <= 0) {
    if (isset($_SESSION['id'])) {
     if (preg_match('/^[0-9]+$/', (int)$_POST['txt_id'])) {
          $q_1 = dd_q('SELECT * FROM user_tb WHERE u_id = ?', [$_SESSION['id']]);
          if ($q_1->rowCount() >= 1) {
              $row_1 = $q_1->fetch(PDO::FETCH_ASSOC);
                $q_2 = dd_q('SELECT * FROM product_tb WHERE pd_id = ? AND pd_usid = ?', [(int)$_POST['txt_id'],0]);
                if ($q_2->rowCount() >= 1) {

                  $row_2 = $q_2->fetch(PDO::FETCH_ASSOC);
                  if ((float)$row_1['u_youbuy'] >= 10000.00) {
                    $sell_price = ((float)$row_2['pd_price'] * (float)$_CONFIG['vip_sale']) / 100.00;
                    $price = (float)$row_2['pd_price'] - $sell_price;
                  }else{
                    $price = (float)$row_2['pd_price'];
                  }


                    if ($row_1['u_point'] >= $price) {
                      $q_3 = dd_q('UPDATE user_tb SET u_point = u_point - ?,u_youbuy = u_youbuy + ? WHERE u_id = ?', [$price,$price,$_SESSION['id']]);
                      if ($q_3 == true) {
                        $q_4 = dd_q('UPDATE product_tb SET pd_usid = ?,pd_buydate = ? WHERE pd_id = ?', [$_SESSION['id'],date("Y-m-d H:i:s"),(int)$_POST['txt_id']]);
                        if ($q_4 == true) {
                          dd_return(true, "สั่งซื้อสินค้าสำเร็จ");
                        }else{
                          dd_return(false, "สั่งซื้อไม่สำเร็จ");
                        }
                      }else{
                        dd_return(false, "หักเงินไม่สำเร็จ");
                      }
                    }else{
                      dd_return(false, "ยอดเงินคงเหลือไม่เพียงพอ");
                    }


                }else{
                  dd_return(false, "ไม่พบสินค้า");
                }
          }else{
            dd_return(false, "ไม่พบชื่อผู้ใช้งาน");
          }
      }else{
      dd_return(false, "กรุณากรอก ตัวเลข เท่านั้น");
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









?>
