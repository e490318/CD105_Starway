<?php
ob_start();
session_start();

try {
require_once("../Star_Way_Database.php");

$sql="SELECT * FROM `orderdetail_disk` ORDER BY `orderNo` DESC";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
		?>
		
			<tr>
				<td><?php echo $data['orderNo'] ?></td>
				<td><?php echo $data['albumNo'] ?></td>
				<td><?php echo $data['diskQty'] ?></td>
				<td><?php echo $data['diskTotal'] ?></td>
				<td style='position: relative;'>
					<a style='position: absolute;cursor:pointer;'><img src="../images/StarWay_Backend/edit.png" alt=""></a>
					<input class="L_CDWallSell_back_input" type="submit" value="" style='background-color: transparent;position: absolute;padding-top: 1%;
					padding-right: 0.5%;padding-bottom: 1%;padding-left: 0.5%;width:20px;border:none;'>
				</td>
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