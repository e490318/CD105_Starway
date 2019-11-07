<?php
ob_start();
session_start();
$UPDATE_info_server = json_decode($_REQUEST["UPDATE_info_server"]);

$data = $UPDATE_info_server;
 
try {
require_once("../Star_Way_Database.php");

	$sql="UPDATE info_server SET adminPms=:adminPms WHERE adminNo=:adminNo";
	$products = $pdo->prepare($sql);
	$products -> bindValue(":adminNo", $data->adminNo);
	$products -> bindValue(":adminPms", $data->adminPms); 
	$products -> execute();
}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>
 









<?php
// session_start();
// $loginInfo = json_decode($_REQUEST["loginInfo"]);
// try{
//   require_once("connectBooks.php");
//   $sql = "select * from member where memId=:memId and memPsw = :memPsw";
//   $member = $pdo->prepare( $sql );
//   $member -> bindValue( ":memId", $loginInfo->memId);
//   $member -> bindValue( ":memPsw", $loginInfo->memPsw);
//   $member -> execute();

//   if( $member->rowCount()==0){ //查無此人
// 	  echo "{}";
//   }else{ //登入成功
//     //自資料庫中取回資料
//   	$memRow = $member -> fetch(PDO::FETCH_ASSOC);

//   	//將登入者資料寫入session
//   	$_SESSION["adminNo"] = $memRow["no"];
//   	$_SESSION["memId"] = $memRow["memId"];
//   	$_SESSION["memName"] = $memRow["memName"];
//   	$_SESSION["email"] = $memRow["email"];
//     //送出登入者的姓名資料
//     //$loginInfo = array("memId"=>$_SESSION["memId"], "memName"=>$_SESSION["memName"]);
//     //echo json_encode($loginInfo);
//     echo json_encode($memRow);

//   }
// }catch(PDOException $e){
//   echo $e->getMessage();
// }
?>