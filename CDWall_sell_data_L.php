<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

// _____________新歌報到_______________
$sql="SELECT i.albumNo, i.albumName, i.albumSinger, i.albumCover, i.albumLink, i.diskPrice, i.linkPrice, t.trackName, t.trackNo, t.trackIndex FROM info_album i JOIN album_track t on i.albumNo = t.albumNo WHERE (t.trackIndex = '1') AND (i.albumNo < 4) AND (shelfStatus='1')";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
		?>
		<form action="CDPage.php" method="get">

			<div class="L_pop_record">
                <a href="#"></a>
                <img src="images/CDWall/records/<?php echo $data['albumCover'] ?>" alt="<?php echo $data['albumCover'] ?>">
            </div>
            <div class="L_pop_cont">  
                <input type="hidden" name="PHPalbemName" id="albemName" value="墜落">
                <input type="hidden" name="PHPsinger" id="singer" value="南瓜寶寶泥">
                <input type="hidden" name="PHPprice" id="price" value="350">
                <input type="hidden" name="PHPimageName" id="imageName" value="reco_03.png">
                <span><?php echo $data['albumName'] ?></span>
                <a href="#"><?php echo $data['albumSinger'] ?></a>
                <a href="#">01 There's nothing to prove</a>
                <a href="#">02 看不見</a>
                <a href="#">03 在那邊境</a>
                <a href="#">04 我們像朋友般一直走然後死去</a>
                <span id="Y_cdPrice">售價： <?php echo $data['diskPrice'] ?></span><br>
                <input class="L_addCart" type="submit" value="放入購物車">
            </div>
			
	    </form>
		<?php
	}
// _____________強打唱片_______________
$sql="SELECT * from info_album where (shelfStatus = '1')AND(albumNo>3)";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
		?>
		<form action="CDPage.php" method="get">

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
	                <a href="CDPage_sell.html">
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