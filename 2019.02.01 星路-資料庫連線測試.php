<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<?php
try {
$dsn = "mysql:host=127.0.0.1;port=3306;dbname=cd105g4;charset=utf8";
$user = "root";
$password = "Hasegawa666";
$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION );
$pdo = new PDO($dsn, $user, $password, $options);
$sql ="select * from info_album";
$pdo->exec($sql);
echo "連線成功";
	
} catch (Exception $e) {
echo '連線失敗';
	echo "錯誤 : ", $e -> getMessage(), "<br>";
	echo "行號 : ", $e -> getLine(), "<br>";
}

?>
	
</body>
</html>