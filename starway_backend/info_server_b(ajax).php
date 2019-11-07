<?php
ob_start();
session_start();

try {
require_once("../Star_Way_Database.php");

$sql="SELECT * FROM info_server";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_server = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$memRow = $info_server->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($memRow as $data){
		?>
		

			<tr>
				<td><?php echo $data['memNo'] ?></td>
				<td><?php echo $data['memName'] ?></td>
				<td><?php echo $data['memId'] ?></td>
				<td><?php echo $data['memPsw'] ?></td>
				<td><?php echo $data['memAvatar'] ?></td>
				<td><?php echo $data['sex'] ?></td>
				<td><?php echo $data['birthDate'] ?></td>
				<td><?php echo $data['rgsDate'] ?></td>
				<td><?php echo $data['phone'] ?></td>
				<td><?php echo $data['email'] ?></td>
				<td><?php echo $data['memPms'] ?></td>
				<td><?php echo $data['couponNo'] ?></td>
				<td>
						<a href='#'><img src="../images/StarWay_Backend/edit.png" alt=""></a>
						<input class="L_CDWallSell_back_input" type="submit" value="放入購物車" style='background-color: transparent;'>
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