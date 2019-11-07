<?php
session_start(); 
$adminId = $_POST["adminId"];
$adminPsw = $_POST["adminPsw"];
$errMsg = "";
try {
    require_once("../Star_Way_Database.php");

    $sql = "select * from info_server where adminId=:adminId and adminPsw=:adminPsw"; 
    //$sql = "select * from server where memId='Sara' and memPsw='' or '1'";
    $server = $pdo->prepare( $sql ); //先編譯好
    $server->bindValue(":adminId", $adminId); //代入資料
    $server->bindValue(":adminPsw", $adminPsw);
    $server->execute();//執行之
    $serverRow = $server->fetch(PDO::FETCH_ASSOC);
    // echo $serverRow["adminPms"];
    
    if($serverRow["adminPms"]==1){ 
        $sql = "select * from info_server where adminId=:adminId and adminPsw=:adminPsw and adminPms=1"; 
        //$sql = "select * from server where memId='Sara' and memPsw='' or '1'";
        $server = $pdo->prepare( $sql ); //先編譯好
        $server->bindValue(":adminId", $adminId); //代入資料
        $server->bindValue(":adminPsw", $adminPsw);
        $server->execute();//執行之

        if( $server->rowCount() == 0 ){//找不到
            // $errMsg .= "帳密錯誤, <a href='login.html'>重新登入</a><br>";
            // echo "0";
            // exit();
        }else{
            $serverRow = $server->fetch(PDO::FETCH_ASSOC);
            //登入成功,將登入者的資料寫入session
            $_SESSION["adminId"] = $serverRow["adminId"];
            $_SESSION["adminPsw"] = $serverRow["adminPsw"];
            $_SESSION["adminNo"] = $serverRow["adminNo"];
            $_SESSION["adminName"] = $serverRow["adminName"];
            $_SESSION["adminPms"] = $serverRow["adminPms"];

            //檢查是否從別支程式轉來
            // if( isset($_SESSION["where"]) === true){
            //     $to = $_SESSION["where"];
            //     unset( $_SESSION["where"]);
            //     header("location:$to");
            // }       

                echo "1";
            exit();
                // echo $serverRow["adminName"], " 您好~<br>";
                // header("location:order_fund.php");  
        } 
    }else if($serverRow["adminPms"]=="0"){
        echo "2";
            exit();
        // echo "你被停權";

    }else if($server->rowCount() == 0 ){
        echo "0";
        exit();
         // echo "帳密輸入錯誤";
    }
} catch (PDOException $e) {
    $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
    $errMsg .= "行號 : ".$e -> getLine()."<br>";
}
?>  
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>

</head>
<body>
<?php 
// if($errMsg !=""){
//     echo $errMsg;
// }else{
//     // echo $serverRow["adminName"], " 您好~<br>";
//     // header("location:order_fund.php");  
// }

?>
 
</body>
</html>