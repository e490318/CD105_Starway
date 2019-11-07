<?php
    require_once("Star_Way_Database.php");
	$sql="SELECT donateNo , donateDate from orderdetail_fund order by donateNo desc limit 1";
    $fundOlder = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$fundOlderRow = $fundOlder->fetchAll(PDO::FETCH_ASSOC);
	     foreach ( $fundOlderRow as $fundOlderData){
   ?>
      <div class="Y_completeMsg">
        <strong>THANK YOU</strong><br>
        <strong>感謝您的贊助</strong>
        <p>您的贊助編號:<span style="color: #f00"><?php echo '0000'.$fundOlderData['donateNo'] ?></span></p>
        <p>贊助日期:<span><?php echo $fundOlderData['donateDate'] ?></span></p>
     	<div class="Y_checkBtn">
            <a href="CDWall.php">繼續瀏覽</a>
        	 <!-- <a href="user.php#tab01">贊助明細查詢</a> -->
     	</div>
    </div>
<?php
}  
?>	
