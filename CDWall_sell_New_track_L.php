<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

// _____________新歌報到_______________
$sql="SELECT * FROM album_track WHERE albumNo='$albumNo'";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$album_track = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$trackRow = $album_track->fetchAll(PDO::FETCH_ASSOC);

	// exit();
	foreach($trackRow as $data){
		?>
            <form action="CDPage_sell.php" method="get" class="L_pop_pin_<?php echo $data['albumNo'] ?>">

                <input type="hidden" name="albumNo" value="<?php echo $data['albumNo'] ?>">
                <a href="#" class="L_pop_pin_track_<?php echo $data['albumNo'] ?>"><?php echo $data['trackIndex'] ?> <?php echo $data['trackName'] ?></a>
                
            </form>
		<?php
	}
}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>