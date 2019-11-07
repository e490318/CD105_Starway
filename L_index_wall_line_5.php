<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

// _____________強打唱片_______________
$sql="SELECT f.demoName, m.memName, f.demoCover
      FROM order_fund f JOIN info_member m on f.memNo = m.memNo 
      UNION
      SELECT albumName, albumSinger, albumCover
      FROM info_album
      ORDER BY rand()
      LIMIT 5";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$order_fund = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $order_fund->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
        $str=$data['demoCover'];
        $strcheck=substr($str,0,4);
        if($strcheck == "reco"){
            $src="images/CDWall/records/".$str;
        }else{
            $src="images/Record/demo/".$str;
        }


		?>

            <div class="L_index_wall_card">
                <a>
                    <div class="L_index_wall_card_cont">
                        <img src="<?php echo $src ?>" alt="">
                        <div class="L_index_wall_card_cont_wrap">
                            <p><?php echo $data['demoName'] ?></p>
                            <p><?php echo $data['memName'] ?></p>
                        </div>
                    </div>
                </a>
            </div>

		<?php
	}
}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>