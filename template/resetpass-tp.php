<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-sm-2">
          <div class="bg_contentlogin_reg">
                <h3 class="">ลืมรหัสผ่าน ?</h3>
                <hr>

                <form>
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_reset_email" placeholder=" ">
                    <label for="txt_login_user">Email <span class="text-danger">*</span></label>
                    <small class="grey-text" style="font-size: 13px;">
                      อีเมล์ต้องตรงกับตอนสมัครสมาชิก รอรับรหัสผ่านใหม่ที่อีเมล์
                    </small>
                  </div>
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_reset_key" placeholder=" " maxlength="4">
                    <label for="txt_reset_key">KEY <span class="text-danger">*รหัสลับตัวเลข 4 หลัก</span></label>
                    <small class="grey-text" style="font-size: 13px;">
                      KEY 4 หลักต้องตรงกับตอนสมัครสมาชิก
                    </small>
                  </div>
                  <div class="text-center mt-5">
                    <div class="g-recaptcha" style="display: inline-block;" data-sitekey="<?php echo $_CONFIG['sitekey']; ?>"></div>
                  </div>

                </form>
                <div class="row mb-2">
                    <div class="col-lg-6 text-center">
                      <button type="button" class="btn btn-success btn-block" id="btn_reset" ><i class="fas fa-share-square mr-1"></i>ส่งรหัสผ่านใหม่</button>
                    </div>
                    <div class="col-lg-6 text-center">
                      <a href="<?php echo base_url(); ?>/login" class="btn btn-danger btn-block"><i class="fas fa-sign-in-alt mr-1"></i>เข้าสู่ระบบ</a>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
