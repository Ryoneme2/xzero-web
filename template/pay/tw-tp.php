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
                <h3 class="">เติมเงิน truewallet</h3>
                <hr>
                <div class="bg-danger p-2 mt-2 mb-2 text-white">
                  หลังโอนรอ 1 - 2 นาท นำเลขอ้างอิงมากรอก  <span style="font-size: 15px;font-weight:bold;">( 1 บาท = 1 Point )</span>
                </div>
                <div class="bg-primary p-2 mb-2">
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr class="text-white">
                          <th scope="col">ชื่อวอลเล็ท</th>
                          <th scope="col">เบอร์วอลเล็ท</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="text-white">
                          <td><?php echo $_CONFIG['name_wallet']; ?></td>
                          <!-- <td><?php print_r($_CONFIG) ?></td> -->
                          <td><span class="text-white"><?php echo $_CONFIG['number_wallet']; ?></span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <form>
                  <!-- Material input -->
                  <div class="md-form form-group mt-5">
                    <input type="text" class="form-control" id="txt_paytw_ref" placeholder=" " maxlength="14">
                    <label for="txt_paytw_ref"> กรอกเลขอ้างอิง<span class="text-danger">*</span></label>
                  </div>
                  <div class="text-center mt-5">
                    <div class="g-recaptcha" style="display: inline-block;" data-sitekey="<?php echo $_CONFIG['sitekey']; ?>"></div>
                  </div>

                  <input type="hidden"  id="txt_paytw_user">

                </form>
                <div class="mt-2 mb-4">
                  <a href="<?php echo $_CONFIG['howto_payment']; ?>" target="_blank">ไม่รู้วิธีเติมเงิน กดที่นี้เลย !!</a>
                </div>



                <div class="row justify-content-center mb-2">
                    <div class="col-lg-6 text-center">
                      <button type="button" class="btn btn-success btn-block" id="btn_paytw" <?php echo check_login_disabled(); ?>>
                        <i class="fas fa-check-circle mr-1"></i><?php echo check_login_text("ยืนยันเติมเงิน"); ?>
                      </button>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>
