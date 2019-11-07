<?php
ob_start();
session_start();
$UPDATE_albumCover = json_decode($_REQUEST["UPDATE_albumCover"]);
 
 try{
  require_once("../Star_Way_Database.php");
  $sql = "UPDATE info_album SET albumCover=:albumCover WHERE albumNo=:albumNo";
  $info_album = $pdo->prepare( $sql );
  $info_album -> bindValue( ":albumCover", $UPDATE_albumCover->albumCover);  
  $info_album -> bindValue( ":albumNo", $UPDATE_albumCover->albumNo);
  $info_album -> execute();

  echo $UPDATE_albumCover->albumCover;
  echo $UPDATE_albumCover->albumNo;
  // exit();

  // if( $info_album->rowCount()==0){ //查無此人
  //     echo "{}";
  //     exit();
  // }else{ //登入成功
  //   //自資料庫中取回資料
  //   $info_album_Row = $info_album -> fetch(PDO::FETCH_ASSOC);

  //   //送出登入者的姓名資料
  //   $re_UPDATE_albumCover = array("albumCover"=>$info_album_Row["albumCover"]);
  //   echo json_encode($re_UPDATE_albumCover);

  // }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>