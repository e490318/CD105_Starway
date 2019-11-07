<?php
ob_start();
session_start();

try {
require_once("../Star_Way_Database.php");

$sql="SELECT * FROM `cdwall_msg` ORDER BY `cdwall_msg`.`msgNo` DESC";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$cdwall_msg = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$msgRow = $cdwall_msg->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($msgRow as $data){
		?>
		

			<tr>
				<td><?php echo $data['msgNo'] ?></td>
				<td><?php echo $data['albumNo'] ?></td>
				<td><?php echo $data['memNo'] ?></td>
				<td><?php echo $data['msgContent'] ?></td>
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