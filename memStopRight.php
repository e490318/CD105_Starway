<?php
ob_start();
session_start();

try{
  require_once("Star_Way_Database.php");
  $sql = "SELECT * from info_member where memId=:memId and memPsw = :memPsw";
  $member = $pdo->prepare( $sql );
  $member->bindValue(":memId", $_REQUEST["memId"]);
  $member->bindValue(":memPsw", $_REQUEST["memPsw"]);
  $member->execute();

  $memberRow = $member->fetch(PDO::FETCH_ASSOC);

  if( $member->rowCount()== 0){ //查無此人
	  echo "查無此人";
  }
  else if(!$memberRow["memPms"] == 0){ //停權
    echo "1";
  }
  else { 
    echo "0";
  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>