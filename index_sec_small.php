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

	$order_fund = $pdo->query($sql);  //gearlist 是 PDOStatement物件
	$albumRow = $order_fund->fetchAll(PDO::FETCH_ASSOC);


	// exit();
	foreach($albumRow as $data){
        ?>

            <div class="L_index_pop_records">
                <img class="L_index_pop_records_img" src="images/Record/demo/<?php echo $data['demoCover'] ?>" alt="<?php echo $data['demoCover'] ?>">
            </div>

		<?php
	}
}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}
?>