<style media="screen">
  .vbox-figlio {
    width: auto!important;
    height: auto!important;
  }
</style>
<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="bg_contentlogin_reg">
            <?php
              $q = dd_q("SELECT * FROM product_tb INNER JOIN type_tb ON product_tb.pd_tyid = type_tb.t_id WHERE product_tb.pd_id = ? AND product_tb.pd_usid = ?",[$_GET['id'],0]);
              if ($q->rowCount() >= 1) {
                $row = $q->fetch(PDO::FETCH_ASSOC);
            ?>
                <div class="row">
                  <div class="col-12 col-lg-4 mt-2 text-center">
                      <img src="<?php echo base_url()."/img/product_image/".$row['pd_img']; ?>" alt="ITEM" width="350" height="350" class="img-fluid">
                  </div>
                  <div class="col-12 col-lg-8 mt-2">
                        <h4 style="color:var(--main-color);"><?php echo $row['pd_name']; ?></h4>
                        <span class="text-muted">หมวดหมู่สินค้า : <?php echo $row['t_name']; ?></span>
                        <div class="mt-3">
                          <?php $vip_price = ((float)$row['pd_price'] * (float)$_CONFIG['vip_sale']) / 100.00; ?>
                            <h6>
                              <span style="color:rgb(91, 91, 91);">ราคาปกติ: <?php echo number_format($row['pd_price'],2); ?> บาท</span>
                              <?php
                              if (isset($_SESSION['id'])) {
                                $q_1 = dd_q("SELECT * FROM user_tb WHERE u_id = ?",[$_SESSION['id']]);
                                if ($q_1->rowCount() >= 1) {
                                $row_1 = $q_1->fetch(PDO::FETCH_ASSOC);
                              ?>
                                <span style="color:rgb(255, 51, 51); <?php if ($row_1['u_youbuy'] >= $_CONFIG['buy_vip']) { echo ''; }else{ echo 'text-decoration: line-through;';} ?>">ราคา VIP: <?php echo number_format($row['pd_price'] - $vip_price,2); ?> บาท</span>
                              <?php } } ?>
                            </h6>
                        </div>
                        <h6 class="badge badge-success badge-xs p-1 pl-2 pr-2" style="font-size: 12px;font-weight:none;">สถานะ : ยังมีสินค้า</h6>
                        <div class="mt-2">
                          <h6 style="color:var(--sec-color);">รายละเอียด</h6>
                          <p class="text-muted" style="word-wrap: break-word; white-space:pre-wrap;width:80%;"><?php echo $row['pd_des']; ?></p>
                        </div>
                        <div class="row mt-5">
                          <div class="col-12 col-lg-4">
                            <a class="btn btn-info w-100 venobox" data-gall="gallery01" href="<?php echo base_url()."/img/product_image/".$row['pd_img']; ?>"><i class="fas fa-images mr-1"></i>รูปภาพเพิ่มเติม</a>
                          </div>
                          <div class="col-12 col-lg-4">
                            <button type="button" id="btn_buyid" onclick="buyid('<?php echo$_GET['id']; ?>');" class="btn btn-success w-100" <?php echo check_login_disabled(); ?>>
                              <i class="fas fa-shopping-cart mr-1"></i><?php echo check_login_text("สั่งซื้อสินค้า"); ?>
                            </button>
                          </div>
                        </div>
                        <?php
                         $q_2 = dd_q("SELECT * FROM image_tb WHERE img_pdid = ?",[$_GET['id']]);
                         while ($row_2 = $q_2->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                           <a class="venobox d-none" data-gall="gallery01" href="<?php echo base_url()."/img/product_image/".$row_2['img_name']; ?>"></a>
                        <?php } ?>

                  </div>
                </div>
            <?php }else{ ?>
              <h1 class="text-center">ไม่พบข้อมูล</h1>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
</div>
