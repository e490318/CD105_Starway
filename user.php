<?php
ob_start();
session_start(); 
// phpinfo(); 
// 查出upload_max_filesize最大限制為2M

//如果已登出
if(!isset($_SESSION["memId"])){
	//若在會員中心登出，轉跳到首頁
    header("location:starway.php"); 
}
//如果已登入
else{ 

$memNo = $_SESSION["memNo"];
$errMsg = ""; 
  
try {
	require_once("Star_Way_Database.php");

	// 會員資料
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
	
	$sql = "select * from info_member where memNo=:memNo AND memPms=1"; 
	$member = $pdo->prepare( $sql ); 
	$member->bindValue(":memNo", $memNo); 
	$member->execute();

	if( $member->rowCount() == 0 ){
		$errMsg .= "帳密錯誤, <a href='user.php'>重新登入</a><br>";
	}else{
		$memRow = $member->fetch(PDO::FETCH_ASSOC);  
		if($memRow["memAvatar"]=="")
			$memRow["memAvatar"] = "default_memPhoto.jpg";
	}

	// 我的作品
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 

	$sql = "select * from order_fund where memNo=:memNo and fundStatus=0 order by fundNo desc LIMIT 1"; 
	$demo = $pdo->prepare( $sql ); //先編譯好
	$demo->bindValue(":memNo", $_SESSION["memNo"]); //代入資料
	$demo->execute();//執行之 

	if( $demo->rowCount() == 0 ){//找不到
		// $errMsg .= "目前尚未製作募資專輯";
		$demoRow["fundNo"] = "0";
		$demoRow["demoCover"] = "no_album.png";
		$demoRow["demoName"] = "募資專輯: -- ";
		$demoRow["demoLink"] = "-- --";
		$demoRow["demoDescript"] = "專輯描述 : --  <br> 提醒:您尚未發起募資案件";
		$demoRow["fundTotal"] = "";
		$demoRow["fundGoal"] = "";
	}else{
		$demoRow = $demo->fetch(PDO::FETCH_ASSOC);  
	}

	// 贊助會員明細(分頁檢視)
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

	
	if(isset($demoRow["fundNo"])==true){

		// $sql = "select * from orderdetail_fund where fundNo=:fundNo"; 
		$sql = "select * from orderdetail_fund f 
		join info_member m on f.memNo = m.memNo 
		where fundNo=:fundNo 
		order by donateNo asc" ; 
		$donateAll = $pdo->prepare( $sql ); //先編譯好
		$donateAll->bindValue(":fundNo", $demoRow["fundNo"]); //代入資料
		$donateAll->execute();//執行之

		$totalData_t1 = $donateAll->rowCount();//取得頁數 
	  
		//每頁有幾筆
		$PerPage_t1 = 5;

		//共有幾頁
		$TotalPage_t1 = ceil($totalData_t1/$PerPage_t1); //  7/2...>3.5

		//設定好要開始抓取的位置
		if(isset($_GET["pageNo_t1"])==false)
		  $pageNo_t1=1;
		else  //有提供pageNo_t1
		  $pageNo_t1=$_GET["pageNo_t1"];
		  
		$Start_t1 = ($pageNo_t1-1) * $PerPage_t1;
	 
		$sql =  "select * from orderdetail_fund f 
				 join info_member m on f.memNo = m.memNo 
				 where fundNo=:fundNo 
				 order by donateDate desc limit $Start_t1,$PerPage_t1 ";
		// $products = $pdo->query($sql);
		$donate = $pdo->prepare($sql); 
	 	$donate->bindValue(":fundNo", $demoRow["fundNo"]); //代入資料
		$donate->execute();//執行之
	}

 
 

	// 我的收藏
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
 	//(會員音源線上聽+下載)
	// 商品圖片albumCover	商品編號albumNO	商品名稱albumName	訂購日期orderDate	出貨狀況shipStatus
	$errMsg = "";
  
	$sql = "select distinct d.albumNo, 
		 i.albumCover,i.albumLink,i.albumName,i.albumSinger,i.saleCount
		 from order_album o 
		 join orderdetail_disk d on o.orderNO = d.orderNO
		 join info_album i on i.albumNo = d.albumNo 
		 where o.memNo = :memNo and i.shelfStatus = 1"; 
  	$orderLinkAll = $pdo->prepare($sql); 
 	$orderLinkAll->bindValue(":memNo", $_SESSION["memNo"]); //代入資料
 	$orderLinkAll -> execute();


 	// 銷售專輯訂單(分頁檢視)
	// -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

	$errMsg = "";
  
	$sql = "select * from order_album o 
		 join orderdetail_disk d on o.orderNO = d.orderNO
		 join info_album i on i.albumNo = d.albumNo 
		 where o.memNo = :memNo";
  $orderDiskAll = $pdo->prepare($sql); 
 	$orderDiskAll->bindValue(":memNo", $_SESSION["memNo"]); //代入資料
 	$orderDiskAll -> execute();

 	$totalData_t2 = $orderDiskAll->rowCount();//取得總筆數
	// echo "<script>console.log( 'totalData_t2: " . $totalData_t2 . "' );</script>";
  
	//每頁有幾筆
	$PerPage_t2 = 5;

	//共有幾頁
	$TotalPage_t2 = ceil($totalData_t2/$PerPage_t2); //  7/2...>3.5

	//設定好要開始抓取的位置
	if(isset($_GET["pageNo_t2"])==false)
	  $pageNo_t2=1;
	else  //供t2pageNo_t2
	  $pageNo_t2=$_GET["pageNo_t2"];
	  
	$start_t2 = ($pageNo_t2-1) * $PerPage_t2;

	$sql =  "select *
			 from order_album o 
			 join orderdetail_disk d on o.orderNO = d.orderNO
			 join info_album i on i.albumNo = d.albumNo 
			 where o.memNo = :memNo
			 order by d.orderNO limit $start_t2,$PerPage_t2";
	//,i.linkPrice
	// $products = $pdo->query($sql);
	// i.albumCover,l.albumNo,i.albumName,o.orderDate		 
	$orderLink = $pdo->prepare($sql); 
 	$orderLink->bindValue(":memNo", $_SESSION["memNo"]); //代入資料
 	$orderLink -> execute();  

 	//課程訂單
 	$errMsg = "";

 	$sql = "select * from order_class o
			join info_class c on o.classNo = c.classNo
			join info_teacher t on t.teacherNo = c.teacherNo
			where o.memNo = :memNo";
	$class = $pdo->prepare($sql); 
 	$class -> bindValue(":memNo", $_SESSION["memNo"]); //代入資料
 	$class -> execute();

 	$totalData_t3 = $orderDiskAll->rowCount();//取得總筆數
	// echo "<script>console.log( 'totalData_t2: " . $totalData_t2 . "' );</script>";
  
	//每頁有幾筆
	$PerPage_t3 = 5;

	//共有幾頁
	$TotalPage_t3 = ceil($totalData_t3/$PerPage_t3); //  7/2...>3.5

	//設定好要開始抓取的位置
	if(isset($_GET["pageNo_t3"])==false)
	  $pageNo_t3=1;
	else  //供t2pageNo_t2
	  $pageNo_t3=$_GET["pageNo_t3"];
	  
	$start_t3 = ($pageNo_t3-1) * $PerPage_t3;

} catch (PDOException $e) {
	$errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
	$errMsg .= "行號 : ".$e -> getLine()."<br>";
}

?>  
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0,minimum-scale=1" />
<title>星路</title>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="
sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">


<!-- 自己的CSS -->
<link rel="stylesheet" type="text/css" href="css/style_J.css">
<!-- jQuery-->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Tweenmax的Scroll套件-->
<script src="js/TweenMax/ScrollToPlugin.min.js"></script>
<!-- 搭配Scroll的ScrollMagic套件-->
<script src="js/ScrollMagic/ScrollMagic.min.js"></script>
<script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
<script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>

</head>
<body>
	 <header>
    <section class="mainBar">
      <input type="checkbox" id="menu_ctr">
      <label class="menu_ctr" for="menu_ctr"></label>
      <div class="logo L_logo">
        <a href="starway.php" id="logo" class="L_btn"></a>
        <img class="logo_b" src="images/logo_b.png" alt="logo.png">
        <audio id="neonSound" src="sounds/neon.mp3"></audio>
        <div id="L_box"></div>
      </div>
      <nav>
          <ul class="menu">
              <li><a class="menu_items L_CD" href="CDWall.php">募唱片</a></li>
              <li><a class="menu_items" href="CDWall_sell.php">購唱片</a></li>
              <li><a class="menu_items" href="Record.php">做專輯</a></li>
              <li><a class="menu_items" href="Game.php">賺酷碰</a></li>
              <li><a class="menu_items" href="Class.php">買課程</a></li>
              <li><a class="menu_items" href="About.php">說星路</a></li>
              <li class="login_mobile"><a onclick="checkToUser()" class="menu_items">
              <i class="fas fa-user"></i></a>
              <span id="spanLogin2" onclick="document.getElementById('memLoginShow').style.display='block'" style="width:auto;">登入</span>
              </li>
              <li class="login_mobile"><a class="menu_items " href="#"><i class="fas fa-shopping-cart"></i></a></li>
          </ul>
      </nav>
      <div class="nav_user">
        <a onclick="checkToUser()" style="cursor: pointer;"><i class="fas fa-user"></i></a>
        <span id="memName">&nbsp;</span> <!-- 使用者姓名 -->
        <span id="spanLogin" onclick="document.getElementById('memLoginShow').style.display='block'"
          style="width:auto;">登入</span>
        <a href="cartPage.php"><i class="fas fa-shopping-cart"></i></a>
      </div> 
    </section>
  </header>
 	<div class="width1200">

 		<!-- 燈箱顯示 - 還未登入 -->
    <section id="NotLogged">
        <div id="NotBtnBox">
            <p>您還沒登入</p>
            <button id="reBtn">返回</button>
            <button id="GoToBtn">登入</button>
        </div>
    </section> 

		<!-- 燈箱顯示 - 會員登入 -->
		<!-- <?php //include("memLoginShow.php"); ?>   -->

		<section id="memLoginShow" class="modal">
				<form id="memContainer" class="disppear">
						<div id="memberImg">
								<img src="images/Login/vinil.png">
									<span onclick="document.getElementById('memLoginShow').style.display='none'" class="close" title="Close Modal">&times;</span>
								<h4>會員登入</h4>
						</div>
						<div id="memInfoCheck">
								<input class="member" type="text" name="memId" id="memId" placeholder="請輸入您的帳號"><br>
								<input class="member" type="password" name="memPsw" id="memPsw" placeholder="請輸入您的密碼"><br>
								<button type="button" id="btnLogin" onclick="document.getElementById('memLoginShow').style.display='none'">登入</button>
						</div>
						<div id="memInfoReg">
								<a class="forgotPsw" href="#">忘記密碼</a>
								<a class="memberReg" href="memRegister.html">會員註冊</a>
						</div>
				</form>
		</section> 

		<section class="user_Info">	
			<!-- <div class="sidebar"> -->  <!-- 左側每屏導覽 -->
				<!-- <p>會員資料</p> -->
			<!-- </div> -->

			<!-- graphic_info START -->
			<div class="graphic_info">
				<?php 
				if($errMsg !=""){
						echo $errMsg;
				}else{
				?>
					<div class="memAvatar"> 
						<!-- 貼圖上傳測試 --> 
						<form action="Upload_user.php" method="post" enctype="multipart/form-data">
							<label>						
								<input type="file" name="upFile" id="upFile" style="display:none">
								<br>	
								<img src="images/user/memAvatar//<?php echo $memRow["memAvatar"];?>" alt="" id="memAvatar">
							</label>
							<br>
							<input style="display: none" id="submitPic" type="submit" value="圖片確認">
							<br>						
						</form>
						<input type="button" value="上傳檔案" id=upFile_skin style="display:none" onclick="
							document.getElementById('upFile').click();
						">
						<input type="button" style="display: none" id="cancelPic" value="取消" onclick="
							//取消圖片選擇結果
							$id('memAvatar').src = 'images/user/memAvatar//<?php echo $memRow['memAvatar'];?>';
							file = null;					
						"> 
					</div> 
				<?php
					}
				?>
			</div>
			<!-- graphic_info END -->


			<div class="literal_info"> 
				<?php 
				if($errMsg !=""){
						echo $errMsg;
				}else{
					$sex = '';
					$memRow["sex"] == 1 ? $sex='男':$sex='女';
				?> 

				<div class="upper_literal">
				<ul>
				<li><?php echo $memRow["memId"];?></li>
				<a id="btnModify">修改資料</a>
				</ul>				
				</div>		

				<!-- lower_literal START -->
				<div class="lower_literal">
					<!-- 檢視介面 -->
					<ul> 
						<li>會員姓名
							<span class="normal_mode"><?php echo $memRow["memName"];?></span>
							<span class="modify_mode"><input type="text" id="_memName"  value="<?php echo $memRow["memName"];?>"></span>
						</li>	
						<li>會員電話
							<span class="normal_mode"><?php echo $memRow["phone"];?></span>
							<span class="modify_mode"><input type="text" id="phone" value="<?php echo $memRow["phone"];?>"></span>
						</li>
						<li>會員信箱
							<span class="normal_mode"><?php echo $memRow["email"];?></span>
							<span class="modify_mode"><input type="text" id="email" value="<?php echo $memRow["email"];?>"></span>
						</li>
						<li>會員性別
							<span class="normal_mode"><?php echo $sex;?></span>
							<span class="modify_mode">
								<input type="radio" id="sex_m" name="sex" ng-model="sex" ng-value="1"> 男 /
								<input type="radio" id="sex_f" name="sex" ng-model="sex" ng-value="0"> 女
							</span>
						</li>
					</ul>			 
					<ul> 
						<li>會員編號
							<span><?php echo $memRow["memNo"];?></span>
						</li>  			
						<li>會員生日
							<span class="normal_mode"><?php echo $memRow["birthDate"];?></span>
							<span class="modify_mode"><input type="date" id="birthDate" value="<?php echo $memRow["birthDate"];?>"></span>
						</li>
						<li>折價券
							<span>
								<?php 
									$couponNo = $memRow["couponNo"]; 
									switch ($couponNo) {
											case 0:
													echo " - - ";
													break;
											case 1:
													echo "NT50";
													break;
											case 2:
													echo "NT100";
													break;
												case 3:
													echo "NT150";
													break;
									}
								?>
							</span>
						</li>
					</ul>
					<!-- 修改介面 -->
					<!-- <style type="text/css">
						input{
							color: black;
						}
					</style> --> 

				</div>
				<!-- lower_literal END -->
				<?php
					}
				?>
			</div>
			<!-- literal_info END -->	
		</section>
 

		<section class="user_artWork">
			<!-- 左側每屏導覽 -->
		<!-- <div class="sidebar">  
				<p>我的作品</p>
			</div> -->
			<div class="graphic_info" >
				<img src="images/Record/demo/<?php echo $demoRow["demoCover"];?>" alt="" id="preview" style="min-width:300px">
			</div>
			<!-- literal_info START -->
			<div class="literal_info">
				<div class="artWork_name" id="albumName">
					<?php echo $demoRow["demoName"];?><!-- Ｄua  Lipa -->
				</div>
				<!-- <div id="skin"> -->
				<audio id="myMovie" width="640">
					<source src="images/Record/demo/<?php echo $demoRow["demoLink"];?>"> 
						<!-- japan.mp3 -->
						<!-- images/Record/demo/2019-02-17T05_05_22.761Z.mp3 -->
				</audio>
				<section>
					<div id="buttons">
						<button id="playButton">Play</button>
						<button id="stopButton">Stop</button>
						<!-- <button id="upButton">Up</button>
						<button id="downButton">Down</button>
						<button id="muteButton">UnMute</button> -->
					</div>
					<script type="text/javascript">
						if(<?php echo $demoRow["fundNo"];?> == "0"){
							document.getElementById("playButton").disabled = true;
							document.getElementById("stopButton").disabled = true;
						}else{
							document.getElementById("playButton").disabled = false;
							document.getElementById("stopButton").disabled = false;
						}

					</script>
					<div id="defaultBar" style="">

						<!-- 滑條皮膚BAR -->
						<!-- <button id="p_bar_changer" onclick="bar_change()" style="display: none;">Try it</button> -->
						<input id="p_Bar" type="range" min="0" max="100" value="0"   class="range">

						<!-- 舊的BAR -->
						<div id="progressBar"  style="display: none"></div>
					</div>
					<div style="clear:both;"></div>
				</section> 
				<div class="artWork_descript" id="albumDescript" style="word-break: break-all;">	
						<?php echo $demoRow["demoDescript"];?>
				</div>
				<div class="fundTotal" id="fundTotal"></div>
				<div class="fundStatusBar" id="fundStatusBar"></div>
				<div class="fundGoal" id="fundGoal"></div>	
			</div>
		</section>	

		


		<section class="user_order"> 
			<!-- 左側每屏導覽 -->
			<!-- <div class="sidebar">  ‧
				<p>我的訂單</p>
			</div> -->
			
				<div id="tab-orderTable">
				<ul class="tab-title">
						<li id="#tab01">募資贊助</li>
						<li id="#tab02">購買紀錄</li>
						<li id="#tab03">預購課程</li>
				</ul>

				<?php
					if( $errMsg != ""){
						exit("<div><center>$errMg</center></div>");
					}
				?>	 

				<div id="tab01" class="tab-inner">
				<table class="typeA">
					<thead>
						<tr>
							<th></th><th>姓名</th><th>編號</th><th>金額</th><th>日期</th>
						</tr>
					</thead>
				<tbody>
				<?php	
					while($donateRow = $donate->fetch(PDO::FETCH_ASSOC)){
				?>	
					<form action="">
					<tr>
						<td><img src="images/user/memAvatar/
							<?php echo $donateRow["memAvatar"];?>" alt="">
						</td> 
						<td class="memNo" >
							<?php echo $donateRow["memName"];?>				
						</td> 
						<td><?php echo $donateRow["donateNo"];?></td> 
						<td><?php echo $donateRow["donation"];?></td> 
						<td><?php echo $donateRow["donateDate"];?></td>
						<!-- <td>
							<input class="getlinkdetail" 
							type="button" value="詳細">
						</td> -->
					</tr>
					</form>
				<?php
					}
				?>
				</tbody>
				</table> 
				
				<!-- -- -- -- -- -- -- -- -- -- -- -- -- 跳換資料頁 -- -- -- -- -- -- -- -- -- -- -- -- -- 	 --> 
			        <div class="pageBar" style="display:compact;text-align:center">
								<?php
								echo "<a href='?pageNo_t1=1#tab01'>第一頁</a>&nbsp";
								for($i=1; $i <= $TotalPage_t1;$i++){
									if($i==$pageNo_t1)
										echo "<a href='?pageNo_t1=$i#tab01' style='color:deepPink'>",$i,"</a>&nbsp&nbsp";
									else
										echo "<a href='?pageNo_t1=$i#tab01'>",$i,"</a>&nbsp&nbsp";
								}
								echo "<a href='?pageNo_t1=$TotalPage_t1#tab01'>最後一頁</a>&nbsp";
								?>
							</div>  
				</div>
					
				<?php
				  if( $errMsg != ""){
				  	exit("<div><center>$errMg</center></div>");
				  }
				?>	

				<div id="tab02" class="tab-inner">
					<table class="typeA">
						<thead>
							<tr>
								<th id="emptyThead"><!--空標題--></th><th>專輯</th><th>訂購日</th><th>數量</th><th>總額</th>
							</tr>
						</thead>
						<tbody>
						<?php	
							while($orderDiskRow = $orderLink->fetch(PDO::FETCH_ASSOC)){
						?>	
							<form action="CDPage_sell(AJAX).php" method="get"><!-- action="cartAdd.php" -->
							<tr>
								<td class="tab02_albumCover"><img src="images/CDWall/records/<?php echo $orderDiskRow["albumCover"];?>" alt=""></td> 
								<!-- <td class="albumNo" ><?php //echo $orderDiskRow["albumNo"];?></td>  -->
								<td><?php echo $orderDiskRow["albumName"];?></td> 
								<td><?php echo $orderDiskRow["orderDate"];?></td>
								<td><?php echo $orderDiskRow["diskQty"];?></td> 
								<td><?php echo $orderDiskRow["diskTotal"];?></td> 
								<!-- <td><?php //echo $orderDiskRow["linkPrice"];?></td> -->
								<td>
									<input type="hidden" name="albumNo" value="<?php echo $orderDiskRow['albumNo'] ?>">
									<input class="getlinkdetail" type="submit" value="專輯簡介">
								</td>
							</tr>
							</form>
						<?php
							}
						?>
						</tbody>
					</table> 
 
				
			<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- 跳換資料頁 -- -- -- -- -- -- -- -- -- -- -- -- 	 -->

					<div class="pageBar" style="display:compact;text-align:center">
						<?php
						echo "<a href='?pageNo_t2=1#tab02'>第一頁</a>&nbsp";
						for($i=1; $i <= $TotalPage_t2;$i++){
							if($i==$pageNo_t2)
								echo "<a href='?pageNo_t2=$i#tab02' style='color:deepPink'>",$i,"</a>&nbsp&nbsp";
							else
								echo "<a href='?pageNo_t2=$i#tab02'>",$i,"</a>&nbsp&nbsp";
						}
						echo "<a href='?pageNo_t2=$TotalPage_t2#tab02'>最後一頁</a>&nbsp";
						?>
					</div>
				</div> 
					
				<?php
					if( $errMsg != ""){
						exit("<div><center>$errMg</center></div>");
					}
				?>	

				<div id="tab03" class="tab-inner"> 
				<table class="typeA">
					<thead>
						<tr>
							<th></th><th>課程</th><th>老師</th><th>訂購日</th><th>上課日期</th><th>總額</th>
						</tr>
					</thead>
					<tbody>
					<?php	
						while($classRow = $class->fetch(PDO::FETCH_ASSOC)){
					?>	
						<form action="">
							<tr>
								<td></td>
								<td><?php echo $classRow["className"];?></td>
								<td><?php echo $classRow["teacherName"];?></td> 
								<td><?php echo $classRow["orderDate"];?></td> 
								<td><?php echo $classRow["classDate"];?></td> 
								<td><?php echo $classRow["orderTotal"];?></td>
								<!-- <td>
									<input class="getlinkdetail" 
									type="button" value="詳細">
								</td> -->
							</tr>
						</form>
					<?php
						}
					?>
					</tbody>
				</table> 
				
				<!-- -- -- -- -- -- -- -- -- -- -- -- -- -- 跳換資料頁 -- -- -- -- -- -- -- -- -- -- -- -- 	 -->

			    <div class="pageBar" style="display:compact;text-align:center">
						<?php
						echo "<a href='?pageNo_t1=1#tab03'>第一頁</a>&nbsp";
						for($i=1; $i <= $TotalPage_t1;$i++){
							if($i==$pageNo_t1)
								echo "<a href='?pageNo_t1=$i#tab03' style='color:deepPink'>",$i,"</a>&nbsp&nbsp";
							else
								echo "<a href='?pageNo_t1=$i#tab03'>",$i,"</a>&nbsp&nbsp";
						}
						echo "<a href='?pageNo_t1=$TotalPage_t1#tab03'>最後一頁</a>&nbsp";
						?>
					</div>
				</div>
			</div>
		</section> 

		<section class="user_collection">
			<!-- <div class="sidebar"> -->  <!-- 左側每屏導覽 -->
				<!-- <p>我的唱片</p> -->
			<!-- </div> -->

			<table >
				<tbody>
				<?php	
					while($orderLinkRow = $orderLinkAll->fetch(PDO::FETCH_ASSOC)){
				?>	
 					<tr>
						<td>
							<ul class="album_pic"> 
								<li>
									<img src="images/CDWall/records/
									<?php echo $orderLinkRow["albumCover"];?>" alt="">  
								</li>
								<li>
									<ul class="p_album_inner">
										<li class="albumName">
											<?php echo $orderLinkRow["albumName"];?>
										</li>
										<li class="albumSinger">
											<?php echo $orderLinkRow["albumSinger"];?>	
										</li>
										<li class="saleCount">
											<?php echo "*".$orderLinkRow["saleCount"];?>	
										</li>
									</ul>
								</li>
							</ul>
							<ul class="album_inner">
								<li class="albumName">
									<?php echo $orderLinkRow["albumName"];?>
								</li>
								<li class="albumSinger">
									<?php echo $orderLinkRow["albumSinger"];?>	
								</li>
								<li class="saleCount">
									<?php echo "*".$orderLinkRow["saleCount"];?>	
								</li>
								<li>
									<audio controls src="images/CDWall/records/
									<?php echo $orderLinkRow["albumLink"];?>"
									onplay="pauseAll(<?php echo $orderLinkRow["albumNo"];?>)">
										<?php echo $orderLinkRow["albumNo"];?>
									</audio>
								</li>
							</ul>
						</td>						
					</tr>
 				<?php
					}
				?>
				</tbody>
				
			</table> 
		</section>


	</div>
	<!-- 如果已登入 else{}  -->
	<?php
		}
	?> 

	<!-- <section class="footer width1700"></section> -->
	<section class="section fp-auto-height">
			<div class="footer" style="text-align: left;">
			<div class="copyright">
				<div>copyright © </div>
				<span>starway</span>
			</div>
			<div class="trd" style="font-size: 10px;" >
				<!-- 暫連官網 -->
				<a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
				<a href="https://www.google.com/"><img src="images/g.png" alt="g+.png"></a>
				<a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
			</div>
		</div>
	</section>



	<!-- <script type="text/javascript">
		//測試撈取專輯編號 t02 typeA
		let some = document.getElementsByClassName("albumNo")[0].innerHTML
		alert(some);
	</script> -->

	<script type="text/javascript">
		//-- -- -- -- -- -- 	
		//@@ 會員資料修改按鈕
		//-- -- -- -- -- --  

		let btn = document.getElementById("btnModify");
		let normal = document.getElementsByClassName("normal_mode");
		let modify = document.getElementsByClassName("modify_mode");

		//設定初始介面
		window.onload=begin;
		function begin(){ 
			for (i = 0; i < modify.length; i++) {
			  modify[i].style.display = "none";
			}
			btn.innerHTML = "修改資料";
			document.getElementById("upFile").disabled = true;
			document.getElementById("upFile").style.display = 'none';
			document.getElementById("upFile_skin").style.display = 'none';		
			 
		}
		//設定按鈕動作
		  btn.addEventListener("click", () => { 
		  		if(btn.innerHTML === "修改資料" ){
	          		btnModify.innerHTML = "確認送出";

	        //開啟 - 修改狀態欄位(會員資料) 
					for (i = 0; i < normal.length; i++) {
					  normal[i].style.display = "none";
					}
					for (i = 0; i < modify.length; i++) {
					  modify[i].style.display = "block";
					}
					//點圖上傳按鈕開啟
					$id("upFile").disabled = false;
					// $id("upFile").style.display = 'block';	
					$id("upFile_skin").style.display = 'block';	
					$id("cancelPic").style.display = 'block';	
				}else if(btn.innerHTML === "確認送出" ){
					btnModify.innerHTML = "修改資料"; 

					//開啟 - 檢視狀態欄位(會員資料)
					for (i = 0; i < modify.length; i++) {
					  modify[i].style.display = "none";
					}
					for (i = 0; i < normal.length; i++) {
					  normal[i].style.display = "block";
					}
					//若有選擇圖檔->自動按下確認
					if(file!=null)
				  	$('#submitPic').trigger('click'); 
				  	//點圖上傳按鈕關閉 
				  	$id("upFile").disabled = true;
				  	// $id("upFile").style.display = 'none';
				  	$id("upFile_skin").style.display = 'none';
				  	$id("cancelPic").style.display = 'none';	
						//性別勾選判斷	 
						let $sex;
						radiobtn_m = document.getElementById("sex_m");
						radiobtn_m.checked == true?$sex=1:$sex=0; 
						//送出會員資料更新值 
						sendForm();
				  		

				  	//-- -- -- -- -- -- -- -- -- -- -- -- 
					function sendForm(){
					  //=====使用Ajax 回server端,取回登入者姓名, 放到頁面上 
					  let xhr = new XMLHttpRequest();
					  xhr.onload = function(){
					  	console.log(xhr.responseText);
					  }

					  if(file!=null)
					  $fileName = file.name;
					  else
					  $fileName = null;
					
					  xhr.open("Post", "UpdateMemberInfo.php", true);
					  xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
					  let memberInfo = {
					  	memAvatar  :$fileName,
					    memName :$id("_memName").value,
					    phone	:$id("phone").value,
					    email 	:$id("email").value,
					    sex 	:$sex,
					    birthDate :$id("birthDate").value
					  }
					  
					  xhr.send("memberInfo="+ JSON.stringify(memberInfo)); 
					  	console.log(document.getElementById('_memName').value);

					  	console.log($id("phone").value);
					  	console.log($id("email").value);
					    console.log(JSON.stringify(memberInfo));

					    //刷新頁面->讀取新會員資料
					    //(若只單獨改文字資料 未上傳圖檔)
					    if(file==null)
					    location.reload();
					    
					}//sendForm	 
					//-- -- -- -- -- -- -- -- -- -- -- -- 

				}//else if
    	  });//btn
	</script>	

	<script type="text/javascript"> 
		//-- -- -- -- --	
		//@@會員性別修改
		//-- -- -- -- --	

		// $sex = '';
		// $memRow["sex"] == 1 ? $sex='男':$sex='女';
		//預設原會員性別
		sexNum = <?php echo $memRow["sex"];?>;
		// console.log(sexNum);
		switch (sexNum){
			 	case 0:
		        radiobtn = document.getElementById("sex_f");
				radiobtn.checked = true;
				// console.log("sex_f: "+radiobtn.value);
		        break;
	   		case 1:
		        radiobtn = document.getElementById("sex_m");
				radiobtn.checked = true;
				// console.log("sex_m: "+radiobtn.value);
		        break;
	    }
	</script>


	<script type="text/javascript">
		//-- -- -- -- --	
		//@@會員大貼修改
		//-- -- -- -- --	

		function $id(id){
			return document.getElementById(id);
		} 
		let file = null;
		function init(){
		  $id("upFile").onchange = function(e){
			  	//選擇圖檔後展示預覽
		  	file = e.target.files[0];
		  	let reader = new FileReader();
		  	reader.onload = function(){
		  		$id("memAvatar").src = reader.result;
		  	}
		  	reader.readAsDataURL(file);  
		  	console.log(file.name);//獲得圖檔名稱
		  }
		}	
		window.addEventListener("load", init, false);	
	</script>  


	<script type="text/javascript">	
		//-- -- -- -- --	
		//@@募資狀態條	
		//-- -- -- -- --	

		//參考二
		//https://www.zhihu.com/question/264684026
		//https://blog.csdn.net/sinat_40603210/article/details/78233960
		//https://github.com/bevacqua/insert-rule

		let fundTotal = <?php echo $demoRow["fundTotal"];?>;//320000;
		let fundGoal = <?php echo $demoRow["fundGoal"];?>;//500000;
		
		let len = fundTotal/fundGoal*100;
		let strLen=len+'%';
		let strPad=(len*0.5)+'%';
		document.getElementById("fundTotal").innerHTML = '目前募款: '+fundTotal;
		document.getElementById("fundGoal").innerHTML = '達標額: '+fundGoal;
		document.styleSheets[0].insertRule('#fundStatusBar::after { width: '+strLen+' }', 0);
		document.styleSheets[0].insertRule('#fundStatusBar::after { padding-left: '+strPad+' }', 0);
		document.styleSheets[0].insertRule('#fundStatusBar::after { content:"'+strLen+'" }', 0); 			
	</script>		



	<script type="text/javascript">
		//-- -- -- -- --	
		//@@ 音源詳細資訊(目前廢棄)
		//-- -- -- -- --	 
		  
				// $(document).ready(function(){
				// 		$(".getlinkdetail").bind("click",getlinkdetail);	            
				// });

        function getlinkdetail(e){
          //取得按鈕所屬專輯編號
          let albumNo=$(this).parent().parent().children("td")[1].innerHTML;
          //取得音源資訊
	        let xhr = new XMLHttpRequest();
	        xhr.onload = function(){
	            if( xhr.responseText == "{}"){
	            	alert("錯誤");
	            }else{
	            	let albumRow = JSON.parse(xhr.responseText);
		            alert(
	            	`${albumRow.albumCover}
	            	 ${albumRow.albumName}
	            	 ${albumRow.albumSinger}
	            	 ${albumRow.albumDescript}
	            	 ${albumRow.saleCount}`
	            	);
	            }
	        }
	        xhr.open("Post", "getLinkDetail.php", true); 
	        xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	        xhr.send(`albumNo=${albumNo}`); 
        }
	</script>


	<script type="text/javascript">
		//-- -- -- -- --	
		//@@ TAB換頁事件
		//-- -- -- -- --	

		$(function(){
		    let $li = $('ul.tab-title li');
		        $($li. eq(tabNum) .addClass('active').attr('id')).siblings('.tab-inner').hide();
		    
		        $li.click(function(){
		            $($(this). attr ('id')).show().siblings ('.tab-inner').hide();
		            $(this).addClass('active'). siblings ('.active').removeClass('active'); 
		        });
		    });
	</script>

	<script type="text/javascript"> 
		//-- -- -- -- --	
		//@@音樂專輯播放-停下其他	
		//-- -- -- -- --	

		let audios = document.getElementsByTagName("audio");
		function pauseAll(innerHTML) {			 
		    let self = innerHTML;
		    [].forEach.call(audios, function (i) {
		        // 将audios中其他的audio全部暂停
		        if(i.innerHTML == self ){
		        	i.play();
		        }else{
		        	i.pause();
		        }
		    })
		} 
	</script>

	<script type="text/javascript">
		//-- -- -- -- -- -- 	
		//@@ TAB頁面載入跳至錨點
		//-- -- -- -- -- -- 

		let tabNum;
		function GOTO(){ 
			if((location.href).match("tab02")!=null)
			tabNum=1;
			else if((location.href).match("tab01")!=null)
			tabNum=0;	
		    else
			tabNum=0;	  
		}
		window.addEventListener('load',GOTO(),false); 


		//-- -- -- -- -- -- 	
		//@@ 畫面大小適應文字
		//-- -- -- -- -- -- 

		window.onresize = resizeDetailBtn;  
		function resizeDetailBtn(){	
			let detailBtn = document.getElementsByClassName("getlinkdetail");
		  let	emptyThead = document.getElementById("emptyThead");
				for(i = 0 ;i<=detailBtn.length-1;i++){
						if(window.screen.width>414){
							detailBtn[i].value = "專輯簡介"; 
				    }else{
				      detailBtn[i].value = "簡介"; 
				    } 
				}
				if(window.screen.width>414){
							emptyThead.style.display = ""; 
				    }else{
							emptyThead.style.display = "none"; 
				    } 
				
		}
 
		window.addEventListener('load',resizeDetailBtn(),false);  
	</script>



	
	<!-- TweenMax-->
	<script src="js/TweenMax/Tweenmax.js"></script>
	<script src="js/memLogin.js"></script>
	<script src="js/mediaControl.js"></script> 


	<!-- logo墜落 -->
	<script src="js/Logo_neon.js"></script>

</body>
</html>