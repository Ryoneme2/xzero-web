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
    $q_0 = dd_q('SELECT * FROM setting_tb WHERE st_set != ? AND st_type = ?', ["on","buy_code"]);
    if ($q_0->rowCount() <= 0) {
    if (isset($_SESSION['id'])) {
     if (preg_match('/^[0-9]+$/', (int)$_POST['txt_id']) AND preg_match('/^[0-9]+$/', (int)$_POST['txt_qty']) AND (int)$_POST['txt_qty'] >= 1) {
          $q_1 = dd_q('SELECT * FROM user_tb WHERE u_id = ?', [$_SESSION['id']]);
          if ($q_1->rowCount() >= 1) {
              $row_1 = $q_1->fetch(PDO::FETCH_ASSOC);
                $q_2 = dd_q('SELECT * FROM code_tb WHERE c_id = ?', [(int)$_POST['txt_id']]);
                if ($q_2->rowCount() >= 1) {
                  $row_2 = $q_2->fetch(PDO::FETCH_ASSOC);
                  $price = $row_2['c_price'] * (float)$_POST['txt_qty'];
                    if ($row_1['u_point'] >= $price) {
                        $q_3 = dd_q('SELECT * FROM stockcode_tb WHERE sc_cid = ? AND sc_userid = ?', [(int)$_POST['txt_id'],0]);
                        if ($q_3->rowCount() >= (int)$_POST['txt_qty']) {

                            $qty = 0;
                            for ($i=1; $i <= (int)$_POST['txt_qty']; $i++) {
                              if ($row_1['u_point'] >= $row_2['c_price']) {
                                $q_4 = dd_q('UPDATE user_tb SET u_point = u_point - ?,u_youbuy = u_youbuy + ? WHERE u_id = ?', [$row_2['c_price'],$row_2['c_price'],$_SESSION['id']]);
                                if ($q_4 == true) {
                                  $q_5 = dd_q('UPDATE stockcode_tb SET sc_userid = ?,sc_buydate = ? WHERE sc_cid = ? AND sc_userid = ? LIMIT 1', [$_SESSION['id'],date("Y-m-d H:i:s"),(int)$_POST['txt_id'],0]);
                                  if ($q_5 == false) {
                                    dd_return(false, "สั่งซื้อชิ้นที่ {$i} ไม่สำเร็จ");
                                  }else{
                                    $qty++;
                                  }
                                }else{
                                  dd_return(false, "หักเงินชิ้นที่ {$i} ไม่สำเร็จ");
                                }
                              }else{
                                dd_return(false, "ยอดเงินคงเหลือไม่เพียงพอ สำหรับชิ้นที่ {$i}");
                              }
                          }
                          dd_return(true, "สั่งซื้อสินค้าสำเร็จ {$qty} ชิ้น");




                        }else{
                          dd_return(false, "สินค้าไม่เพียงพอ");
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
