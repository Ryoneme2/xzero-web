<?php
  session_start();
  require_once 'tw.class.php';
  if (isset($_POST['save']) AND isset($_SESSION['backend'])) {
    $tw = new TrueWallet($_POST['user'], $_POST['pass']);
    $data = $tw->RequestLoginOTP();
?>
  <center>
    <form action="r_genwallet_2.php" method="post">
      <h5>OTP Wallet</h5>
      <input type="text" name="otp"><br><br><br>
      <input type="hidden" name="user" value="<?php echo $_POST['user'];?>">
      <input type="hidden" name="pass" value="<?php echo $_POST['pass'];?>">
      <input type="hidden" name="tel" value="<?php echo $data['data']['mobile_number'];?>">
      <input type="hidden" name="ref" value="<?php echo $data['data']['otp_reference'];?>">
      <button type="submit" name="save">ยืนยัน otp</button>
    </form>
  </center>
<?php
  }else{
    echo "ERROR";
  }
?>
