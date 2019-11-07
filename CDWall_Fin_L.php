<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

// _____________新歌報到_______________
$sql="SELECT m.memNo, m.memName, f.fundNo, f.demoName, f.fundEndDate, f.fundTotal, f.demoCover, f.demoDescript, f.demoLink 
      FROM info_member m JOIN order_fund f on m.memNo = f.memNo 
      WHERE (fundStatus = 0)AND(fundTotal > 200000) 
      ORDER BY `f`.`fundNo` 
      DESC LIMIT 5";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
		?>
		<form action="CDPage.php" method="get" class="swiper-slide">

            <input type="hidden" name="fundNo" value="<?php echo $data['fundNo'] ?>">
            <a class="L_dona_fin_record">
                <img src="images/Record/demo/<?php echo $data['demoCover'] ?>" alt="<?php echo $data['demoCover'] ?>">
                <div class="L_dona_fin_info">
                    <div><?php echo $data['demoName'] ?></div>
                    <span><?php echo $data['memName'] ?></span>
                    <span><?php echo $data['demoDescript'] ?></span>
                    <ul>
                        <li>
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
                            </li> <!-- 現在時間減去fundEndDate -->
                        <li>已募 <?php
                            $fundTotal = number_format($data['fundTotal']);
                            echo $fundTotal;
                        ?> 元</li>
                    </ul>
                    <div style="width: <?php 
                                            if($data['fundTotal'] > 200000){
                                                echo 100;
                                            }else{
                                                echo $data['fundTotal']/2000 ;
                                            }
                                       ?>% ">
                    </div>
                    <input type="submit" name="" value="" class="L_dona_new_input">
                </div>
            </a>
            <div class="L_dona_fin_bg">
                <img src="images/Record/demo/<?php echo $data['demoCover'] ?>" alt="<?php echo $data['demoCover'] ?>">
            </div>
			
	    </form>
		<?php
	}
}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>