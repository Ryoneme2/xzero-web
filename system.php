<?php 

include 'sqli.php';
require __DIR__ . '/vendor/autoload.php';

class shopweb {
	function __construct(){
		$this->db = DB();
	}

	function profire(){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username = :user");
		$stmt->execute([":user"=>$_SESSION['username']]);
		return $stmt;
	}

	function register($user,$email,$pass){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username = :user");
		$stmt->bindparam(":user",$user);
		$stmt->execute();
		if($stmt->rowcount() > 0){
			$message = "มีผู้ใช้นี้อยู่ในระบบแล้ว";
		}else{
			$ph = $this->db->prepare("SELECT * FROM users WHERE email = :email");
			$ph->bindvalue(":email",$email);
			$ph->execute();
			if($ph->rowcount() > 0){
				$message = "มีอีเมลนี้อยู่ในระบบแล้ว";
			}else{
				$stmt = $this->db->prepare("INSERT INTO users(username, email, password) VALUES (:user,:email,:pass)");
				try {
					$stmt->execute([':user'=>$user,':pass'=>$pass,':email'=>$email]);
					$message = "success";
				} catch (Exception $e) {
					$message = $e->getMessage();
				}
			}
		}
		return $message;
	}
	function getphone(){
		$stmt = $this->db->prepare("SELECT * FROM config_web");
		$stmt->execute();
		$row = $stmt->fetch();
		$phone = $row["number_phone"];
		
		return $phone;
	}
	function login($user,$email,$pass){
		$stmt = $this->db->prepare("SELECT * FROM `users` WHERE username = :uname OR email = :uemail");
		$stmt->execute([':uname' => $user, ':uemail' => $email]);
		$row = $stmt->fetch();
		if($stmt->rowcount() > 0){
			if ($user == $row['username'] OR $email == $row['email']) {
				if (password_verify($pass, $row['password'])) {
					$message = "success";
					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['profire'] = $row['profire'];
					$_SESSION['point'] = $row['point'];
					$_SESSION['status'] = $row['status'];
				}else{
					$message = "คุณใส่รหัสผ่านผิด";
				}
			}else{
				$message = "ไม่พบ ชื่อผู้ใช้ หรือ อีเมล";
			}
		}else{
			$message = "ไม่พบ ชื่อผู้ใช้ หรือ อีเมล";
		}
		return $message;
	}

	function changeprofire($input){
		$stmt = $this->db->prepare("SELECT * FROM `users` WHERE profire = :profire");
		$stmt->execute([':profire'=>$input]);
		$row = $stmt->fetch();
		if(isset($_SESSION['username'])){
			$stmt = $this->db->prepare("UPDATE users SET profire = :profire WHERE username = :username");
			try {
				$stmt->execute([':profire'=>$input, ':username'=>$_SESSION['username']]);
				$message = "success";
			} catch (Exception $e) {
				$message = $e->getMessage();
			}
		} else {
			$message = "WTFFF!!!";
		}
		return $message;
	}

	function changepassword($pass,$new_password){
		$stmt = $this->db->prepare("SELECT * FROM `users` WHERE username = :id");
		$stmt->execute([':id'=>$_SESSION['username']]);
		$row = $stmt->fetch();
		if (password_verify($pass, $row['password'])) {
			$stmt = $this->db->prepare("UPDATE users SET password = :newpassword WHERE username = :username");
			try {
				$stmt->execute([':newpassword'=>$new_password, ':username'=>$_SESSION['username']]);
				$message = "success";	
				session_destroy();
			} catch (Exception $e) {
				$message = $e->getMessage();
			}
		}else {
			$message = "รหัสผ่านเดิมไม่ถูกต้อง";
		}
		return $message;
	}

	function changeusername($user_c,$pass_c){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username = :id");
		$stmt->execute([':id'=>$_SESSION['username']]);
		$row = $stmt->fetch();
		if ($user_c == $row['username']) {
			$message = "คุณใส่ชื่อผู้ใช้เดิม";
		} elseif (password_verify($pass_c, $row['password'])) {
			$stmt = $this->db->prepare("UPDATE users SET username = :newusername WHERE username = :username");
			try {
				$stmt->execute([':newusername'=>$user_c, ':username'=>$_SESSION['username']]);
				$message = "success";	
				session_destroy();
			} catch (Exception $e) {
				$message = $e->getMessage();
			}
		} else {
			$message = "รหัสผ่านไม่ถูกต้อง";
		}
		return $message;
	}

	function product(){
		$stmt = $this->db->prepare("SELECT * FROM product ");
		$stmt->execute();
		return $stmt;
	}

	function shopshowid($id){
		$stmt = $this->db->prepare("SELECT * FROM stock WHERE id = :id");
		$stmt->execute(['id'=>$id]);
		return $stmt;
	}

	function showstock($id){
		$stmt = $this->db->prepare("SELECT count(*) FROM stock WHERE type = :id AND owner = ''");
		$stmt->execute([':id'=>$id]);
		return $stmt;
	}

	function selectproduct($id){
		$stmt = $this->db->prepare("SELECT * FROM product WHERE id = :id");
		$stmt->execute([':id'=>$id]);
		return $stmt;
	}

	function modal_purchase($id){
		$stmt = $this->db->prepare("SELECT * FROM product WHERE id = ? LIMIT 1");
		$stmt->execute(array($id));
		return $stmt;
	}
	
	function redeem($phone,$voucher_hash){
		$curl = curl_init();
		curl_setopt_array($curl, array(
    
        CURLOPT_URL => 'https://gift.truemoney.com/campaign/vouchers/'.$voucher_hash.'/redeem',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_SSLVERSION => 7,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(array('mobile' => $phone,'voucher_hash' => $voucher_hash)),
        CURLOPT_HTTPHEADER => array(
            'accept: application/json',
            'content-type: application/json',
            
        ),
        CURLOPT_USERAGENT => "please_give_me_money"
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response);
    if (isset($result->status->code)) {
        $codestatus = $result->status->code;
        if ($codestatus == "VOUCHER_OUT_OF_STOCK") {
            $message['status'] = "error";
            $message['info'] = "อั๋งเปานี้ถูกใช้งานไปแล้ว";
        }elseif ($codestatus == "VOUCHER_NOT_FOUND") {
            $message['status'] = "error";
            $message['info'] = "ไม่พบอั๋งเปานี้!!";
        }elseif ($codestatus == "VOUCHER_EXPIRED"){
            $message['status'] = "error";
            $message['info'] = "อั๋งเปาหมดอายุ!!";
        }elseif ($codestatus == "SUCCESS"){
            $balance = $result->data->voucher;
            $ownerprofile = $result->data->owner_profile;
            if ($balance->amount_baht == $balance->redeemed_amount_baht) {
                $message['status'] = "success";
                $message['info'] = "เติมเงินสำเร็จ";
                $message['amount_baht'] = $balance->redeemed_amount_baht;
                $message['voucher_owner'] = $ownerprofile->full_name;
				//code add point here
				$stmt = $this->db->prepare("UPDATE users SET point = point + :point WHERE username = :username");
				$stmt->execute(['point' => $message['amount_baht'],':username'=>$_SESSION['username']]);
            }else{
                $message['status'] = "error";
                $message['info'] = "กรุณาแบ่งอั๋งเปาแค่1คน!!";
            }
        }else{
            $message['status'] = "error";
            $message['info'] = "ไม่ทราบสาเหตุ!!";
        }
    }else{
        $message['status'] = "error";
        $message['info'] = "ลิ้งอั๋งเปาไม่ถูกต้อง";
    }
    return $message;
	}

	function config(){
		$stmt = $this->db->prepare("SELECT * FROM config_web");
		$stmt->execute();
		return $stmt;
	}

	function editlogo($web_logo){
		$stmt = $this->db->prepare("SELECT * FROM config_web");
		$stmt->execute();
		$row = $stmt->fetch();
		if ($web_logo == $row['logo']) {
			$message = "คุณใช้รูปภาพเดิม";
		} else {
			$stmt = $this->db->prepare("UPDATE config_web SET logo = :logo, date = NOW()");
			try {
				$stmt->execute([':logo'=>$web_logo]);
				$message = "success";

			} catch (Exception $e) {
				$message = $e->getMessage();
			}
		}
		return $message;
	}

	function editfb($fb_page){
		$stmt = $this->db->prepare("SELECT * FROM config_web");
		$stmt->execute();
		$row = $stmt->fetch();
		if ($fb_page == $row['page_facebook']) {
			$message = "คุณใช้รูปภาพเดิม";
		} else {
			$stmt = $this->db->prepare("UPDATE config_web SET page_facebook = :fb, date = NOW()");
			try {
				$stmt->execute([':fb'=>$fb_page]);
				$message = "success";

			} catch (Exception $e) {
				$message = $e->getMessage();
			}
		}
		return $message;
	}

	function editname($nameweb){
		$stmt = $this->db->prepare("SELECT * FROM config_web");
		$stmt->execute();
		$row = $stmt->fetch();
		if ($nameweb == $row['name']) {
			$message = "คุณใช้ชื่อเดิม";
		} else {
			$stmt = $this->db->prepare("UPDATE config_web SET name = :name, date = NOW()");
			try {
				$stmt->execute([':name'=>$nameweb]);
				$message = "success";

			} catch (Exception $e) {
				$message = $e->getMessage();
			}
		}
		return $message;
	} 

	function editphone($phone){
		$stmt = $this->db->prepare("SELECT * FROM config_web");
		$stmt->execute();
		$row = $stmt->fetch();
		if ($phone == $row['number_phone']) {
			$message = "คุณใช้เบอร์เดิม";
		} else {
			$stmt = $this->db->prepare("UPDATE config_web SET number_phone = :number_phone, date = NOW()");
			try {
				$stmt->execute([':number_phone'=>$phone]);
				$message = "success";

			} catch (Exception $e) {
				$message = $e->getMessage();
			}
		}
		return $message;
	}

	function editemail($email){
		$stmt = $this->db->prepare("SELECT * FROM config_web");
		$stmt->execute();
		$row = $stmt->fetch();
		if ($email == $row['email']) {
			$message = "คุณใช้อีเมลเดิม";
		} else {
			$stmt = $this->db->prepare("UPDATE config_web SET email = :email, date = NOW()");
			try {
				$stmt->execute([':email'=>$email]);
				$message = "success";

			} catch (Exception $e) {
				$message = $e->getMessage();
			}
		}
		return $message;
	}

	function editline($line){
		$stmt = $this->db->prepare("SELECT * FROM config_web");
		$stmt->execute();
		$row = $stmt->fetch();
		if ($line == $row['line']) {
			$message = "คุณใช้@ไลน์เดิม";
		} else {
			$stmt = $this->db->prepare("UPDATE config_web SET line = :line, date = NOW()");
			try {
				$stmt->execute([':line'=>$line]);
				$message = "success";

			} catch (Exception $e) {
				$message = $e->getMessage();
			}
		}
		return $message;
	}

	function selectuser(){
		$add = $this->db->prepare("SELECT * FROM users");
		$add->execute();
		return $add;
	}

	function editselectuser($id){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
		$stmt->execute([':id'=>$id]);
		return $stmt;
	}

	function edituser($id,$user,$email,$point,$status,$imgprofire){
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("UPDATE users SET point = :point, email = :email, status = :status, profire = :profire, username = :user WHERE id = :id");
			$stmt->execute([
				':id'=>$id,
				':user'=>$user,
				':profire'=>$imgprofire,
				':point'=>$point,
				':email'=>$email,
				':status'=>$status
			]);
			$msg = "success";
		}else{
			$msg = "WTFF!!!";
		}
		return $msg;
	}

	function deleteuser($id){
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function editproduct($id,$name,$img,$detail,$price,$pattern){
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("UPDATE product SET name = :name, image = :img, detail = :detail, price = :price, pattern = :pat  WHERE id = :id");
			$stmt->execute([
				':id'=>$id,
				':name'=>$name,
				':img'=>$img,
				':detail'=>$detail,
				':price'=>$price,
				':pat'=>$pattern
			]);
			$msg = "success";
		}else{
			$msg = "WTFF!!!";
		}
		return $msg;
	}

	function countproduct(){
		$stmt = $this->db->prepare("SELECT count(id) FROM product ");
		$stmt->execute();
		return $stmt;
	}

	function deleteproduct($id) {
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("DELETE FROM product WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function selectstock(){
		$sdsd = $this->db->prepare("SELECT * FROM stock");
		$sdsd->execute();
		return $sdsd;
	}

	function selectstockid($id){
		$sdsd = $this->db->prepare("SELECT * FROM stock WHERE type = :type");
		$sdsd->execute([':type'=>$id]);
		return $sdsd;
	}

	function dsdsd($id){
		$qProductMeta = $this->db->prepare('SELECT * FROM product WHERE id= :id');
		$qProductMeta->execute(array(':id'=>$id));
		return $qProductMeta;
	}

	function editstock($id,$ct){
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("UPDATE stock SET contents = :ct WHERE id = :id");
			$stmt->execute([
				':id'=>$id,
				':ct'=>$ct
			]);
			$msg = "success";
		}else{
			$msg = "WTFF!!!";
		}
		return $msg;
	}

	function deletestock($id){
		if ($_SESSION['status'] == "admin") {
			$stmt = $this->db->prepare("DELETE FROM stock WHERE id = :id");
			$stmt->execute([':id'=>$id]);
			$msg = "success";
		}else{
			$msg = "WTFF!!";
		}
		return $msg;
	}

	function addstock($id,$inputItemData){
		$req_type = $id;
		$req_data = $inputItemData;
		$allData = preg_split('/\r\n|\r|\n/', $req_data);
		if (array_values($allData)[0] == '<batch>') {
			$x = '';
			foreach ($allData as $myData) {
				if ($myData != '<batch>') {
					$q1 = $this->db->prepare('INSERT INTO stock (type, contents, owner, date) VALUES (:a , :b, "", NULL)');
					$q1->execute([':a'=>$req_type,':b'=>$myData]);
					$x .= $this->db->lastInsertId() . ', ';
				}
			}if (!$q1) {
				$msg = 'ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้!';
			}else{
				$msg = 'success';
			}
		}else{
			$q1 = $this->db->prepare('INSERT INTO stock (type, contents, owner, date) VALUES (:a , :b, "", NULL)');
			$q1->execute([':a'=>$req_type,':b'=>$req_data]);
			if (!$q1) {
				$msg = 'ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้!';
			}else{
				$msg = 'success';
			}	
		}
		return $msg;
	}

	function addproduct($name,$price,$detail,$img,$pattern){
		if ($_SESSION['status'] !== "admin") {
			$msg = "WTFF";
		}else{
			$q1 = $this->db->prepare("INSERT INTO product (name, image, detail, price, pattern) VALUES (:name,:image,:detail,:price,:pattern)");
			$q1->execute(array(':name'=>$name,':image'=>$img,':detail'=>$detail,':price'=>$price,':pattern'=>$pattern));
			if (!$q1) {
				$msg = 'ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้!';
			}else{
				$msg = 'success';
			}
		}
		return $msg;
	}

	function counter(){
		$ip = $_SERVER["REMOTE_ADDR"];
		if ($ip == '::1') {
			$ip = "127.0.0.1";
		}
		$strSQL = $this->db->prepare("SELECT DATE FROM counter LIMIT 0,1");
		$strSQL->execute();
		$strSQLip = $this->db->prepare(" SELECT * FROM counter WHERE IP = :ip");
		$strSQLip->execute([':ip'=>$ip]);
		$row = $strSQL->fetch();
		$rowip = $strSQLip->fetch();

		if ($ip !== $rowip['IP']) {
			$set_ip = $this->db->prepare(" INSERT INTO counter (DATE,IP) VALUES (:_date,:ip)");
			$date = date('Y-m-d');
			$set_ip->execute([':_date'=>$date,':ip'=>$ip]);
		}

		if($row["DATE"] != date("Y-m-d")) {
			$strSQLin = $this->db->prepare(" INSERT INTO daily (DATE,NUM) SELECT '".date('Y-m-d',strtotime("-1 day"))."',COUNT(*) AS intYesterday FROM  counter WHERE 1 AND DATE = '".date('Y-m-d',strtotime("-1 day"))."'");
			$strSQLin->execute();		

			$strSQL = $this->db->prepare(" DELETE FROM counter WHERE DATE != '".date("Y-m-d")."' ");
			$strSQL->execute();	
		}


		//today
		$objQuery = $this->db->prepare(" SELECT COUNT(DATE) FROM counter WHERE DATE = :_date ");
		$objQuery->execute([':_date'=>date("Y-m-d")]);
		$conuter['today'] = $objQuery->fetchColumn();

		//yesterday
		$objQueryY = $this->db->prepare( " SELECT NUM FROM daily WHERE DATE = :_date ");
		$objQueryY->execute([':_date'=>date('Y-m-d',strtotime("-1 day"))]);
		$conuter['yesterday'] = $objQueryY->fetchColumn();

		$strSQLM = $this->db->prepare(" SELECT SUM(NUM) FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = :tmon");
		$strSQLM->execute([':tmon'=>date('Y-m')]);
		$conuter['Tmonth'] = $strSQLM->fetchColumn();

		$strSQLLM = $this->db->prepare(" SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  =  :lmon");
		$strSQLLM->execute([':lmon'=>date('Y-m',strtotime("-1 month"))]);
		$conuter['Lmonth'] = $strSQLLM->fetchColumn();

		$strSQLA = $this->db->prepare(" SELECT SUM(NUM) FROM daily ");
		$strSQLA->execute();
		$conuter['All'] = $strSQLA->fetchColumn();

		if ($conuter['today'] == '') {
			$conuter['today'] = '0';
		}

		if ($conuter['yesterday'] == '') {
			$conuter['yesterday'] = '0';
		}

		if ($conuter['Tmonth'] == '') {
			$conuter['Tmonth'] = '0';
		}

		if ($conuter['Lmonth'] == '') {
			$conuter['Lmonth'] = '0';
		}

		if ($conuter['All'] == '') {
			$conuter['All'] = '0';
		}

		if ($conuter['Lmonth'] == '') {
			$conuter['Lmonth'] = '0';
		}

		return $conuter;

	}

	function myshop(){
		$q1 = $this->db->prepare("SELECT * FROM stock WHERE owner = :user");
		$q1->execute([':user'=>$_SESSION['username']]);
		return $q1;
	}

	function buyproduct($id){
		$product_id = $id;
		$q = $this->db->prepare('SELECT count(*) FROM stock WHERE type = :id AND owner = ""');
		$q->execute(array(':id'=>$product_id));
		$result = $q->fetchColumn();
		if (empty($_SESSION['username'])) {
			$msg = 'กรุณาเข้าสู่ระบบก่อนดำเนินการ';
		}else{
			if ($result > 0) {
				$q = $this->db->prepare('SELECT * FROM stock WHERE type= :type AND owner="" ORDER BY RAND() LIMIT 1');
				$q->execute(array(':type'=>$product_id));
				$result = $q->fetchAll();
				foreach($result as $row) {
					$item_id = $row['id'];
					$item_type = $row['type'];
					$item_contents = $row['contents'];
					$item_date = $row['date'];
				}
				$q = $this->db->prepare('SELECT * FROM product WHERE id = :id');
				$q->execute(array(':id'=>$item_type));
				$result = $q->fetchAll();
				foreach($result as $row) {
					$product_id = $row['id'];
					$product_name = $row['name'];
					$product_price = $row['price'];
					$product_patt = $row['pattern'];
				}
				$q = $this->db->prepare('SELECT point FROM users where username = :user');
				$q->execute(array(':user'=>$_SESSION['username']));
				$coins = $q->fetchColumn();
				if ($coins >= $product_price) {
					$ras = $this->db->prepare('UPDATE stock SET owner= :owner, date= :date WHERE id= :id');
					$ras->execute(array(':owner'=>rtrim($_SESSION['username']),':id'=>$item_id,':date'=>date("Y-m-d H:i:s")));
					$buy = $this->db->prepare('UPDATE users SET point = point - :amount WHERE username = :user');
					$buy->execute(array(':user'=>$_SESSION['username'],':amount'=>$product_price));
					$msg = 'success';
				}else{
					$msg = 'ยอดเงินของคุณไม่เพียงพอที่จะซื้อสินค้านี้';
				}
			}else{
				$msg = 'สินค้าหมด!';
			}
		}
		return $msg;
	}

	function maxbuy(){
		$q1 = $this->db->prepare("SELECT MAX(id) FROM stock WHERE owner = :user");
		$q1->execute([':user'=>$_SESSION['username']]);
		return $q1;
	}

	function limitstock(){
		$stmt = $this->db->prepare("SELECT * FROM stock WHERE owner = ''");
		$stmt->execute();
		return $stmt;
	}

	function countmyproduct(){
		$stmt = $this->db->prepare("SELECT count(id) FROM stock WHERE owner = :user ");
		$stmt->execute([':user'=>$_SESSION['username']]);
		return $stmt;
	}

	function countuser(){
		$stmt = $this->db->prepare("SELECT count(*) FROM users ");
		$stmt->execute();
		return $stmt;
	}

	function shownumproduct(){
		$stmt = $this->db->prepare("SELECT count(*) FROM product ");
		$stmt->execute();
		return $stmt;
	}

	function add_history_topup($name,$amount){
		$stmt = $this->db->prepare("INSERT INTO history_topup(user_topup, name_topup, amount_topup) VALUES (:user,:name,:amount)");
		$stmt->execute([':user'=>$_SESSION['username'],':name'=>$name,':amount'=>$amount]);
		return $stmt;
	}

	function sum_history_topup(){
		$stmt = $this->db->prepare("SELECT SUM(amount_topup) FROM history_topup");
		$stmt->execute();
		return $stmt;
	}
}
?>