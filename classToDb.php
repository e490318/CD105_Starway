<?php 
session_start();
// $orderDate = Date("Y-m-d");
$memNo = $_SESSION['memNo'];
$classNo = $_REQUEST['classNo'];
$classDate = $_REQUEST['classDate'];
$payMethod = $_REQUEST['payMethod'];
$orderTotal = $_REQUEST['orderTotal'];
$shipEmail = $_SESSION['email'];
$shipPhone = $_SESSION['phone'];
// echo $memNo;



$errMsg = '';
		try {
		//連線
		require_once("Star_Way_Database.php");
		 $pdo->beginTransaction();

		$sql = "INSERT INTO order_class (orderNo, classNo , memNo ,orderDate, classDate , payMethod, orderTotal , shipPhone ,shipEmail) VALUES ( null,:classNo,:memNo,current_date(),:classDate,:payMethod,:orderTotal,:shipPhone,:shipEmail)";

		$albumOlder = $pdo->prepare($sql);
		$albumOlder->bindValue(":classNo",$classNo);
		$albumOlder->bindValue(":memNo",$memNo);
		$albumOlder->bindValue(":classDate",$classDate);
		$albumOlder->bindValue(":payMethod",$payMethod);
		$albumOlder->bindValue(":orderTotal",$orderTotal);
		$albumOlder->bindValue(":shipPhone",$shipPhone);
		$albumOlder->bindValue(":shipEmail",$shipEmail);
		$albumOlder->execute();

		//即然上面已經寫入了訂單主單，則可以用lastInsertId()的函數找到最後一筆的訂單編號，即為剛新增的訂單編號
		$orderNo = $pdo->lastInsertId();

		$pdo->commit();

		echo "購課成功，您的訂單編號為:00000$orderNo";

		} catch (Exception $e) {
		  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
		  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
		  echo $errMsg;
		  $pdo->rollBack();

		}
		

?>
