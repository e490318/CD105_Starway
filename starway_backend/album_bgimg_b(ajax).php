<?php
ob_start();
session_start();

try {
require_once("../Star_Way_Database.php");

$sql="SELECT * FROM `album_bgimg` ORDER BY `album_bgimg`.`bgImgNo` DESC";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$album_bgimg = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$imgRow = $album_bgimg->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($imgRow as $data){
		?>
		

			<tr>
				<td><?php echo $data['bgImgNo'] ?></td>
				<td><?php echo $data['bgName'] ?></td>
				<td><?php echo $data['bgImg'] ?></td>
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