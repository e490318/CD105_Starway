<?php 
//這是一支前端要確認會員是否已有登入的程式
session_start();
//若$_SESSION["memName"]==true(也就是Session已會員的資料)代表登入過
if( isset($_SESSION["memName"]) === true){

	//若要傳的資訊比較多一點，例如會員ID、會員名稱..等，那就把這些資訊用array包起來
	$loginInfo = array("memId"=>$_SESSION["memId"], "memName"=>$_SESSION["memName"]);

	//用array包起來後，再編碼成JSON字串送出去
	echo json_encode($loginInfo);
}else{
	//若沒有會員已登入的資訊，則傳回空的物件字串(空的JSON字串)
	echo "{}";
}
?>