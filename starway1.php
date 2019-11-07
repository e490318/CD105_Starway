<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>星路</title>
	<!-- favicon -->
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
	 crossorigin="anonymous">

	<!-- 自己的CSS -->
	<link rel="stylesheet" type="text/css" href="css/fullpage.css">
	<link rel="stylesheet" type="text/css" href="css/style_L.css">
	<link rel="stylesheet" type="text/css" href="css/style_A_index.css">
	<!-- jQuery-->
	<script src="js/jquery-3.3.1.min.js"></script>
	<!-- jQuery.js v1.11.1 -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<!-- OwlCarousel -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css">
	</link>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.min.css">
	</link>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/owl.carousel.min.js"></script>
	<script src="js/jquery-ui.min.js">
	</script>


	<!-- This following line is optional. Only necessary if you use the option css3:false and you want to use other easing effects rather than "linear", "swing" or "easeInOutCubic". -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/jquery.easings.min.jss"></script> -->

	<!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/scrolloverflow.min.js"></script>

	<!-- fullPage.js v2.9.5 -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.js"></script>


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
				<a href="starway.html" id="logo" class="L_btn"></a>
				<img class="logo_b" src="images/logo_b.png" alt="logo.png">
				<audio id="neonSound" src="sounds/neon.mp3"></audio>
				<div id="L_box"></div>
			</div>
			<nav>
				<ul class="menu">
					<li><a class="menu_items" href="CDWall.html">募唱片</a></li>
					<li><a class="menu_items" href="CDWall_sell.html">購唱片</a></li>
					<li><a class="menu_items" href="Record.html">做專輯</a></li>
					<li><a class="menu_items" href="Game.html">賺酷碰</a></li>
					<li><a class="menu_items" href="Class.html">買課程</a></li>
					<li><a class="menu_items" href="About.html">說星路</a></li>
					<li class="login_mobile"><a class="menu_items " href="user.html"><i class="fas fa-user"></i></a></li>
					<li class="login_mobile"><a class="menu_items " href="#"><i class="fas fa-shopping-cart"></i></a></li>
				</ul>
			</nav>
			<div class="nav_user">
				<a href="user.html"><i class="fas fa-user"></i></a>
				<a href="cartPage.php"><i class="fas fa-shopping-cart"></i></a>
			</div>
			<!-- <div class="sidebar"> -->
			<!-- 左側每屏導覽 -->
			<!-- <p>專輯客製</p> -->
			<!-- </div> -->
			<!-- <div class="star">
				右側星星
				<img src="images/star.png" alt="star.png">
				<img src="images/star.png" alt="star.png">
				<img src="images/star.png" alt="star.png">
				<img src="images/star.png" alt="star.png">
				<img src="images/star.png" alt="star.png">
			</div> -->
		</section>
	</header>


	<div id="fullPage-A">
		<!-- //第一屏 -->
		<div class="section L_index_wall_wrap">
			<!-- <div class="sidebar">
				左側每屏導覽
				<p>專輯客製</p>
			</div> -->
			<div class="L_index_wall_lingra">
				<img src="images/index/starwayy.png" alt="starwayy.png">
				<div>「 就是管不住嘴 」</div>
				<span>全球第一專輯募資平台</span>
				<span>至今已有</span>
				<span>
					<div>3,245,</div>
					<div id="L_index_wall_lingra_peop100">
						<div>9</div>
						<div>0</div>
						<div>1</div>
						<div>2</div>
						<div>3</div>
						<div>4</div>
						<div>5</div>
						<div>6</div>
						<div>7</div>
						<div>8</div>
						<div>9</div>
					</div><!-- 
					--><div id="L_index_wall_lingra_peop10">
						<div>9</div>
						<div>0</div>
						<div>1</div>
						<div>2</div>
						<div>3</div>
						<div>4</div>
						<div>5</div>
						<div>6</div>
						<div>7</div>
						<div>8</div>
						<div>9</div>
					</div><!-- 
					--><div id="L_index_wall_lingra_peop1">
						<div>9</div>
						<div>0</div>
						<div>1</div>
						<div>2</div>
						<div>3</div>
						<div>4</div>
						<div>5</div>
						<div>6</div>
						<div>7</div>
						<div>8</div>
						<div>9</div>
					</div>
				</span><!-- 
				--><span>歌手出道</span>
			</div>
			
			<div class="L_index_wall" id="L_index_wall">

				<!-- php開始 -->
				<div class="L_index_wall_line L_index_wall_line_1"></div>
				<div class="L_index_wall_line L_index_wall_line_2"></div>
				<div class="L_index_wall_line L_index_wall_line_3"></div>
				<div class="L_index_wall_line L_index_wall_line_4"></div>
				<div class="L_index_wall_line L_index_wall_line_5"></div>
				<div class="L_index_wall_line L_index_wall_line_6"></div>
				<div class="L_index_wall_line L_index_wall_line_7"></div>
				<div class="L_index_wall_line L_index_wall_line_8"></div>
				<div class="L_index_wall_line L_index_wall_line_9"></div>
				<div class="L_index_wall_line L_index_wall_line_10"></div>
	

				
				<script>
					$(document).ready(function() {
						//保留原方式
						// $.ajax({
						// 	url: 'L_index_wall_line_1.php',
						// 	dataType: 'text',
						// 	success: function(data){
						// 		$('.L_index_wall_line_1').html(data);
						// 	}
						// });

						$('.L_index_wall_line').each(function callPic(e) { 
							tar=$(this);
							console.log(`tar: ${tar}`);
							$.ajax({
								url: 'L_index_wall_line_1.php',
								dataType: 'text',
								async:false, //變成同步，等事情做完才做下一件事
								success: function(data){
									// console.log(data);
									tar.html(data);
								}
							});
						})
					});
				</script>
				<!-- php結束 -->

			</div>
		</div>


		<!-- //第二屏 -->
		<div class="section L_index_pop_wrap">
			<div class="sidebar1">
				<!-- 左側每屏導覽 -->
				<p>募資唱片牆</p>
			</div>

			<div class="L_index_pop_wrap_inner">

				<!-- <div class="L_index_pop">
					<img src="../images/CDWall/reco.png" alt="reco.png">
					<div class="L_index_pop_cont">
						<span>墜落1</span>
						<a href="#">南瓜寶寶泥</a>
						<p>目標500,000元</p>
						<div class="L_index_pop_cont_line">
							<div></div>
							<div></div>
						</div>
						<p>已募得 235,400元</p>
						<p>3,578位贊助人</p>
						<a href="CDPage.html" class="L_index_addCart">
							<p>我想贊助</p>
						</a>
					</div>
				</div>

				<div class="L_index_pop">
					<img src="../images/CDWall/reco.png" alt="reco.png">
					<div class="L_index_pop_cont">
						<span>墜落2</span>
						<a href="#">南瓜寶寶泥</a>
						<p>目標500,000元</p>
						<div class="L_index_pop_cont_line">
							<div></div>
							<div></div>
						</div>
						<p>已募得 235,400元</p>
						<p>3,578位贊助人</p>
						<a href="CDPage.html" class="L_index_addCart">
							<p>我想贊助</p>
						</a>
					</div>
				</div>

				<div class="L_index_pop">
					<img src="../images/CDWall/reco.png" alt="reco.png">
					<div class="L_index_pop_cont">
						<span>墜落3</span>
						<a href="#">南瓜寶寶泥</a>
						<p>目標500,000元</p>
						<div class="L_index_pop_cont_line">
							<div></div>
							<div></div>
						</div>
						<p>已募得 235,400元</p>
						<p>3,578位贊助人</p>
						<a href="CDPage.html" class="L_index_addCart">
							<p>我想贊助</p>
						</a>
					</div>
				</div>

				<div class="L_index_pop">
					<img src="../images/CDWall/reco.png" alt="reco.png">
					<div class="L_index_pop_cont">
						<span>墜落4</span>
						<a href="#">南瓜寶寶泥</a>
						<p>目標500,000元</p>
						<div class="L_index_pop_cont_line">
							<div></div>
							<div></div>
						</div>
						<p>已募得 235,400元</p>
						<p>3,578位贊助人</p>
						<a href="CDPage.html" class="L_index_addCart">
							<p>我想贊助</p>
						</a>
					</div>
				</div> -->

			</div>
			<script>
				$(document).ready(function() {
					$.ajax({
						url: 'index_sec.php',
						dataType: 'text',
						success: function(data){
							$('.L_index_pop_wrap_inner').html(data);
							LsecClone();
						}
					});
				});
			</script>
			
			<div class="L_index_pop_swich">
				<ul>
					<div class="L_index_pop_swich_li">
						<li></li>
					</div>
					<div class="L_index_pop_swich_li">
						<li></li>
					</div>
					<div class="L_index_pop_swich_li">
						<li></li>
					</div>
					<div class="L_index_pop_swich_li">
						<li></li>
					</div>
					<div class="L_index_pop_swich_li">
						<li></li>
					</div>
				</ul>
			</div>
		</div>

		<!-- //第三屏 -->
		<div class="section A-record">

			<div class="width1200 A-page4th">
				<div class="sidebar3">
					<!-- 左側每屏導覽 -->
					<p>做專輯</p>
				</div>
				<h2 class="A-recordH2">製作屬於你自己的專輯，並參加募資</h2>
				<h3 class="A-recordH3">募資達標者，我們將會為您製作並發行專輯</h3>
				<!--步驟流程 start-->
				<div class="cuProcrss">
					<div class="cuPro cuPro1">
						<img class="A-CDStep" src="images/Login/vinil.png" alt="blackCD">
						<p>
							<img class="A-starStep" src="images/Record/star-with-number-1-01-01.png" alt="star-with-number-1">
							錄製20秒音樂
						</p>
					</div>
					<!-- <img class="A-star" src="images/star.png" alt="star.png">
					<img class="A-star" src="images/star.png" alt="star.png">
					<img class="A-star" src="images/star.png" alt="star.png"> -->
					<div class="cuPro cuPro2">
						<img class="A-CDStep" src="images/Login/vinil.png" alt="blackCD">
						<p>
							<img class="A-starStep" src="images/Record/star-with-number-2-02-02.png" alt="star-with-number-1">
							製作專輯封面
						</p>
					</div>
					<!-- <img class="A-star" src="images/star.png" alt="star.png">
					<img class="A-star" src="images/star.png" alt="star.png">
					<img class="A-star" src="images/star.png" alt="star.png"> -->
					<div class="cuPro cuPro3">
						<img class="A-CDStep" src="images/Login/vinil.png" alt="blackCD">
						<p>
							<img class="A-starStep" src="images/Record/star-with-number-3-03-03.png" alt="star-with-number-1">
							填寫專輯介紹
						</p>
					</div>
					<!-- <img class="A-star" src="images/star.png" alt="star.png">
					<img class="A-star" src="images/star.png" alt="star.png">
					<img class="A-star" src="images/star.png" alt="star.png"> -->
					<div class="cuPro cuPro4">
						<img class="A-CDStep" src="images/Login/vinil.png" alt="blackCD">
						<p>
							<img class="A-starStep" src="images/Record/star-with-number-4-04-04.png" alt="star-with-number-1">
							上架至募資牆
						</p>
					</div>
				</div>
				<!--步驟流程 end-->
				<div class="container">
					<div class="carousel">
						<div class="carousel__face"><span></span></div>
						<div class="carousel__face"><span></span></div>
						<div class="carousel__face"><span></span></div>
						<div class="carousel__face"><span></span></div>
						<div class="carousel__face"><span></span></div>
						<div class="carousel__face"><span></span></div>
						<div class="carousel__face"><span></span></div>
						<div class="carousel__face"><span></span></div>
						<div class="carousel__face"><span></span></div>
					</div>
				</div>
				<!-- <div class="record">
					<img src="images/Record/microphone.svg" alt="錄音">
				</div>
				<div id="controls">
					<button id="recordButton">錄音</button>
					<button id="stopButton" disabled>結束</button>
				</div>
				<div id="formats"></div>
				
				<ol id="recordingsList"></ol>
				<div class="mic">
					<img src="images/index/mic.png" alt="mic">
				</div> -->
				<h3><button id="A-nextButton">製作屬於自己的專輯</button></h3>
				


				<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
				<script src="js/app.js"></script>

			</div>


		</div>

		<!-- //第四屏 -->
		<div class="section A-gamePage">
			<div class="width1200 A-page3rd">
				<div class="sidebar2">
					<p>賺酷碰</p>
				</div>
				<div class="A-couponTiTle">
					<img class="coupon3" src="images/Test/50 coupon.png" alt="50酷碰券">
					<h2>玩遊戲，領取酷碰券，酷碰券可現折『 購唱片 』專輯!</h2>
					<img class="coupon4" src="images/Test/150 coupon.png" alt="150酷碰券">
					<div class="coupon">
						<img class="coupon1" src="images/Test/50 coupon.png" alt="50酷碰券">
						<img class="coupon2" src="images/Test/150 coupon.png" alt="150酷碰券">
					</div>
				</div>
				<div class="game-allA">
					<div class="star-game">
						<div class="sing-game">
							<a href="SoundTest.html">
								<img class="sing-gameImg" src="images/index/soundTest.png" alt="發聲練習">
								<div class="sing-game-content">
									<h4>發聲練習</h4>
									<p>透過錄音來進行聲音的音準比對，分析並得到成績後獲得酷碰券。</p>
								</div>
								<img class="gameLine" src="images/index/gameLine.png" alt="gameLine">
							</a>
						</div>
						<div class="clear-fix"></div>
						<div class="rhyme-game">
							<a href="tapu_no_tatsujin-master/RhythmGame.html">
								<img class="rhyme-gameImg" src="images/index/rhyme.png" alt="節奏遊戲">
								<div class="rhyme-game-content">
									<h4>節奏遊戲</h4>
									<p>透過手指點擊並跟著節奏，你可以得到節奏感的分數並獲得酷碰券。</p>
								</div>
								<img class="gameLine" src="images/index/gameLine.png" alt="gameLine">
							</a>
						</div>
						<div class="clear-fix"></div>
					</div>
				</div>
				<!-- <div class="slide">
					第三屏的第一屏
				</div>
				<div class="slide">
					第三屏的第二屏
				</div>
				<div class="slide">
					第三屏的第三屏
				</div>
				<div class="slide">
					第三屏的第四屏
				</div> -->
			</div>
		</div>


		<!-- //第五屏 -->
		<div class="section A-class">

			<div class="width1200">
				<div class="sidebar4">
					<!-- 左側每屏導覽 -->
					<p>買課程</p>
				</div>
				<h2 class="A-classH2">透過星路加值課程，來提升星值能力!</h2>
				<div class="owl-carousel owl-theme">
					<div class="A-classItem">
						<img src="images/index/sound1.png" alt="發聲練習">
						<h4>[初階]發聲訓練</h4>
						<p>健康正確的發聲方式是解決所有問題的方式，一旦達到，久唱不會累，音質不會變，高低也不成問題。</p>
						<button class="A-singUpButton">報名</button>
					</div>
					<div class="A-classItem">
						<img src="images/index/rym1.png" alt="節奏感練習">
						<h4>[初階]節奏感訓練</h4>
						<p>節奏是學習音樂過程中不可或缺的超級重點，其實大多數的音樂家都是經由學習而不斷精進節奏感的。</p>
						<button class="A-singUpButton">報名</button>
					</div>
					<div class="A-classItem">
						<img src="images/index/musicTest1.png" alt="樂理練習">
						<h4>[初階]樂理知識</h4>
						<p>學音樂，最基礎的就是要知道各種音的音階，瞭解音樂可以先從認識音階開始，樂理的知識是必要的。</p>
						<button class="A-singUpButton">報名</button>
					</div>
					<div class="A-classItem">
						<img src="images/index/sound2.png" alt="發聲練習">
						<h4>[進階]發聲訓練</h4>
						<p>健康正確的發聲方式是解決所有問題的方式，一旦達到，久唱不會累，音質不會變，高低也不成問題。</p>
						<button class="A-singUpButton">報名</button>
					</div>
					<div class="A-classItem">
						<img src="images/index/rym2.png" alt="節奏感練習">
						<h4>[進階]節奏感訓練</h4>
						<p>一首音樂的好壞，節奏擔負了很大比例的重責大任，因此節奏能力的良好，對於音樂性有著鉅大的影響。</p>
						<button class="A-singUpButton">報名</button>
					</div>
					<div class="A-classItem">
						<img src="images/index/musicTest2.png" alt="樂理練習">
						<h4>[進階]樂理知識</h4>
						<p>本課程以流行音樂基礎樂理知識，並能應用於創作、展演以及音樂製作為主要內容，建立樂理知識應用能力。</p>
						<button class="A-singUpButton">報名</button>
					</div>
				</div>

				<script>
					$('.owl-carousel').owlCarousel({
						center: true,
						items: 2,
						loop: true,
						// margin: 10,
						responsive: {
							0: {
								items: 1
							},
							600: {
								items: 2
							}
						}
					});
					$('.nonloop').owlCarousel({
						center: true,
						items: 2,
						loop: false,
						margin: 10,
						responsive: {
							600: {
								items: 4
							}
						}
					});
				</script>
			</div>
		</div>
		<section class="section fp-auto-height">
			<div class="footer" style="text-align: left;">
				<div class="copyright">
					<div>copyright © </div>
					<span>starway</span>
				</div>
				<div class="trd" style="font-size: 10px;">
					<!-- 暫連官網 -->
					<a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
					<a href="https://www.google.com/"><img src="images/g+.png" alt="g+.png"></a>
					<a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
				</div>
			</div>
		</section>

	</div>




	<script src="js/record.js"></script>
	<script>
		$("#fullPage-A").fullpage({
			// 參數設定[註1]
			navigation: true, // 顯示導行列
			navigationPosition: "right", // 導行列位置
			anchors: ['firstPage', 'secondPage', '3rdPage', '4thPage', '5thPage'],
			// sectionsColor: ['#C63D0F', '#1BBC9B', '#7E8F7C'],
		});
	</script>


	<!-- 第一屏滑鼠視差 -->
	<script>
		var Lwall = document.getElementById('L_index_wall');
		// Lwall.onmousemove = WallMove;	//在牆上抓取距離失敗

		window.onmousemove = WallMove;

		//抓取滑鼠座標
		function WallMove(e) {
			var mouseX = e.pageX;
			var mouseY = e.pageY;
			var winW = window.outerWidth;
			var winH = window.outerHeight;
			// console.log(mouseX,mouseY);
			// console.log((winW-mouseX)/70,(winH-mouseY)/50);

			var mouseMove = 1;

			Lwall.style.top = (winH - mouseY) / 30 + 'px';
			Lwall.style.left = (winW - mouseX) / 50 + 'px';

			//滑鼠移動時模糊
			Lwall.style.filter = 'blur(2px)';

			//滑鼠移動計時0.5秒後清楚
			setInterval(function () {
				Lwall.style.filter = 'blur(0px)';
			}, 500);

		}
	</script>

	<script>
		var Lswich = document.getElementsByClassName('L_index_pop_swich');
		var LswichLi = document.getElementsByClassName('L_index_pop_swich_li');
		var Linner = document.getElementsByClassName('L_index_pop_wrap_inner');

		//	為父層第幾個元素節點
		function getChildrenIndex(e) {

			var ind = 0;
			while (e = e.previousElementSibling) {
				ind++;
			}
			return ind;
		}


		console.log(Linner);
		for (var i = 0; i < LswichLi.length; i++) {

			LswichLi[i].onclick = function () {

				//抓取
				var indd = getChildrenIndex(this);

				var a;
				switch (indd) {
					case 0:
						a = 0;
						Linner.style.left = '0px';
						break;

					case 1:
						a = 1;
						break;

					case 2:
						a = 2;
						break;

					case 3:
						a = 3;
						break;

				}
				document.write(a);
			}
		}
	</script>



	<!-- TweenMax-->
	<script src="js/TweenMax/Tweenmax.js"></script>

	<!-- logo墜落 -->
	<script src="js/Logo_neon.js"></script>

	<!-- JQ sec圖片輪播clone第一個 -->
	<script>
		function LsecClone(){
			console.log(':D');

			var $IndexPop = $(".L_index_pop_wrap_inner");
			var $Clone = $IndexPop.children("form:first").clone();

			$Clone.appendTo($IndexPop);
		}
	</script>

</body>

</html>