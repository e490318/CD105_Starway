<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

// _____________新歌報到_______________
$sql="SELECT i.albumNo, i.albumName, i.albumSinger, i.albumCover, i.albumLink, i.diskPrice, t.trackName, t.trackNo, t.trackIndex 
      FROM info_album i JOIN album_track t on i.albumNo = t.albumNo 
      WHERE (t.trackIndex = '1') AND (i.albumNo < 4) AND (shelfStatus='1')";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
		?>
		<form action="CDPage_sell.php" method="get" class="L_pop_pin_<?php echo $data['albumNo'] ?>">

            <input type="hidden" name="albumNo" value="<?php echo $data['albumNo'] ?>">
			<div class="L_pop_record">
                <a href="#"></a>
                <img src="images/CDWall/records/<?php echo $data['albumCover'] ?>" class="L_pop_pin_img_<?php echo $data['albumNo'] ?>" alt="<?php echo $data['albumCover'] ?>">
            </div>
            <div class="L_pop_cont L_pop_cont_<?php echo $data['albumNo'] ?>">  
                <input type="hidden" name="PHPalbemName" id="albemName" value="墜落">
                <input type="hidden" name="PHPsinger" id="singer" value="南瓜寶寶泥">
                <input type="hidden" name="PHPprice" id="price" value="350">
                <input type="hidden" name="PHPimageName" id="imageName" value="reco_03.png">
                <span class="L_pop_pin_name_<?php echo $data['albumNo'] ?>"><?php echo $data['albumName'] ?></span>
                <a href="#" class="L_pop_pin_singer_<?php echo $data['albumNo'] ?>"><?php echo $data['albumSinger'] ?></a>
                
                <!-- php開始 -->
                <!-- <section id="L_pop_cont_track"> -->
                <h4 class="mainTitle">今日主打歌</h4><br>
               <a href="#" class="L_pop_pin_track_"><?php echo $data['trackName'] ?></a>
              <!--       <a href="#" class="L_pop_pin_track_">02 看不見</a>
                    <a href="#" class="L_pop_pin_track_">03 在那邊境</a>
                    <a href="#" class="L_pop_pin_track_">04 我們像朋友般一直走然後死去</a> -->

                <!-- </section>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: 'CDWall_sell_New_track_L.php',
                            dataType: 'text',
                            success: function(data){
                                $('#L_pop_cont_track').html(data);
                            }
                        });
                    });
                </script> -->
                <!-- php結束 -->

     <!--            <span id="Y_cdPrice" class="L_pop_pin_price_<?php echo $data['albumNo'] ?>">售價： <?php echo $data['diskPrice'] ?>元</span><br>
                <input class="L_addCart" type="submit" value="放入購物車"> -->
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