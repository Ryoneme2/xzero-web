<?php
session_start();
if (!isset($_SESSION['backend'])) {
  header("location: {$link}/backend/setting");
}
require_once 'tw.class.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Gen Wallet</title>
  </head>
  <body>
    <center>
      <form action="r_genwallet.php" method="post">
        <h5>ชื่อผู้ใช้งาน wallet</h5>
        <input type="text" name="user"><br>
        <h5>ชื่อรหัสผ่าน wallet</h5>
        <input type="text" name="pass"><br><br><br>
        <button type="submit" name="save">ตั้งค่าระบบ</button>
      </form>
    </center>
  </body>
</html>
