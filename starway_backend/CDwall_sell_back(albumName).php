<?php
ob_start();
session_start();
$UPDATE_albumName = json_decode($_REQUEST["UPDATE_albumName"]);
 
 try{
  require_once("../Star_Way_Database.php");
  $sql = "UPDATE info_album SET albumName=:albumName WHERE albumNo=:albumNo";
  $info_album = $pdo->prepare( $sql );
  $info_album -> bindValue( ":albumName", $UPDATE_albumName->albumName);  
  $info_album -> bindValue( ":albumNo", $UPDATE_albumName->albumNo);
  $info_album -> execute();

  echo $UPDATE_albumName->albumName;
  echo $UPDATE_albumName->albumNo;
  // exit();

  // if( $info_album->rowCount()==0){ //查無此人
  //     echo "{}";
  //     exit();
  // }else{ //登入成功
  //   //自資料庫中取回資料
  //   $info_album_Row = $info_album -> fetch(PDO::FETCH_ASSOC);

  //   //送出登入者的姓名資料
  //   $re_UPDATE_albumName = array("albumName"=>$info_album_Row["albumName"]);
  //   echo json_encode($re_UPDATE_albumName);

  // }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>