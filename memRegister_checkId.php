<?php
$data_info = json_decode($_REQUEST["data_info"]);

try{
  // sleep(1);//sleep(1)的用意是董董要讓我們看readyState的狀態設定的，會慢一秒，記得拿掉
  require_once("Star_Way_Database.php");
  $sql = "select memName from info_member where memId = :memId";
  $member = $pdo->prepare($sql);
  $member->bindValue(":memId", $data_info->memId);
  $member->execute();

  if( $member->rowCount() ==1){
    //rowCount若不等於零，則代表找到此帳號，在2018.12.27 PHP+MySQL的影片裡(將抓回來的資料用for迴圈的方式一次將資料放到table表 + exit教學.mp4)有提到rowCount()還有提供一個訊息是"滿足這個條件的有幾筆"。此範例其實$member->rowCount() !==1也可以也比較直覺，我個人比較偏好這個寫法
    echo "帳號已存在，不可使用此帳號";
  }else{

    echo "可使用此帳號";
  }

}catch(PDOException $e){
  echo $e->getMessage();  
  echo "error";
}
// ?>