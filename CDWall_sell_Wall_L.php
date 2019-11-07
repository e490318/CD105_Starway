<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

// _____________強打唱片_______________
$sql="SELECT * from info_album 
	  where shelfStatus = '1'
	  ORDER BY RAND()
	  LIMIT 8";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
		?>
		<form action="CDPage_sell.php" method="get">

			<input type="hidden" name="albumNo" value="<?php echo $data['albumNo'] ?>">
			<div class="L_wall_card">
	            <div class="L_wall_card_cont">
	                <div class="L_wall_card_cont_img">
	                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/<?php echo $data['albumCover'] ?>" alt="<?php echo $data['albumCover'] ?>">
	                    <div class="L_wall_card_cont_img_playpause">
	                        <i class="fas fa-play">播放</i>
	                        <i class="fas fa-pause">暫停</i>
	                    </div>
	                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/<?php echo $data['albumCover'] ?>" alt="<?php echo $data['albumCover'] ?>">
	                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
	                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/<?php echo $data['albumLink'] ?>"></audio>
	                </div>
	                <a>
	                    <div class="L_wall_card_cont_wrap">
	                        <p><?php echo $data['albumName'] ?></p>
	                        <p><?php echo $data['albumSinger'] ?></p>
	                        <span class="L_wall_card_cont_wrap_star">
	                            <i class="fas fa-star"></i>
	                            <span>購買次數：<?php echo $data['saleCount'] ?></span>
							</span>
							<p class="L_wall_card_cont_wrap_pp"><?php echo $data['albumDescript'] ?></p>
	                        <input type="submit" name="" value="" class="L_wall_card_input">
	                    </div>
	                </a>
	            </div>
	        </div>

	    </form>
		<?php
	}
}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>

<!-- 開專輯 -->
<script src="js/CDwall_openCD.js"></script>