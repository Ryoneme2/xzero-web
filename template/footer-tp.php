<script type="text/javascript" src="<?php echo base_url(); ?>/asset/mdb/js/mdb.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/asset/sweetalert.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/asset/slick-1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {


    $('.slick-track').slick({
        dots: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 800,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
    });


    $(window).scroll(function() {

        if ($(document).scrollTop() > 5) {
            $('#nav_top').addClass('fixed-top');
            $('#nav_menu').addClass('fixed-top-2');

            $('#nav_menu').addClass('fixed-top');
        }else {
            $('#nav_top').removeClass('fixed-top');
            $('#nav_menu').removeClass('fixed-top-2');

            $('#nav_menu').removeClass('fixed-top');
        }
    });

    $("#btn_login").click(function(e) {
          e.preventDefault();
          var formData = new FormData();
          formData.append('user', $("#txt_login_user").val());
          formData.append('pass', $("#txt_login_pass").val());
          captcha = grecaptcha.getResponse();
          formData.append('captcha', captcha);
          $('#btn_login').attr('disabled', 'disabled');
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>/system/login.php',
              data:formData,
              contentType: false,
              processData: false,
          }).done(function(res){
              result = res;
              grecaptcha.reset();
              swal({
                  icon: 'success',
                  title: 'สำเร็จ',
                  text: result.message
              }).then(function() {
                      window.location = "<?php echo base_url(); ?>";
              });
              console.clear();
              $('#btn_login').removeAttr('disabled');
          }).fail(function(jqXHR){
              res = jqXHR.responseJSON;
              grecaptcha.reset();
              swal({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: res.message
              })
              console.clear();
              $('#btn_login').removeAttr('disabled');
          });
    });

    $("#btn_register").click(function(e) {
          e.preventDefault();
          var formData = new FormData();
          formData.append('user', $("#txt_reg_user").val());
          formData.append('email', $("#txt_reg_email").val());
          formData.append('pass', $("#txt_reg_pass").val());
          formData.append('conpass', $("#txt_reg_conpass").val());
          formData.append('key', $("#txt_reg_key").val());
          captcha = grecaptcha.getResponse();
          formData.append('captcha', captcha);

          $('#btn_register').attr('disabled', 'disabled');
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>/system/register.php',
              data:formData,
              contentType: false,
              processData: false,
          }).done(function(res){
              result = res;
              grecaptcha.reset();
              swal({
                  icon: 'success',
                  title: 'สำเร็จ',
                  text: result.message
              }).then(function() {
                      window.location = "<?php echo base_url(); ?>";
              });
              console.clear();
              $('#btn_register').removeAttr('disabled');
          }).fail(function(jqXHR){
              res = jqXHR.responseJSON;
              grecaptcha.reset();
              swal({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: res.message
              })
              console.clear();
              $('#btn_register').removeAttr('disabled');
          });
    });



    $("#btn_change").click(function(e) {
          e.preventDefault();
          var formData = new FormData();
          formData.append('txt_change_oldpass', $("#txt_change_oldpass").val());
          formData.append('txt_change_pass', $("#txt_change_pass").val());
          formData.append('txt_change_conpass', $("#txt_change_conpass").val());


          $('#btn_change').attr('disabled', 'disabled');
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>/system/change_pass.php',
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
                      window.location = "<?php echo base_url(); ?>";
              });
              console.clear();
              $('#btn_change').removeAttr('disabled');
          }).fail(function(jqXHR){
              res = jqXHR.responseJSON;
              swal({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: res.message
              })
              console.clear();
              $('#btn_change').removeAttr('disabled');
          });
    });

    $("#btn_paytw").click(function(e) {
          e.preventDefault();
          var formData = new FormData();
          formData.append('txt_ref', $("#txt_paytw_ref").val());
          captcha = grecaptcha.getResponse();
          formData.append('captcha', captcha);

          $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>/system/pay_tw.php',
              data:formData,
              contentType: false,
              processData: false,
              beforeSend: function() {
                $('#btn_paytw').attr('disabled', 'disabled');
                $('#btn_paytw').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>รอสักครู่...');
              },
          }).done(function(res){
              result = res;
              grecaptcha.reset();
              swal({
                  icon: 'success',
                  title: 'สำเร็จ',
                  text: result.message
              }).then(function() {
                      window.location = "<?php echo base_url()."/profile/log_payment"; ?>";
              });
              console.clear();
              //console.log(result.message);
              $('#btn_paytw').html('<i class="fas fa-check-circle mr-1"></i>ยืนยันเติมเงิน');
              $('#btn_paytw').removeAttr('disabled');
          }).fail(function(jqXHR){
              res = jqXHR.responseJSON;
              grecaptcha.reset();
              swal({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: res.message
              })
              console.clear();
              $('#btn_paytw').html('<i class="fas fa-check-circle mr-1"></i>ยืนยันเติมเงิน');
              $('#btn_paytw').removeAttr('disabled');
          });
    });


    $("#btn_paytm").click(function(e) {
          e.preventDefault();
          var formData = new FormData();
          formData.append('txt_paytm_ref', $("#txt_paytm_ref").val());
          captcha = grecaptcha.getResponse();
          formData.append('captcha', captcha);
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>/system/pay_tm.php',
              data:formData,
              contentType: false,
              processData: false,
              beforeSend: function() {
                $('#btn_paytm').attr('disabled', 'disabled');
                $('#btn_paytm').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>รอสักครู่...');
              },
          }).done(function(res){
              result = res;
              grecaptcha.reset();
              swal({
                  icon: 'success',
                  title: 'สำเร็จ',
                  text: result.message
              }).then(function() {
                      window.location = "<?php echo base_url()."/profile/log_payment"; ?>";
              });
              console.clear();
              $('#btn_paytm').html('<i class="fas fa-check-circle mr-1"></i>ยืนยันเติมเงิน');
              $('#btn_paytm').removeAttr('disabled');
          }).fail(function(jqXHR){
              res = jqXHR.responseJSON;
              grecaptcha.reset();
              swal({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: res.message
              })
              console.clear();
              $('#btn_paytm').html('<i class="fas fa-check-circle mr-1"></i>ยืนยันเติมเงิน');
              $('#btn_paytm').removeAttr('disabled');
          });
    });



    $("#btn_payb").click(function(e) {
          e.preventDefault();
          var formData = new FormData();
          formData.append('pay_date', $("#txt_payb_date").val());
          formData.append('pay_time', $("#txt_payb_time").val());
          formData.append('pay_point', $("#txt_payb_point").val());
          captcha = grecaptcha.getResponse();
          formData.append('captcha', captcha);
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>/system/pay_bank.php',
              data:formData,
              contentType: false,
              processData: false,
              beforeSend: function() {
                $('#btn_payb').attr('disabled', 'disabled');
                $('#btn_payb').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>รอสักครู่...');
              },
          }).done(function(res){
              result = res;
              grecaptcha.reset();
              swal({
                  icon: 'success',
                  title: 'สำเร็จ',
                  text: result.message
              }).then(function() {
                      window.location = "<?php echo base_url()."/profile/log_payment"; ?>";
              });
              console.clear();
              $('#btn_payb').html('<i class="fas fa-check-circle mr-1"></i>ยืนยันเติมเงิน');
              $('#btn_payb').removeAttr('disabled');
          }).fail(function(jqXHR){
              res = jqXHR.responseJSON;
              grecaptcha.reset();
              swal({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: res.message
              })
              console.clear();
              $('#btn_payb').html('<i class="fas fa-check-circle mr-1"></i>ยืนยันเติมเงิน');
              $('#btn_payb').removeAttr('disabled');
          });
    });





    $("#btn_reset").click(function(e) {
          e.preventDefault();
          var formData = new FormData();
          formData.append('email', $("#txt_reset_email").val());
          formData.append('key', $("#txt_reset_key").val());
          captcha = grecaptcha.getResponse();
          formData.append('captcha', captcha);

          $('#btn_reset').attr('disabled', 'disabled');
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>/system/reset_pass.php',
              data:formData,
              contentType: false,
              processData: false,
          }).done(function(res){
              result = res;
              grecaptcha.reset();
              swal({
                  icon: 'success',
                  title: 'สำเร็จ',
                  text: result.message
              }).then(function() {
                      window.location = "<?php echo base_url(); ?>";
              });
              console.clear();
              $('#btn_reset').removeAttr('disabled');
          }).fail(function(jqXHR){
              res = jqXHR.responseJSON;
              grecaptcha.reset();
              swal({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: res.message
              })
              console.clear();
              $('#btn_reset').removeAttr('disabled');
          });
    });

    $('#datatable_truemoney').DataTable();
    $('#datatable_bank').DataTable();
    $('#datatable_wallet').DataTable();
    $('#datatable_mailid').DataTable();
    $('#datatable_mailcode').DataTable();
    $('#datatable_mailcard').DataTable();
    $('#datatable_user_random').DataTable();

  });

  function buyid(id) {
    var formData = new FormData();
    formData.append('txt_id', id);

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>/system/buy_id.php',
        data:formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $('#btn_buyid').attr('disabled', 'disabled');
          $('#btn_buyid').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>รอสักครู่...');
        },
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
        $('#btn_buyid').html('<i class="fas fa-shopping-cart mr-1"></i>สั่งซื้อสินค้า');
        $('#btn_buyid').removeAttr('disabled');
    }).fail(function(jqXHR){
        res = jqXHR.responseJSON;
        swal({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: res.message
        })
        console.clear();
        $('#btn_buyid').html('<i class="fas fa-shopping-cart mr-1"></i>สั่งซื้อสินค้า');
        $('#btn_buyid').removeAttr('disabled');
    });
  }


  function buycode(id) {
    var formData = new FormData();
    formData.append('txt_id', id);
    formData.append('txt_qty', $("#txt_qty").val());

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>/system/buy_code.php',
        data:formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $('#btn_buycode').attr('disabled', 'disabled');
          $('#btn_buycode').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>รอสักครู่...');
        },
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
        $('#btn_buycode').html('<i class="fas fa-shopping-cart mr-1"></i>สั่งซื้อสินค้า');
        $('#btn_buycode').removeAttr('disabled');
    }).fail(function(jqXHR){
        res = jqXHR.responseJSON;
        swal({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: res.message
        })
        console.clear();
        $('#btn_buycode').html('<i class="fas fa-shopping-cart mr-1"></i>สั่งซื้อสินค้า');
        $('#btn_buycode').removeAttr('disabled');
    });
  }


  function IDdetail(id) {
    var formData = new FormData();
    formData.append('txt_id', id);
    formData.append('txt_type', "idgame");

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>/system/show_details.php',
        data:formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $('#btn_detailid_'+id).attr('disabled', 'disabled');
          $('#btn_detailid_'+id).html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>รอสักครู่...');
        },
    }).done(function(res){
        result = res;
        $('#desModal_id').modal('show');
        $('#desModal_id').find('.pduser_des').html(result.message);
        $('#desModal_id').find('.pdpass_des').html(result.pd_pass);
        $('#desModal_id').find('.pdtel_des').html(result.pd_tel);
        $('#desModal_id').find('.pdemail_des').html(result.pd_email);

        console.clear();
        $('#btn_detailid_'+id).html('ข้อมูล');
        $('#btn_detailid_'+id).removeAttr('disabled');
    }).fail(function(jqXHR){
        res = jqXHR.responseJSON;
        swal({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: res.message
        })
        console.clear();
        $('#btn_detailid_'+id).html('ข้อมูล');
        $('#btn_detailid_'+id).removeAttr('disabled');
    });
  }


  function CODEdetail(id) {
    var formData = new FormData();
    formData.append('txt_id', id);
    formData.append('txt_type', "code");

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>/system/show_details.php',
        data:formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $('#btn_detailcode_'+id).attr('disabled', 'disabled');
          $('#btn_detailcode_'+id).html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>รอสักครู่...');
        },
    }).done(function(res){
        result = res;
        $('#desModal_code').modal('show');
        $('#desModal_code').find('.code_des').html(result.message);

        console.clear();
        $('#btn_detailcode_'+id).html('ข้อมูล');
        $('#btn_detailcode_'+id).removeAttr('disabled');
    }).fail(function(jqXHR){
        res = jqXHR.responseJSON;
        swal({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: res.message
        })
        console.clear();
        $('#btn_detailcode_'+id).html('ข้อมูล');
        $('#btn_detailcode_'+id).removeAttr('disabled');
    });
  }
</script>

<script>
jQuery(document).ready(function($){
  var items = [
    {
      name: '<img src="<?php echo base_url(); ?>/img/randomcsgo/2.png" width="200px" class="img-fluid">',
      value: 'credit_10_10',
    },{
      name: '<img src="<?php echo base_url(); ?>/img/randomcsgo/9.png" width="200px" class="img-fluid">',
      value: 'stock_14',
    },{
      name: '<img src="<?php echo base_url(); ?>/img/randomcsgo/4.png" width="200px" class="img-fluid">',
      value: 'none',
    },{
      name: '<img src="<?php echo base_url(); ?>/img/randomcsgo/5.png" width="200px" class="img-fluid">',
      value: 'stock_9',
    },{
      name: '<img src="<?php echo base_url(); ?>/img/randomcsgo/6.png" width="200px" class="img-fluid">',
      value: 'stock_10',
    },{
      name: '<img src="<?php echo base_url(); ?>/img/randomcsgo/3.png" width="200px" class="img-fluid">',
      value: 'credit_5_50',
    },{
      name: '<img src="<?php echo base_url(); ?>/img/randomcsgo/7.png" width="200px" class="img-fluid">',
      value: 'stock_11',
    },{
      name: '<img src="<?php echo base_url(); ?>/img/randomcsgo/1.png" width="200px" class="img-fluid">',
      value: 'credit_1_5',
    },{
      name: '<img src="<?php echo base_url(); ?>/img/randomcsgo/8.png" width="200px" class="img-fluid">',
      value: 'stock_12',
    }
  ];

  $(".roller").eroller({
    items : items,
    key		: 'name',
  });
  let itemname = "";
  $(document).on('click','.start-spin',function(){
        $('.start-spin').attr('disabled', 'disabled');
        $(".start-spin").prop("disabled", true);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/system/csgo.php'
        }).done(function(res){
            result = res;
            console.log(result);
            var winner = result.index;
            itemname = res.message;
            $('.roller').eroller('destroy').eroller({
              items	: items,
              key		: 'name',
              direction		: 'left',
            });
            $('.roller').eroller('start','value',winner,8000);
            console.clear();
        }).fail(function(jqXHR){
            res = jqXHR.responseJSON;
            swal('เกิดข้อผิดพลาด', res.message, 'error');
            console.log(res);
            console.clear();
            $('.start-spin').removeAttr('disabled');
        });
  });
  $(document).on('eroller.start','.roller',function(){
      console.log("start");
  });
  $(document).on('eroller.complete','.roller',function(event,item){
      $(".start-spin").prop("disabled", false);
      $('.start-spin').removeAttr('disabled');
      swal({
          icon: 'success',
          title: 'สำเร็จ',
          text: itemname
      }).then(function() {
              window.location = "<?php echo base_url(); ?>/csgogame";
      });
      console.clear();
  });

});

</script>
