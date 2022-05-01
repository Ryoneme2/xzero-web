<style media="screen">
  .iffbcm {
    width: 100%!important;
    height: 450px;
  }
  @media (max-width: 575.98px) {
    .iffbcm {
      width: 100%!important;
      height: 500px;
    }
  }
</style>
<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="bg_contentlogin_reg" style="text-align: center">
          <div class="row justify-content-center">
            <div class="col-md-12 col-lg-6 mt-2 mb-2">
              <!-- <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FJspShopMarket%2F%3Fref%3Dprofile_intro_card&tabs=timeline&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=501898887031136" -->

              <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F<?php echo $_CONFIG['fanpage_@']; ?>%2F%3Fref%3Dprofile_intro_card&tabs=timeline&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=501898887031136"
               class="iffbcm" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            </div>
            <div class="col-md-12 col-lg-6 mt-2 mb-2">
              <h1 class="text-left mb-2">ติดต่อ</h1>
              <h5  class="text-left">เฟสส่วนตัว :  <a href="<?php echo $_CONFIG['facebook_me']; ?>" target="_blank"><?php echo $_CONFIG['facebook_name']; ?></a></h5>
              <h5  class="text-left">แฟนเฟจ :  <a href="https://www.facebook.com/<?php echo $_CONFIG['fanpage_@']; ?>/" target="_blank"><?php echo $_CONFIG['fanpage_name']; ?></a></h5>
              <h5  class="text-left">เบอร์ :  <a href="tel:<?php echo $_CONFIG['tel']; ?>"><?php echo $_CONFIG['tel']; ?></a></h5>




            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>
