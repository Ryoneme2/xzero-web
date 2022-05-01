<?php
require_once './tw.class.php';
require_once '../config.php';
if (isset($_SESSION['backend'])) {
  $username = $_CONFIG['user_wallet'];
  $password = $_CONFIG['pass_wallet'];
  $reftoken = $_CONFIG['ref_wallet'];

  $tw = new TrueWallet("$username", "$password","$reftoken");
  $tw->Login();
  $tw = new TrueWallet($tw->access_token);
  $transactions = $tw->getTransaction(15);
  foreach ($transactions["data"]["activities"] as $report) {
    if ($report != NULL) {

      $data = $tw->GetTransactionReport($report["report_id"]);

      if ($data['data']['service_code'] == "creditor") {
        $show = array();
        $show['ref'] = $data['data']['section4']['column2']['cell1']['value'];
        $show['datetime'] = $data['data']['section4']['column1']['cell1']['value'];
        $show['amount'] = $data['data']['section3']['column1']['cell1']['value'];
        $show['fullname'] = $data['data']['section2']['column1']['cell2']['value'];
        $show['tel'] = $data['data']['ref1'];
        $dateformat =  DateTime::createFromFormat('d/m/y H:i', $show['datetime']);
        $dateformat = date_format($dateformat,"Y-m-d H:i:s");
        echo $show['ref'] . " " . $show['datetime'] . " " . $show['amount'] . " " . $show['fullname'] . " " . $show['tel'] . "<br>";
      }
    }
  }
}else{
  $link = base_url();
  header("location: {$link}");
}

 ?>
