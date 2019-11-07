<?php 
session_start();
$memNo = $_SESSION['memNo'];
$demoName = $_REQUEST['demoName'];
$demoCover = $_REQUEST['demoCover'];
$demoDescript = $_REQUEST['demoDescript'];
$demoLink = $_REQUEST['demoLink'];
// echo $memNo.'<br>';
// echo $demoName.'<br>';
// echo $demoCover.'<br>';
// echo $demoDescript.'<br>';
// echo $demoLink.'<br>';
// exit();

$errMsg = '';
		try {
		//連線
		require_once("Star_Way_Database.php");
		 $pdo->beginTransaction();

	$sql = "INSERT INTO order_fund ( fundNo, memNo, demoName,fundDate,fundStartDate,fundEndDate,demoCover,demoDescript ,demoLink) VALUES (null,:memNo,:demoName,current_date(),current_date(), date_add(now(), interval 90 day),:demoCover,:demoDescript,:demoLink)";

		$albumOlder = $pdo->prepare($sql);
		$albumOlder->bindValue(":memNo",$memNo);
		$albumOlder->bindValue(":demoName",$demoName);
		$albumOlder->bindValue(":demoCover",$demoCover);
		$albumOlder->bindValue(":demoDescript",$demoDescript);
		$albumOlder->bindValue(":demoLink",$demoLink);
		$albumOlder->execute();

		//即然上面已經寫入了訂單主單，則可以用lastInsertId()的函數找到最後一筆的訂單編號，即為剛新增的訂單編號
		$fundNo = $pdo->lastInsertId();

		$pdo->commit();

		//下單完成後，把購物車裡的資料清掉
		// unset($_SESSION['albumName']);
		// unset($_SESSION['singer']);
		// unset($_SESSION['qpricety']);
		// unset($_SESSION['qpricety']);
		// unset($_SESSION['imageName']);

		echo "申請成功，您的專輯編號為:$fundNo";

		} catch (Exception $e) {
		  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
		  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
		  echo $errMsg;
		  $pdo->rollBack();

		}
		

?>
