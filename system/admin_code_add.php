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

    if ($_POST['name'] != "" AND $_POST['name'] != null AND $_POST['des'] != "" AND $_POST['des'] != null
  AND $_POST['type'] != "" AND $_POST['type'] != null AND $_POST['price'] != "" AND $_POST['price'] != null AND $_POST['price'] >= 1 AND $_FILES['file']['size'] !== 0) {
      if (preg_match('/^[0-9.]+$/', $_POST['price'])) {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_id = ?', [$_SESSION['backend']]);
            if ($q_1->rowCount() >= 1) {
              //==============================================================//
                $q_2 = dd_q('SELECT * FROM type_tb WHERE t_id = ?', [$_POST['type']]);
                if ($q_2->rowCount() >= 1) {

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
                          $q_3 = dd_q('INSERT INTO code_tb (c_name,c_des,c_img,c_price,c_date,c_tyid) VALUES (?, ?, ?, ?, ?, ?)', [
                            $_POST['name'],
                            $_POST['des'],
                            $basename,
                            $_POST['price'],
                            date("Y-m-d H:i:s"),
                            $_POST['type']
                          ]);
                          if ($q_3 == true) {
                            dd_return(true, "เพิ่มข้อมูลสำเร็จ");
                          }else{
                            dd_return(false, "เกิดข้อผิดพลาด");
                          }
                        }else{
                          dd_return(false, "ย้ายรูปไม่สำเร็จ");
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
