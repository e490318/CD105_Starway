<?php 
session_start();
ob_start();
$memNo = $_SESSION['memNo'];
// echo $memNo;

$errMsg = '';
try {
require_once("Star_Way_Database.php");
$sql= "UPDATE info_member set couponNo=0 where memNo=$memNo";
$pdo->exec($sql);

$_SESSION['couponNo'] = 0;

echo "異動成功";
} catch (Exception $e) {
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
  echo $errMsg;
}
 ?>
