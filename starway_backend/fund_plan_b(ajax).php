<?php
ob_start();
session_start();

try {
require_once("../Star_Way_Database.php");

$sql="SELECT * FROM `fund_plan`";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$fund_plan = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$planRow = $fund_plan->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($planRow as $data){
		?>
		

			<tr>
				<td><?php echo $data['planImg'] ?></td>
				<td><?php echo $data['planName'] ?></td>
				<td><?php echo $data['planPrice'] ?></td>
				<td><?php echo $data['planContent'] ?></td>
				<td><?php echo $data['planDescription'] ?></td>
				<td><?php echo $data['planNotice'] ?></td> 
			</tr>

		
		<?php
	}
}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>

<!-- 開專輯 -->
<script src="js/CDwall_openCD.js"></script>