<?php
try {
	$dsn = "mysql:host=localhost;port=3306;dbname=books;charset=utf8";
	$user = "root";
	$password = "dac413";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION );

	$pdo = new PDO($dsn, $user, $password, $options);

	$sql = "select * from products";
	$products = $pdo->query($sql); 
	$products = $pdo->query($sql); 
} catch (PDOException $e) {
	echo "錯誤 : ", $e -> getMessage(), "<br>";
	echo "行號 : ", $e -> getLine(), "<br>";
}
 
?> 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
<style type="text/css">
h2 {
	color:deeppink;
}	
td {
	border-bottom:1px dotted deeppink;
}
</style>
</head>
<body>
<table align="center">
	<tr><th>書號</th><th>書名</th><th>價格</th><th>作者</th></tr>
<?php	
	$prodRow = $products->fetchAll(PDO::FETCH_ASSOC)
?>		
		<tr>
			<td><?php echo $prodRow[0]["psn"];?></td>
			<td><?php echo $prodRow[0]["pname"];?></td>
			<td><?php echo $prodRow[0]["price"];?></td>
			<td><?php echo $prodRow[0]["author"];?></td>
		</tr>
			<tr>
				
			<td><?php echo $prodRow[1]["psn"];?></td>
			<td><?php echo $prodRow[1]["pname"];?></td>
			<td><?php echo $prodRow[1]["price"];?></td>
			<td><?php echo $prodRow[1]["author"];?></td>
			</tr>
	
<?php
	
?>
</table>     
</body>
</html>