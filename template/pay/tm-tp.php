<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-4">
            <div class="list-group" style="margin:30px;">
              <a href="<?php echo base_url()."/payment/gift"; ?>" class="list-group-item list-group-item-action">
                <i class="fab fa-google-wallet mr-1"></i> ทรูมันนี่วอลเล็ท
              </a>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
          <div class="bg_contentlogin_reg">
                <h3 class="">เติมเงิน truemoney</h3>
                <hr>

                <form>
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_paytm_ref" placeholder=" " maxlength="14">
                    <label for="txt_paytm_ref">รหัสบัตรทรูมันนี่ 14 หลัก <span class="text-danger">*</span></label>
                  </div>
                  <div class="text-center mt-5">
                    <div class="g-recaptcha" style="display: inline-block;" data-sitekey="<?php echo $_CONFIG['sitekey']; ?>"></div>
                  </div>
                  <input type="hidden"  id="txt_paytm_user">

                </form>

                <div class="table-responsive mt-2 mb-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" style="font-size:20px;font-weight:bold;">ราคาบัตร</th>
                          <th scope="col" style="font-size:20px;font-weight:bold;">Point ที่ได้รับ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">บัตร 50 ทรู</th>
                          <td><?php echo $_CONFIG['truemoney_50']; ?> Point</td>
                        </tr>
                        <tr>
                          <th scope="row">บัตร 90 ทรู</th>
                          <td><?php echo $_CONFIG['truemoney_90']; ?> Point</td>
                        </tr>
                        <tr>
                          <th scope="row">บัตร 150 ทรู</th>
                          <td><?php echo $_CONFIG['truemoney_150']; ?> Point</td>
                        </tr>
                        <tr>
                          <th scope="row">บัตร 300 ทรู</th>
                          <td><?php echo $_CONFIG['truemoney_300']; ?> Point</td>
                        </tr>
                        <tr>
                          <th scope="row">บัตร 500 ทรู</th>
                          <td><?php echo $_CONFIG['truemoney_500']; ?> Point</td>
                        </tr>
                        <tr>
                          <th scope="row">บัตร 1000 ทรู</th>
                          <td><?php echo $_CONFIG['truemoney_1000']; ?> Point</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                <div class="row justify-content-center mb-2">
                    <div class="col-lg-6 text-center">
                      <button type="button" class="btn btn-success btn-block" id="btn_paytm" <?php echo check_login_disabled(); ?>>
                        <i class="fas fa-check-circle mr-1"></i><?php echo check_login_text("ยืนยันเติมเงิน"); ?>
                      </button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
