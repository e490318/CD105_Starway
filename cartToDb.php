<?php 
session_start();
$orderDate = Date("Y-m-d");
$memNo = $_SESSION['memNo'];
$receiveName = $_REQUEST['customerName'];
$orderTotal = $_REQUEST['cartTotal'];
$ShipAddr = $_REQUEST['customerAdd'];
$shipPhone = $_REQUEST['customerContact'];
$shipEmail = $_SESSION['email'];
$payMethod = $_REQUEST['payMethod'];
// echo $memNo;
// exit();

$errMsg = '';
		try {
		//連線
		require_once("Star_Way_Database.php");
		 $pdo->beginTransaction();

	$sql = "INSERT INTO order_album (orderNo, memNo, payMethod,orderTotal, orderDate, receiveName,ShipAddr,shipPhone,shipEmail) VALUES ( null,:memNo,:payMethod,:orderTotal,current_date(),:receiveName,:ShipAddr,:shipPhone,:shipEmail)";

		$albumOlder = $pdo->prepare($sql);
		$albumOlder->bindValue(":memNo",$memNo);
		$albumOlder->bindValue(":payMethod",$payMethod);
		$albumOlder->bindValue(":orderTotal",$orderTotal);
		$albumOlder->bindValue(":receiveName",$receiveName);
		$albumOlder->bindValue(":ShipAddr",$ShipAddr);
		$albumOlder->bindValue(":shipPhone",$shipPhone);
		$albumOlder->bindValue(":shipEmail",$shipEmail);
		$albumOlder->execute();

		//即然上面已經寫入了訂單主單，則可以用lastInsertId()的函數找到最後一筆的訂單編號，即為剛新增的訂單編號
		$orderNo = $pdo->lastInsertId();

		//寫回訂單明細
		$sql = "INSERT INTO orderdetail_disk (orderNo,albumNo,diskQty,diskTotal) values($orderNo,:albumNo,1,:diskTotal)";//即然orderNo是系統自動創號產生的(也因此不會有injection攻擊的問題)，就直接給值，不需要再綁資料了
		$orderdetail_disk = $pdo->prepare($sql);
		foreach ($_SESSION['price'] as $albumNo =>$price) {
			$orderdetail_disk->bindValue(":albumNo",$albumNo);
			$orderdetail_disk->bindValue(":diskTotal",$price);
			$orderdetail_disk->execute();
		}
	
		$pdo->commit();

		//下單完成後，把購物車裡的資料清掉
		unset($_SESSION['albumName']);
		unset($_SESSION['singer']);
		unset($_SESSION['qpricety']);
		unset($_SESSION['qpricety']);
		unset($_SESSION['imageName']);

		echo "下單成功，您的訂編號為:$orderNo<br>";

		} catch (Exception $e) {
		  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
		  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
		  echo $errMsg;
		  $pdo->rollBack();

		}
		

?>
