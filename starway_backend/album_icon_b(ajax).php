<?php
ob_start();
session_start();

try {
require_once("../Star_Way_Database.php");

$sql="SELECT * FROM `album_icon` ORDER BY `album_icon`.`iconNo` DESC";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$album_icon = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$iconRow = $album_icon->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($iconRow as $data){
		?>
		

			<tr>
				<td><?php echo $data['iconNo'] ?></td>
				<td><?php echo $data['iconName'] ?></td>
				<td><?php echo $data['iconImg'] ?></td>
				<td><?php echo $data['shelfStatus'] ?></td>

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