<?php
ob_start();
session_start();

try {
require_once("../Star_Way_Database.php");

$sql="SELECT * from info_class where shelfStatus='1'";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_class = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$classRow = $info_class->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($classRow as $data){
		?>
			<tr>
				<td><?php echo $data['classNo'].'<br>'; ?></td>
				<td><?php echo $data['teacherNo'].'<br>'; ?></td>
				<td><?php echo $data['className'].'<br>'; ?></td>
				<td><?php echo $data['classDescript'].'<br>'; ?></td>
				<td><?php echo $data['classPrice'].'<br>'; ?></td>
				<td><?php echo $data['shelfStatus'].'<br>'; ?></td> 
			</tr>
		<?php 
	}
}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>