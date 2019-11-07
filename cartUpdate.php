<?php
session_start();
ob_start();
$albumNo = (int)$_REQUEST['albumNo'];
// echo $albumNo;
	unset($_SESSION['albumName'][$albumNo]);
	unset($_SESSION['price'][$albumNo]);
	unset($_SESSION['singer'][$albumNo]);
	unset($_SESSION['imageName'][$albumNo]);

header('location:cartPage.php');
?>

