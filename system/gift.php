<?php
include '../config.php';
// print_r($_SESSION);
check_login_text('โปรดเข้าสู่ระบบ');
// echo get_credit();
	$link = $_POST['link'];
	$voucher_hash = str_replace("https://gift.truemoney.com/campaign/?v=","",$link);
	$phone = $_CONFIG['number_wallet'];
	$curl = curl_init();
		curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://gift.truemoney.com/campaign/vouchers/'.$voucher_hash.'/redeem',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_SSLVERSION => 7,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(array('mobile' => $phone,'voucher_hash' => $voucher_hash)),
        CURLOPT_HTTPHEADER => array(
            'accept: application/json',
            'content-type: application/json',
            
        ),
        CURLOPT_USERAGENT => "please_give_me_money"
    ));
	
    $response = curl_exec($curl);
	curl_close($curl);
    $result = json_decode($response);
    if (isset($result->status->code)) {
        $codestatus = $result->status->code;
        if ($codestatus == "VOUCHER_OUT_OF_STOCK") {
            $message['status'] = "error";
            $message['info'] = "อั๋งเปานี้ถูกใช้งานไปแล้ว";
        }elseif ($codestatus == "VOUCHER_NOT_FOUND") {
            $message['status'] = "error";
            $message['info'] = "ไม่พบอั๋งเปานี้!!";
        }elseif ($codestatus == "VOUCHER_EXPIRED"){
            $message['status'] = "error";
            $message['info'] = "อั๋งเปาหมดอายุ!!";
        }elseif ($codestatus == "SUCCESS"){
            $balance = $result->data->voucher;
            $ownerprofile = $result->data->owner_profile;
            if ($balance->amount_baht == $balance->redeemed_amount_baht) {
                $message['status'] = "success";
                $message['info'] = "เติมเงินสำเร็จ";
                $message['amount_baht'] = $balance->redeemed_amount_baht;
                $message['voucher_owner'] = $ownerprofile->full_name;
				//code add point here
            }else{
                $message['status'] = "error";
                $message['info'] = "กรุณาแบ่งอั๋งเปาแค่1คน!!";
            }
        }else{
            $message['status'] = "error";
            $message['info'] = "ไม่ทราบสาเหตุ!!";
        }
    }else{
        $message['status'] = "error";
        $message['info'] = "ลิ้งอั๋งเปาไม่ถูกต้อง";
    }
 ?>
<?php
$credit = get_credit();
// echo $credit;
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>?-?</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="sweetalert2.all.min.js"></script>
  </head>
  <body>
    
  </body>
</html>
<?php
if ($message['status'] == "success") {
  $money = $message['amount_baht'];
  $id_user = $_SESSION['id'];
  $sql = "UPDATE user_tb SET u_point= u_point + ".$money." WHERE u_id ='". $id_user ."'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
	
  $conn = null;
	$_SESSION['status'] = "success";
	$_SESSION['msg'] = $message['info'];  
	$_SESSION['amount'] = $message['amount_baht'];
	header("location:../payment/gift");
	
}else{
  $error = $message['info'];
  $_SESSION['status'] = "error";
  $_SESSION['msg'] = $message['info']; 
  header("location:../payment/gift");
  
}
?>
