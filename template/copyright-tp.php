0283ba<style media="screen">
  .ftimg {
    background-image: url("<?php echo base_url(); ?>/img/footer/1.jpg");
    color: var(--copyright-color);
    font-size: 13px;
    font-weight: bold;
  }
  .text-copyright {
    color: #333 !important;
    text-decoration: underline;
  }
  .text-copyright:hover {
    color: var(--copyright-color);
    opacity: 0.6;
  }
  .titleft {
    font-size: 15px;
    font-weight: bold;
  }
  .iffb {
    width: 310px;
    height: 140px;
  }
  .fffs {
    color: #333 !important;
  }

  @media (min-width:0px) and (max-width: 575.98px) {
    .iffb {
      width: 265px;
      height: 140px;
    }
    .fffs {
      text-align: center;
    }
  }

  @media (min-width:575.98px) and (max-width: 767.98px) {
    .fffs {
      text-align: center;
    }
  }

  @media (min-width:767.98px) and  (max-width: 991.98px) {
    .fffs {
      text-align: center;
    }
  }

  @media (min-width:991.98px) and (max-width: 1199.98px) {


  }
</style>
<footer id="footer">
  <div class="container-fluid ftimg">
    <div class="container">
      <div class="row pt-5 pb-5">

        <div class="col-12 col-md-8 col-lg-4 mb-2 fffs">
          <img src="<?php echo base_url(); ?>/img/logo/lognav.png" class="d-inline-block align-top img-fluid">
          <div class="mt-2 mb-4">Copyright © <?php echo date("Y")." ".$_CONFIG['nameserver_short']; ?> All rights reserved.</div>

          <p>เว็บไซต์สำหรับ คนสนใจ ID เกม โค้ตเติมเกมต่างๆ มาที่นี้เลย <?php echo $_CONFIG['nameserver_full']; ?></p>
        </div>
        <div class="col-6 col-md-4 col-lg-2 mb-2 fffs">
          <div class="mt-2 mb-3 titleft">Contact</div>
          <p>
            <div class="mb-3 mt-1">
              เบอร์: <?php echo $_CONFIG['tel']; ?>
            </div>
            <div class="mb-3 mt-1">
              Fanpage : @<?php echo $_CONFIG['fanpage_@']; ?>
            </div>
            <div class="mb-3 mt-1">
              จ - อา : 24Hr.
            </div>
          </p>
        </div>
        <div class="col-6 col-md-4 col-lg-2 mb-2 fffs">
          <div class="mt-2 mb-3 titleft">Help ?</div>
          <p>
            <div class="mb-3 mt-1">
              <a href="<?php echo $_CONFIG['howto_register']; ?>" target="_blank" class="list-none text-copyright">วิธีการสมัครสมาชิก</a>
            </div>
            <div class="mb-3 mt-1">
              <a href="<?php echo $_CONFIG['howto_download']; ?>" target="_blank" class="list-none text-copyright">วิธีการดาวน์โหลด</a>
            </div>
            <div class="mb-3 mt-1">
              <a href="<?php echo $_CONFIG['howto_payment']; ?>" target="_blank" class="list-none text-copyright">วิธีการเติมเงิน</a>
            </div>
          </p>
        </div>
        <div class="col-12 col-md-8 col-lg-4 mb-2 fffs">
          <div class="mt-2 mb-3 titleft">Facebook Fanpage</div>
          <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F<?php echo $_CONFIG['fanpage_@']; ?>%2F&tabs=timeline&width=310&height=140&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=502704343866570" class="iffb" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        </div>

      </div>
    </div>
  </div>
  <div class="container-fluid  p-4" style="background-color: #009933;">
    <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col-xs-12 col-md-6 col-lg-6 cpr-left">
              Web all developer by <?php echo $_CONFIG['nameserver_full']; ?>.
          </div>
          <div class="col-xs-12 col-md-6 col-lg-6 cpr-right">
              <img src="<?php echo base_url(); ?>/img/payment/payments.png" alt="payments.png" class="img-fluid">
          </div>
        </div>
    </div>
  </div>
</footer>
<div class="fb-customerchat" page_id="<?php echo $_CONFIG['fanpage_id']; ?>" theme_color="<?php echo $_CONFIG['sec_color']; ?>" logged_in_greeting="ติดต่อ สอบถามได้นะครับ" logged_out_greeting="ติดต่อ สอบถามได้นะครับ"></div>
