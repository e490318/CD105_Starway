<?php
ob_start();
session_start();
 

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>星路-節奏遊戲</title>
  <!-- <link rel="stylesheet" type="text/css" href="assets/style.css" /> -->

  <!-- // 以下兩種設定都可以防止使用者做畫面縮放，將畫面鎖在縮放比例 100% -->
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

  <!-- <meta name="viewport" content="width=device-width, initial-scale=1" > -->

  <script type="application/javascript" src="tapu_no_tatsujin-master/lib/bundle_out.js"></script>
  <script src="https://code.createjs.com/easeljs-0.8.2.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy|Roboto" rel="stylesheet">
  <!-- <link rel=“shortcut icon” href=“”> -->
  <link rel="shortcut icon" href="">




  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- favicon -->
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <!-- 自己的CSS -->
  <link rel="stylesheet" type="text/css" href="css/style_H_RhythmGame_test.css">
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
      <div class="sidebar">
        <p>節奏遊戲</p>
      </div>
    </section>
  </header>

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


  <!-- 燈箱顯示 - 會員登入 -->
  <section id="memLoginShow" class="modal">
    <form id="memContainer" class="disppear">
      <div id="memberImg">
        <img src="images/Login/vinil.png">
        <span onclick="document.getElementById('memLoginShow').style.display='none'" class="close"
          title="Close Modal">&times;</span>
        <h4>會員登入</h4>
      </div>
      <div id="memInfoCheck">
        <input class="member" type="text" name="memId" id="memId" placeholder="請輸入您的帳號"><br>
        <input class="member" type="password" name="memPsw" id="memPsw" placeholder="請輸入您的密碼"><br>
        <button type="button" id="btnLogin"
          onclick="document.getElementById('memLoginShow').style.display='none'">登入</button>
      </div>
      <div id="memInfoReg">
        <a class="forgotPsw" href="#">忘記密碼</a>
        <a class="memberReg" href="memRegister.html">會員註冊</a>
      </div>
    </form>
  </section>

  <!-- 燈箱顯示 - 遊戲結果 -->
  <section id="gameOver">
    <div id="gameOverBox">
      <div id="couponImg"></div>
      <div id="score"></div>
      <button id="getCoupon">領取優惠券</button>
      <button id="regame">重新遊戲</button>
      <button id="cancel">選其他風格</button>
      <button id="toMenu">回主選單</button>
    </div>
  </section>
  <!-- $('#NotLogged').css({"display":"block"}); -->


  <div class="width1200">
    <div class="all-container">

      <input type="checkbox" id="sidebar_ctr">
      <label class="sidebar_ctr" for="sidebar_ctr"></label>

      <div class="info-container">
        <div class="info-intro-container">
          <h2>遊戲規則</h2>
          <p>
            在鍵盤上，點擊「Z」「X」「空白鍵」與「C」，當節奏到達底部霓虹燈區域時，在最佳時機點擊才能獲得分數。</p>
        </div>
        <!-- On your keyboard, tap "C", "B", or "M" as the smiling tap reach to the bottom indicated area. You will need to to tap at the best timing to get score. -->

        <div class="info-level-container">
          <h2>音樂風格</h2>
          <button id="level-beginner">幽谷之境</button>
          <button id="level-normal">時感輕觸</button>
          <button id="level-master">爵士咖啡</button>
        </div>

        <div class="info-music-container">
          <h2>音樂</h2>
          <button id="info-music-mute-button">靜音</button>
          <input id="volume" type="range" min="0" max="100" value="25" class="range blue">
          <!--  <li><input type="range" min="0" max="100" value="0" class="range blue"/></li> -->
        </div>

      </div>

      <div class="game-container">
        <canvas id="gameCanvas" width="520" height="600"></canvas>
        <!-- width="400" -->
      </div>
      <!--info-container END-->

      <div class="scoreboard-container">
        <div class="scoreboard-score-container">
          <h2>分數</h2>
          <h3 id="my-score" class="score">0<h3>
              <h2>失誤</h2>
              <h3 id="my-miss" class="score">0<h3>
        </div>

        <div class="scoreboard-button-container">
          <button id="reset">重玩一次</button>
          <button id="stop">停止遊戲</button>
        </div>

        <div class="control-panel">
          <button id="btnLeft"></button>
          <button id="btnRed"></button>
          <button id="btnNew"></button>
          <button id="btnRight"></button>
        </div>

      </div>
      <style>

      </style>
      <!--scoreboard-container END-->

      <!-- <div class="control-panel" id="control-panel-phone">
        <button id="btnLeft"></button>
        <button id="btnRed"></button>
        <button id="btnRight"></button>
      </div> -->
    </div>
    <!--all-container END-->
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
        <a href="https://www.google.com/"><img src="images/g.png" alt="g+.png"></a>
        <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
      </div>
    </div>
  </section>

  <!-- TweenMax-->
  <script src="js/TweenMax/Tweenmax.js"></script>
  <script src="js/Logo_neon.js"></script>
  <script src="tapu_no_tatsujin-master/lib/bubbly-bg.js"></script>
  <script src="tapu_no_tatsujin-master/lib/my_memReg.js"></script>
  <script src="js/memLogin.js"></script>


</body>

</html>