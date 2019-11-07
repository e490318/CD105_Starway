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
// // $sql="UPDATE  info_album set albumDescript='0'";

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
$UPDATE_albumDescript = json_decode($_REQUEST["UPDATE_albumDescript"]);
 
 try{
  require_once("../Star_Way_Database.php");
  $sql = "UPDATE info_album SET albumDescript=:albumDescript WHERE albumNo=:albumNo";
  $info_album = $pdo->prepare( $sql );
  $info_album -> bindValue( ":albumDescript", $UPDATE_albumDescript->albumDescript);  
  $info_album -> bindValue( ":albumNo", $UPDATE_albumDescript->albumNo);
  $info_album -> execute();

  echo $UPDATE_albumDescript->albumDescript;
  echo $UPDATE_albumDescript->albumNo;
  // exit();

  // if( $info_album->rowCount()==0){ //查無此人
  //     echo "{}";
  //     exit();
  // }else{ //登入成功
  //   //自資料庫中取回資料
  //   $info_album_Row = $info_album -> fetch(PDO::FETCH_ASSOC);

  //   //送出登入者的姓名資料
  //   $re_UPDATE_albumDescript = array("albumDescript"=>$info_album_Row["albumDescript"]);
  //   echo json_encode($re_UPDATE_albumDescript);

  // }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>