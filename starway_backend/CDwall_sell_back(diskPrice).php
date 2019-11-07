<?php
ob_start();
session_start();
$UPDATE_diskPrice = json_decode($_REQUEST["UPDATE_diskPrice"]);
 
 try{
  require_once("../Star_Way_Database.php");
  $sql = "UPDATE info_album SET diskPrice=:diskPrice WHERE albumNo=:albumNo";
  $info_album = $pdo->prepare( $sql );
  $info_album -> bindValue( ":diskPrice", $UPDATE_diskPrice->diskPrice);  
  $info_album -> bindValue( ":albumNo", $UPDATE_diskPrice->albumNo);
  $info_album -> execute();

  echo $UPDATE_diskPrice->diskPrice;
  echo $UPDATE_diskPrice->albumNo;
  // exit();

  // if( $info_album->rowCount()==0){ //查無此人
  //     echo "{}";
  //     exit();
  // }else{ //登入成功
  //   //自資料庫中取回資料
  //   $info_album_Row = $info_album -> fetch(PDO::FETCH_ASSOC);

  //   //送出登入者的姓名資料
  //   $re_UPDATE_diskPrice = array("diskPrice"=>$info_album_Row["diskPrice"]);
  //   echo json_encode($re_UPDATE_diskPrice);

  // }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>