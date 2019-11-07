<?php
session_start();
try{
 
  require_once("Star_Way_Database.php");
  $sql = "select * from info_album where albumNo=:albumNo";
  $album = $pdo->prepare( $sql );
  $album -> bindValue( ":albumNo", $_REQUEST["albumNo"]);
  $album -> execute();

  if( $album->rowCount()==0){ //查無此人
    echo "{}";
  }else{ //登入成功
    //自資料庫中取回資料
    $albumRow = $album -> fetch(PDO::FETCH_ASSOC);

    //送出登入者的姓名資料
    //$loginInfo = array("memId"=>$_SESSION["memId"], "memName"=>$_SESSION["memName"]);
    //echo json_encode($loginInfo);
    echo json_encode($albumRow);

  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>