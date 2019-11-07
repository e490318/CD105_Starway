<?php
ob_start();
session_start();
?>
<?php
// ob_start();
// session_start();

// try {
// require_once("../Star_Way_Database.php");

// $sql="SELECT * FROM `info_album`  ORDER BY `info_album`.`albumNo` DESC";
// // $sql="UPDATE  info_album set shelfStatus='0'";

//     $info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
//     // $albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);
    
// }catch (PDOException $e) {
//     echo "錯誤原因 : " , $e->getMessage(), "<br>";
//     echo "錯誤行號 : " , $e->getLine(), "<br>"; 
// }
?>

<?php
// ob_start();
// session_start();
// $UPDATE_order_fund = json_decode($_REQUEST["UPDATE_order_fund"]);

// $data = $UPDATE_order_fund;
 
// try {
// require_once("../Star_Way_Database.php");

//   $sql="UPDATE order_fund SET fundStatus=:fundStatus WHERE fundNo=:fundNo";
//   $products = $pdo->prepare($sql);
//   $products -> bindValue(":fundNo", $data->fundNo);
//   $products -> bindValue(":fundStatus", $data->fundStatus); 
//   $products -> execute();
// }catch (PDOException $e) {
//   echo "錯誤原因 : " , $e->getMessage(), "<br>";
//   echo "錯誤行號 : " , $e->getLine(), "<br>"; 
// }
?>
 




<?php
ob_start();
session_start();
$UPDATE_shelfStatus = json_decode($_REQUEST["UPDATE_shelfStatus"]);
 
 try{
  require_once("../Star_Way_Database.php");
  $sql = "UPDATE info_album SET shelfStatus=:shelfStatus WHERE albumNo=:albumNo";
  $info_album = $pdo->prepare( $sql );
  $info_album -> bindValue( ":shelfStatus", $UPDATE_shelfStatus->shelfStatus);  
  $info_album -> bindValue( ":albumNo", $UPDATE_shelfStatus->albumNo);
  $info_album -> execute();

  echo $UPDATE_shelfStatus->shelfStatus;
echo $UPDATE_shelfStatus->albumNo;
// exit();

  // if( $info_album->rowCount()==0){ //查無此人
  //     echo "{}";
  //     exit();
  // }else{ //登入成功
  //   //自資料庫中取回資料
  //   $info_album_Row = $info_album -> fetch(PDO::FETCH_ASSOC);

  //   //送出登入者的姓名資料
  //   $re_UPDATE_shelfStatus = array("shelfStatus"=>$info_album_Row["shelfStatus"]);
  //   echo json_encode($re_UPDATE_shelfStatus);

  // }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>