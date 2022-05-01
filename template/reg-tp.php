<?php
$uri = base_url()."/system/fblogin.php";
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginUrl  = $helper->getLoginUrl($uri, $permissions);
 ?>
<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-sm-2">
          <div class="bg_contentlogin_reg">
                <h3 class="">สมัครสมาชิก</h3>
                <hr>

                <form>
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_reg_user" placeholder=" ">
                    <label for="txt_reg_user">Username <span class="text-danger">*</span></label>
                  </div>
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_reg_pass" placeholder=" ">
                    <label for="txt_reg_pass">Password <span class="text-danger">*</span></label>
                  </div>
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_reg_conpass" placeholder=" ">
                    <label for="txt_reg_conpass">Confirm Password <span class="text-danger">*</span></label>
                  </div>
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_reg_email" placeholder=" ">
                    <label for="txt_reg_email">Email <span class="text-danger">*</span></label>
                  </div>
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_reg_key" placeholder=" " maxlength="4">
                    <label for="txt_reg_key">KEY <span class="text-danger">*รหัสลับกรณีลืมรหัสผ่านตัวเลข 4 หลัก</span></label>
                  </div>
                  <div class="text-center mt-5">
                    <div class="g-recaptcha" style="display: inline-block;" data-sitekey="<?php echo $_CONFIG['sitekey']; ?>"></div>
                  </div>


                </form>
                <div class="row mb-2">
                    <div class="col-lg-6 text-center">
                      <button type="button" class="btn btn-success btn-block" id="btn_register"><i class="fas fa-user-plus mr-1"></i>สมัครสมาชิก</button>
                    </div>
                    <div class="col-lg-6 text-center">
                      <a href="<?php echo base_url(); ?>/login" class="btn btn-danger btn-block"><i class="fas fa-sign-in-alt mr-1"></i>มีผู้ใช้งานอยู่แล้ว ?</a>
                    </div>
                    <div class="col-lg-12 text-center mt-2">
                        <a href="<?php echo $loginUrl; ?>" type="button" class="btn btn-primary btn-block"><i class="fab fa-facebook-f mr-1"></i>เข้าสู่ระบบด้วย Facebook</a>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
