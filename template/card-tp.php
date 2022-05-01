<style media="screen">
nav.pagination-nav{
  max-width:500px;
}
@media (max-width: 575.98px) {
  nav.pagination-nav{
    max-width:300px;
  }
}
nav.pagination-nav::-webkit-scrollbar {
  height: 8px;
}
/* Track */
nav.pagination-nav::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
nav.pagination-nav::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
nav.pagination-nav::-webkit-scrollbar-thumb:hover {
  background: #555;
}
.card_product {
    padding: 10px;
    display: block;
    font-size: 16px;
    font-weight: 500;
    text-align: center;
    border: 0;
    cursor: pointer;
    border-radius: 5px;
    color: #666;
    position: relative;
    border: 1px solid #ebebeb;
    box-shadow: 0 2px 6px 0 rgba(0,0,0,.07);
    margin-top: 15px;
    width: 100%;
    -o-transition: all .3s ease-in;
    -webkit-transition: all .3s ease-in;
    transition: all .3s ease-in;
}
.card_product_disable {
    padding: 10px;
    text-align: center;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    color: #666;
    background: #f9f9f9;
    box-shadow: 0 1px 1px 1px rgba(0,0,0,.1);
    margin-top: 16px;
    width: 100%;
    -o-transition: all .3s ease-in;
    -webkit-transition: all .3s ease-in;
    transition: all .3s ease-in;
    pointer-events: none;
    opacity: .6;
}
.card_product:hover, .card_product:focus {
    background: var(--main-color);
    color: #fff;
    cursor: pointer;
}
.card_product_active {
    background: var(--main-color);
    color: #fff;
    cursor: pointer;
}
.select_card_product {
    padding: 10px;
    text-align: center;
    font-size: 18px;
    border-radius: 5px;
    background-color: #dfdfdf;
    color: #666;
    width: 100%;
    -o-transition: all .3s ease-in;
    -webkit-transition: all .3s ease-in;
    transition: all .3s ease-in;
}
.qty_card_product {
    padding: 8px;
    vertical-align: middle;
    border-color: transparent;
    border-radius: 5px;
    width: 100%;
    font-size: 18px;
    background-color: #dfdfdf;
    color: #666;
    text-align: center;
    outline: 0;
    -webkit-transition: all .75s ease 0s;
    -o-transition: all .75s ease 0s;
    transition: all .75s ease 0s;
}
.shell-icon {
    margin-top: 3px;
    margin-left: 5px;
    position: absolute;
    width: 16px;
    height: 16px;
    background-image: url(https://cdngarenanow-a.akamaihd.net/gop/app/0000/010/091/point.png);
    background-size: 16px 16px;
}
.razer-icon {
    margin-top: 3px;
    margin-left: 5px;
    position: absolute;
    width: 16px;
    height: 16px;
    background-image: url(https://media.gold.razer.com/goldweb/assets/images/favicon.ico);
    background-size: 16px 16px;
}
</style>
<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="bg_contentlogin_reg">
            <?php
            $q = dd_q("SELECT * FROM cardtype_tb");
            $count = $q->rowCount();
            while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
             if(isset($_GET['id']) AND $_GET['id'] == "{$row['ct_name']}") {
            ?>
               <div class="row p-2">
                  <div class="col-lg-6 col-12 text-center">
                    <img src="<?php echo base_url(); ?>/img/product_image/<?php echo $row['ct_image']; ?>" alt="<?php echo $row['ct_image']; ?>" class="img-fluid">
                  </div>
                  <div class="col-lg-6 col-12">
                    <h6 class="text-danger">เลือกบัตรที่ต้องการ *</h6>
                    <div class="text_carddes text-muted mt-3 mb-3"> <?php echo $row['ct_des']; ?></div>
                    <div class="mb-3" style="border-bottom: 1px solid #ccc;"></div>
                    <div class="row">
                        <div class="col-lg-4 col-12 mt-1">
                          <?php
                            $q2 = dd_q("SELECT * FROM cardoption_tb WHERE co_ctid = ?",[$row['ct_id']]);
                            while ($row2 = $q2->fetch(PDO::FETCH_ASSOC)) {
                              $q3 = dd_q("SELECT * FROM cardstock_tb WHERE cs_coid = ? AND cs_userid = ?",[$row2['co_id'],0]);
                              $count_2 = $q3->rowCount();
                           ?>
                            <div class="card_product <?php if($count_2 <= 0) { echo "card_product_disable"; } ?>" stock="<?php echo $count_2; ?>" cardid="<?php echo $row2['co_id']; ?>" data-price="<?php echo $row2['co_price']; ?>">
                              <?php echo $row2['co_display']; if($row['ct_name'] == "garena") { echo '<i class="shell-icon"></i>';}?>
                            </div>
                          <?php } ?>
                        </div>

                        <div class="col-lg-8 col-12 mt-1">
                            <div class="row">
                              <div class="col-12">
                                <h6 style="margin-top: 15px;" class="text-mute"><strong>ราคาบัตรที่เลือก</strong></h6>
                                <div class="select_card_product" id="card_select">0 บาท</div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 col-lg-6">
                                  <h6 style="margin-top: 15px;" class="text-mute"><strong>จำนวน</strong></h6>
                                  <input type="number" id="card_qty" min="1" class="qty_card_product" value="1">
                              </div>
                              <div class="col-12 col-lg-6">
                                <h6 style="margin-top: 15px;" class="text-mute"><strong>สินค้าในสต็อค</strong></h6>
                                <div class="select_card_product" id="card_stock">0 ชิ้น</div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <h6 style="margin-top: 15px;" class="text-mute"><strong>ยอดรวม</strong></h6>
                                <div class="select_card_product" id="card_sum">0 บาท</div>
                              </div>
                              <div class="col-12 mt-4">
                                <button type="button" id="btn_buycard" buyqty="1" cardid="0" class="btn btn-outline-main w-100 <?php echo check_login_disabled(); ?>"><?php echo check_login_text("ยืนยันการสั่งซื้อ"); ?></button>
                              </div>
                            </div>
                        </div>

                    </div>
                  </div>
               </div>
             <?php } ?>

            <?php } ?>

          </div>
        </div>
      </div>
    </div>
</div>
<?php //}else{ ?>
   <!-- <div class="row p-2">
     <div class="col-12 p-5 text-center">
       <h2>ไม่พบข้อมูล ...</h2>
     </div>
   </div> -->
<?php //} ?>
<script type="text/javascript">
    $("#btn_buycard").click(function(e) {
        e.preventDefault();
        var btn_buyqty = $(this)[0].getAttribute("buyqty");
        var btn_cardid = $(this)[0].getAttribute("cardid");
        var formData = new FormData();
        formData.append('buyqty', btn_buyqty);
        formData.append('cardid', btn_cardid);
        $('#btn_buycard').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/system/buy_card.php',
            data:formData,
            contentType: false,
            processData: false,
        }).done(function(res){
            result = res;
            swal({
                icon: 'success',
                title: 'สำเร็จ',
                text: result.message
            }).then(function() {
                    window.location = "<?php echo base_url(); ?>/profile/mailbox";
            });
            console.clear();
            $('#btn_buycard').removeAttr('disabled');
        }).fail(function(jqXHR){
            res = jqXHR.responseJSON;
            swal({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            console.clear();
            $('#btn_buycard').removeAttr('disabled');
        });
    });
    $('.card_product').click(function(e) {
      e.preventDefault();
      if($(this).attr('class') !== "card_product card_product_active cardselect"){
        $(this).toggleClass('card_product_active cardselect').siblings().removeClass('card_product_active cardselect');
        var selprice = document.getElementById('card_select');
        var getsumprice = document.getElementById('card_sum');
        var selstock = document.getElementById('card_stock');
        var cprice = $(".cardselect")[0].getAttribute('data-price');
        var cardid = $(".cardselect")[0].getAttribute('cardid');
        var stock = $(".cardselect")[0].getAttribute('stock');

        var cardqty = $('#card_qty').val();
        var value = cprice*cardqty;
        getsumprice.innerHTML = Number(value).toLocaleString()+" บาท";
        selprice.innerHTML = Number(cprice).toLocaleString()+" บาท";
        selstock.innerHTML = Number(stock).toLocaleString()+" ชิ้น";

          $("#btn_buycard")[0].setAttribute("buyqty", cardqty);
          $("#btn_buycard")[0].setAttribute("cardid", cardid);
          $('#btn_buycard').removeAttr('disabled');
      }
    });

    $('#card_qty').on('input', function() {
      var cardqty = $('#card_qty').val();
      var sump = $(".cardselect")[0].getAttribute('data-price');
      var getsumprice = document.getElementById('card_sum');
      var cprice = sump*cardqty;
      getsumprice.innerHTML = Number(cprice).toLocaleString()+" บาท";
      $("#btn_buycard")[0].setAttribute("buyqty", cardqty);
    });
</script>
