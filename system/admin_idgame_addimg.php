<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once '../config.php';

function dd_return($status, $message, $id) {
    $json = ['message' => $message];
    if ($status) {
        http_response_code(200);
        if (isset($id)) $json['id'] = $id;
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
    if ($_POST['id'] != "" AND $_POST['id'] != null AND $_POST['id'] != 0 ) {
      if (preg_match('/^[0-9]+$/', $_POST['id'])) {
            $q_1 = dd_q('SELECT * FROM admin_tb WHERE ad_id = ?', [$_SESSION['backend']]);
            if ($q_1->rowCount() >= 1) {
              //==============================================================//
                $q_2 = dd_q('SELECT * FROM product_tb WHERE pd_id = ? AND pd_usid = ?', [$_POST['id'],0]);
                if ($q_2->rowCount() >= 1) {

                    if(is_array($_FILES)) {
                      function randtext($range){
                         $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIGKLMNOPQRSTUVWXYZ123456789';
                         $start = rand(1,(strlen($char)-$range));
                         $shuffled = str_shuffle($char);
                         return substr($shuffled,$start,$range);
                      }
                      $s = 0;
                      foreach ($_FILES['files']['name'] as $name => $value) {
                           $file_name = explode(".", $_FILES['files']['name'][$name]);
                           $allowed_ext = array("jpg", "jpeg", "png");
                           if(in_array($file_name[1], $allowed_ext)) {
                                $new_name = randtext(3).time().randtext(5).".".$file_name[1];
                                $sourcePath = $_FILES['files']['tmp_name'][$name];
                                if(move_uploaded_file($sourcePath, "../img/product_image/{$new_name}")) {
                                  $q_3 = dd_q('INSERT INTO image_tb (img_name,img_pdid) VALUES (?, ?)', [
                                    $new_name,
                                    $_POST['id']
                                  ]);
                                  $s++;
                                }
                           }
                      }
                      dd_return(true, "เพิ่มรูปสำเร็จ {$s} รูป","{$_POST['id']}");
                    }else{
                      dd_return(false, "เลือกรูปด้วย"," ");
                    }

                }
                dd_return(false, "ไม่พบข้อมูล"," ");
              //==============================================================//
          }
          dd_return(false, "ไม่พบข้อมูล"," ");
      }
      dd_return(false, "ตัวเลข เท่านั้น"," ");
    }
    dd_return(false, "กรุณากรอกข้อมูลให้ครบ"," ");
  }
  dd_return(false, "เข้าสู่ระบบก่อน"," ");
}
dd_return(false, "Method '{$_SERVER['REQUEST_METHOD']}' not allowed!"," ");
 ?>
