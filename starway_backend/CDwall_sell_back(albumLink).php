<?php
ob_start();
session_start();
$UPDATE_albumLink = json_decode($_REQUEST["UPDATE_albumLink"]);
 
 try{
  require_once("../Star_Way_Database.php");
  $sql = "UPDATE info_album SET albumLink=:albumLink WHERE albumNo=:albumNo";
  $info_album = $pdo->prepare( $sql );
  $info_album -> bindValue( ":albumLink", $UPDATE_albumLink->albumLink);  
  $info_album -> bindValue( ":albumNo", $UPDATE_albumLink->albumNo);
  $info_album -> execute();

  echo $UPDATE_albumLink->albumLink;
  echo $UPDATE_albumLink->albumNo;
  // exit();

  // if( $info_album->rowCount()==0){ //查無此人
  //     echo "{}";
  //     exit();
  // }else{ //登入成功
  //   //自資料庫中取回資料
  //   $info_album_Row = $info_album -> fetch(PDO::FETCH_ASSOC);

  //   //送出登入者的姓名資料
  //   $re_UPDATE_albumLink = array("albumLink"=>$info_album_Row["albumLink"]);
  //   echo json_encode($re_UPDATE_albumLink);

  // }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>