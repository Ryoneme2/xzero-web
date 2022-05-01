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

// //////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id'])) {
     if (preg_match('/^[0-9]+$/', (int)$_POST['buyqty']) AND preg_match('/^[0-9]+$/', (int)$_POST['cardid'])) {
       if ((int)$_POST['buyqty'] >= 1 AND (int)$_POST['cardid'] >= 1) {
          $q_1 = dd_q('SELECT * FROM user_tb WHERE u_id = ?', [$_SESSION['id']]);
          if ($q_1->rowCount() >= 1) {
              $row_1 = $q_1->fetch(PDO::FETCH_ASSOC);
                $q_2 = dd_q('SELECT * FROM cardoption_tb WHERE co_id = ?', [(int)$_POST['cardid']]);
                if ($q_2->rowCount() >= 1) {
                  $row_2 = $q_2->fetch(PDO::FETCH_ASSOC);
                  $price = $row_2['co_price'] * (float)$_POST['buyqty'];
                    if ($row_1['u_point'] >= $price) {
                        $q_3 = dd_q('SELECT * FROM cardstock_tb WHERE cs_coid = ? AND cs_userid = ?', [(int)$_POST['cardid'],0]);
                        if ($q_3->rowCount() >= (int)$_POST['buyqty']) {

                            $qty = 0;
                            for ($i=1; $i <= (int)$_POST['buyqty']; $i++) {
                              if ($row_1['u_point'] >= $row_2['co_price']) {
                                $q_4 = dd_q('UPDATE user_tb SET u_point = u_point - ?,u_youbuy = u_youbuy + ? WHERE u_id = ?', [$row_2['co_price'],$row_2['co_price'],$_SESSION['id']]);
                                if ($q_4 == true) {
                                  $q_5 = dd_q('UPDATE cardstock_tb SET cs_userid = ?,cs_datebuy = ? WHERE cs_coid = ? AND cs_userid = ? LIMIT 1', [$_SESSION['id'],date("Y-m-d H:i:s"),(int)$_POST['cardid'],0]);
                                  if ($q_5 == false) {
                                    dd_return(false, "สั่งซื้อรายการที่ {$i} ไม่สำเร็จ");
                                  }else{
                                    $qty++;
                                  }
                                }else{
                                  dd_return(false, "หักเงินรายการที่ {$i} ไม่สำเร็จ");
                                }
                              }else{
                                dd_return(false, "ยอดเงินคงเหลือไม่เพียงพอ สำหรับรายการที่ {$i}");
                              }
                          }
                          dd_return(true, "สั่งซื้อสินค้าสำเร็จ {$qty} รายการ");


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
        dd_return(false, "กรุณาเลือกข้อมูลให้ครบ");
        }
      }else{
      dd_return(false, "กรุณากรอก ตัวเลข เท่านั้น");
      }
    }else{
    dd_return(false, "เข้าสู่ระบบก่อนทำรายการ");
    }

}else{
  dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
}

?>
