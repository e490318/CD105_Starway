<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

// _____________強打唱片_______________
$sql="SELECT m.memNo, m.memName, f.fundNo, f.demoName, f.fundEndDate, f.fundTotal, f.demoCover, f.demoDescript, f.demoLink ,f.fundCount
      FROM info_member m JOIN order_fund f on m.memNo = f.memNo
      WHERE (fundStatus = 0)  
      ORDER BY RAND() DESC
      LIMIT 8";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
		?>
		<form action="CDPage.php" method="get">

            <input type="hidden" name="fundNo" value="<?php echo $data['fundNo'] ?>">
            <div class="L_wall_card">
                <div class="L_wall_card_cont">
                    <div class="L_wall_card_cont_img">
                        <img class="L_wall_card_cont_img_cover" src="images/Record/demo/<?php echo $data['demoCover'] ?>" alt="<?php echo $data['demoCover'] ?>">
                        <div class="L_wall_card_cont_img_playpause">
                            <i class="fas fa-play">播放</i>
                            <i class="fas fa-pause">暫停</i>
                        </div>
                        <img class="L_wall_card_cont_img_round" src="images/Record/demo/<?php echo $data['demoCover'] ?>" alt="<?php echo $data['demoCover'] ?>">
                        <img class="L_wall_card_cont_img_reco" src="images/Record/demo/reco_inner.png" alt="reco_inner.png">
                        <audio class="L_wall_card_cont_img_reco1" src="images/Record/demo/<?php echo $data['demoLink'] ?>"></audio>
                    </div>
                    <a>
                        <div class="L_wall_card_cont_wrap">
                            <p><?php echo $data['demoName'] ?></p>
                            <p><?php echo $data['memName'] ?></p>
                            <span class="L_wall_card_cont_wrap_star">
                                <i class="fas fa-star"></i>
                                <span>購買次數：<?php echo $data['fundCount'] ?></span>
                            </span>
                            <div>
                                <div>
                                    <?php
                                        $arr = explode('-',$data['fundEndDate']);
                                        date_default_timezone_set("America/New_York");

                                        $Y = $arr[0] - date('Y');
                                        $m = $arr[1] - date('m');
                                        $d = $arr[2] - date('d');
                                        
                                        $leftDay = $Y*365 + $m*30 + $d;

                                        if($leftDay < 0){
                                            echo '募款已截止';
                                        }else{
                                            echo '剩下'.$leftDay.'天';
                                        }
                                    ?>
                                </div>
                                <div>已募
                                    <?php
                                        $fundTotal = number_format($data['fundTotal']);
                                        echo $fundTotal;
                                    ?> 元
                                </div>
                            </div>
                            <div>
                                <div style="width: <?php 
                                                        if($data['fundTotal'] > 200000){
                                                            echo 100;
                                                        }else{
                                                            echo $data['fundTotal']/2000 ;
                                                        }
                                                    ?>% ">
                                </div>
                            </div>
                            <p><?php echo $data['demoDescript'] ?></p>
                            <input type="submit" name="" value="" class="L_dona_wall_input">
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
