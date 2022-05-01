<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="bg_contentlogin_reg">
            <?php
              $q = dd_q("SELECT * FROM code_tb INNER JOIN type_tb ON code_tb.c_tyid = type_tb.t_id WHERE code_tb.c_id = ?",[$_GET['id']]);
              if ($q->rowCount() >= 1) {
                $row = $q->fetch(PDO::FETCH_ASSOC);
            ?>
                <div class="row">
                  <div class="col-12 col-lg-4 mt-2 text-center">
                      <img src="<?php echo base_url()."/img/product_image/".$row['c_img']; ?>" alt="ITEM" width="350" height="350" class="img-fluid">
                  </div>
                  <div class="col-12 col-lg-8 mt-2">
                        <h4 style="color:var(--main-color);"><?php echo $row['c_name']; ?></h4>
                        <span class="text-muted">หมวดหมู่สินค้า : <?php echo $row['t_name']; ?></span>
                        <div class="mt-3">
                            <h6>
                              <span style="color:rgb(91, 91, 91);">ราคาปกติ: <?php echo number_format($row['c_price'],2); ?> บาท</span>
                            </h6>
                        </div>
                        <?php
                          $q_1 = dd_q("SELECT * FROM stockcode_tb WHERE sc_cid = ? AND sc_userid = ?",[$_GET['id'],0]);
                        ?>
                        <h6 class="badge badge-success badge-xs p-1 pl-2 pr-2" style="font-size: 12px;font-weight:none;">สต็อก : <?php echo $q_1->rowCount(); ?> ชิ้น</h6>

                        <!-- <h6 class="badge badge-danger badge-xs p-1 pl-2 pr-2" style="font-size: 12px;font-weight:none;">สต็อก : 0 ชิ้น</h6> -->

                        <div class="mt-2">
                          <h6 style="color:var(--sec-color);">รายละเอียด</h6>
                          <p class="text-muted" style="word-wrap: break-word; white-space:pre-wrap;width:80%;"><?php echo $row['c_des']; ?></p>
                        </div>
                        <div class="row mt-5">
                          <div class="col-12 col-lg-4">
                            <button type="button" id="btn_buycode" onclick="buycode('<?php echo$_GET['id']; ?>');" class="btn btn-success w-100" <?php if($q_1->rowCount() <= 0) {echo "disabled";}; ?> <?php echo check_login_disabled(); ?>>
                              <i class="fas fa-shopping-cart mr-1"></i><?php echo check_login_text("สั่งซื้อสินค้า"); ?>
                            </button>
                          </div>
                          <div class="col-12 col-lg-4">
                            <div class="md-form" style="width: 100px;">
                              <input type="number" id="txt_qty" class="form-control" value="1" placeholder=" ">
                              <label for="numberExample">จำนวนที่ต้องการ</label>
                            </div>
                          </div>
                        </div>
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
