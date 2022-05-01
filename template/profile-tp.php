<style media="screen">
  a {
    text-decoration: none;
    color: #000;
  }
    .table-responsive::-webkit-scrollbar {
      width: 20px;
      height: 10px;
    }
    /* Track */
    .table-responsive::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    /* Handle */
    .table-responsive::-webkit-scrollbar-thumb {
      background: #888;
    }

    /* Handle on hover */
    .table-responsive::-webkit-scrollbar-thumb:hover {
      background: #555;
    }

</style>
<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">

      <div class="row">
          <div class="col-12 col-lg-3 mt-3">
            <ul class="list-group">
              <a href="<?php echo base_url(); ?>/profile/">
                <li class="list-group-item <?php if($_GET['subpage'] != 'log_buy' AND $_GET['subpage'] != 'log_payment' AND $_GET['subpage'] != 'mailbox') { echo "active"; }?>">
                  <i class="fas fa-users-cog mr-1"></i>ข้อมูลส่วนตัว
                </li>
              </a>
              <a href="<?php echo base_url(); ?>/profile/mailbox">
                <li class="list-group-item <?php if(isset($_GET['subpage']) AND $_GET['subpage'] == 'mailbox') { echo "active"; }?>">
                  <i class="fas fa-envelope mr-1"></i>กล่องจดหมาย
                </li>
              </a>
              <a href="<?php echo base_url(); ?>/profile/log_payment">
                <li class="list-group-item <?php if(isset($_GET['subpage']) AND $_GET['subpage'] == 'log_payment') { echo "active"; }?>">
                  <i class="fas fa-history mr-1"></i>ประวัติการเติมเงิน
                </li>
              </a>
              <a href="<?php echo base_url(); ?>/logout"><li class="list-group-item"><i class="fas fa-sign-out-alt mr-1"></i>ออกจากระบบ</li></a>
            </ul>
          </div>
          <div class="col-12 col-lg-9 mt-3">
              <?php if($_GET['subpage'] != 'log_buy' AND $_GET['subpage'] != 'log_payment' AND $_GET['subpage'] != 'mailbox') {?>
                  <div class="row">
                    <div class="col-12 col-lg-4 mt-2 text-center">
                      <?php
                          $q_1 = dd_q('SELECT * FROM user_tb WHERE u_id = ? LIMIT 1', [$_SESSION['id']]);
                          $row = $q_1->fetch(PDO::FETCH_ASSOC);
                          if ($row['u_type'] == "w") { $link = base_url();$show_reg = "Website"; }else{ $link = "";$show_reg = "Facebook"; }
                       ?>
                      <img src="<?php echo $link.$row['u_img']; ?>" alt="USER" width="200" height="200">
                    </div>
                    <div class="col-12 col-lg-8 mt-2">
                      <?php
                        if ($row['u_youbuy'] >= $_CONFIG['buy_vip']) {
                          $check_vip = "VIP";
                        }else{
                          $check_vip = "ผู้ใช้ทั่วไป";
                        }
                       ?>
                      <div class="mt-2">
                          <h5>ชื่อ : <?php echo $row['u_name']; ?></h5>
                      </div>
                      <div class="mt-2">
                          <h5>อีเมล์ : <?php echo $row['u_email']; ?></h5>
                      </div>
                      <div class="mt-2">
                          <h5>เงินคงเหลือ : <?php echo $row['u_point']; ?></h5>
                      </div>
                      <div class="mt-2">
                          <h5>ยอดรวมที่ซื้อ : <?php echo $row['u_youbuy']; ?></h5>
                      </div>
                      <div class="mt-2">
                          <h5>สมัครผ่าน : <?php echo $show_reg; ?></h5>
                      </div>
                      <div class="mt-2">
                          <h5>สถานะ : <?php echo $check_vip; ?></h5>
                      </div>
                    </div>
                    <div class="col-12 mt-5">
                      <h4>เปลี่ยนรหัสผ่าน</h4>
                      <form>
                        <div class="md-form form-group mt-5">
                          <input type="text" class="form-control" id="txt_change_oldpass" placeholder=" ">
                          <label for="txt_change_oldpass">รหัสผ่านปัจจุบัน <span class="text-danger">*</span></label>
                        </div>
                        <div class="md-form form-group mt-5">
                          <input type="text" class="form-control" id="txt_change_pass" placeholder=" ">
                          <label for="txt_change_pass">รหัสผ่านใหม่ <span class="text-danger">*</span></label>
                        </div>
                        <div class="md-form form-group mt-5">
                          <input type="text" class="form-control" id="txt_change_conpass" placeholder=" ">
                          <label for="txt_change_conpass">ยืนยันรหัสผ่านใหม่ <span class="text-danger">*</span></label>
                        </div>
                        <div class="md-form form-group mt-5">
                          <button type="button" class="btn btn-success btn-block" id="btn_change" <?php if ($row['u_type'] == "f") { echo "disabled";} ?>><i class="fas fa-undo-alt mr-1"></i>เปลี่ยนรหัสผ่าน</button>
                        </div>
                      </form>
                    </div>
                  </div>
              <?php }elseif(isset($_GET['subpage']) AND $_GET['subpage'] == 'mailbox') { ?>


                <ul class="nav nav-tabs nav-justified md-tabs primary-color" id="myTabJust_mail" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link active" id="id-tab-just" data-toggle="tab" href="#id-just" role="tab" aria-controls="id-just" aria-selected="true">
                        ไอดีเกม
                      </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="code-tab-just" data-toggle="tab" href="#code-just" role="tab" aria-controls="code-just" aria-selected="false">
                        ไอเท็มโค้ต
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="card-tab-just" data-toggle="tab" href="#card-just" role="tab" aria-controls="card-just" aria-selected="false">
                        บัตรเติมเงิน
                    </a>
                  </li>
                </ul>
                <div class="tab-content card pt-5" id="myTabContentJust_mail">
                  <div class="tab-pane fade show active" id="id-just" role="tabpanel" aria-labelledby="id-tab-just">
                    <div class="table-responsive pt-3 pb-3">
                        <table id="datatable_mailid" class="table table-striped ">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="th-md">รูป</th>
                              <th class="th-sm">รายละเอียด</th>
                              <th class="th-lg">ชื่อ</th>
                              <th class="th-sm">ราคา</th>
                              <th class="th-lg">วันที่-เวลา</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $q = dd_q("SELECT * FROM product_tb WHERE pd_usid = ? ORDER BY pd_buydate DESC",[$_SESSION['id']]);
                              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><img src="<?php echo base_url(); ?>/img/product_image/<?php echo $row['pd_img']; ?>" alt="<?php echo $row['pd_img']; ?>" class="img-fluid" width="80px" height="80px"></td>
                              <td><button type="button" onclick="IDdetail('<?php echo $row['pd_id']; ?>')" id="btn_detailid_<?php echo $row['pd_id']; ?>" class="btn btn-info">ข้อมูล</button></td>
                              <td><?php echo $row['pd_name']; ?></td>
                              <td><?php echo number_format($row['pd_price'],2); ?></td>
                              <td><?php echo $row['pd_buydate']; ?></td>
                            </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="code-just" role="tabpanel" aria-labelledby="code-tab-just">
                    <div class="table-responsive pt-3 pb-3">
                        <table id="datatable_mailcode" class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="th-md">รูป</th>
                              <th class="th-sm">รายละเอียด</th>
                              <th class="th-lg">ชื่อ</th>
                              <th class="th-sm">ราคา</th>
                              <th class="th-lg">วันที่-เวลา</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $q = dd_q("SELECT * FROM stockcode_tb INNER JOIN code_tb ON stockcode_tb.sc_cid = code_tb.c_id WHERE stockcode_tb.sc_userid = ? ORDER BY sc_buydate DESC",[$_SESSION['id']]);
                              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><img src="<?php echo base_url(); ?>/img/product_image/<?php echo $row['c_img']; ?>" alt="<?php echo $row['c_img']; ?>" class="img-fluid" width="80px" height="80px"></td>
                              <td><button type="button" onclick="CODEdetail('<?php echo $row['sc_id']; ?>')" id="btn_detailcode_<?php echo $row['sc_id']; ?>" class="btn btn-info">ข้อมูล</button></td>
                              <td><?php echo $row['c_name']; ?></td>
                              <td><?php echo $row['c_price']; ?></td>
                              <td><?php echo $row['sc_buydate']; ?></td>
                            </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="card-just" role="tabpanel" aria-labelledby="card-tab-just">
                    <div class="table-responsive pt-3 pb-3">
                        <table id="datatable_mailcard" class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="th-md">รูป</th>
                              <th class="th-lg">โค้ต</th>
                              <th class="th-md">ชื่อ</th>
                              <th class="th-sm">ราคา</th>
                              <th class="th-lg">วันที่-เวลา</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $q = dd_q("SELECT * FROM cardstock_tb INNER JOIN cardoption_tb ON cardstock_tb.cs_coid = cardoption_tb.co_id WHERE cardstock_tb.cs_userid = ? ORDER BY cardstock_tb.cs_datebuy DESC",[$_SESSION['id']]);
                              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                                $q1 = dd_q("SELECT * FROM cardoption_tb INNER JOIN cardtype_tb ON cardoption_tb.co_ctid = cardtype_tb.ct_id WHERE cardoption_tb.co_id = ?",[$row['co_id']]);
                                $row1 = $q1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><img src="<?php echo base_url(); ?>/img/product_image/<?php echo $row1['ct_image']; ?>" alt="<?php echo $row1['ct_image']; ?>" class="img-fluid" width="80px" height="80px"></td>
                              <td><?php echo $row['cs_code']; ?></td>
                              <td><?php echo $row1['ct_displayname']." ".$row['co_display']; ?></td>
                              <td><?php echo $row['co_price']; ?></td>
                              <td><?php echo $row['cs_datebuy']; ?></td>
                            </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>


              <?php }elseif(isset($_GET['subpage']) AND $_GET['subpage'] == 'log_payment') { ?>


                  <ul class="nav nav-tabs nav-justified md-tabs primary-color" id="myTabJust_pay" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="true-tab-just" data-toggle="tab" href="#true-just" role="tab" aria-controls="true-just" aria-selected="true">
                        ทรูมันนี่วอลเล็ท
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content card pt-5" id="myTabContentJust_pay">
                    <div class="tab-pane fade show active" id="true-just" role="tabpanel" aria-labelledby="true-tab-just">
                      <div class="table-responsive pt-3 pb-3">
                          <table id="datatable_truemoney" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="th-md">ลิงค์</th>
                                <th class="th-sm">ราคาบัตร</th>
                                <th class="th-sm">เงินที่ได้รับ</th>
                                <th class="th-md">สถานะ</th>
                                <th class="th-lg">วันที่-เวลา</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $i = 1;
                                $q = dd_q("SELECT * FROM logtopup WHERE username = ?",[$_SESSION['id']]);
                                while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td><?php echo $row['real_amount']; ?></td>
                                <td><?php echo $row['youpoint']; ?></td>
                                <td>
                                  <?php
                                    if($row['status'] == 1 ) {
                                      echo '<span class="badge badge-success p-2">สำเร็จ</span>';
                                    }elseif ($row['status'] == 3) {
                                      echo '<span class="badge badge-danger p-2">ซองอั่งเปาถูกใช้ไปแล้ว</span>';
                                    }elseif ($row['status'] == 4) {
                                      echo '<span class="badge badge-danger p-2">ซองอั่งเปาสดไม่ถูกต้อง</span>';
                                    }elseif ($row['status'] == 5) {
                                      echo '<span class="badge badge-danger p-2">ไม่ใช่ซองอั่งเปา</span>';
                                    }else{
                                      echo '<span class="badge badge-warning p-2">รอสักครู่..</span>';
                                    }
                                  ?>
                                </td>
                                <td><?php echo $row['date']; ?></td>
                              </tr>
                              <?php $i++; } ?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="bank-just" role="tabpanel" aria-labelledby="bank-tab-just">
                      <div class="table-responsive pt-3 pb-3">
                          <table id="datatable_bank" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="th-sm">จำนวนเงิน</th>
                                <th class="th-sm">วันที่</th>
                                <th class="th-sm">เวลา</th>
                                <th class="th-sm">เลขบัญชี</th>
                                <th class="th-sm">ช่องทาง</th>
                                <th class="th-lg">วันที่-เวลา</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $i = 1;
                                $q = dd_q("SELECT * FROM logbank_tb WHERE lb_userid = ?",[$_SESSION['id']]);
                                while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['lb_amount']; ?></td>
                                <td><?php echo $row['lb_date']; ?></td>
                                <td><?php echo $row['lb_time']; ?></td>
                                <td><?php echo $row['lb_account_number']; ?></td>
                                <td><?php echo $row['lb_chanel']; ?></td>
                                <td><?php echo $row['lb_added_time']; ?></td>
                              </tr>
                              <?php $i++; } ?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="wallet-just" role="tabpanel" aria-labelledby="wallet-tab-just">
                      <div class="table-responsive pt-3 pb-3">
                          <table id="datatable_wallet" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th class="th-md">เลขอ้างอิง</th>
                                <th class="th-lg">ชื่อ</th>
                                <th class="th-sm">เบอร์</th>
                                <th class="th-sm">จำนวนเงิน</th>
                                <th class="th-lg">วันที่-เวลา</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $i = 1;
                                $q = dd_q("SELECT * FROM logwallet_tb WHERE user_id = ?",[$_SESSION['id']]);
                                while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['lw_ref']; ?></td>
                                <td><?php echo $row['lw_name']; ?></td>
                                <td><?php echo $row['lw_tel']; ?></td>
                                <td><?php echo $row['lw_amount']; ?></td>
                                <td><?php echo $row['lw_datetime']; ?></td>
                              </tr>
                              <?php $i++; } ?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>


              <?php } ?>
          </div>


      </div>

      <div class="modal fade" id="desModal_id" tabindex="-1" role="dialog" aria-labelledby="desModalid" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="desModalidLabel">รายละเอียด</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="mb-3" style="font-size: 18px;">
                ชื่อผู้ใช้งาน : <span class="pduser_des">-</span><br>
                รหัสผ่าน : <span class="pdpass_des">-</span><br>
                เบอร์ : <span class="pdtel_des">-</span><br>
                อีเมล์ : <span class="pdemail_des">-</span><br>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดเมนู</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="desModal_code" tabindex="-1" role="dialog" aria-labelledby="desModalcode" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="desModalcodeLabel">รายละเอียด</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="mb-3" style="font-size: 18px;">
                โค้ต : <span class="code_des">-</span><br>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดเมนู</button>
            </div>
          </div>
        </div>
      </div>

    </div>
</div>
