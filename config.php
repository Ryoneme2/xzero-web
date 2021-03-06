<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");

function base_url() {
  return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"."";
}
$links_re = base_url();
require_once __dir__ . "/asset/php-graph-sdk-5.x/src/Facebook/autoload.php";

$str_hosting = 'localhost'; // EDIT
$str_database = 'shopza'; // EDIT
$str_password = ''; // EDIT
$str_username = 'root'; // EDIT

try {
    $conn = new PDO("mysql:host=$str_hosting;dbname=$str_database",$str_username,$str_password);
    $conn->exec("set names utf8");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
function get_setting($text)
{
  return $text ?? '';
}
function bg_change($where){
	$q_setting = dd_q("SELECT * FROM setting_tb WHERE st_type = ? LIMIT 1", [$where]);
	$row_setting = $q_setting->fetch(PDO::FETCH_ASSOC);
  get_setting($row_setting['st_set']);
}
function dd_q($str, $arr = []) {
    global $conn;
    try {
        $exec = $conn->prepare($str);
        $exec->execute($arr);
    } catch (PDOException $e) {
        return false;
    }
    return $exec;
}
function check_login_disabled() {
  if(isset($_SESSION['id'])) {
    $show = "";
  }else{
    $show = "disabled";
  }
  return $show;
}
function check_login_text($text) {
  if(isset($_SESSION['id'])) {
    $show = $text;
  }else{
    $show = "เข้าสู่ระบบ";
  }
  return $show;
}
function get_credit(){
	$q_credit = dd_q('SELECT * FROM user_tb WHERE u_id = ? LIMIT 1', [$_SESSION['id']]);
	$row_credit = $q_credit->fetch(PDO::FETCH_ASSOC);
	return $row_credit['u_point'];
}


// get_setting();
// exit;

$_CONFIG = array();
$_CONFIG['nameserver_full'] = "Xzero-Gameshop"; //ชื่อเซิฟ แบบเต็ม
$_CONFIG['nameserver_short'] = "Xzero-Gameshop"; //ชื่อเซิฟ แบบย่อ


$_CONFIG['number_wallet'] = '0823482522'; //เบอร์ วอลเล็ทเท่านั้น 

$_CONFIG['sitekey'] = "6LfGSJkeAAAAACXo-TJKb3YGGAav1t-_qnD5nGh_"; //Google reCAPTCHA Site
$_CONFIG['secretkey'] = "6LfGSJkeAAAAACsdtdKkVB-jciXbdN5dEkr6bP8d"; //Google reCAPTCHA Secret


$_CONFIG['buy_vip'] = 400.00; //ซื้อเท่าไหร่เป็น VIP
$_CONFIG['vip_sale'] = 20; //vip ลดราคากี่ %

$_CONFIG['tmpay_id'] = get_setting("tmpay_id"); //รหัสร้านค้า TMPAY (ใน DB แก้หลังร้านได้)
//===============Point ที่ได้รับของ truemoney=================//
$_CONFIG['truemoney_50'] = 41;
$_CONFIG['truemoney_90'] = 74;
$_CONFIG['truemoney_150'] = 123;
$_CONFIG['truemoney_300'] = 246;
$_CONFIG['truemoney_500'] = 410;
$_CONFIG['truemoney_1000'] = 820;
//========================================================//

$_CONFIG['you_email'] = get_setting("gmail_user"); //gmail ของคุณ (ใน DB แก้หลังร้านได้)
$_CONFIG['you_email_password'] = get_setting("gmail_pass"); //รหัสผ่าน gmail (ใน DB แก้หลังร้านได้)
//กดเปิด อนุญาตแอปที่มีความปลอดภัยน้อย เพิ่อใช้ในการส่งเมล์
//https://myaccount.google.com/u/4/lesssecureapps?utm_source=google-account&utm_medium=web

$_CONFIG['main_color'] = "#99FF99"; //รหัสสีหลักสำหรับเว็บไซต์ (แนะนำให้ทำรูปสีนี้เป็นหลัก)
$_CONFIG['sec_color'] = "#ff94b1"; //รหัสสีรองสำหรับเว็บไซต์ (แนะนำให้ใช้สีที่ตัดกับรูป)
$_CONFIG['copyright_color'] = "#fcfcfc"; //รหัสสีตัวอักษรสำหรับด้านล่างเว็บไซต์ (แนะนำให้ใช้โทนมืดใน กรณีที่พื้นหลังสว่าง ถ้าพื้นหลังโทนมืด แนะนำตัวอักษรสว่าง)

$_CONFIG['fanpage_@'] = "MagMaBuxTh"; //คือชื่อหลังลิ้งแฟนเพจ https://www.facebook.com/MagMaBuxTh  หมายถึง MagMaBuxTh
$_CONFIG['fanpage_id'] = "MagMaBuxTh"; //แฟนเพจ ID
$_CONFIG['fanpage_appId'] = "111807212698634"; //แอพ ID
$_CONFIG['fanpage_appSecret'] = "93f0519d98a1b719ffaffc0dbd854ce5"; //ข้อมูลลับของแอพ
$_CONFIG['fanpage_version'] = "6.0"; //แอพ version
//ลิ้ง callback https://domain.com.com/system/fblogin.php

$_CONFIG['fanpage_name'] = "MagMaBuxTh";
$_CONFIG['facebook_name'] = "Rotjanasak Poemtoem";
$_CONFIG['facebook_me'] = "https://www.facebook.com/profile.php?id=100016080676211"; //แอพ version


$_CONFIG['tel'] = get_setting("0823482522"); //เบอร์โทร ไม่ต้องการโชว์ให้ใส่ "-" แบบนี้
$_CONFIG['line'] = "@Rotjanasak"; //ถ้าเป็น line ส่วยตัวให้ใส่ ~ตามด้วย ID Line เช่น ~qqqqqqq แต่ถ้าเป็น line@ ให้ใส่ @ตามด้วย ID Line@  เช่น @qqqqqqq

$_CONFIG['howto_all'] = "https://youtu.be/EVx8zwCEkKM"; //ลิ้งวิธีใช้งานทั้งหมด
$_CONFIG['howto_register'] = "https://youtu.be/EVx8zwCEkKM"; //ลิ้งวิธีสมัคร
$_CONFIG['howto_download'] = "https://youtu.be/EVx8zwCEkKM"; //ลิ้งวิธีดาวน์โหลด
$_CONFIG['howto_payment'] = "https://youtu.be/EVx8zwCEkKM"; //ลิ้งวิธีเติมเงิน

$_CONFIG['banner_text1_line1'] = $_CONFIG['nameserver_short']; //ข้อความบนรูป ปกรูปที่ 1 -> บรรทัด 1
$_CONFIG['banner_text1_line2'] = "เว็บขายไอดีอัตโนมัติ"; //ข้อความบนรูป ปกรูปที่ 1 -> บรรทัด 2
$_CONFIG['banner_text1_line3'] = "กดซื้อได้เล่นทันทีไม่ต้องรอ"; //ข้อความบนรูป ปกรูปที่ 1 -> บรรทัด 3

$_CONFIG['banner_text2_line1'] = $_CONFIG['nameserver_short']; //ข้อความบนรูป ปกรูปที่ 2 -> บรรทัด 1
$_CONFIG['banner_text2_line2'] = "เติมเงินเร็วทันใจ"; //ข้อความบนรูป ปกรูปที่ 2 -> บรรทัด 2
$_CONFIG['banner_text2_line3'] = "อัตโนมัติทุกช่องทาง เร็วทันใจ"; //ข้อความบนรูป ปกรูปที่ 2 -> บรรทัด 3

$_CONFIG['banner_text3_line1'] = $_CONFIG['nameserver_short']; //ข้อความบนรูป ปกรูปที่ 3 -> บรรทัด 1
$_CONFIG['banner_text3_line2'] = "ซื้อครบ 1,000 บาท"; //ข้อความบนรูป ปกรูปที่ 3 -> บรรทัด 2
$_CONFIG['banner_text3_line3'] = "ได้สิทธิซื้อสินค้าในราคาพิเศษ"; //ข้อความบนรูป ปกรูปที่ 3 -> บรรทัด 3


$fb = new Facebook\Facebook([
  'app_id' => $_CONFIG['fanpage_appId'],
  'app_secret' => $_CONFIG['fanpage_appSecret'],
  'default_graph_version' => 'v3.2',
]);

?>
