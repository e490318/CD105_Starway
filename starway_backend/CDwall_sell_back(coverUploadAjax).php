<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
</head>
<body>

<?php


// $file=(empty($_FILES['file']))?"":$_FILES['file']; 

if( $_FILES["upFile"]["error"] == 0 ){
	//檢查是否有images資料夾
	// if( file_exists("images") === false){
	// 	//建立資料夾 make directory
	// 	mkdir("images");
	// }

	$from = $_FILES['upFile']['tmp_name'];
	$to = "../images/CDWall/records//{$_FILES['upFile']['name']}";
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
	echo "['error']: " , $_FILES['upFile']['error'] , "<br>";
}

// echo "['error']: " , $_FILES['upFile']['error'] , "<br>";
// echo "['name']: " , $_FILES['upFile']['name'] , "<br>";
// echo "['tmp_name']: " , $_FILES['upFile']['tmp_name'] , "<br>";
// echo "['type']: " , $_FILES['upFile']['type'] , "<br>";
// echo "['size']: " , $_FILES['upFile']['size'] , "<br>";
?>

</body>
</html>