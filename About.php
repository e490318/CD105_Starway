<?php
ob_start();
session_start();

if(isset($_SESSION["memNo"]) ==true){ //從session裡確認是否有memNo的變數。若有該變數，則宣告一個Session_memNo變數等於session裡的memNo,目的是要讓javascript去抓可以用這個PHP的變數，來判斷是否有登入
    $Session_memNo = $_SESSION["memNo"];
}else{
    $Session_memNo = 0;
}
?>
<!DOCTYPE html>
<head>

<meta charset="UTF-8">
<title>星路-說星路</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- favicon -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="
sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous"> -->


<!-- 自己的CSS -->
<link rel="stylesheet" type="text/css" href="css/style_Y.css">
<!-- Timeline 用的bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/Timeline/Timeline_style.css">

<!-- flipster CSS -->
<link rel="stylesheet" type="text/css" href="css/jQuery flipster/jquery.flipster.css">

<!-- jQuery-->
<script src="js/jquery-3.3.1.min.js"></script>

<!-- Timeline-->
<script src="js/Timeline/timeLine.js"></script>
<!-- jQuery flipster成員介紹-->
<script src="js/jQuery flipster/jquery.flipster.min.js"></script>
 <script src="js/about.js"></script>
 <!-- <script src="js/notLoginYet.js"></script> -->

<style>
    body{
        /* 字型加在這頁的用意是若放在scss裡，會被bootstrap的scaffolding.less裡的CSS樣式吃掉，雖然可以花時間去更改scaffolding.less裡字型的樣式，但目前最快的做法還是先放在這比較快，之後有時間再改*/
        font-family: Microsoft JhengHei;
    }
    
    /* 下面這些flip的CSS是成員介紹套件用的CSS，這是我自己加的，為了要配合TweenMax的動畫設定的 */
    .flipster__item__content{
        overflow: hidden; 
    }

    .flipster--coverflow .flipster__item__content img:only-child{
        transform: translateY(170px);
        opacity: 0;
    }

    .flip-items li img{
        border-radius: 10px !important;
        border: 7px solid rgba(255, 255, 255, .6); 
        /*border: 7px solid rgba(34, 21, 43, .6); */

        box-shadow: 2px 2px 7px 1px rgba(255, 255,255, .7);
        /* max-width: 82%; */
        display: none;


    }
    .menu li:nth-child(6) a {
    color: rgba(255, 255, 255, 1);
    text-shadow: 0 0 15px rgba(255, 0, 106, 0.8);


}



</style>
</head>

<body>
    <canvas id="canvas"></canvas>
    <!-- 燈箱顯示 - 還未登入 -->
    <section id="NotLogged">
        <div id="NotBtnBox">
            <p>您還沒登入</p>
            <button id="reBtn">返回</button>
            <button id="GoToBtn">登入</button>
        </div>
    </section> 

   <header>
        <section class="mainBar">
            <input type="checkbox" id="menu_ctr">
            <label class="menu_ctr" for="menu_ctr"></label>
            <div class="logo L_logo">
                <a href="index.html" id="logo" class="L_btn"></a>
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
                    <li class="login_mobile"><a class="menu_items " href="cartPage.php"><i class="fas fa-shopping-cart"></i></a></li>
                </ul>
            </nav>
          <div class="nav_user">
                <a a onclick="checkToUser()"><i class="fas fa-user"></i></a>
                 <span id="memName">&nbsp;</span>   <!-- 使用者姓名 -->
                 <span id="spanLogin" onclick="document.getElementById('memLoginShow').style.display='block'" style="width:auto;">登入</span>
                <a href="cartPage.php"><i class="fas fa-shopping-cart"></i></a>
            </div>
        </section>
    </header>

    <!-- 燈箱顯示 - 會員登入 -->
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

    <!-- 品牌理念 -->
    <section class="width1200">
        <ul id="Y_idealInfo">
        	<li>
        		<h2>品牌理念</h2>
        		<p>2004年，星路音樂成立，剛開始只是簡單喜歡音樂的一群人一起創作並發行合輯，之後和許多音樂人合作並成立公司且順應網際網路的盛行，將專輯的購買轉往線上平台並提供線上音樂下載，成為第一間提供合法下載的音樂公司。 2015年因為選秀的熱潮，團隊為了促成各位有夢成為歌手的素人，打造全球第一募資專輯線上平台，只要能達成募資目標，星路音樂將會從零到有的完成一張屬於自己的專輯。 </p>
        	</li>
        	<li>
        		<img src="images/About/idealimg-1.jpg">
        	</li>
         </ul>

        </div>
   </section>

<!-- 星路歷程 -->
 <section id="Y_timeline">
    <h2>星路歷程</h2>
    <div class="timeLine">
            <div class="row">
                <div class="lineHeader hidden-sm hidden-xs"></div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item" >
                        <div class="caption">
                            <div class="Tstar center-block">
                                <span class="h4">27</span>
                                <span>Jan</span>
                                <span>2004</span>
                            </div>
                            <div class="image">
                                <img src="images/About/Timeline/timeline-1.jpg">
                                <div class="title">
                                    <h4>星路開始 <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h4>
                                </div>
                            </div>
                            <div class="textContent">
                                <p class="lead">星路音樂工作室成立並發行首張專輯《就是管不住嘴》，自此開始從事製作及發行音樂唱片。</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item">
                        <div class="caption">
                            <div class="Tstar center-block">
                                <span class="h4">15</span>
                                <span>Sep</span>
                                <span>2008</span>
                            </div>
                            <div class="image">
                                 <img src="images/About/Timeline/timeline-2.jpg">
                                <div class="title">
                                    <h4>正式啟程 <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h4>
                                </div>
                            </div>
                            <div class="textContent">
                                <p class="lead">星路音樂連續發行了好幾張百萬專輯，也因此創立音樂工廠，並正式成立公司。</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item">
                        <div class="caption">
                            <div class="Tstar center-block">
                                <span class="h4">18</span>
                                <span>Aug</span>
                                <span>2012</span>
                            </div>
                            <div class="image">
                                <img src="images/About/Timeline/timeline-3.jpg">
                                <div class="title">
                                    <h4>漸入佳境 <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h4>
                                </div>
                            </div>
                            <div class="textContent">
                                <p class="lead">經過十年的淬鍊，星路音樂工作團隊發現台灣選秀的熱度，決定幫有志成為歌手的夢想者們打造一個平台，只要募資成功，星路音樂就幫你發行專輯。</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item">
                        <div class="caption">
                            <div class="Tstar center-block">
                                <span class="h4">01</span>
                                <span>May</span>
                                <span>2012</span>
                            </div>
                            <div class="image">
                                <img src="images/About/Timeline/timeline-4.jpg">
                                <div class="title">
                                    <h4>發行專輯 <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h4>
                                </div>
                            </div>
                            <div class="textContent">
                                <p class="lead">經過十年的淬鍊，星路音樂工作團隊發現台灣選秀的熱度，決定幫有志成為歌手的夢想者們打造一個平台，只要募資成功，星路音樂就幫你發行專輯。</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item">
                        <div class="caption">
                            <div class="Tstar center-block">
                                <span class="h4">14</span>
                                <span>Apr</span>
                                <span>2015</span>
                            </div>
                            <div class="image">
                                <img src="images/About/Timeline/timeline-5.jpg">
                                <div class="title">
                                    <h4>展翅高飛 <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h4>
                                </div>
                            </div>
                            <div class="textContent">
                                <p class="lead">星路音樂已經成功幫各位歌手們製作專輯，並成為全球第一的募資音樂平台。
                            星路音樂也開始舉辦募資新人歌手演唱會，是台灣第一場全素人歌手演唱會。</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
</section>

<!-- 成員介紹 -->
<div id="Y_member">
 <h2>眾星雲集</h2>
 <section id="coverflow">
        
        <ul class="flip-items">
            <li data-flip-title="Red">
                <img src="">
            </li>
            <li data-flip-title="Razzmatazz" data-flip-category="Purples">
                <img src="images/About/self_pic/W-min.png">
             </li>
            <li data-flip-title="Deep Lilac" data-flip-category="Purples">
                <img src="images/About/self_pic/L-min.png">
            </li>
            <li data-flip-title="Daisy Bush" data-flip-category="Purples">
                <img src="images/About/self_pic/A-min.png">
            </li>
            <li data-flip-title="Cerulean Blue" data-flip-category="Blues">
                <img src="images/About/self_pic/Y-min.png">
            </li>
            <li data-flip-title="Dodger Blue" data-flip-category="Blues">
                <img src="images/About/self_pic/J-min.png">
            </li>
        </ul>

</section>       
 </div>

   <script>
</script>

<section class="footer width1700">
  <div class="copyright">
      <div>copyright © </div>
      <span>starway</span>
  </div>
  <div class="trd">
      <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
      <a href="https://www.google.com/"><img src="images/g.png" alt="g+.png"></a>
      <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
  </div>
</section>



 <!-- 背景Canvas-->
 <script  src="js/about_canvas.js"></script>
 <!-- TweenMax-->
 <script src="js/TweenMax/Tweenmax.js"></script>
  <!-- TweenMax-->
 <script src="js/Timeline/Timeline_script.js"></script>
 <script src="js/Logo_neon.js"></script>
 <script src="js/memLogin.js"></script>
 <script src="js/jquery-stars.js"></script>
<script>
$(document).ready(function() {
$('body,html').jstars({
        image_path: 'images',
         // image: 'jstar-map.png',
        style: 'white',
        frequency: 16   });


// $('body,html').jstars({
//  image_path: 'images',
//  // image: 'jstar-map.png',
//  style: 'rand',
//  width: 27,
//  height: 27,
//  frequency: 25,
//  style_map: {
//      white: 0,
//      blue: -27,
//      green: -54,
//      red: -81,
//      yellow: -108
//  },
//  delay: 300
// });

}); 

</script>
</body>

</html>
