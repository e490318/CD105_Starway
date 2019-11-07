<?php
ob_start();
session_start();

try {
require_once("../Star_Way_Database.php");

$sql="SELECT * FROM `album_track` ORDER BY `album_track`.`trackNo` DESC";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$album_track = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$trackRow = $album_track->fetchAll(PDO::FETCH_ASSOC);

	// exit();
	foreach($trackRow as $data){
		?> 
			<tr>
				<td><?php echo $data['trackNo'] ?></td>
				<td><?php echo $data['albumNo'] ?></td>
				<td><?php echo $data['trackIndex'] ?></td>
				<td><?php echo $data['trackName'] ?></td>
				<td><?php echo $data['trackLength'] ?></td>
				<!-- <td>
					<a href='#'><img src="../images/StarWay_Backend/edit.png" alt=""></a>
					<input class="L_CDWallSell_back_input" type="submit" value="放入購物車" style='background-color: transparent;'>
				</td> -->
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