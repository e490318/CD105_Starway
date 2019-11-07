<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
</head>
<body>

<?php


// $file=(empty($_FILES['file']))?"":$_FILES['file']; 

if( $_FILES["upFileLink"]["error"] == 0 ){
	//檢查是否有images資料夾
	// if( file_exists("images") === false){
	// 	//建立資料夾 make directory
	// 	mkdir("images");
	// }

	$from = $_FILES['upFileLink']['tmp_name'];
	$to = "../images/CDWall/records//{$_FILES['upFileLink']['name']}";
	copy($from, iconv("UTF-8", "big5", $to));
	//檢查是否從別支程式轉來
    // if( isset($_SESSION["where"]) === true){
    // 	$to = $_SESSION["where"];
    // 	unset( $_SESSION["where"]);
    // 	header("location:$to");
    // }	
// header("location:".getenv("HTTP_REFERER"));  
	// header("Location:CDwall_sell_back.php");
	// echo "OK";
	// exit();
}else{
	echo "['error']: " , $_FILES['upFileLink']['error'] , "<br>";
}

// echo "['error']: " , $_FILES['upFileLink']['error'] , "<br>";
// echo "['name']: " , $_FILES['upFileLink']['name'] , "<br>";
// echo "['tmp_name']: " , $_FILES['upFileLink']['tmp_name'] , "<br>";
// echo "['type']: " , $_FILES['upFileLink']['type'] , "<br>";
// echo "['size']: " , $_FILES['upFileLink']['size'] , "<br>";
?>

</body>
</html>