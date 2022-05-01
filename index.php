<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once __DIR__ . '/template/header-tp.php'; ?>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="sweetalert2.min.js"></script>
  <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <script src="sweetalert2.all.min.js"></script>
</head>

<body style="background-color: #eee;">
  <?php include_once __DIR__ . '/template/fb-tp.php'; ?>
  <div class="container-fluid pr-0 pl-0" id="wrapper">
    <div id="header">
      <?php include_once __DIR__ . '/template/navbar-tp.php'; ?>
    </div>
    <div id="content">
      <?php
      if (isset($_GET['onpage']) and $_GET['onpage'] == 'gift') {
        include_once __DIR__ . '/template/pay/gift.php';
        exit;
      }
      ?>
      <?php include_once __DIR__ . '/template/banner-tp.php'; ?>

      <?php if (isset($_GET['onpage']) and $_GET['onpage'] == 'login') { ?>

        <?php if (isset($_SESSION['id'])) {
          $link = base_url() . "/";
          header("location: {$link}");
          exit();
        } else {
          include_once __DIR__ . '/template/login-tp.php';
        } ?>

      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'register') { ?>

        <?php if (isset($_SESSION['id'])) {
          $link = base_url() . "/";
          header("location: {$link}");
          exit();
        } else {
          include_once __DIR__ . '/template/reg-tp.php';
        } ?>

      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'reset') { ?>

        <?php if (isset($_SESSION['id'])) {
          $link = base_url() . "/";
          header("location: {$link}");
          exit();
        } else {
          include_once __DIR__ . '/template/resetpass-tp.php';
        } ?>

      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'truemoney') { ?>
        <?php include_once __DIR__ . '/template/pay/tm-tp.php'; ?>
      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'truewallet') { ?>
        <?php include_once __DIR__ . '/template/pay/tw-tp.php'; ?>
      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'bank') { ?>
        <?php include_once __DIR__ . '/template/pay/b-tp.php'; ?>
      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'card') { ?>
        <?php include_once __DIR__ . '/template/card-tp.php'; ?>
      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'contact') { ?>
        <?php include_once __DIR__ . '/template/contact-tp.php'; ?>
      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'shop') { ?>
        <?php include_once __DIR__ . '/template/shop-tp.php'; ?>
      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'code') { ?>
        <?php include_once __DIR__ . '/template/code-tp.php'; ?>
      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'csgogame') { ?>
        <?php include_once __DIR__ . '/template/csgo-game.php'; ?>
      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'product_detail') { ?>
        <?php include_once __DIR__ . '/template/product_detail-tp.php'; ?>
      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'code_detail') { ?>
        <?php include_once __DIR__ . '/template/code_detail-tp.php'; ?>

      <?php } elseif (isset($_GET['onpage']) and $_GET['onpage'] == 'profile') { ?>
        <?php if (!isset($_SESSION['id'])) {
          $link = base_url() . "/login";
          header("location: {$link}");
          exit();
        } else {
          include_once __DIR__ . '/template/profile-tp.php';
        } ?>
      <?php } else { ?>
        <div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
          <div class="container">
            <div class="row mb-3">
              <div class="col-12 col-md-6 col-lg-4 mb-2 mt-2">
                <a href="<?php echo base_url(); ?>/shop/1/1">
                  <img src="<?php echo base_url(); ?>/img/button/1.png" alt="350x200" class="img-fluid w-100 hoverable">
                </a>
              </div>
              <div class="col-12 col-md-6 col-lg-4 mb-2 mt-2">
                <a href="<?php echo base_url(); ?>/payment/gift">
                  <img src="<?php echo base_url(); ?>/img/button/2.png" alt="350x200" class="img-fluid w-100 hoverable">
                </a>
              </div>
              <div class="col-12 col-md-6 col-lg-4 mb-2 mt-2">
                <a href="<?php echo base_url(); ?>/profile">
                  <img src="<?php echo base_url(); ?>/img/button/3.png" alt="350x200" class="img-fluid w-100 hoverable">
                </a>
              </div>
            </div>
            <div class="row justify-content-center mt-4">
              <div class="col-12 mb-1 mt-1">
                <img src="<?php echo base_url(); ?>/img/promotion/promotion_1.png" alt="1280x250" class="img-fluid hoverable">
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid pt-4 pb-3">
          <div class="container">
            <h2 style="font-weight: bold;" class="mt-2 mb-4">New Products <span class="text-muted" style="font-size: 50%;font-weight: 400;">สินค้ามาใหม่</span></h2>

            <div class="row justify-content-center mt-4 mb-2">
              <div class="col-12">
                <style media="screen">
                  .slick-prev:before,
                  .slick-next:before {
                    font-family: 'slick';
                    font-size: 20px;
                    line-height: 1;
                    opacity: .75;
                    color: #000;
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                  }

                  .slick-dots {
                    display: none !important;
                  }

                  .slick-slide {
                    text-align: -webkit-center;
                  }
                </style>
                <div class="slick-track">

                  <?php
                  $q_new = dd_q("SELECT * FROM product_tb WHERE pd_usid = ? ORDER BY pd_date DESC LIMIT 6", [0]);

                  while ($row_new = $q_new->fetch(PDO::FETCH_ASSOC)) {

                  ?>
                    <div>
                      <div class="card mb-4 product-item" style="width:270px;height: 465px;">
                        <div class="view overlay">
                          <img class="card-img-top" src="<?php echo base_url() . "/img/product_image/{$row_new['pd_img']}"; ?>" alt="Card image cap" style="width:270px;height: 270px;">
                          <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                          </a>
                        </div>
                        <div class="card-body">
                          <h4 class="card-title"><?php echo $row_new['pd_name']; ?></h4>
                          <hr>
                          <p class="card-text">ราคา: <?php echo number_format($row_new['pd_price'], 2); ?> บาท</p>
                          <a href="<?php echo base_url() . "/product_detail/{$row_new['pd_id']}"; ?>" class="btn btn-main-color">สั่งซื้อ</a>
                        </div>
                      </div>
                    </div>
                  <?php } ?>


                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <?php include_once __DIR__ . '/template/modal/modal-tem.php'; ?>
    </div>

    <?php include_once __DIR__ . '/template/copyright-tp.php'; ?>
  </div>



</body>
<?php include_once __DIR__ . '/template/footer-tp.php'; ?>

</html>