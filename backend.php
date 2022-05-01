<?php require_once __DIR__  . '/config.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once __DIR__ . '/template/header-tp.php'; ?>
    <style media="screen">
      body {
        background: rgb(255,222,190);
        background: linear-gradient(90deg, rgba(255,222,190,1) 0%, rgba(209,255,252,1) 50%, rgba(255,222,190,1) 100%);
      }
      .table-responsive::-webkit-scrollbar {
        width: 20px;
        height: 10px;
      }
      .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
      }
      .table-responsive::-webkit-scrollbar-thumb {
        background: #888;
      }
      .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #555;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="container">
          <?php if (!isset($_SESSION['backend'])) { ?>
            <!-- login -->
              <form class="mt-5 p-5 bg-white z-depth-2">
                <h3 class="text-center mb-4">ระบบผู้ดูแล</h3>
                <div class="form-group row">
                  <label for="txt_backend_pass" class="col-lg-2 col-form-label">ชื่อผู้ใช้</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="txt_backend_user" placeholder="ชื่อผู้ใช้">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="txt_backend_pass" class="col-lg-2 col-form-label">รหัสผ่าน</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" id="txt_backend_pass" placeholder="รหัสผ่าน">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-12">
                    <button id="btn_backend_login" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
                  </div>
                </div>
              </form>
          <?php }else{ ?>
            <div class="row mt-2 mb-2">
                <div class="col-lg-6 col-12">
                  <a href="<?php echo base_url(); ?>/backend/setting" class="btn btn-info w-100 p-3">ตั้งค่าระบบ</a>
                </div>
                <div class="col-lg-6 col-12">
                  <a href="<?php echo base_url(); ?>/logout" class="btn btn-danger w-100 p-3">ออกจากระบบ</a>
                </div>
                <div class="col-lg-6 col-12" style="padding: 30px;">
                  <a href="<?php echo base_url(); ?>/backend/idgame" class="btn btn-success w-100 p-3">จัดการไอดี</a>
                  <a href="<?php echo base_url(); ?>/backend/code" class="btn btn-primary w-100 p-3">จัดการโค้ต</a>
                  <a href="<?php echo base_url(); ?>/backend/category" class="btn btn-warning w-100 p-3">จัดการหมวดหมู่</a>
                  <a href="<?php echo base_url(); ?>/backend/card" class="btn btn-brown w-100 p-3">จัดการบัตรเติมเงิน</a>
                  <a href="<?php echo base_url(); ?>/backend/user" class="btn btn-pink w-100 p-3">จัดการผู้ใช้งาน</a>
                  <a href="<?php echo base_url(); ?>/backend/random" class="btn btn-secondary w-100 p-3">จัดการระบบสุ่ม</a>

                </div>
                <div class="col-lg-6 col-12" style="padding: 10px;">
                  <div style="background: #fff;padding: 10px;">
                    <div class="md-form w-100">
                      <input type="text" id="txt_backend_reset_oldpass" class="form-control" placeholder=" ">
                      <label for="form1">รหัสผ่านเก่า</label>
                    </div>
                    <div class="md-form w-100">
                      <input type="text" id="txt_backend_reset_newpass" class="form-control" placeholder=" ">
                      <label for="form1">รหัสผ่านใหม่</label>
                    </div>
                    <div class="md-form w-100">
                      <input type="text" id="txt_backend_reset_connewpass" class="form-control" placeholder=" ">
                      <label for="form1">ยืนยันรหัสผ่านใหม่</label>
                    </div>
                    <button id="btn_backend_reset" class="btn btn-info w-100">เปลี่ยนรหัสผ่าน</button>
                  </div>
                </div>
            </div>


            <?php if(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'logwallet') { ?>
            <div class="row mt-5 mb-5">
                <div class="col-12 bg-white p-3">
                  <h2>รายการ Truewallet</h2>
                  <div class="table-responsive pt-3 pb-3">
                      <table id="datatable_backend_logwallet" class="table table-striped ">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th class="th-lg">เลขอ้างอิง</th>
                            <th class="th-lg">ชื่อ</th>
                            <th class="th-sm">เบอร์</th>
                            <th class="th-sm">จำนวน</th>
                            <th class="th-md">ชื่อผู้ใช้งาน</th>
                            <th class="th-lg">วันที่-เวลา</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i = 1;
                            $q = dd_q("SELECT * FROM logwallet_tb INNER JOIN user_tb ON logwallet_tb.user_id = user_tb.u_id ORDER BY logwallet_tb.lw_datetime DESC");
                            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['lw_ref']; ?></td>
                            <td><?php echo $row['lw_name']; ?></td>
                            <td><?php echo $row['lw_tel']; ?></td>
                            <td><?php echo number_format($row['lw_amount'],2); ?></td>
                            <td><?php echo $row['u_name']; ?></td>
                            <td><?php echo $row['lw_datetime']; ?></td>
                          </tr>
                          <?php $i++; } ?>
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
          <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'random') { ?>

            <div class="row mt-5 mb-5">
                <div class="col-12">
                  <a href="<?php echo base_url(); ?>/backend/lograndom" class="btn btn-cyan w-100 p-3">ประวัติการสุ่ม</a>
                </div>
                <div class="col-4 mt-2">
                  <a href="<?php echo base_url(); ?>/backend/csgo" class="btn btn-mdb-color w-100 p-3">จัดการเปอร์เซ็นต์ Csgo</a>
                </div>
                <div class="col-12">
                  <div class="row mt-5 mb-5">
                      <div class="col-12 bg-white p-3">
                          <h4 class="text-danger">***เพิ่มสต็อกรางวัลสุ่ม***</h4>
                          <div class="md-form">
                            <input type="text" id="txt_gameadd" class="form-control" placeholder=" ">
                            <label for="txt_gameadd">รหัสบัตร</label>
                          </div>
                          <div class="row">
                            <div class="col-12">
                                <select class="mdb-select md-form" id="txt_gamesel">
                                  <?php
                                    $q1 = dd_q("SELECT * FROM random_rewards");
                                    while($row1 = $q1->fetch(PDO::FETCH_ASSOC)) {
                                   ?>
                                   <option value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
                                  <?php } ?>
                                </select>
                                <label for="txt_gamesel">ประเภทบัตร</label>
                            </div>
                          </div>
                          <button type="button" class="btn btn-success w-100" id="btn_backend_add_stockgame">เพิ่มของรางวัล</button>
                      </div>
                  </div>
                </div>
                <div class="col-12 bg-white p-3">
                  <h2>ของรางวัลในสต็อก</h2>
                  <div class="table-responsive pt-3 pb-3">
                      <table id="datatable_backend_lograndom" class="table table-striped ">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th class="th-md">รางวัล</th>
                            <th class="th-lg">รายละเอียด</th>
                            <th class="th-md">ลบ</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i = 1;
                            $q = dd_q("SELECT * FROM random_stock WHERE owner_id = ?",[0]);
                            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                              $q1 = dd_q("SELECT * FROM random_rewards WHERE id = ?",[$row['type']]);
                              $row1 = $q1->fetch(PDO::FETCH_ASSOC);
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row1['name']; ?></td>
                            <td><?php echo $row['contents']; ?></td>
                            <td>
                              <button type="button" id="backend_gamestock_del" class="btn btn-danger" onclick="backend_gamestock_del('<?php echo $row['id']; ?>');"  style="padding: .0.4rem;">ลบ</button>
                            </td>
                          </tr>
                          <?php $i++; } ?>
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
          <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'lograndom') { ?>

            <?php
              $q_allprice = dd_q('SELECT SUM(price) as allday_amount FROM random_day');
              $row_allprice = $q_allprice->fetch(PDO::FETCH_ASSOC);

              $q_allplay = dd_q('SELECT * FROM random_day');
              $row_countplay = $q_allplay->rowCount();

              $q_nowday = dd_q('SELECT SUM(price) as nowday_amount FROM random_day WHERE date = ?', [date("Y-m-d")]);
              $row_nowday = $q_nowday->fetch(PDO::FETCH_ASSOC);
             ?>
            <div class="row mt-5 mb-5">
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card text-white bg-secondary mb-3" style="max-width: 20rem;">
                    <div class="card-header">รายได้ทั้งหมด</div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo number_format($row_allprice['allday_amount'],2); ?> บาท</h5>
                      <p class="card-text text-white">เริ่มวันที่ 05-02-2020</p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
                    <div class="card-header">รายได้ของวันนี้</div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo number_format($row_nowday['nowday_amount'],2); ?> บาท</h5>
                      <p class="card-text text-white">วันที่ <?php echo date("d-m-Y"); ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card text-white bg-warning  mb-3" style="max-width: 20rem;">
                    <div class="card-header">เล่นทั้งหมด</div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo number_format($row_countplay,0); ?> ครั้ง</h5>
                      <p class="card-text text-white">จำนวนคนเล่นทั้งหมด</p>
                    </div>
                  </div>
                </div>
                <div class="col-12 bg-white p-3">
                  <h2>ประวัติการสุ่ม</h2>
                  <div class="table-responsive pt-3 pb-3">
                      <table id="datatable_backend_lograndom" class="table table-striped ">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th class="th-sm">เกม</th>
                            <th class="th-md">รางวัล</th>
                            <th class="th-lg">รายละเอียด</th>
                            <th class="th-md">ชื่อผู้ใช้งาน</th>
                            <th class="th-lg">วันที่-เวลา</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i = 1;
                            $q = dd_q("SELECT * FROM random_history INNER JOIN user_tb ON random_history.user_id = user_tb.u_id ORDER BY random_history.date DESC");
                            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['game_name']; ?></td>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['item_detail']; ?></td>
                            <td><?php echo $row['u_name']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                          </tr>
                          <?php $i++; } ?>
                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
          <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'csgo') { ?>
              <?php
                  function get_csgorandom_persent($where) {
                    $q_random_persent = dd_q("SELECT * FROM csgo_chance WHERE id = ? LIMIT 1", [$where]);
                    $row_random_persent = $q_random_persent->fetch(PDO::FETCH_ASSOC);
                    return $row_random_persent['chance'];
                  }
               ?>
              <div class="row mt-5 mb-5">
                  <div class="col-12 bg-white p-3">
                      <h4 class="text-danger">***เกม CSGO ต้องรวมกันได้ 100% ห้ามมีทศนิยม***</h4>
                      <div class="md-form">
                        <input type="text" id="txt_gamecsgo_1" class="form-control" value="<?php echo get_csgorandom_persent(1); ?>" placeholder=" ">
                        <label for="txt_gamecsgo_1">พ้อยท์ 1-5 กี่ %</label>
                      </div>
                      <div class="md-form">
                        <input type="text" id="txt_gamecsgo_2" class="form-control"  value="<?php echo get_csgorandom_persent(2); ?>"  placeholder=" ">
                        <label for="txt_gamecsgo_2">พ้อยท์ 10 กี่ %</label>
                      </div>
                      <div class="md-form">
                        <input type="text" id="txt_gamecsgo_3" class="form-control"  value="<?php echo get_csgorandom_persent(3); ?>" placeholder=" ">
                        <label for="txt_gamecsgo_3">พ้อยท์ 5-50 กี่ %</label>
                      </div>
                      <div class="md-form">
                        <input type="text" id="txt_gamecsgo_4" class="form-control"  value="<?php echo get_csgorandom_persent(4); ?>" placeholder=" ">
                        <label for="txt_gamecsgo_4">ไม่ได้รางวัล กี่ %</label>
                      </div>
                      <div class="md-form">
                        <input type="text" id="txt_gamecsgo_5" class="form-control"  value="<?php echo get_csgorandom_persent(5); ?>" placeholder=" ">
                        <label for="txt_gamecsgo_5">บัตรทรู 50 กี่ %</label>
                      </div>
                      <div class="md-form">
                        <input type="text" id="txt_gamecsgo_6" class="form-control"  value="<?php echo get_csgorandom_persent(6); ?>" placeholder=" ">
                        <label for="txt_gamecsgo_6">บัตรทรู 90 กี่ %</label>
                      </div>
                      <div class="md-form">
                        <input type="text" id="txt_gamecsgo_7" class="form-control"  value="<?php echo get_csgorandom_persent(7); ?>" placeholder=" ">
                        <label for="txt_gamecsgo_7">บัตรทรู 150 กี่ %</label>
                      </div>
                      <div class="md-form">
                        <input type="text" id="txt_gamecsgo_8" class="form-control"  value="<?php echo get_csgorandom_persent(8); ?>" placeholder=" ">
                        <label for="txt_gamecsgo_8">บัตรทรู 300 กี่ %</label>
                      </div>
                      <div class="md-form">
                        <input type="text" id="txt_gamecsgo_9" class="form-control" value="<?php echo get_csgorandom_persent(9); ?>" placeholder=" ">
                        <label for="txt_gamecsgo_9">บัตรทรู 1000 กี่ %</label>
                      </div>
                      <button type="button" class="btn btn-success w-100" id="btn_backend_save_persentcsgo">บันทึก</button>

                  </div>
              </div>
          <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'logtruemoney') { ?>
            <div class="row mt-5 mb-5">
                <div class="col-12 bg-white p-3">
                  <h2>รายการ Truemoney</h2>
                  <div class="table-responsive pt-3 pb-3">
                      <table id="datatable_backend_logtruemoney" class="table table-striped ">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th class="th-md">รหัสรายการ</th>
                            <th class="th-lg">รหัสบัตรทรู</th>
                            <th class="th-sm">ราคาบัตร</th>
                            <th class="th-sm">จำนวนที่ได้รับ</th>
                            <th class="th-md">ชื่อผู้ใช้งาน</th>
                            <th class="th-md">สถานะ</th>
                            <th class="th-lg">วันที่-เวลา</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i = 1;
                            $q = dd_q("SELECT * FROM logtopup INNER JOIN user_tb ON logtopup.username = user_tb.u_id ORDER BY logtopup.date DESC");
                            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['transaction_id']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td><?php echo number_format($row['real_amount'],2); ?></td>
                            <td><?php echo number_format($row['lw_amount'],2); ?></td>
                            <td><?php echo $row['u_name']; ?></td>
                            <td>
                              <?php
                                if ($row['status'] == 1) {
                                  echo '<span class="badge badge-success">เติมเงินสำเร็จ</span>';
                                }elseif ($row['status'] == 3) {
                                  echo '<span class="badge badge-warning">บัตรถูกใช้ไปแล้ว</span>';
                                }elseif ($row['status'] == 4) {
                                  echo '<span class="badge badge-danger">บัตรไม่ถูกต้อง</span>';
                                }elseif ($row['status'] == 5) {
                                  echo '<span class="badge badge-dark">เป็นบัตรทรูมฟู</span>';
                                }else{
                                  echo '<span class="badge badge-secondary">กำลังตรวจสอบ</span>';
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
            </div>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'logbank') { ?>
              <div class="row mt-5 mb-5">
                  <div class="col-12 bg-white p-3">
                    <h2>รายการ ธนาคาร</h2>
                    <div class="table-responsive pt-3 pb-3">
                        <table id="datatable_backend_logbank" class="table table-striped ">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="th-md">วันที่</th>
                              <th class="th-sm">เวลา</th>
                              <th class="th-sm">จำนวน</th>
                              <th class="th-md">เลขบัญชี</th>
                              <th class="th-md">ช่องทาง</th>
                              <th class="th-md">ชื่อผู้ใช้งาน</th>
                              <th class="th-lg">วันที่-เวลา</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $q = dd_q("SELECT * FROM logbank_tb INNER JOIN user_tb ON logbank_tb.lb_userid = user_tb.u_id ORDER BY logbank_tb.lb_added_time DESC");
                              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['lb_date']; ?></td>
                              <td><?php echo $row['lb_time']; ?></td>
                              <td><?php echo number_format($row['lb_amount'],2); ?></td>
                              <td><?php echo $row['lb_account_number']; ?></td>
                              <td><?php echo $row['lb_chanel']; ?></td>
                              <td><?php echo $row['u_name']; ?></td>
                              <td><?php echo $row['lb_added_time']; ?></td>
                            </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
              </div>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'user') { ?>
              <div class="row mt-5 mb-5">
                  <div class="col-12 bg-white p-3">
                    <h2>ข้อมูลผู้ใช้งาน</h2>
                    <div class="table-responsive pt-3 pb-3">
                        <table id="datatable_backend_user" class="table table-striped ">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="th-md">ชื่อ</th>
                              <th class="th-lg">อีเมล์</th>
                              <th class="th-sm">เงิน</th>
                              <th class="th-sm">ยอดซื้อรวม</th>
                              <th class="th-sm">รหัส 4 หลัก</th>
                              <th class="th-lg">สมัครผ่าน</th>
                              <th class="th-lg">วันที่-เวลา</th>
                              <th class="th-lg">แก้ไข / ลบ</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $q = dd_q("SELECT * FROM user_tb ORDER BY u_date DESC");
                              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['u_name']; ?></td>
                              <td><?php echo $row['u_email']; ?></td>
                              <td><?php echo number_format($row['u_point'],2); ?></td>
                              <td><?php echo number_format($row['u_youbuy'],2); ?></td>
                              <td>
                                <?php
                                  if($row['u_key'] == null) {
                                    echo "-";
                                  }else{
                                    echo $row['u_key'];
                                  } ?>
                              </td>
                              <td>
                                <?php
                                  if($row['u_type'] == "f") {
                                    echo "Facebook";
                                  }else{
                                    echo "WebSite";
                                  } ?>
                              </td>
                              <td><?php echo $row['u_date']; ?></td>
                              <td>
                                <div class="row">
                                  <div class="col-6">
                                    <button type="button" id="backend_us_edit" class="btn btn-warning" onclick="backend_us_edit('<?php echo $row['u_id']; ?>');" style="padding: .0.4rem;">แก้ไข</button>
                                  </div>
                                  <div class="col-6">
                                    <button type="button" id="backend_us_del" class="btn btn-danger" onclick="backend_us_del('<?php echo $row['u_id']; ?>');"  style="padding: .0.4rem;">ลบ</button>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
              </div>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'card') { ?>
              <div class="row mt-5 mb-5">
                <a href="<?php echo base_url(); ?>/backend/logcard" class="btn btn-purple w-100">ประวัติการสั่งซื้อ บัตรเติมเงิน</a>
              </div>
              <div class="row mb-5">
                <?php
                  $q = dd_q("SELECT * FROM cardtype_tb");
                  while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="col-12 col-lg-4 mt-2">
                  <div class="card">
                        <img class="card-img-top" src="<?php echo base_url(); ?>/img/product_image/<?php echo $row['ct_image']; ?>" width="250px" height="250px;">
                        <div class="card-body">
                          <h4 class="card-title"><a><?php echo $row['ct_displayname']; ?></a></h4>
                          <div class="row">
                            <div class="col-12">
                              <a href="<?php echo base_url(); ?>/backend/detailcard/<?php echo $row['ct_id']; ?>" class="btn btn-primary w-100">จัดการสต็อก</a>
                            </div>
                          </div>
                        </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'detailcard') { ?>
              <?php
                $q = dd_q("SELECT * FROM cardtype_tb WHERE ct_id = ?",[$_GET['id']]);
                if ($q->rowCount() <= 0) {
              ?>
                <div class="row mt-5 mb-5">
                    <div class="col-12 bg-white p-3 text-center">
                      <h2>ไม่พบข้อมูล</h2>
                  </div>
                </div>
              <?php }else{ ?>
                  <?php $row = $q->fetch(PDO::FETCH_ASSOC); ?>
                  <div class="row mt-5 mb-5">
                    <div class="col-12 bg-white p-3">
                      <div class="mb-5">
                        <h2>เพิ่มสต็อก <?php echo $row['ct_displayname']; ?></h2>
                      </div>
                      <div class="md-form form-group w-100">
                        <input type="text" id="txt_backend_add_stockcard_code" class="form-control" placeholder=" ">
                        <label for="txt_backend_add_stockcard_code">รหัสบัตรเติมเงิน</label>
                      </div>
                      <div class="row">
                        <div class="col-12">
                            <select class="mdb-select md-form" id="txt_backend_add_stockcard_type">
                              <?php
                                $q1 = dd_q("SELECT * FROM cardoption_tb WHERE co_ctid = ?",[$row['ct_id']]);
                                while($row1 = $q1->fetch(PDO::FETCH_ASSOC)) {
                               ?>
                               <option value="<?php echo $row1['co_id']; ?>"><?php echo $row1['co_display']; ?></option>
                              <?php } ?>
                            </select>
                            <label for="txt_backend_add_stockcard_type">ราคาบัตร</label>
                        </div>
                      </div>
                      <input type="hidden" id="txt_backend_add_stockcard_id" value="<?php echo $_GET['id']; ?>">
                      <button type="button" class="btn btn-success w-100" id="btn_backend_add_stockcard">เพิ่มสต็อก</button>
                    </div>
                  </div>

                  <div class="row mb-5">
                      <div class="col-12 bg-white p-3">
                        <h2>สต็อกที่ยังไม่ขาย <?php echo $row['ct_displayname']; ?></h2>
                        <div class="table-responsive pt-3 pb-3">
                            <table id="datatable_backend_card" class="table table-striped ">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th class="th-md">ชื่อสินค้า</th>
                                  <th class="th-sm">โค้ต</th>
                                  <th class="th-sm">วันที่-เวลา</th>
                                  <th class="th-sm">ลบ</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $i = 1;
                                  $q3 = dd_q("SELECT * FROM cardstock_tb INNER JOIN cardoption_tb ON cardstock_tb.cs_coid = cardoption_tb.co_id
                                    WHERE cardstock_tb.cs_userid = ? AND cardoption_tb.co_ctid = ? ORDER BY cardstock_tb.cs_date DESC",[0,$_GET['id']]);

                                  while ($row3 = $q3->fetch(PDO::FETCH_ASSOC)) {
                                    $q4 = dd_q("SELECT * FROM cardoption_tb INNER JOIN cardtype_tb ON cardoption_tb.co_ctid = cardtype_tb.ct_id WHERE cardoption_tb.co_id = ? LIMIT 1",[$row3['cs_coid']]);
                                    $row4 = $q4->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $row4['ct_displayname']." ".$row3['co_display']; ?></td>
                                  <td><?php echo $row3['cs_code']; ?></td>
                                  <td><?php echo $row3['cs_date']; ?></td>
                                  <td>
                                    <div class="col-6">
                                      <button type="button" id="backend_stockcard_del" class="btn btn-danger" onclick="backend_stockcard_del('<?php echo $row3['cs_id']; ?>');"  style="padding: .0.4rem;">ลบ</button>
                                    </div>
                                  </td>
                                </tr>
                                <?php $i++; } ?>
                              </tbody>
                            </table>
                        </div>
                      </div>
                  </div>

              <?php } ?>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'logcard') { ?>

              <div class="row mt-5 mb-5">
                  <div class="col-12 bg-white p-3">
                    <h2>ประวัติการซื้อ บัตรเติมเงิน</h2>
                    <div class="table-responsive pt-3 pb-3">
                        <table id="datatable_backend_logcard" class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="th-md">ชื่อสินค้า</th>
                              <th class="th-sm">ราคา</th>
                              <th class="th-sm">โค้ต</th>
                              <th class="th-sm">ผู้ซื้อสินค้า</th>
                              <th class="th-lg">วันที่ - เวลา</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $q = dd_q("SELECT * FROM ((cardstock_tb INNER JOIN cardoption_tb ON cardstock_tb.cs_coid = cardoption_tb.co_id)
                              INNER JOIN user_tb ON cardstock_tb.cs_userid = user_tb.u_id) WHERE cardstock_tb.cs_userid != ? ORDER BY cardstock_tb.cs_datebuy DESC",[0]);
                              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                                $q1 = dd_q("SELECT * FROM cardoption_tb INNER JOIN cardtype_tb ON cardoption_tb.co_ctid = cardtype_tb.ct_id WHERE cardoption_tb.co_id = ?",[$row['co_id']]);
                                $row1 = $q1->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row1['ct_displayname']." ".$row['co_display']; ?></td>
                              <td><?php echo $row['co_price']; ?></td>
                              <td><?php echo $row['cs_code']; ?></td>
                              <td><?php echo $row['u_name']; ?></td>
                              <td><?php echo $row['cs_datebuy']; ?></td>
                            </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
              </div>

            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'category') { ?>
              <div class="row mt-5 mb-5">
                  <div class="col-12 bg-white p-3">
                    <h2>หมวดหมู่สินค้า</h2>
                    <div class="table-responsive pt-3 pb-3">
                        <table id="datatable_backend_category" class="table table-striped ">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="th-md">ชื่อ</th>
                              <th class="th-sm">ประเภท</th>
                              <th class="th-sm">ลขข้อมูล</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $q = dd_q("SELECT * FROM type_tb");
                              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['t_name']; ?></td>
                              <td>
                                <?php
                                  if($row['t_type'] == 0) {
                                    echo "ไอดีเกม";
                                  }else{
                                    echo "ไอเท็มโค้ต";
                                  } ?>
                              </td>
                              <td>
                                <div class="col-6">
                                  <button type="button" id="backend_category_del" class="btn btn-danger" onclick="backend_category_del('<?php echo $row['t_id']; ?>');"  style="padding: .0.4rem;">ลบ</button>
                                </div>
                              </td>
                            </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
              </div>
              <div class="row mb-5">
                <div class="col-12 bg-white p-3">
                  <div class="mb-5">
                    <h2>เพิ่มหมวดหมู่สินค้า</h2>
                  </div>
                  <div class="md-form form-group w-100">
                    <input type="text" id="txt_backend_add_category_name" class="form-control" placeholder=" ">
                    <label for="txt_backend_add_category_name">ชื่อหมวดหมู่</label>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <select class="mdb-select md-form" id="txt_backend_add_category_type">
                        <option value="0">ไอดีเกม</option>
                        <option value="1">ไอเท็มโค้ต</option>
                      </select>
                      <label for="txt_backend_add_category_type">ประเภท</label>
                    </div>
                  </div>

                  <button type="button" class="btn btn-success w-100" id="btn_backend_add_category">เพิ่มหมวดหมู่</button>
                </div>
              </div>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'code') { ?>
              <div class="row mt-5 mb-5">
                  <div class="col-12 mb-3">
                    <a href="<?php echo base_url(); ?>/backend/logcode" class="btn btn-info w-100">ประวัติการสั่งซื้อ Code</a>
                  </div>
                  <div class="col-12 bg-white p-5 mb-5">
                        <div class="mb-5">
                          <h2>เพิ่มไอเท็มโค้ต</h2>
                        </div>
                        <form enctype="multipart/form-data" method="post">


                        <div class="md-form form-lg">
                          <input type="text" id="txt_backend_code_name" class="form-control form-control-lg" placeholder=" ">
                          <label for="txt_backend_code_name">ชื่อไอเท็มโค้ต</label>
                        </div>
                        <div class="md-form">
                          <textarea id="txt_backend_code_des" class="md-textarea form-control" rows="2" ></textarea>
                          <label for="txt_backend_code_des">รายละเอียด</label>
                        </div>
                        <div class="md-form form-sm">
                          <input type="number" id="txt_backend_code_price" class="form-control form-control-sm" placeholder=" ">
                          <label for="txt_backend_code_price">ราคา</label>
                        </div>
                        <div class="md-form form-sm">
                          <div class="file-field">
                            <div class="btn btn-primary btn-sm float-left">
                              <span>เลือกรูปภาพ</span>
                              <input type="file" id="txt_backend_code_file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="Upload your file">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <select class="mdb-select md-form" id="txt_backend_code_type">
                              <?php
                                $q = dd_q("SELECT * FROM type_tb WHERE t_type = ?",[1]);
                                while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                                <option value="<?php echo $row['t_id']; ?>"><?php echo $row['t_name']; ?></option>
                              <?php } ?>
                            </select>
                            <label for="txt_backend_code_type">ประเภท</label>
                          </div>
                        </div>
                        <button type="button" class="btn btn-success w-100" id="btn_backend_add_code">เพิ่มไอเท็มโค้ต</button>
                        </form>
                  </div>
                  <?php
                    $q = dd_q("SELECT * FROM code_tb");
                    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="col-12 col-lg-4 mt-2">
                    <div class="card">
                          <img class="card-img-top" src="<?php echo base_url(); ?>/img/product_image/<?php echo $row['c_img']; ?>" width="250px" height="250px;">
                          <div class="card-body">
                            <h4 class="card-title"><a><?php echo $row['c_name']; ?></a></h4>
                            <div class="row">
                              <div class="col-6">
                                <button type="button" id="backend_funcode_edit" class="btn btn-warning w-100" onclick="backend_funcode_edit('<?php echo $row['c_id']; ?>');">แก้ไข</button>
                              </div>
                              <div class="col-6">
                                <button type="button" id="backend_funcode_del" class="btn btn-danger w-100" onclick="backend_funcode_del('<?php echo $row['c_id']; ?>');">ลบสินค้า</button>
                              </div>
                              <div class="col-12">
                                <a href="<?php echo base_url(); ?>/backend/detailcode/<?php echo $row['c_id']; ?>" class="btn btn-primary w-100">จัดการสต็อก</a>
                              </div>
                            </div>
                          </div>
                    </div>
                  </div>
                  <?php } ?>

              </div>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'logcode') { ?>
              <div class="row mt-5 mb-5">
                  <div class="col-12 bg-white p-3">
                    <h2>ประวัติการซื้อ code</h2>
                    <div class="table-responsive pt-3 pb-3">
                        <table id="datatable_backend_logcode" class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="th-md">ชื่อ</th>
                              <th class="th-sm">โค้ต</th>
                              <th class="th-sm">ราคา</th>
                              <th class="th-sm">ประเภท</th>
                              <th class="th-sm">ผู้ซื้อสินค้า</th>
                              <th class="th-lg">วันที่ - เวลา</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $q = dd_q("SELECT * FROM (( stockcode_tb INNER JOIN code_tb ON stockcode_tb.sc_cid = code_tb.c_id )
                              INNER JOIN user_tb ON stockcode_tb.sc_userid = user_tb.u_id ) WHERE stockcode_tb.sc_userid != ? ORDER BY stockcode_tb.sc_buydate DESC",[0]);
                              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                              <?php
                                $q1 = dd_q("SELECT * FROM code_tb INNER JOIN type_tb ON code_tb.c_tyid = type_tb.t_id WHERE code_tb.c_id = ? LIMIT 1",[$row['c_id']]);
                                $row1 = $q1->fetch(PDO::FETCH_ASSOC);
                               ?>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['c_name']; ?></td>
                              <td><?php echo $row['sc_code']; ?></td>
                              <td><?php echo $row['c_price']; ?></td>
                              <td><?php echo $row1['t_name']; ?></td>
                              <td><?php echo $row['u_name']; ?></td>
                              <td><?php echo $row['sc_buydate']; ?></td>
                            </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
              </div>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'detailcode') { ?>
              <?php
                $q = dd_q("SELECT * FROM code_tb WHERE c_id = ?",[$_GET['id']]);
                if ($q->rowCount() <= 0) {
              ?>
                <div class="row mt-5 mb-5">
                    <div class="col-12 bg-white p-3 text-center">
                      <h2>ไม่พบข้อมูล</h2>
                  </div>
                </div>
              <?php }else{ ?>
                  <?php $row = $q->fetch(PDO::FETCH_ASSOC); ?>
                  <div class="row mt-5 mb-5">
                      <div class="col-12 bg-white p-3 mb-5">
                        <h2>สต็อก <?php echo $row['c_name']; ?> (ที่ยังไม่ได้ขาย) </h2>
                        <div class="table-responsive pt-3 pb-3">
                            <table id="datatable_backend_stockcode1" class="table table-striped">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th class="th-md">โค้ต</th>
                                  <th class="th-lg">วันที่ - เวลา</th>
                                  <th class="th-lg">ลบโค้ตนี้</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $i = 1;
                                  $q_1 = dd_q("SELECT * FROM stockcode_tb WHERE sc_cid = ? AND sc_userid = ? ORDER BY sc_date DESC",[$_GET['id'],0]);
                                  while ($row_1 = $q_1->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $row_1['sc_code']; ?></td>
                                  <td><?php echo $row_1['sc_date']; ?></td>
                                  <td>
                                    <button type="button" id="backend_stockcode_del" class="btn btn-danger" onclick="backend_stockcode_del('<?php echo $row_1['sc_id']; ?>');" style="padding: .0.4rem;">ลบสินค้า</button>
                                  </td>
                                </tr>
                                <?php $i++; } ?>
                              </tbody>
                            </table>
                        </div>
                      </div>
                      <div class="col-12 bg-white p-5 mb-5">
                            <div class="mb-5">
                              <h2>เพิ่มสต็อก <?php echo $row['c_name']; ?></h2>
                            </div>
                            <div class="md-form form-lg">
                              <input type="text" id="txt_backend_stockcode_key" class="form-control form-control-lg" placeholder=" ">
                              <label for="txt_backend_stockcode_key">ไอเท็มโค้ต</label>
                            </div>
                            <input type="hidden" id="txt_backend_stockcode_id" value="<?php echo $_GET['id']; ?>">
                            <button type="button" class="btn btn-success w-100" id="btn_backend_add_stockcode">เพิ่มสต็อกโค้ต</button>
                      </div>
                  </div>
            <?php } ?>

          <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'idgame') { ?>
              <div class="row mt-5 mb-5">
                  <div class="col-12 mb-3">
                    <a href="<?php echo base_url(); ?>/backend/logidgame" class="btn btn-info w-100">ประวัติการสั่งซื้อ ไอดี</a>
                  </div>
                  <div class="col-12 bg-white p-5 mb-5">
                        <div class="mb-5">
                          <h2>เพิ่มไอดี</h2>
                        </div>
                        <form enctype="multipart/form-data" method="post">
                          <div class="md-form form-lg">
                            <input type="text" id="txt_backend_idgame_name" class="form-control form-control-lg" placeholder=" ">
                            <label for="txt_backend_idgame_name">ชื่อไอดี</label>
                          </div>
                          <div class="md-form">
                            <textarea id="txt_backend_idgame_des" class="md-textarea form-control" rows="2" ></textarea>
                            <label for="txt_backend_idgame_des">รายละเอียด</label>
                          </div>
                          <div class="md-form form-lg">
                            <input type="number" id="txt_backend_idgame_price" class="form-control form-control-lg" placeholder=" ">
                            <label for="txt_backend_idgame_price">ราคา</label>
                          </div>

                          <div class="md-form form-lg mt-5">
                            <input type="text" id="txt_backend_idgame_user" class="form-control form-control-lg" placeholder=" ">
                            <label for="txt_backend_idgame_user">ชื่อผู้ใช้งาน (ของไอดี ไม่มีปล่อยว่าง)</label>
                          </div>
                          <div class="md-form form-lg">
                            <input type="text" id="txt_backend_idgame_pass" class="form-control form-control-lg" placeholder=" ">
                            <label for="txt_backend_idgame_pass">รหัสผ่าน (ของไอดี ไม่มีปล่อยว่าง)</label>
                          </div>
                          <div class="md-form form-lg">
                            <input type="text" id="txt_backend_idgame_email" class="form-control form-control-lg" placeholder=" ">
                            <label for="txt_backend_idgame_email">อีเมล์ (ของไอดี ไม่มีปล่อยว่าง)</label>
                          </div>
                          <div class="md-form form-lg mb-5">
                            <input type="text" id="txt_backend_idgame_tel" class="form-control form-control-lg" placeholder=" ">
                            <label for="txt_backend_idgame_tel">เบอร์ (ของไอดี ไม่มีปล่อยว่าง)</label>
                          </div>


                          <div class="md-form form-sm">
                            <div class="file-field">
                              <div class="btn btn-primary btn-sm float-left">
                                <span>เลือกรูปภาพ (ปก)</span>
                                <input type="file" id="txt_backend_idgame_file">
                              </div>
                              <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload your file">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <select class="mdb-select md-form" id="txt_backend_idgame_type">
                                <?php
                                  $q = dd_q("SELECT * FROM type_tb WHERE t_type = ?",[0]);
                                  while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                  <option value="<?php echo $row['t_id']; ?>"><?php echo $row['t_name']; ?></option>
                                <?php } ?>
                              </select>
                              <label for="txt_backend_idgame_type">ประเภท</label>
                            </div>
                          </div>
                          <button type="button" class="btn btn-success w-100" id="btn_backend_add_idgame">เพิ่มไอดีเกม</button>
                        </form>
                  </div>
                  <?php
                    $q = dd_q("SELECT * FROM product_tb WHERE pd_usid = ?",[0]);
                    while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="col-12 col-lg-4 mt-2">
                    <div class="card">
                          <img class="card-img-top" src="<?php echo base_url(); ?>/img/product_image/<?php echo $row['pd_img']; ?>" width="250px" height="250px;">
                          <div class="card-body">
                            <h4 class="card-title"><a><?php echo $row['pd_name']; ?></a></h4>
                            <div class="row">
                              <div class="col-6">
                                <button type="button" id="backend_funidgame_edit" class="btn btn-warning w-100" onclick="backend_funidgame_edit('<?php echo $row['pd_id']; ?>');">แก้ไข</button>
                              </div>
                              <div class="col-6">
                                <button type="button" id="backend_funidgame_del" class="btn btn-danger w-100" onclick="backend_funidgame_del('<?php echo $row['pd_id']; ?>');">ลบสินค้า</button>
                              </div>
                              <div class="col-12">
                                <a href="<?php echo base_url(); ?>/backend/detailidgame/<?php echo $row['pd_id']; ?>" class="btn btn-primary w-100">จัดการรูปเพิ่มเติม</a>
                              </div>
                            </div>
                          </div>
                    </div>
                  </div>
                  <?php } ?>
              </div>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'logidgame') {  ?>
              <div class="row mt-5 mb-5">
                  <div class="col-12 bg-white p-3">
                    <h2>ประวัติการซื้อ ไอดี</h2>
                    <div class="table-responsive pt-3 pb-3">
                        <table id="datatable_backend_logcode" class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th class="th-md">ชื่อ</th>
                              <th class="th-sm">ราคา</th>
                              <th class="th-sm">ประเภท</th>
                              <th class="th-sm">ผู้ซื้อสินค้า</th>
                              <th class="th-md">ชื่อผู้ใช้งาน</th>
                              <th class="th-md">รหัสผ่าน</th>
                              <th class="th-md">อีเมล์</th>
                              <th class="th-md">เบอร์</th>
                              <th class="th-lg">วันที่ - เวลา</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $i = 1;
                              $q = dd_q("SELECT * FROM (( product_tb INNER JOIN type_tb ON product_tb.pd_tyid = type_tb.t_id )
                              INNER JOIN user_tb ON product_tb.pd_usid = user_tb.u_id )  WHERE product_tb.pd_usid != ? ORDER BY product_tb.pd_buydate DESC",[0]);
                              while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['pd_name']; ?></td>
                              <td><?php echo $row['pd_price']; ?></td>
                              <td><?php echo $row['t_name']; ?></td>
                              <td><?php echo $row['u_name']; ?></td>
                              <td><?php echo $row['pd_user']; ?></td>
                              <td><?php echo $row['pd_pass']; ?></td>
                              <td><?php echo $row['pd_email']; ?></td>
                              <td><?php echo $row['pd_tel']; ?></td>
                              <td><?php echo $row['pd_buydate']; ?></td>
                            </tr>
                            <?php $i++; } ?>
                          </tbody>
                        </table>
                    </div>
                  </div>
              </div>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'detailidgame') { ?>
              <?php
                $q = dd_q("SELECT * FROM product_tb WHERE pd_id = ? AND pd_usid = ?",[$_GET['id'],0]);
                if ($q->rowCount() <= 0) {
              ?>
                <div class="row mt-5 mb-5">
                    <div class="col-12 bg-white p-3 text-center">
                      <h2>ไม่พบข้อมูล</h2>
                  </div>
                </div>
              <?php }else{ ?>
                  <?php $row = $q->fetch(PDO::FETCH_ASSOC); ?>
                  <div class="row mt-5 mb-5">
                      <div class="col-12 bg-white p-3 mb-5">
                        <h2>รูปเพิ่มเติม <?php echo $row['pd_name']; ?> </h2>

                        <form method='post' id="uploadForm" action="<?php echo base_url(); ?>/system/admin_idgame_addimg.php" enctype="multipart/form-data">
                          <div class="md-form form-sm">
                            <div class="file-field">
                              <div class="btn btn-primary btn-sm float-left">
                                <span>เลือกรูปภาพ (กด Ctrl ค้างเพื่อเลือกที่ละหลายรูป)</span>
                                <input type="file" id="files" name="files[]" multiple />
                              </div>
                              <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload your file">
                              </div>
                            </div>
                          </div>
                          <input type="hidden" id="txt_backend_detailidgame_id" name="id" value="<?php echo $row['pd_id']; ?>">
                          <input type="submit" id="btn_detailidgame_addimg" class="btn btn-success w-100" value="เพิ่มรูปภาพ">
                        </form>
                      </div>
                      <?php
                        $q1 = dd_q("SELECT * FROM image_tb WHERE img_pdid = ?",[$_GET['id']]);
                        while($row1 = $q1->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="card">
                              <img class="card-img-top" src="<?php echo base_url(); ?>/img/product_image/<?php echo $row1['img_name']; ?>" width="250px" height="250px;">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-12">
                                    <button type="button" id="backend_fundetailidgame_del" class="btn btn-danger w-100" onclick="backend_fundetailidgame_del('<?php echo $row1['img_id']; ?>');">ลบรูปนี้</button>
                                  </div>
                                </div>
                              </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
              <?php }?>
            <?php }elseif(isset($_GET['adminpage']) AND $_GET['adminpage'] == 'setting') {?>
              <div class="row mt-5 mb-5">
                  <div class="col-12 bg-white p-3 mb-5">
                    <h2>ตั้งค่าระบบ</h2>
                    <div class="md-form form-lg mb-5">
                      <input type="text" id="txt_backend_setting_tel" class="form-control form-control-lg" placeholder=" " value="<?php echo get_setting("tel_contact"); ?>">
                      <label for="txt_backend_setting_tel">เบอร์ติดต่อ</label>
                    </div>
                    <div class="md-form form-lg mb-5">
                      <input type="text" id="txt_backend_setting_email" class="form-control form-control-lg" placeholder=" " value="<?php echo get_setting("gmail_user"); ?>">
                      <label for="txt_backend_setting_email">Gmail สำหรับใช้ส่งข้อมูล</label>
                    </div>
                    <div class="md-form form-lg mb-5">
                      <input type="text" id="txt_backend_setting_passemail" class="form-control form-control-lg" placeholder=" " value="<?php echo get_setting("gmail_pass"); ?>">
                      <label for="txt_backend_setting_passemail">รหัส Gmail</label>
                    </div>
                    <div class="md-form form-lg mb-5">
                      <input type="text" id="txt_backend_setting_tmpay" class="form-control form-control-lg" placeholder=" " value="<?php echo get_setting("tmpay_id"); ?>">
                      <label for="txt_backend_setting_tmpay">รหัสร้านค้า Tmpay</label>
                    </div>

                    <div class="md-form form-lg mb-5">
                      <input type="text" id="txt_backend_setting_namebank" class="form-control form-control-lg" placeholder=" " value="<?php echo get_setting("kb_name"); ?>">
                      <label for="txt_backend_setting_namebank">ชื่อบัญชี กสิกรเท่านั้น</label>
                    </div>
                    <div class="md-form form-lg mb-5">
                      <input type="text" id="txt_backend_setting_numberbank" class="form-control form-control-lg" placeholder=" " value="<?php echo get_setting("kb_number"); ?>">
                      <label for="txt_backend_setting_numberbank">เลขที่บัญชี กสิกรเท่านั้น (xxx-x-xxxxx-x)</label>
                    </div>
                    <div class="md-form form-lg mb-5">
                      <input type="text" id="txt_backend_setting_userbank" class="form-control form-control-lg" placeholder=" " value="<?php echo get_setting("kb_user"); ?>">
                      <label for="txt_backend_setting_userbank">ชื่อผู้ใช้ k-cyber</label>
                    </div>
                    <div class="md-form form-lg mb-2">
                      <input type="text" id="txt_backend_setting_passbank" class="form-control form-control-lg" placeholder=" " value="<?php echo get_setting("kb_pass"); ?>">
                      <label for="txt_backend_setting_passbank">รหัสผ่าน k-cyber</label>
                    </div>
                    <div class="text-right mb-3">
                      <a href="<?php echo base_url(); ?>/system/genwallet.php" class="btn btn-info">ตั้งค่า Wallet</a>
                    </div>
                    <button type="button" class="btn btn-success w-100" id="btn_backend_save_setting">บันทึกข้อมูล</button>
                  </div>
            </div>
            <?php } ?>

          <?php } ?>
          <?php include_once __DIR__ . '/template/modal/modal-admin.php'; ?>
      </div>
    </div>
  </body>
<?php include_once __DIR__ . '/template/footer-tp.php'; ?>
<?php include_once __DIR__ . '/template/adminjs-tp.php'; ?>
</html>
