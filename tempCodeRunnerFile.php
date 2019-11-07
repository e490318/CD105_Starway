<?php
$sql = "select * from info_member where memNo=:memNo AND memPms=1"; 
	$member = $pdo->prepare( $sql ); //先編譯好
	$member->bindValue(":memNo", $memNo); //代入資料	
	// $member->bindValue(":memPsw", $memPsw);
	$member->execute();//執行之

	if( $member->rowCount() == 0 ){//找不到
		$errMsg .= "帳密錯誤, <a href='user.php'>重新登入</a><br>";
	}else{
		$memRow = $member->fetch(PDO::FETCH_ASSOC);  
		if($memRow["memAvatar"]=="")
			$memRow["memAvatar"] = "default_memPhoto.jpg";
	}