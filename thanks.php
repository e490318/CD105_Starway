<?php
    require_once("Star_Way_Database.php");
	$sql="SELECT orderNo , orderDate from order_album order by orderNo desc limit 1";
    $albumOlder = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumOlderRow = $albumOlder->fetchAll(PDO::FETCH_ASSOC);
	     foreach ( $albumOlderRow as $albumOlderData){
   ?>
      <div class="Y_completeMsg">
        <strong>THANK YOU</strong><br>
        <strong>感謝您的購買</strong>
        <p>您的訂單編號:<span style="color: #f00"><?php echo '0000'.$albumOlderData['orderNo'] ?></span></p>
        <p>下單日期:<span><?php echo $albumOlderData['orderDate'] ?></span></p>
     	<div class="Y_checkBtn">
            <a href="CDWall_sell.php#L_CDWallSell">繼續購買</a>
        	 <a href="user.php#tab02">查詢您的訂單</a>
     	</div>
    </div>
<?php
}  
?>	
