<?php
session_start();
ob_start();

$memName =$_REQUEST['memName'];
$memId =$_REQUEST['memId'];
$memPsw =$_REQUEST['memPsw'];
$gender =$_REQUEST['gender'];
$birthday =$_REQUEST['birthday'];
$telNumber =$_REQUEST['telNumber'];
$email =$_REQUEST['email'];
$err = "";
$row = "";

// echo $memName."<br>";
// echo $memId."<br>";
// echo $memPsw."<br>";
// echo $email."<br>";
// echo $gender."<br>";
// echo $birthday."<br>";
// echo $telNumber."<br>";
// exit();
// $memName ="8BQ";
// $memId ="one0911";
// $memPsw ="aaa";
// $gender ="男";
// $birthday ="2019-01-05";
// $telNumber ="0934153410";
// $email ="one0910@gmail.com";


try {
	require_once("Star_Way_Database.php");
	$sql='INSERT into info_member(memNo,memName,memId,memPsw,sex,birthDate,rgsDate,phone,email)
		VALUES(null,:memName,:memId,:memPsw,:sex,:birthDate,current_date(),:phone,:email)';
	$pdoStatement = $pdo->prepare($sql);
	$pdoStatement->bindValue(":memName",$memName); 
	$pdoStatement->bindValue(":memId",$memId); 
	$pdoStatement->bindValue(":memPsw",$memPsw); 
	$pdoStatement->bindValue(":sex",$gender); 
	$pdoStatement->bindValue(":birthDate",$birthday); 
	$pdoStatement->bindValue(":phone",$telNumber); 
	$pdoStatement->bindValue(":email",$email); 
	$pdoStatement->execute();
	// $sql = 'select * from member';
	// $pdo->query($sql);
	// $row = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
	// print_r($row);
	// echo "<hr>";

	//註冊完後同時將註冊的資訊寫入session
	$_SESSION["memNo"] = $pdo->lastInsertId();
    $_SESSION["memId"] = $memId;
    $_SESSION["memName"] = $memName;
    $_SESSION["email"] = $email;
    $_SESSION["couponNo"] = 0;

    // echo $_SESSION["memNo"].'<br>';
    // echo $_SESSION["memId"].'<br>';
    // echo $_SESSION["memName"].'<br>';
    // echo $_SESSION["email"].'<br>';
    // echo $_SESSION["couponNo"].'<br>';
    echo "註冊已成功，您可至遊戲區獲取優惠卷";

	// echo "<script>alert('註冊成功，歡迎您!')
	// 		window.location.href='cartPage.php';
	// 		</script>";
	// echo "新增成功"."<br>";
	// foreach ($row as $index => $data) {
	// 	echo $data['memName']."<br>";
	// }
} catch (Exception $e) {
    $err .= "錯誤 : ".$e -> getMessage()."<br>";
    $err .= "行號 : ".$e -> getLine()."<br>";
	echo $err;
	// echo '連線失敗';
	// echo "錯誤 : ", $e -> getMessage(), "<br>";
	// echo "行號 : ", $e -> getLine(), "<br>";
}

?>
	
</body>
</html>