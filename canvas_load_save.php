<?php
session_start();
$upload_dir = "images//Record//demo//";
if( ! file_exists($upload_dir ))
mkdir($upload_dir);
$img = $_POST['myImage'];
$img = str_replace('data:image/png;base64,', '', $img);
// $img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$fileName = date("YmdHis");
$file = $upload_dir . $fileName . ".png";
$success = file_put_contents($file, $data);
// echo $success ? $file : 'Unable to save the file.';
echo $fileName.".png";
$_SESSION['demoCover'] = $fileName.".png";
?>