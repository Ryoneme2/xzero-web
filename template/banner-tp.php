<style media="screen">
  .carousel-caption span.nameweb {
    color: var(--sec-color);
    font-size: 48px;
    font-weight: 900;
    text-shadow: rgba(0,0,0,.7) 0 1px 2px;
  }
  .carousel-caption span.title {
    font-size: 30px;
    font-weight: 900;
    text-shadow: rgba(0,0,0,.7) 0 1px 2px;
  }
  .carousel-caption span.subtitle {
    font-size: 20px;
    text-shadow: rgba(0,0,0,.7) 0 1px 2px;
  }

  .carousel-caption#pagecarousel {
    position: absolute;
    right: 15%;
    bottom: 150px;
    left: 15%;
    z-index: 10;
    padding-top: 20px;
    padding-bottom: 20px;
    color: #fff;
    text-align: center;
  }
  .carousel-caption#pagecarousel .text-pagecarousel {
    color: var(--sec-color);
    font-size: 39px;
    font-weight: 700;
    text-transform: uppercase;
  }
  .carousel-caption#pagecarousel .text-sub-pagecarousel , .carousel-caption#pagecarousel .text-sub-pagecarousel a {
    color: #999!important;
    text-decoration: none;
  }
  .carousel-caption#pagecarousel .text-sub-pagecarousel a:hover {
    color: #707070!important;
    text-decoration: none;
  }


  .carousel-caption {
    position: absolute;
    right: 0%;
    bottom: 150px;
    left: 20%;
    z-index: 10;
    padding-top: 20px;
    padding-bottom: 20px;
    color: #fff;
    text-align: left;
  }
  @media (min-width:0px) and (max-width: 575.98px) {
    .carousel-caption {
        bottom: 0px;
        left: 15%;
    }
    .carousel-caption span.nameweb {
      font-size: 18px;
    }
    .carousel-caption span.title {
      font-size: 12px;
    }
    .carousel-caption span.subtitle {
      font-size: 10px;
    }

    .carousel-caption#pagecarousel .text-pagecarousel {
      font-size: 18px;
    }
    .carousel-caption#pagecarousel .text-sub-pagecarousel , .carousel-caption#pagecarousel .text-sub-pagecarousel a {
      font-size: 10px;
    }
    .carousel-caption#pagecarousel {
      bottom: 10px;
    }
  }

  @media (min-width:575.98px) and (max-width: 767.98px) {
    .carousel-caption {
        bottom: 45px;
        left: 17%;
    }
    .carousel-caption span.nameweb {
      font-size: 30px;
    }
    .carousel-caption span.title {
      font-size: 15px;
    }
    .carousel-caption span.subtitle {
      font-size: 13px;
    }
    .carousel-caption#pagecarousel {
      bottom: 30px;
    }
  }

  @media (min-width:767.98px) and  (max-width: 991.98px) {
    .carousel-caption {
      bottom: 70px;
      left: 17%;
    }
    .carousel-caption span.nameweb {
      font-size: 35px;
    }
    .carousel-caption span.title {
      font-size: 20px;
    }
    .carousel-caption span.subtitle {
      font-size: 18px;
    }
    .carousel-caption#pagecarousel {
      bottom: 50px;
    }
  }

  @media (min-width:991.98px) and (max-width: 1199.98px) {
    .carousel-caption {
      left: 19%;
      bottom: 90px;
    }
    .carousel-caption span.nameweb {
      font-size: 40px;
    }
    .carousel-caption span.title {
      font-size: 25px;
    }
    .carousel-caption#pagecarousel {
      bottom: 80px;
    }

  }
</style>
<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
  <!--Indicators-->
  <ol class="carousel-indicators">
    <?php if(isset($_GET['onpage']) AND $_GET['onpage'] == 'login') { ?>
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
    <?php }else{ ?>
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    <?php } ?>
  </ol>
  <!--/.Indicators-->
  <!--Slides 1920 * 500-->
  <div class="carousel-inner" role="listbox">
  <?php if(isset($_GET['onpage']) AND $_GET['onpage'] == 'login') { ?>
    <div class="carousel-item active" id="pagecarousel">
      <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
        <div class="carousel-caption" id="pagecarousel">
          <span class="text-pagecarousel">เข้าสู่ระบบ</span>
          <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > เข้าสู่ระบบ</div>
        </div>
    </div>
  <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'register') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">สมัครสมาชิก</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > สมัครสมาชิก</div>
          </div>
      </div>
  <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'reset') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">ลืมรหัสผ่าน</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > ลืมรหัสผ่าน</div>
          </div>
      </div>

  <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'truemoney') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">เติมเงิน truemoney</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > เติมเงิน truemoney</div>
          </div>
      </div>
    <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'csgogame') { ?>
        <div class="carousel-item active" id="pagecarousel">
          <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
            <div class="carousel-caption" id="pagecarousel">
              <span class="text-pagecarousel">เสี่ยงโชค CSGO</span>
              <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > เสี่ยงโชค CSGO</div>
            </div>
        </div>
  <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'truewallet') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">เติมเงิน truewallet</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > เติมเงิน truewallet</div>
          </div>
      </div>
  <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'bank') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">เติมเงิน Bank</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > เติมเงิน Bank</div>
          </div>
      </div>
    <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'credit') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">เครดิต</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > เครดิต</div>
          </div>
      </div>
    <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'contact') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">ติดต่อ</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > ติดต่อ</div>
          </div>
      </div>
    <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'shop') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">ร้านค้า</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > ร้านค้า</div>
          </div>
      </div>
    <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'code') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">ไอเท็มโค้ต</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > ไอเท็มโค้ต</div>
          </div>
      </div>
    <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'product_detail') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">รายละเอียดสินค้า</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > รายละเอียดสินค้า</div>
          </div>
      </div>
    <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'code_detail') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">รายละเอียดโค้ต</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > รายละเอียดโค้ต</div>
          </div>
      </div>
    <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'card') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">บัตรเติมเงิน</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > บัตรเติมเงิน</div>
          </div>
      </div>
    <?php }elseif(isset($_GET['onpage']) AND $_GET['onpage'] == 'profile') { ?>
      <div class="carousel-item active" id="pagecarousel">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/4.png" style="max-height: 500px;"alt="First slide">
          <div class="carousel-caption" id="pagecarousel">
            <span class="text-pagecarousel">โปรไฟล์</span>
            <div class="text-sub-pagecarousel mt-2"><a href="<?php echo base_url(); ?>">หน้าหลัก</a> > โปรไฟล์</div>
          </div>
      </div>
    <?php }else{ ?>

      <!--First slide-->
      <div class="carousel-item active">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/1.png" style="max-height: 500px;"alt="First slide">
        <div class="carousel-caption">
            <span class="nameweb animated zoomIn" style="animation-delay: 0.5s"><?php echo $_CONFIG['banner_text1_line1']; ?></span><br>
            <span class="title animated zoomIn" style="animation-delay: 1s"><?php echo $_CONFIG['banner_text1_line2']; ?></span><br>
            <span class="subtitle animated zoomIn" style="animation-delay: 1.5s"><?php echo $_CONFIG['banner_text1_line3']; ?></span><br>
          </div>
      </div>
      <!--/First slide-->
      <!--Second slide-->
      <div class="carousel-item">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/2.png" style="max-height: 500px;" alt="Second slide">
        <div class="carousel-caption">
          <span class="nameweb animated zoomIn" style="animation-delay: 0.5s"><?php echo $_CONFIG['banner_text2_line1']; ?></span><br>
          <span class="title animated zoomIn" style="animation-delay: 1s"><?php echo $_CONFIG['banner_text2_line2']; ?></span><br>
          <span class="subtitle animated zoomIn" style="animation-delay: 1.5s"><?php echo $_CONFIG['banner_text2_line3']; ?></span><br>
          </div>
      </div>
      <!--/Second slide-->
      <!--Third slide-->
      <div class="carousel-item">
        <img class="d-block w-100 img-fluid" src="<?php echo base_url(); ?>/img/banner/3.png" style="max-height: 500px;" alt="Third slide">
        <div class="carousel-caption">
            <span class="nameweb animated zoomIn" style="animation-delay: 0.5s"><?php echo $_CONFIG['banner_text3_line1']; ?></span><br>
            <span class="title animated zoomIn" style="animation-delay: 1s"><?php echo $_CONFIG['banner_text3_line2']; ?></span><br>
            <span class="subtitle animated zoomIn" style="animation-delay: 1.5s"><?php echo $_CONFIG['banner_text3_line3']; ?></span><br>
          </div>
      </div>
      <!--/Third slide-->

    <?php } ?>
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
