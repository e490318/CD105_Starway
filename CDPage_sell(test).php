<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php
$albumNo = $_REQUEST['albumNo'];

try {
require_once("Star_Way_Database.php");
$sql="SELECT * from info_album where albumNo='$albumNo'";
$albumInfo = $pdo->query($sql);  //gearlist 是 PDOStatement物件
$albumRow = $albumInfo->fetchAll(PDO::FETCH_ASSOC);

foreach ($albumRow as $data) {
	?>
	<strong><?php echo $data['albumName'] ?></strong>
	<?php 
}



}catch (PDOException $e) {
	echo "錯誤原因 : " , $e->getMessage(), "<br>";
	echo "錯誤行號 : " , $e->getLine(), "<br>";	
}

?>
</body>
</html>