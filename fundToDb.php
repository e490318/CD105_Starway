<?php 
session_start();
$fundNo = $_REQUEST['fundNo'];
$fundPlanNo = $_REQUEST['fundplanNo'];
$memNo = $_SESSION['memNo'];
$donation  = $_REQUEST['planPrice'];
$donateDate = Date("Y-m-d");
$donaPay = $_REQUEST['payMethod'];
$donatorName = $_REQUEST['customerName'];
$donatorAdress = $_REQUEST['customerAdd'];
$donatorNumber = $_REQUEST['customerContact'];
$donatorEmail = $_SESSION['email'];
// echo $fundNo."<br>";
// echo $fundPlanNo."<br>";
// echo $memNo."<br>";
// echo $donation."<br>";
// echo $donateDate."<br>";
// echo $donaPay."<br>";
// echo $donatorName."<br>";
// echo $donatorAdress."<br>";
// echo $donatorNumber."<br>";
// echo $donatorEmail."<br>";

// exit();

$errMsg = '';
		try {
		//連線
		require_once("Star_Way_Database.php");
		 $pdo->beginTransaction();

	$sql = "INSERT INTO orderdetail_fund (donateNo, fundNo, fundPlanNo,memNo, donation, donateDate,donaPay,donatorName,donatorAdress,donatorNumber,donatorEmail) VALUES (null,:fundNo,:fundPlanNo,:memNo,:donation,current_date(),:donaPay,:donatorName,:donatorAdress,:donatorNumber,:donatorEmail)";

		$albumOlder = $pdo->prepare($sql);
		$albumOlder->bindValue(":fundNo",$fundNo);
		$albumOlder->bindValue(":fundPlanNo",$fundPlanNo);
		$albumOlder->bindValue(":memNo",$memNo);
		$albumOlder->bindValue(":donation",$donation);
		$albumOlder->bindValue(":donaPay",$donaPay);
		$albumOlder->bindValue(":donatorName",$donatorName);
		$albumOlder->bindValue(":donatorAdress",$donatorAdress);
		$albumOlder->bindValue(":donatorNumber",$donatorNumber);
		$albumOlder->bindValue(":donatorEmail",$donatorEmail);
		$albumOlder->execute();

		//即然上面已經寫入了訂單主單，則可以用lastInsertId()的函數找到最後一筆的訂單編號，即為剛新增的訂單編號
		$donateNo = $pdo->lastInsertId();

		//把贊助金額寫回被贊助者目前累計金額及贊助次數
		$sql2 = "UPDATE order_fund SET fundTotal=fundTotal+$donation, fundCount=fundCount+1 WHERE fundNo=$fundNo";//即然orderNo是系統自動創號產生的(也因此不會有injection攻擊的問題)，就直接給值，不需要再綁資料了
		$pdo->exec($sql2);
		// $orderdetail_disk = $pdo->prepare($sql);
		// foreach ($_SESSION['price'] as $albumNo =>$price) {
		// 	$orderdetail_disk->bindValue(":albumNo",$albumNo);
		// 	$orderdetail_disk->bindValue(":diskTotal",$price);
		// 	$orderdetail_disk->execute();
		// }
	
		$pdo->commit();

		echo "贊助成功，您的贊助編號為:$donateNo <br>";
		echo $donateNo;
		//下單完成後，把購物車裡的資料清掉
		// unset($_SESSION['albumName']);
		// unset($_SESSION['singer']);
		// unset($_SESSION['qpricety']);
		// unset($_SESSION['qpricety']);
		// unset($_SESSION['imageName']);


		} catch (Exception $e) {
		  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
		  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
		  echo $errMsg;
		  $pdo->rollBack();

		}
		

?>
