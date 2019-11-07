<?php
session_start();
$memberInfo = json_decode($_REQUEST["memberInfo"]);
try{
   echo $memberInfo->memAvatar;
   echo $memberInfo->memName;
      echo $memberInfo->phone;
      echo $memberInfo->email;
      echo $memberInfo->sex;
      echo $memberInfo->birthDate;
      echo $_SESSION["memId"];

  $str_memAvatar ="";
  if( $memberInfo->memAvatar!=null)
    $str_memAvatar = "memAvatar = :memAvatar ,";

  

  require_once("Star_Way_Database.php");
   $sql = "UPDATE info_member SET ".
   $str_memAvatar.
   "memName = :memName ,
   phone = :phone ,
   email = :email ,
   sex = :sex ,
   birthDate = :birthDate 
   WHERE memId= :memId ";
        $member = $pdo->prepare( $sql );
        if( $memberInfo->memAvatar!=null)
        $member -> bindValue( ":memAvatar", $memberInfo->memAvatar);

        $member -> bindValue( ":memName", $memberInfo->memName);
        $member -> bindValue( ":phone", $memberInfo->phone);
        $member -> bindValue( ":email", $memberInfo->email);
        $member -> bindValue( ":sex", $memberInfo->sex);
        $member -> bindValue( ":birthDate", $memberInfo->birthDate);
        $member -> bindValue( ":memId",  $_SESSION["memId"]);
        $member -> execute();

// UPDATE runoob_tbl SET runoob_title='学习 C++' WHERE runoob_id=3;
// UPDATE info_member SET 
//    memName = '林鉦文'
//    phone = '5645646'
//    email = 'jjj@gmail.com' 
//    sex = '1' 
//    birthDate = '2019-01-03' 
//    WHERE memId= 'jjj'
     

  // if( $member->rowCount()==0){ //查無此人
  //   echo "{}";
  // }else{ //登入成功
  //   //自資料庫中取回資料
  //   $memRow = $member -> fetch(PDO::FETCH_ASSOC);

  //   //將登入者資料寫入session
  //   $_SESSION["memNo"] = $memRow["no"];
  //   $_SESSION["memId"] = $memRow["memId"];
  //   $_SESSION["memName"] = $memRow["memName"];
  //   $_SESSION["email"] = $memRow["email"];
  //   //送出登入者的姓名資料
  //   //$loginInfo = array("memId"=>$_SESSION["memId"], "memName"=>$_SESSION["memName"]);
  //   //echo json_encode($loginInfo);
  //   echo json_encode($memRow);

  // }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>

 $sql = "UPDATE info_member SET couponNO = :couponNO WHERE memId=:memId ";
       // UPDATE runoob_tbl SET runoob_title='学习 C++' WHERE runoob_id=3;
      $member = $pdo->prepare( $sql );
      $member->bindValue( ":memId", $memId);
      $member->bindValue( ":couponNO", $couponNO);
      $member->execute();

      $errMsg = "領取成功, 您的折價券編號為 : $couponNO <br>"; 
      echo $errMsg;