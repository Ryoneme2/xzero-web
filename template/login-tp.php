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
                <h3 class="">เข้าสู่ระบบ</h3>
                <hr>

                <form>
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_login_user" placeholder=" ">
                    <label for="txt_login_user">Username <span class="text-danger">*</span></label>
                  </div>
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="password" class="form-control" id="txt_login_pass" placeholder=" ">
                    <label for="txt_login_pass">Password <span class="text-danger">*</span></label>
                  </div>
                  <div class="text-center mt-5">
                    <div class="g-recaptcha" style="display: inline-block;" data-sitekey="<?php echo $_CONFIG['sitekey']; ?>"></div>
                  </div>
                </form>
                <div class="row mb-2">
                    <div class="col-lg-6 text-center">
                      <button type="button" class="btn btn-success btn-block" id="btn_login" ><i class="fas fa-sign-in-alt mr-1"></i>เข้าสู่ระบบ</button>
                    </div>
                    <div class="col-lg-6 text-center">
                      <a href="<?php echo base_url(); ?>/reset" type="button" class="btn btn-danger btn-block"><i class="fas fa-reply mr-1"></i>ลืมรหัสผ่าน ?</a>
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
