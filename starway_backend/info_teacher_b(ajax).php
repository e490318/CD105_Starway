<?php
ob_start();
session_start();

try {
require_once("../Star_Way_Database.php");

$sql="SELECT * FROM info_teacher";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_teacher = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$teacherRow = $info_teacher->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($teacherRow as $data){
		?>
		

			<tr>
				<td><?php echo $data['teacherNo'] ?></td>
				<td><?php echo $data['teacherName'] ?></td>
				<td><?php echo $data['teacherPhoto'] ?></td>
				<td><?php echo $data['teacherDescript'] ?></td>
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