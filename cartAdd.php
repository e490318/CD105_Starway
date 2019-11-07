<?php
ob_start();
session_start();
$sum = 0;
$albumNo = $_REQUEST['albumNo'];
$_SESSION['albumName'][$albumNo]=$_REQUEST['albumName'];
$_SESSION['singer'][$albumNo]=$_REQUEST['singer'];
$_SESSION['price'][$albumNo]=$_REQUEST['price'];
$_SESSION['imageName'][$albumNo]=$_REQUEST['Cover'];

// echo $_SESSION['price'];
if (isset($_SESSION['albemName'])===true) {
	$sum=+1;
}

// echo $sum."<br>";
// echo $albumNo;


header("Location:cartPage.php");

?>