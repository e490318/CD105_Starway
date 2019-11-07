<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
</head>
<body>

<?php
if( $_FILES["upFile"]["error"] == 0 ){
	// //檢查是否有images資料夾
	// if( file_exists("images") === false){
	// 	//建立資料夾 make directory
	// 	mkdir("images");
	// }

	$from = $_FILES['upFile']['tmp_name'];
	$to = "images/Record/demo//{$_FILES['upFile']['name']}";
	copy($from, iconv("UTF-8", "big5", $to));
	echo "上傳成功";
	echo "<script>alert('上傳成功')</script>";
	header("Location:MakingAlbum.php");
	exit;
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