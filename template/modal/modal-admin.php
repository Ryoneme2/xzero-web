<div class="modal fade" id="modaledituserForm" tabindex="-1" role="dialog" aria-labelledby="modaledituserForm"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">แก้ไขข้อมูล</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="txt_backend_edit_user" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_user">ชื่อผู้ใช้งาน</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="text" id="txt_backend_edit_email" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_email">อีเมล์</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-coins prefix grey-text"></i>
          <input type="text" id="txt_backend_edit_point" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_point">เงินคงเหลือ</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-shopping-basket prefix grey-text"></i>
          <input type="text" id="txt_backend_edit_youbuy" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_youbuy">ยอดรวมที่ซื้อ</label>
        </div>

        <div class="md-form mb-5" id="bbssqsc56456">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="text" id="txt_backend_edit_key" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_key">รหัส 4 หลัก</label>
        </div>

        <div class="md-form mb-5">
          <i class="fas fa-globe prefix grey-text"></i>
          <input type="text" id="txt_backend_edit_type" class="form-control" placeholder=" " value="" readonly>
          <label for="txt_backend_edit_type">ช่องทางที่สมัคร</label>
        </div>
        <input type="hidden" id="txt_backend_edit_id" value="">
        <input type="hidden" id="txt_backend_edit_type2" value="">

        <div class="md-form mb-4">
          <button class="btn btn-default w-100" id="btn_backend_user_edit">บันทึกข้อมูล</button>
        </div>

      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="modaleditcodeForm" tabindex="-1" role="dialog" aria-labelledby="modaleditcodeForm"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">แก้ไขข้อมูล</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="txt_backend_edit_code_name" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_user">ชื่อ</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-coins prefix grey-text"></i>
          <input type="text" id="txt_backend_edit_code_price" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_code_price">ราคา</label>
        </div>
        <div class="md-form mb-5">
          <textarea id="txt_backend_edit_code_des" class="md-textarea form-control" rows="2" placeholder=" "></textarea>
          <label for="txt_backend_edit_code_des">รายละเอียด</label>
        </div>
        <input type="hidden" id="txt_backend_edit_code_id" value="">
        <div class="md-form mb-4">
          <button class="btn btn-default w-100" id="btn_backend_code_edit">บันทึกข้อมูล</button>
        </div>

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modaleditidgameForm" tabindex="-1" role="dialog" aria-labelledby="modaleditidgameForm"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">แก้ไขข้อมูล</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

        <div class="md-form mb-5">
          <input type="text" id="txt_backend_edit_idgame_name" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_idgame_name">ชื่อ</label>
        </div>
        <div class="md-form mb-5">
          <input type="text" id="txt_backend_edit_idgame_price" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_idgame_price">ราคา</label>
        </div>
        <div class="md-form mb-5">
          <textarea id="txt_backend_edit_idgame_des" class="md-textarea form-control" rows="2" placeholder=" "></textarea>
          <label for="txt_backend_edit_idgame_des">รายละเอียด</label>
        </div>
        <div class="md-form mb-5">
          <input type="text" id="txt_backend_edit_idgame_user" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_idgame_user">ชื่อผู้ใช้งาน</label>
        </div>
        <div class="md-form mb-5">
          <input type="text" id="txt_backend_edit_idgame_pass" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_idgame_pass">รหัสผ่าน</label>
        </div>
        <div class="md-form mb-5">
          <input type="text" id="txt_backend_edit_idgame_email" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_idgame_email">อีเมล์</label>
        </div>
        <div class="md-form mb-5">
          <input type="text" id="txt_backend_edit_idgame_tel" class="form-control" placeholder=" " value="">
          <label for="txt_backend_edit_idgame_tel">เบอร์</label>
        </div>
        <div class="md-form form-sm">
          <div class="file-field">
            <div class="btn btn-primary btn-sm float-left">
              <span>เลือกรูปภาพ (ปก)</span>
              <input type="file" id="txt_backend_edit_idgame_file">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder="Upload your file">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <select class="mdb-select md-form" id="txt_backend_edit_idgame_type">
              <?php
                $q = dd_q("SELECT * FROM type_tb WHERE t_type = ?",[0]);
                while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <option value="<?php echo $row['t_id']; ?>"><?php echo $row['t_name']; ?></option>
              <?php } ?>
            </select>
            <label for="txt_backend_edit_idgame_type">ประเภท</label>
          </div>
        </div>


        <input type="hidden" id="txt_backend_edit_idgame_id" value="">
        <div class="md-form mb-4">
          <button class="btn btn-default w-100" id="btn_backend_idgame_edit">บันทึกข้อมูล</button>
        </div>

      </div>
    </div>
  </div>
</div>
