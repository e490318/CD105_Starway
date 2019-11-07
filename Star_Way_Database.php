<?php
// $dsn = "mysql:host=localhost;port=3306;dbname=id9416640_cd105g4;charset=utf8";

// $dsn = "mysql:host=104.199.171.114;port=3306;dbname=cd105g4;charset=utf8";
$dsn = "mysql:host=127.0.0.1;port=3306;dbname=cd105g4;charset=utf8";
$user = "root";
$password = "";
$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION );
$pdo = new PDO($dsn, $user, $password, $options);
?>
