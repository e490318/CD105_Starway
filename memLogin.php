<?php
session_start();
//從前端ajaxLogin_json.html傳過來的loginInfo JSON字串，要 解碼成PHP的物件類別
$loginInfo = json_decode($_REQUEST["loginInfo"]);
try{
  require_once("Star_Way_Database.php");
  $sql = "SELECT * from info_member where memId=:memId and memPsw = :memPsw";
  $member = $pdo->prepare( $sql );
  //將剛從前端解碼的JSOJN物件，去bind到Sql相對應的欄位
  $member -> bindValue( ":memId", $loginInfo->memId);//由於解碼為PHP的JSON物件，所以必須將該物件指向所要的欄位(要用->不是.，.是JS呼叫屬性的語法)，才抓的到值。
  $member -> bindValue( ":memPsw", $loginInfo->memPsw);
  $member -> execute();

  if( $member->rowCount()==0){ //若找不到該會員名稱，則回傳空JSON物件(由於是用JSON格式互傳資訊，所以若沒有要傳資訊回去，當然也就是傳回空的JSON物件格式的字串)
    echo "{}";
  }else{ //登入成功
    //自資料庫中取回資料，開始要記錄一些資料到session裡，以用來判斷會員是否登入用
    $memRow = $member -> fetch(PDO::FETCH_ASSOC);
    //為了讓別的網頁也知道使用者登入了，所要要寫session，以下是將登入資者資料寫入session，另外也要跟同一組的人講好，要確定系統裡要哪些session的資訊

    $_SESSION["memNo"] = $memRow["memNo"];
    $_SESSION["memId"] = $memRow["memId"];
    $_SESSION["memName"] = $memRow["memName"];
    $_SESSION["email"] = $memRow["email"];
    $_SESSION["couponNo"] = $memRow["couponNo"];
    $_SESSION["phone"] = $memRow["phone"];

    //送出登入者的姓名資料
    // echo $memRow["memName"];
    //若是要送很多資料，那就把$memRow分解出來存到session的各個資料(memNo、memId、memName、email)用array包起來，然後用json_encode的方式，編碼成JSON字串送出去。
       $loginInfo = array("memNo"=>$_SESSION["memNo"],"memId"=>$_SESSION["memId"], "memName"=>$_SESSION["memName"],"couponNo"=>$_SESSION["couponNo"] );
    echo json_encode($loginInfo);
	// print_r($loginInfo);
	// exit();
   
    // echo json_encode($memRow);
    //$memRow其實是一整列的會資料，依需求看你要丟整包的，還是已整理過的(例$loginInfo)，由於memRow是組陣列資料，傳到前端前要先將資料給字串化，所以用php內建的json_encode函數來將陣列給字串化


  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>