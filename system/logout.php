<?php
require_once '../config.php';
unset($_SESSION['id']);
unset($_SESSION['backend']);
session_destroy();

$link = base_url();
header("location: {$link}");
exit();
 ?>
