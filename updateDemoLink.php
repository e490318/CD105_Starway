<?php 
ob_start();
session_start();

$_SESSION["demoLinkName"] = $_REQUEST['demoLinkName'];
echo $_SESSION["demoLinkName"];
 ?>
