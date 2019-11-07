<?php
session_start();
$errMsg = "";
try{
  require_once("Star_Way_Database.php");
  $memId = $_REQUEST["memId"];
  $couponNo = $_REQUEST["couponNo"];

  //一領取立刻存入SESSION
  $_SESSION["couponNo"] = $_REQUEST["couponNo"];

   //啟動一個交易
      // $pdo->beginTransaction();
      $sql = "UPDATE info_member SET couponNo = :couponNo WHERE memId=:memId ";
       // UPDATE runoob_tbl SET runoob_title='学习 C++' WHERE runoob_id=3;
      $member = $pdo->prepare( $sql );
      $member->bindValue( ":memId", $memId);
      $member->bindValue( ":couponNo", $couponNo);
      $member->execute();

      $errMsg = "領取成功, 您的折價券編號為 : $couponNo <br>"; 
      echo $errMsg;

  //-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
  //寫回訂單主單
  //INSERT INTO `bookorder` (`orderNo`, `orderMemNo`, `orderTime`, `email`, `payStatus`) value (...........)
  // $sql = "INSERT INTO bookorder (orderNo, orderMemNo, orderTime, email, payStatus) values ( null, :orderMemNo, now(), :email, '0' )";
  // $bookorder = $pdo->prepare( $sql );
  // $bookorder->bindValue( ":orderMemNo", $orderMemNo);
  // $bookorder->bindValue( ":email", $email);
  // $bookorder->execute();

  //-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
  // $sql = "select * from member where memId=:memId and couponNo = :couponNo";
  // $member = $pdo->prepare( $sql );
  // $member -> bindValue( ":memId", $_REQUEST["memId"]);
  // $member -> bindValue( ":couponNo", $_REQUEST["couponNo"]);
  // $member -> execute();

  // if( $member->rowCount()==0){ //查無此人
	 //  echo "error";
  // }else{ //登入成功
  //   //自資料庫中取回資料
  // 	$memRow = $member -> fetch(PDO::FETCH_ASSOC);

  // 	//將登入者資料寫入session
  // 	$_SESSION["memNo"] = $memRow["no"];
  // 	$_SESSION["memId"] = $memRow["memId"];
  // 	$_SESSION["memName"] = $memRow["memName"];
  // 	$_SESSION["email"] = $memRow["email"];
  //   //送出登入者的姓名資料
  //   echo $memRow["memName"];
  // }
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
  echo $errMsg;
      // $pdo->rollBack();
}
?>


<!-- try {
      //連線
      require_once("connectBooks.php");
      
      $orderMemNo = $_SESSION["memNo"];
      $email = $_SESSION["email"];
      // $orderTime = date("Y-m-d H:i:s");
      //啟動一個交易
      $pdo->beginTransaction();

      //寫回訂單主單
      //INSERT INTO `bookorder` (`orderNo`, `orderMemNo`, `orderTime`, `email`, `payStatus`) value (...........)
      $sql = "INSERT INTO bookorder (orderNo, orderMemNo, orderTime, email, payStatus) values ( null, :orderMemNo, now(), :email, '0' )";
      $bookorder = $pdo->prepare( $sql );
      $bookorder->bindValue( ":orderMemNo", $orderMemNo);
      $bookorder->bindValue( ":email", $email);
      $bookorder->execute();

      //取回orderNo , $pdo->lastInsertId();
      $orderNo = $pdo->lastInsertId();

      //寫回訂單明細
      //INSERT INTO `orderitems` (`orderNo`, `productNo`, `quantity`)
      $sql = "INSERT INTO orderitems (orderNo, productNo, quantity) values($orderNo, :productNo, :quantity)";
      $orderitems = $pdo->prepare($sql);
      foreach( $_SESSION["qty"] as $psn => $qty){
        $orderitems->bindValue(":productNo", $psn);
        $orderitems->bindValue(":quantity", $qty);
        $orderitems->execute();
      }
      $pdo->commit();
      unset($_SESSION["pname"]);
      unset($_SESSION["price"]);
      unset($_SESSION["qty"]);
      $errMsg = "下單成功, 您的訂單編號為 : $orderNo <br>";      
    }catch(PDOException $e){
      $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
      $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
      echo $errMsg;
      $pdo->rollBack();
    } -->