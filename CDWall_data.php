<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

$sql="SELECT * from info_album where shelfStatus='1'";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
		?>
		<form action="CDPage_sell(AJAX).php" method="get">
			<ul>
				<li><img src="images/CDWall/records/<?php echo $data['albumCover'] ?>"></li>
				<div class="cdInfo">
				<label>
				<input type="hidden" name="albumNo" value="<?php echo $data['albumNo'] ?>">
				<li><strong><?php echo $data['albumName'] ?></strong></li>
				<li><?php echo $data['albumSinger'] ?></li>
				<li><?php echo $data['albumDescript'] ?></li>
				<li>購買次數: <?php echo $data['saleCount'] ?></li>
				<input type="submit" name="" value="" class="addCDPage_sell">
			</label>
			</div>
			</ul>
		</form>
		<?php 
	}
}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>