<?php
ob_start();
session_start();

try {
require_once("Star_Way_Database.php");

// _____________強打唱片_______________
$sql="SELECT m.memNo, m.memName, f.fundNo, f.demoName, f.fundEndDate, f.fundCount, f.fundTotal, f.fundGoal, f.demoCover, f.demoDescript, f.demoLink
      FROM info_member m JOIN order_fund f on m.memNo = f.memNo 
      ORDER BY `f`.`fundTotal` DESC
      LIMIT 10";
// $sql="UPDATE  info_album set shelfStatus='0'";

	$order_fund = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $order_fund->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
        ?>
        
        <form class="L_index_pop_wrap_inner_form" action="CDPage.php" method="get">
            <input type="hidden" name="fundNo" value="<?php echo $data['fundNo'] ?>">
            <div class="L_index_pop">
                <img src="images/Record/demo/<?php echo $data['demoCover'] ?>" alt="<?php echo $data['demoCover'] ?>">
                <div class="L_index_pop_cont">
                    <span><?php echo $data['demoName'] ?></span>
                    <a href="#"><?php echo $data['memName'] ?></a>
                    <p>目標 <?php
                                $fundGoal = number_format($data['fundGoal']);
                                echo $fundGoal;
                            ?> 元</p>
                    <div class="L_index_pop_cont_line">
                        <div></div>
                        <div style="width: <?php 
                                                if($data['fundTotal'] > 200000){
                                                    echo 100;
                                                }else{
                                                    echo $data['fundTotal']/2000 ;
                                                }
                                            ?>% ">
                        </div>
                    </div>
                    <p>已募得 <?php 
                                $fundTotal = number_format($data['fundTotal']);
                                echo $fundTotal;
                             ?>元</p>
                    <p><?php echo $data['fundCount'] ?> 位贊助人</p>
                    <input type="submit" name="" value="我想贊助" class="L_index_addCart">
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