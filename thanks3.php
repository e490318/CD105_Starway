<?php
    require_once("Star_Way_Database.php");
	$sql="SELECT orderNo , classDate from order_class order by orderNo desc limit 1";
    $classOlder = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$classOlderRow = $classOlder->fetchAll(PDO::FETCH_ASSOC);
	     foreach ( $classOlderRow as $classOlderData){
   ?>
      <div class="Y_completeMsg">
        <strong>THANK YOU</strong><br>
        <strong>感謝購買我們的課程</strong>
        <p>您的訂單編號:<span style="color: #f00"><?php echo '0000'.$classOlderData['orderNo'] ?></span></p>
        <p>您的上課日期:<span><?php echo $classOlderData['classDate'] ?></span></p>
     	<div class="Y_checkBtn">
            <a href="Class.php">繼續選課</a>
        	 <a href="user.php#tab03">查詢您的訂單</a>
     	</div>
    </div>
<?php
}  
?>	
