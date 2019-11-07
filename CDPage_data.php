<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

$sql="SELECT * FROM `fund_plan` ORDER BY `fundplanNo`";

// $sql="UPDATE  info_album set shelfStatus='0'";

	$fund_plan = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$planRow = $fund_plan->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($planRow as $data){
		
        ?>           
                <input type="hidden" name="fundplanNo" value="<?php echo $data['fundplanNo'] ?>">
                <form action="Paypage.php" method="get">
                <div class="L_record_pay_plan">
                    <div>
                        <img src="images/<?php echo $data['planImg'] ?>" alt="pay_reco2.png">
                    </div>
                    <div class="L_record_pay_plan_detil">
                        <div><?php echo $data['planName']; ?></div>
                        <span>NT. <?php echo $data['planPrice']?> 元</span>
                        <div><?php echo $data['planContent']?></div>
                        <div><?php echo $data['planContentTwo']?></div>
                        <div><?php echo $data['planDescription']?></div>
                        <span><?php echo $data['planNotice'].'<br>'; ?></span>
                        <a href="Paypage.php">我要贊助</a>
                    </div>
                </div>
                </form>
 
		<?php 
}

}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>
