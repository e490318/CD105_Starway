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
//------------------
foreach( $_FILES["upFile"]["error"] as $i => $data){
	switch( $_FILES["upFile"]["error"][$i] ){
		case UPLOAD_ERR_OK:
			//檢查是否有images資料夾
			if( file_exists("images") === false){
				//建立資料夾 make directory
				mkdir("images");
			}

			$from = $_FILES['upFile']['tmp_name'][$i];
			$to = "images//{$_FILES['upFile']['name'][$i]}";
			copy($from, iconv("UTF-8", "big5", $to));
			echo "OK<br>";
			break;
		case UPLOAD_ERR_INI_SIZE:
			echo "上傳檔案太大,不得超過: ", ini_get("upload_max_filesize"), "<br>";
			break;
		case UPLOAD_ERR_FORM_SIZE:
			echo "上傳檔案太大 <br>";
			break;
		case UPLOAD_ERR_PARTIAL:
			echo "上傳資料有問題，請重送<br>";
			break;
		case UPLOAD_ERR_NO_FILE:
		echo "未選檔案<br>";
			break;
		default : 
			echo "['error']: " , $_FILES['upFile']['error'][$i] , "<br>";
	}//switch
}//foreach

//--------------------------


?>

</body>
</html>