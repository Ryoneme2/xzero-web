<?php
          require_once '../config.php';


          $helper = $fb->getRedirectLoginHelper();
          try {
            $accessToken = $helper->getAccessToken();
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
              echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาด Graph Error'); location.href='".base_url()."';</script>";
              exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
              echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาด SDK Error'); location.href='".base_url()."';</script>";
              exit;
            // exit;
          }

          if (isset($accessToken)) {
                  $_SESSION['facebook_access_token'] = (string) $accessToken;
                  $response = $fb->get('/me?locale=en_US&fields=id,name,first_name,last_name,email', $accessToken);
                  $user = $response->getGraphUser();
                  $str_picture = "https://graph.facebook.com/".$user['id']."/picture?type=large";
                  $str_link = "https://www.facebook.com/app_scoped_user_id/".$user['id']."/";
                  $fullname = $user['first_name']." ".$user['last_name'];
                  if ($user['email'] == null || $user['email'] == "") {
                    $email = "-";
                  }else{
                    $email = $user['email'];
                  }
                  // $q_1 = dd_q('SELECT * FROM user_tb WHERE (u_name = ? OR u_email = ? OR u_fbid = ?) AND u_type = ?', [$fullname,$email,$user['id'],"f"]);

                  $q_1 = dd_q('SELECT * FROM user_tb WHERE (u_email = ? OR u_fbid = ?) AND u_type = ?', [$email,$user['id'],"f"]);
                  if ($q_1->rowCount() >= 1) {
                    //update
                    $row = $q_1->fetch(PDO::FETCH_ASSOC);
                    $q_2 = dd_q('UPDATE user_tb SET u_name = ?,u_fbid = ?,u_token = ? WHERE u_email = ? AND u_fbid = ? AND u_type = ? LIMIT 1', [$fullname,$user['id'],$accessToken,$row['u_email'],$row['u_fbid'],"f"]);
                    if ($q_2 == true) {
                      $_SESSION['id'] = $row['u_id'];
                      echo "<script type='text/javascript'>alert('เข้าสู่ระบบสำเร็จ'); location.href='".base_url()."';</script>";
                      exit;
                    }else{
                      echo "<script type='text/javascript'>alert('เข้าสู่ระบบไม่สำเร็จ'); location.href='".base_url()."';</script>";
                      exit;
                    }

                  }else{
                    //insert
                    $q_3 = dd_q('INSERT INTO user_tb (u_name, u_email, u_img, u_point, u_youbuy, u_link, u_type, u_fbid, u_date, u_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                      $fullname,
                      $email,
                      $str_picture,
                      0,
                      0,
                      $str_link,
                      "f",
                      $user['id'],
                      date("Y-m-d H:i:s"),
                      $accessToken
                    ]);
                      if ($q_3 == true) {
                        $last_id = $conn->lastInsertId();
                        $_SESSION['id'] = $last_id;
                        echo "<script type='text/javascript'>alert('เข้าสู่ระบบสำเร็จ'); location.href='".base_url()."';</script>";
                        exit;
                      }else{
                        echo "<script type='text/javascript'>alert('เข้าสู่ระบบไม่สำเร็จ'); location.href='".base_url()."';</script>";
                        exit;
                      }
                  }


          }

?>
