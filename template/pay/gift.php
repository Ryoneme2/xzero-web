<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-4">
            <div class="list-group" style="margin:30px;">
              <a href="<?php echo base_url()."/payment/gift"; ?>" class="list-group-item list-group-item-action active">
                <i class="fab fa-google-wallet mr-1"></i> ทรูมันนี่วอลเล็ท
              </a>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
          <div class="bg_contentlogin_reg">
                <h3 class="">เติมเงิน  ซองอั่งเปา 🧧</h3>
                <hr>
                <div class="bg-danger p-2 mt-2 mb-2 text-white">
                  หลังโอนรอ 1 - 2 นาที นำลิงค์มากรอก  <span style="font-size: 15px;font-weight:bold;">( 10 บาท = 10 Point )</span>
                </div>
                <form class="" action="../system/gift.php" method="post">
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" name="link" placeholder=" ">
                  </div>
                <div class="mt-2 mb-4">
                  <a href="<?php echo $_CONFIG['howto_payment']; ?>" target="_blank">ไม่รู้วิธีเติมเงิน กดที่นี้เลย !!</a>
                </div>


                  <div class="text-center mt-5">
                    <div class="g-recaptcha" style="display: inline-block;" data-sitekey="<?php echo $_CONFIG['sitekey']; ?>"></div>
                  </div>
                <div class="row justify-content-center mb-2">
                    <div class="col-lg-6 text-center">
                      <button type="submit" class="btn btn-success btn-block" id="btn_paytw" <?php echo check_login_disabled(); ?>>
                        <i class="fas fa-check-circle mr-1"></i><?php echo 'ยืนยันเติมเงิน'; ?>
                      </button>
                    </div>
                </div>
                </form>
          </div>
        </div>
      </div>
    </div>
</div>
<?php 
	
		if (isset($_SESSION['status'])){
			if ($_SESSION['status'] == "success"){
				echo "<script>      Swal.fire({
					title: 'สำเร็จ',
					text: '".$_SESSION['msg']."  จำนวน ".$_SESSION['amount']." บาท',
					icon: 'success',
					timer: 3000,
					confirmButtonText: 'OK'
				});</script>";
			}else{
				echo "<script>      Swal.fire({
					title: 'ผิดพลาด',
					text: '".$_SESSION['msg']."',
					icon: 'error',
					timer: 3000,
					confirmButtonText: 'OK'
				});</script>";
			}
			unset($_SESSION['amount']);
			unset($_SESSION['status']);
			unset($_SESSION['msg']);
			
		}
	?>