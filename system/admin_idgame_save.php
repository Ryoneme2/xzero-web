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

//////////////////////////////////////////////////////////////////////////

header('Content-Type: application/json; charset=utf-8;');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_SESSION['backend'])) {

    if ($_POST['id'] != "" AND $_POST['id'] != null AND $_POST['id'] != 0) {
      if (preg_match('/^[0-9]+$/', $_POST['id'])) {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_id = ?', [$_SESSION['backend']]);
            if ($q_1->rowCount() >= 1) {
              //==============================================================//
                $q_2 = dd_q('SELECT * FROM product_tb WHERE pd_id = ?', [$_POST['id']]);
                if ($q_2->rowCount() >= 1) {
                    $row = $q_2->fetch(PDO::FETCH_ASSOC);
                    if ($_FILES['file']['name'] == "" || empty($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name']) || $_FILES['file']['size'] == 0) {
                          //ไม่มีรูป
                          $q_3 = dd_q('UPDATE product_tb SET pd_name = ?,pd_des = ?,pd_price = ?,pd_tyid = ?,pd_user = ?,pd_pass = ?,pd_tel = ?,pd_email = ? WHERE pd_id = ? LIMIT 1', [
                            $_POST['name'],
                            $_POST['des'],
                            $_POST['price'],
                            $_POST['type'],
                            $_POST['user'],
                            $_POST['pass'],
                            $_POST['tel'],
                            $_POST['email'],
                            $_POST['id']
                          ]);
                          if ($q_3 == true) {
                            dd_return(true, "บันทึกข้อมูลสำเร็จ");
                          }else{
                            dd_return(false, "เกิดข้อผิดพลาด");
                          }

                     }else{
                        // มีรูป
                        $allowed = array('jpeg', 'png', 'jpg');
                        $filename = $_FILES['file']['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        if (!in_array($ext, $allowed)) {
                            dd_return(false, "ไฟล์รูปภาพเท่านั้น");
                        }else{
                            function randtext($range){
                              $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIGKLMNOPQRSTUVWXYZ123456789';
                              $start = rand(1,(strlen($char)-$range));
                              $shuffled = str_shuffle($char);
                              return substr($shuffled,$start,$range);
                            }
                            $newfile = randtext(3).time().randtext(5).".".$ext;
                            $basename = basename($newfile);
                            $url = base_url();
                            if (copy($_FILES['file']['tmp_name'],"../img/product_image/{$basename}")) {
                              $q_3 = dd_q('UPDATE product_tb SET pd_name = ?,pd_des = ?,pd_img = ?,pd_price = ?,pd_tyid = ?,pd_user = ?,pd_pass = ?,pd_tel = ?,pd_email = ? WHERE pd_id = ? LIMIT 1', [
                                $_POST['name'],
                                $_POST['des'],
                                $basename,
                                $_POST['price'],
                                $_POST['type'],
                                $_POST['user'],
                                $_POST['pass'],
                                $_POST['tel'],
                                $_POST['email'],
                                $_POST['id']
                              ]);
                              if ($q_3 == true) {
                                unlink("../img/product_image/{$row['pd_img']}");
                                dd_return(true, "บันทึกข้อมูลสำเร็จ");
                              }else{
                                dd_return(false, "เกิดข้อผิดพลาด");
                              }
                            }else{
                              dd_return(false, "เกิดข้อผิดพลาด");
                            }
                        }
                    }
                }
                dd_return(false, "ไม่พบข้อมูล");
              //==============================================================//
          }
          dd_return(false, "ไม่พบข้อมูล");
      }
      dd_return(false, "ตัวเลข เท่านั้น");
    }
    dd_return(false, "กรุณากรอกข้อมูลให้ครบ");
  }
  dd_return(false, "เข้าสู่ระบบก่อน");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!");
 ?>
