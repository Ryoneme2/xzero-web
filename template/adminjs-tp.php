<script type="text/javascript">

    $(document).ready(function() {
      $('.mdb-select').materialSelect();
      $('#datatable_backend_logwallet').DataTable();
      $('#datatable_backend_logtruemoney').DataTable();
      $('#datatable_backend_logbank').DataTable();
      $('#datatable_backend_user').DataTable();
      $('#datatable_backend_category').DataTable();
      $('#datatable_backend_logcode').DataTable();
      $('#datatable_backend_stockcode1').DataTable();
      $('#datatable_backend_card').DataTable();
      $('#datatable_backend_logcard').DataTable();
      $('#datatable_backend_lograndom').DataTable();

      $("#btn_backend_login").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('user', $("#txt_backend_user").val());
            formData.append('pass', $("#txt_backend_pass").val());
            $('#btn_backend_login').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_login.php',
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
                        window.location = "<?php echo base_url(); ?>/backend";
                });
                console.clear();
                $('#btn_backend_login').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_login').removeAttr('disabled');
            });
      });
      $("#btn_backend_reset").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('oldpass', $("#txt_backend_reset_oldpass").val());
            formData.append('newpass', $("#txt_backend_reset_newpass").val());
            formData.append('conpass', $("#txt_backend_reset_connewpass").val());
            $('#btn_backend_reset').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_reset.php',
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
                        window.location = "<?php echo base_url(); ?>/backend/home";
                });
                console.clear();
                $('#btn_backend_reset').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_reset').removeAttr('disabled');
            });
      });

      $("#btn_backend_add_stockgame").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('txt_gameadd', $("#txt_gameadd").val());
            formData.append('txt_gamesel', $("#txt_gamesel").val());
            $('#btn_backend_add_stockgame').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_add_stockgame.php',
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
                        window.location = "<?php echo base_url(); ?>/backend/random";
                });
                console.clear();
                $('#btn_backend_add_stockgame').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_add_stockgame').removeAttr('disabled');
            });
      });


      $("#btn_backend_save_persentcsgo").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('txt_gamecsgo_1', $("#txt_gamecsgo_1").val());
            formData.append('txt_gamecsgo_2', $("#txt_gamecsgo_2").val());
            formData.append('txt_gamecsgo_3', $("#txt_gamecsgo_3").val());
            formData.append('txt_gamecsgo_4', $("#txt_gamecsgo_4").val());
            formData.append('txt_gamecsgo_5', $("#txt_gamecsgo_5").val());
            formData.append('txt_gamecsgo_6', $("#txt_gamecsgo_6").val());
            formData.append('txt_gamecsgo_7', $("#txt_gamecsgo_7").val());
            formData.append('txt_gamecsgo_8', $("#txt_gamecsgo_8").val());
            formData.append('txt_gamecsgo_9', $("#txt_gamecsgo_9").val());


            $('#btn_backend_save_persentcsgo').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_csgopersent_save.php',
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
                        window.location = "<?php echo base_url(); ?>/backend/csgo";
                });
                console.clear();
                $('#btn_backend_save_persentcsgo').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_save_persentcsgo').removeAttr('disabled');
            });
      });
      $("#btn_backend_add_stockcard").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('code', $("#txt_backend_add_stockcard_code").val());
            formData.append('type', $("#txt_backend_add_stockcard_type").val());
            formData.append('id', $("#txt_backend_add_stockcard_id").val());

            $('#btn_backend_add_stockcard').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_stockcard_add.php',
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
                        window.location = "<?php echo base_url(); ?>/backend/detailcard/"+result.id;
                });
                console.clear();
                $('#btn_backend_add_stockcard').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_add_stockcard').removeAttr('disabled');
            });
      });


      $("#btn_backend_add_stockcard").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('code', $("#txt_backend_add_stockcard_code").val());
            formData.append('type', $("#txt_backend_add_stockcard_type").val());
            formData.append('id', $("#txt_backend_add_stockcard_id").val());

            $('#btn_backend_add_stockcard').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_stockcard_add.php',
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
                        window.location = "<?php echo base_url(); ?>/backend/detailcard/"+result.id;
                });
                console.clear();
                $('#btn_backend_add_stockcard').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_add_stockcard').removeAttr('disabled');
            });
      });


      $("#btn_backend_user_edit").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('user', $("#txt_backend_edit_user").val());
            formData.append('email', $("#txt_backend_edit_email").val());
            formData.append('point', $("#txt_backend_edit_point").val());
            formData.append('youbuy', $("#txt_backend_edit_youbuy").val());
            formData.append('key', $("#txt_backend_edit_key").val());
            formData.append('type', $("#txt_backend_edit_type2").val());
            formData.append('id', $("#txt_backend_edit_id").val());

            $('#btn_backend_user_edit').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_us_save.php',
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
                        window.location = "<?php echo base_url(); ?>/backend/user";
                });
                console.clear();
                $('#btn_backend_user_edit').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_user_edit').removeAttr('disabled');
            });
      });
      $("#btn_backend_add_category").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('type', $("#txt_backend_add_category_type").val());
            formData.append('name', $("#txt_backend_add_category_name").val());
            $('#btn_backend_add_category').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_category_add.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/category";
                });
                console.clear();
                $('#btn_backend_add_category').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_add_category').removeAttr('disabled');
            });
      });

      $("#btn_backend_add_code").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            var files = $('#txt_backend_code_file')[0].files[0];

            formData.append('name', $("#txt_backend_code_name").val());
            formData.append('des', $("#txt_backend_code_des").val());
            formData.append('price', $("#txt_backend_code_price").val());
            formData.append('type', $("#txt_backend_code_type").val());
            formData.append('file', files);
            $('#btn_backend_add_code').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_code_add.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/code";
                });
                console.clear();
                $('#btn_backend_add_code').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_add_code').removeAttr('disabled');
            });
      });
      $("#btn_backend_code_edit").click(function(e) {
            e.preventDefault();
            var formData = new FormData();

            formData.append('name', $("#txt_backend_edit_code_name").val());
            formData.append('price', $("#txt_backend_edit_code_price").val());
            formData.append('des', $("#txt_backend_edit_code_des").val());
            formData.append('id', $("#txt_backend_edit_code_id").val());
            $('#btn_backend_code_edit').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_code_editsave.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/code";
                });
                console.clear();
                $('#btn_backend_code_edit').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_code_edit').removeAttr('disabled');
            });
      });

      $("#btn_backend_add_stockcode").click(function(e) {
            e.preventDefault();
            var formData = new FormData();

            formData.append('key', $("#txt_backend_stockcode_key").val());
            formData.append('id', $("#txt_backend_stockcode_id").val());
            $('#btn_backend_add_stockcode').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_stockcode_add.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/detailcode/"+result.id;
                });
                console.clear();
                $('#btn_backend_add_stockcode').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_add_stockcode').removeAttr('disabled');
            });
      });
      $("#btn_backend_add_idgame").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            var files = $('#txt_backend_idgame_file')[0].files[0];
            formData.append('file', files);
            formData.append('name', $("#txt_backend_idgame_name").val());
            formData.append('des', $("#txt_backend_idgame_des").val());
            formData.append('price', $("#txt_backend_idgame_price").val());
            formData.append('user', $("#txt_backend_idgame_user").val());
            formData.append('pass', $("#txt_backend_idgame_pass").val());
            formData.append('email', $("#txt_backend_idgame_email").val());
            formData.append('tel', $("#txt_backend_idgame_tel").val());
            formData.append('type', $("#txt_backend_idgame_type").val());
            $('#btn_backend_add_idgame').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_idgame_add.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/idgame";
                });
                console.clear();
                $('#btn_backend_add_idgame').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_add_idgame').removeAttr('disabled');
            });
      });

      $("#btn_backend_idgame_edit").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            var files = $('#txt_backend_edit_idgame_file')[0].files[0];
            formData.append('file', files);
            formData.append('id', $("#txt_backend_edit_idgame_id").val());
            formData.append('name', $("#txt_backend_edit_idgame_name").val());
            formData.append('des', $("#txt_backend_edit_idgame_des").val());
            formData.append('price', $("#txt_backend_edit_idgame_price").val());
            formData.append('user', $("#txt_backend_edit_idgame_user").val());
            formData.append('pass', $("#txt_backend_edit_idgame_pass").val());
            formData.append('email', $("#txt_backend_edit_idgame_email").val());
            formData.append('tel', $("#txt_backend_edit_idgame_tel").val());
            formData.append('type', $("#txt_backend_edit_idgame_type").val());
            $('#btn_backend_idgame_edit').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_idgame_save.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/idgame";
                });
                console.clear();
                $('#btn_backend_idgame_edit').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_idgame_edit').removeAttr('disabled');
            });
      });

      $("#btn_backend_save_setting").click(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('tel', $("#txt_backend_setting_tel").val());
            formData.append('email', $("#txt_backend_setting_email").val());
            formData.append('passemail', $("#txt_backend_setting_passemail").val());
            formData.append('tmpay', $("#txt_backend_setting_tmpay").val());
            formData.append('namebank', $("#txt_backend_setting_namebank").val());
            formData.append('numberbank', $("#txt_backend_setting_numberbank").val());
            formData.append('userbank', $("#txt_backend_setting_userbank").val());
            formData.append('passbank', $("#txt_backend_setting_passbank").val());
            $('#btn_backend_save_setting').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>/system/admin_setting_save.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/setting";
                });
                console.clear();
                $('#btn_backend_save_setting').removeAttr('disabled');
            }).fail(function(jqXHR){
                res = jqXHR.responseJSON;
                swal({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: res.message
                })
                console.clear();
                $('#btn_backend_save_setting').removeAttr('disabled');
            });
      });


      $('#uploadForm').on('submit', function(e) {
          e.preventDefault();
          $('#btn_detailidgame_addimg').attr('disabled', 'disabled');
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>/system/admin_idgame_addimg.php',
              data:new FormData(this),
              contentType: false,
              processData: false,
          }).done(function(res){
              result = res;
              swal({
                  icon: 'success',
                  title: 'สำเร็จ',
                  text: result.message
              }).then(function() {
                  window.location = "<?php echo base_url(); ?>/backend/detailidgame/"+result.id;
              });
              console.clear();
              $('#btn_detailidgame_addimg').removeAttr('disabled');
          }).fail(function(jqXHR){
              res = jqXHR.responseJSON;
              swal({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: res.message
              })
              console.clear();
              $('#btn_detailidgame_addimg').removeAttr('disabled');
          });
        });


    });

    function backend_funcode_edit(id) {
      var formData = new FormData();
      formData.append('id', id);
      $('#btn_backend_code_edit').attr('disabled', 'disabled');
      $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>/system/admin_code_edit.php',
          data:formData,
          contentType: false,
          processData: false,
      }).done(function(res){
            result = res;
            $('#modaleditcodeForm').modal('show');
            $('#modaleditcodeForm').find('#txt_backend_edit_code_name').val(result.user);
            $('#modaleditcodeForm').find('#txt_backend_edit_code_price').val(result.price);
            $('#modaleditcodeForm').find('#txt_backend_edit_code_des').html(result.des);
            $('#modaleditcodeForm').find('#txt_backend_edit_code_id').val(result.id);
            console.log(result);

          console.clear();
          $('#btn_backend_code_edit').removeAttr('disabled');
      }).fail(function(jqXHR){
          res = jqXHR.responseJSON;
          swal({
              icon: 'error',
              title: 'เกิดข้อผิดพลาด',
              text: res.message
          })
          console.clear();
          $('#btn_backend_code_edit').removeAttr('disabled');
      });
    }

    function backend_us_edit(id) {
      var formData = new FormData();
      formData.append('id', id);
      $('#backend_us_edit').attr('disabled', 'disabled');
      $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>/system/admin_us_edit.php',
          data:formData,
          contentType: false,
          processData: false,
      }).done(function(res){
          result = res;
            $('#modaledituserForm').modal('show');
            if (result.type == "f") {
              $('#bbssqsc56456').hide();
              type = "Facebook";
            }else{
              $('#bbssqsc56456').show();
              type = "WebSite";
              $('#modaledituserForm').find('#txt_backend_edit_key').val(result.key);
            }

            $('#modaledituserForm').find('#txt_backend_edit_user').val(result.user);
            $('#modaledituserForm').find('#txt_backend_edit_email').val(result.email);
            $('#modaledituserForm').find('#txt_backend_edit_point').val(result.point);
            $('#modaledituserForm').find('#txt_backend_edit_youbuy').val(result.youbuy);
            $('#modaledituserForm').find('#txt_backend_edit_type').val(type);
            $('#modaledituserForm').find('#txt_backend_edit_type2').val(result.type);
            $('#modaledituserForm').find('#txt_backend_edit_id').val(result.id);
            console.log(result);

          console.clear();
          $('#backend_us_edit').removeAttr('disabled');
      }).fail(function(jqXHR){
          res = jqXHR.responseJSON;
          swal({
              icon: 'error',
              title: 'เกิดข้อผิดพลาด',
              text: res.message
          })
          console.clear();
          $('#backend_us_edit').removeAttr('disabled');
      });
    }

    function backend_funidgame_edit(id) {
      var formData = new FormData();
      formData.append('id', id);
      $('#backend_funidgame_edit').attr('disabled', 'disabled');
      $.ajax({
          type: 'POST',
          url: '<?php echo base_url(); ?>/system/admin_idgame_edit.php',
          data:formData,
          contentType: false,
          processData: false,
      }).done(function(res){
          result = res;
            $('#modaleditidgameForm').modal('show');

            $('#modaleditidgameForm').find('#txt_backend_edit_idgame_name').val(result.name);
            $('#modaleditidgameForm').find('#txt_backend_edit_idgame_des').html(result.des);
            $('#modaleditidgameForm').find('#txt_backend_edit_idgame_price').val(result.price);
            $('#modaleditidgameForm').find('#txt_backend_edit_idgame_user').val(result.user);
            $('#modaleditidgameForm').find('#txt_backend_edit_idgame_pass').val(result.pass);
            $('#modaleditidgameForm').find('#txt_backend_edit_idgame_email').val(result.email);
            $('#modaleditidgameForm').find('#txt_backend_edit_idgame_tel').val(result.tel);
            $('#modaleditidgameForm').find('#txt_backend_edit_idgame_id').val(result.id);
            $('#modaleditidgameForm #txt_backend_edit_idgame_type option[value='+result.type+']').attr('selected','selected');

            console.log(result);

          console.clear();
          $('#backend_funidgame_edit').removeAttr('disabled');
      }).fail(function(jqXHR){
          res = jqXHR.responseJSON;
          swal({
              icon: 'error',
              title: 'เกิดข้อผิดพลาด',
              text: res.message
          })
          console.clear();
          $('#backend_funidgame_edit').removeAttr('disabled');
      });
    }



    function backend_us_del(id) {
      var x = confirm("คุณแน่ใจว่าจะลบ");
      if(x) {
        var formData = new FormData();
        formData.append('id', id);
        $('#backend_us_del').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/system/admin_us_del.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/user";
            });
            console.clear();
            $('#backend_us_del').removeAttr('disabled');
        }).fail(function(jqXHR){
            res = jqXHR.responseJSON;
            swal({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            console.clear();
            $('#backend_us_del').removeAttr('disabled');
        });
      }else{
        console.log("ok not del");
      }
    }

    function backend_category_del(id) {
      var x = confirm("คุณแน่ใจว่าจะลบ");
      if(x) {
        var formData = new FormData();
        formData.append('id', id);
        $('#backend_category_del').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/system/admin_category_del.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/category";
            });
            console.clear();
            $('#backend_category_del').removeAttr('disabled');
        }).fail(function(jqXHR){
            res = jqXHR.responseJSON;
            swal({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            console.clear();
            $('#backend_category_del').removeAttr('disabled');
        });
      }else{
        console.log("ok not del");
      }
    }

    function backend_funcode_del(id) {
      var x = confirm("คุณแน่ใจว่าจะลบ ประวัติการซื้อสินค้านี้จะหายด้วย");
      if(x) {
        var formData = new FormData();
        formData.append('id', id);
        $('#backend_funcode_del').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/system/admin_code_del.php',
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
                    window.location = "<?php echo base_url(); ?>/backend/code";
            });
            console.clear();
            $('#backend_funcode_del').removeAttr('disabled');
        }).fail(function(jqXHR){
            res = jqXHR.responseJSON;
            swal({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            console.clear();
            $('#backend_funcode_del').removeAttr('disabled');
        });
      }else{
        console.log("ok not del");
      }
    }


    function backend_stockcode_del(id) {
      var x = confirm("คุณแน่ใจว่าจะลบ");
      if(x) {
        var formData = new FormData();
        formData.append('id', id);
        $('#backend_stockcode_del').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/system/admin_stockcode_del.php',
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
                   window.location = "<?php echo base_url(); ?>/backend/detailcode/"+result.id;
            });
            console.clear();
            $('#backend_stockcode_del').removeAttr('disabled');
        }).fail(function(jqXHR){
            res = jqXHR.responseJSON;
            swal({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            console.clear();
            $('#backend_stockcode_del').removeAttr('disabled');
        });
      }else{
        console.log("ok not del");
      }
    }

    function backend_funidgame_del(id) {
      var x = confirm("คุณแน่ใจว่าจะลบ");
      if(x) {
        var formData = new FormData();
        formData.append('id', id);
        $('#backend_funidgame_del').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/system/admin_idgame_del.php',
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
                   window.location = "<?php echo base_url(); ?>/backend/idgame";
            });
            console.clear();
            $('#backend_funidgame_del').removeAttr('disabled');
        }).fail(function(jqXHR){
            res = jqXHR.responseJSON;
            swal({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            console.clear();
            $('#backend_funidgame_del').removeAttr('disabled');
        });
      }else{
        console.log("ok not del");
      }
    }

      function backend_stockcard_del(id) {
        var x = confirm("คุณแน่ใจว่าจะลบ");
        if(x) {
          var formData = new FormData();
          formData.append('id', id);
          formData.append('page', $("#txt_backend_add_stockcard_id").val());
          $('#backend_stockcard_del').attr('disabled', 'disabled');
          $.ajax({
              type: 'POST',
              url: '<?php echo base_url(); ?>/system/admin_stockcard_del.php',
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
                     window.location = "<?php echo base_url(); ?>/backend/detailcard/"+result.id;
              });
              console.clear();
              $('#backend_stockcard_del').removeAttr('disabled');
          }).fail(function(jqXHR){
              res = jqXHR.responseJSON;
              swal({
                  icon: 'error',
                  title: 'เกิดข้อผิดพลาด',
                  text: res.message
              })
              console.clear();
              $('#backend_stockcard_del').removeAttr('disabled');
          });
        }else{
          console.log("ok not del");
        }
      }



    function backend_fundetailidgame_del(id) {
      var x = confirm("คุณแน่ใจว่าจะลบ");
      if(x) {
        var formData = new FormData();
        formData.append('id', id);
        $('#backend_fundetailidgame_del').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/system/admin_detailidgame_del.php',
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
                   window.location = "<?php echo base_url(); ?>/backend/detailidgame/"+result.id;
            });
            console.clear();
            $('#backend_fundetailidgame_del').removeAttr('disabled');
        }).fail(function(jqXHR){
            res = jqXHR.responseJSON;
            swal({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            console.clear();
            $('#backend_fundetailidgame_del').removeAttr('disabled');
        });
      }else{
        console.log("ok not del");
      }
    }
    function backend_gamestock_del(id) {
      var x = confirm("คุณแน่ใจว่าจะลบ");
      if(x) {
        var formData = new FormData();
        formData.append('id', id);
        $('#backend_gamestock_del').attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/system/admin_gamestock_del.php',
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
                   window.location = "<?php echo base_url(); ?>/backend/random";
            });
            console.clear();
            $('#backend_gamestock_del').removeAttr('disabled');
        }).fail(function(jqXHR){
            res = jqXHR.responseJSON;
            swal({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: res.message
            })
            console.clear();
            $('#backend_gamestock_del').removeAttr('disabled');
        });
      }else{
        console.log("ok not del");
      }
    }

</script>
