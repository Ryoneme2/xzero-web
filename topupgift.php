<?php 

include '../system.php';

$class = new shopweb;
//ทำการนำข้อมูลจากฐานข้อมูลเข้ามา ข้อมูลคือเบอร์รับเงิน
$phone = $class->getphone();

$code = $_POST['topupgift'];


$voucher_h = explode("https://gift.truemoney.com/campaign/?v=", $code);


if (empty($_SESSION['username'])) {
	echo json_encode(array('status' =>'error', 'info' =>'กรุณาเข้าสู่ระบบก่อนดำเนินการ'));
} elseif (empty($voucher_h[1])) {
	echo json_encode(array('status' =>'error', 'info' =>'กรุณากรอกลิ้งอั่งเปาให้ถูกต้อง'));
} else {

	
	$topup = $class->redeem($phone,$voucher_h[1]);
	if ($topup['status'] == "success") {
		$class->add_history_topup($topup['amount_baht'],$topup['voucher_owner'],$phone);
		$js = json_encode($topup, JSON_UNESCAPED_UNICODE);
		echo $js;
	}else{
		$js = json_encode($topup, JSON_UNESCAPED_UNICODE);
		echo $js;
	}

}

?>