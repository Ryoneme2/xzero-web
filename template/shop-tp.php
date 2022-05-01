<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-3">
            <div class="list-group" style="margin-top:30px;">
              <?php
              $q = dd_q("SELECT * FROM type_tb WHERE t_type  = ?",[0]);
              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <a href="<?php echo base_url()."/shop/{$row['t_id']}/1"; ?>" class="list-group-item list-group-item-action <?php if ($_GET['id'] == $row['t_id']) { echo "active";}?>">
                <?php echo $row['t_name']; ?>
              </a>
              <?php } ?>
            </div>
        </div>
        <div class="col-md-12 col-lg-9 mt-4">
          <?php
            $q = dd_q("SELECT * FROM type_tb WHERE t_id  = ? AND t_type = ?",[$_GET['id'],0]);
            if ($q->rowCount() <= 0) {
          ?>
            <div class="mt-5 mb-5 text-center">
              <h1>ไม่พบข้อมูล</h1>
            </div>

          <?php }else{ ?>
            <div class="row justify-content-center">
                <?php
                  $pages_pg = $_GET['subpage'];
                  $page_limit = 9;
                  if ($pages_pg == "" || (int)$pages_pg <= 0) {$pages_pg = 1;}
                  $q_page = dd_q("SELECT * FROM product_tb WHERE pd_tyid = ? AND pd_usid = ?",[$_GET['id'],0]);
                  $total_data = $q_page->rowCount();
                  $total_page = ceil($total_data / $page_limit);
                  $start_page = ($pages_pg - 1) * $page_limit;

                  $q = dd_q("SELECT * FROM product_tb WHERE pd_tyid = ? AND pd_usid = ? ORDER BY pd_date DESC LIMIT {$start_page},{$page_limit}",[$_GET['id'],0]);
                  if ($q->rowCount() <= 0) {
                ?>
                  <div class="mt-5 mb-5 text-center">
                    <h1>ไม่พบข้อมูล</h1>
                  </div>
                <?php }else{ ?>
                  <?php while ($row = $q->fetch(PDO::FETCH_ASSOC)) { ?>
                  <div class="col-12 col-md-6 col-lg-4" style="text-align: -webkit-center;">
                    <div class="card mb-4 product-item" style="width:230px;height: 450px;">
                          <div class="view overlay">
                            <img class="card-img-top" src="<?php echo base_url()."/img/product_image/".$row['pd_img']; ?>" alt="Product" style="width:230px;height: 230px;">
                            <a href="#!">
                              <div class="mask rgba-white-slight"></div>
                            </a>
                          </div>
                          <div class="card-body text-center">
                            <h4 class="card-title"><?php echo $row['pd_name']; ?></h4>
                            <hr>
                            <p class="card-text">ราคา: <?php echo number_format($row['pd_price'],2); ?> บาท</p>
                            <a href="<?php echo base_url()."/product_detail/{$row['pd_id']}"; ?>" class="btn btn-main-color">สั่งซื้อ</a>
                          </div>
                    </div>
                  </div>
                <?php } ?>
              <?php } ?>
            </div>
            <div class="row justify-content-center">
                <div class="col-offset-12 col-md-offset-12 col-lg-offset-12 mt-5 mb-2" style="text-align: -webkit-center;">
                  <nav class="pagination-nav" aria-label="Page navigation example" style="overflow-x: auto;">
                      <ul class="pagination pagination-circle pg-blue">
                        <li class="page-item"><a class="page-link text-center" href="<?php echo base_url()."/shop/{$_GET['id']}/1"; ?>" style="width: 75px;">หน้าแรก</a></li>
                        <li class="page-item">
                          <a class="page-link <?php if($start_page <= 0) {echo "disabled";} ?>" aria-label="Previous" href="<?php echo base_url()."/shop/{$_GET['id']}/{$start_page}"; ?>">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <?php for ($i=1; $i <= $total_page; $i++) { ?>
                          <li class="page-item <?php if($_GET['subpage'] == $i){echo "active";}?>">
                            <a class="page-link" href="<?php echo base_url()."/shop/{$_GET['id']}/{$i}"; ?>"><?php echo $i; ?></a>
                          </li>
                        <?php } ?>
                        <li class="page-item">
                          <?php $page_next = (int)$_GET['subpage']+1; ?>
                          <a class="page-link <?php if($total_page <= (int)$_GET['subpage']) {echo "disabled";} ?>" aria-label="Next" href="<?php echo base_url()."/shop/{$_GET['id']}/{$page_next}"; ?>" >
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                        <li class="page-item"><a class="page-link text-center" href="<?php echo base_url()."/shop/{$_GET['id']}/{$total_page}"; ?>" style="width: 120px;">หน้าสุดท้าย</a></li>
                      </ul>
                    </nav>
                </div>
            </div>
          <?php } ?>


        </div>
      </div>
    </div>
</div>
