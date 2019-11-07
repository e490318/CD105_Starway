<?php
ob_start();
session_start();
 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>星路-發聲練習</title>
    <!-- favicon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- 自己的CSS -->
    <link rel="stylesheet" type="text/css" href="css/style_H_SoundTest.css">
    <!-- jQuery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Tweenmax的Scroll套件-->
    <script src="js/TweenMax/ScrollToPlugin.min.js"></script>
    <!-- 搭配Scroll的ScrollMagic套件-->
    <script src="js/ScrollMagic/ScrollMagic.min.js"></script>
    <script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
    <script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
    <script src="js/stepProgress.js"></script>

    <style type="text/css">
         /* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --  */
            *{
                /*設定文字顏色 版本膚色*/
                color: black; /*背景淺色*/
                /* color: white; /*背景深色*/ 
            }

            /* 音樂圖像化 */
            #thefile {
              position: fixed;
              top: 10px;
              left: 10px;
              z-index: 100;
            }

            #canvas {
            /*  position: relative; 原fixed
              left: 0;*/
             /*  原top: 380px;
              width: 100%;
              height: 43%; */
       /*       top: 0;
              width: 100%;
              height: 100%;*/


              z-index: -1;
              position: relative;
              left: 225px;
              top: -418px;
              width: 142%;
              height: 282%;
              width: 106%;
            }
            #content{
                /* position: relative; */
            }

            audio {
              position: fixed;
              left: 10px;
              bottom: 10px;
              width: calc(100% - 20px);
            }


 /* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --  */
    </style>
</head>

<body>
    <script src="js/pitchdetect.js"></script>
    <script src="js/stepProgress.js"></script>
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
        <p>發聲練習</p>
      </div>
    </section>
  </header>



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
            <button id="toMenu">回主選單</button>
            <!-- <button id="cancel">取消</button>  -->
        </div>
    </section>

 

     <?php

    // 我們僅授權讓 140.115.236.72 網域來存取資源
    // 因為我們認為該網域存取本 application/xml 資源是安全的

    // if($_SERVER['HTTP_ORIGIN'] == "http://140.115.236.72") {
        // header('Access-Control-Allow-Origin: "*",
        // Access-Control-Allow-Headers:"Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        // header('Content-type: application/xml');
        // readfile('arunerDotNetResource.xml');
    // } else {    
      // header('Content-Type: text/html');
      // echo "<html>";
      // echo "<head>";
      // echo "   <title>Another Resource</title>";
      // echo "</head>";
      // echo "<body>",
      //      "<p>This resource behaves two-fold:";
      // echo "<ul>",
      //        "<li>If accessed from <code>http://arunranga.com</code> it returns an XML document</li>";
      // echo   "<li>If accessed from any other origin including from simply typing in the URL into the browser's address bar,";
      // echo   "you get this HTML document</li>", 
      //      "</ul>",
      //    "</body>",
      //  "</html>";
    // }
    ?>

    <div class="H_praticeArea width1700">
        <img class="soundtestBg" src="images/Test/secBg.png" alt="">
        <div class="H_steparea">
            <!-- 彈出對話 - 評論 -->
            <!-- <div id="comment">
                <p>音癡界的曠世奇才啊</p>
            </div> -->
            <div class="soundDemo">
                <img class="step1" src="images/Test/step1.png" alt="step1">
                <h2>聽一段</h2>
            </div>
            <div class="record">
                <img class="step2" src="images/Test/step2.png" alt="step2">
                <h2>錄一下</h2>
            </div>
            <div class="analyze">
                <img class="step3" src="images/Test/step3.png" alt="step3">
                <h2>領酷碰</h2>
            </div>
        </div>



        <div class="card step-progress">
            <div class="step-slider">
                <div data-id="step1" class="step-slider-item"></div>
                <div data-id="step2" class="step-slider-item"></div>
                <div data-id="step3" class="step-slider-item"></div>
            </div>
            <div class="step-content">
                <div class="step-content-body" id="step1">
                    <h2>想知道自己歌唱的功力如何嗎?<br>
                        趕快加入發聲練習的行列吧!
                    </h2>
                </div>
                <div class="step-content-body out" id="step2">
                    <p>按下播放鈕聆聽示範音檔後，音檔可重複播放，記住節奏與音調後再進行下一步</p>
                    <img class="playbtn" onclick="this.innerText = togglePlayback()" src="images/Test/play-button.png"
                        alt="play">
                </div>

                <div class="step-content-body out" id="step3">
                    <p>按下麥克風鈕後，開始模仿示範音檔之音調與節奏，並在結束時按下開始分析，系統將自動為您顯示結果。</p>
                    <img id="LiveInput" class="micbtn" src="images/Test/mic.png" alt="mic">
                    <button id="STOP">開始分析</button>

                <canvas id="canvas"></canvas>
                </div>


                <div class="step-content-body out" id="stepLast">
                    <h2>領取酷碰後，您必須將酷碰使用掉才能再度重玩遊戲，星路音樂感謝您的配合。</h2>
                    <div id="detector" class="vague">
                        <div class="pitch"><span id="pitch">--</span>Hz</div>
                        <div class="note"><span id="note">--</span></div>
                        <canvas id="output" width=300 height=42></canvas>
                        <div id="detune"><span id="detune_amt">--</span><span id="flat">cents &#9837;</span><span
                                id="sharp">cents
                                &#9839;</span></div>
                        <div class="record_note"><span id="record_note">--</span>Hz</div>
                    </div>
                </div>

                <div class="step-content-foot">
                    <button id="prev" type="button" class="active" name="prev">上一步</button>
                    <button id="next" type="button" class="active" name="next">下一步</button>
                </div>

            </div>
        </div>

        <!-- 頁尾 -->
        <section class="footer width1700">
        <div class="copyright">
            <div>copyright © </div>
            <span>starway</span>
        </div>
        <div class="trd">
            <!-- 暫連官網 -->
            <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
            <a href="https://www.google.com/"><img src="images/g.png" alt="g+.png"></a>
            <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
        </div>
    </section>


         <!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->

        <!-- 音量圖像化 -->
        <div id="content" style="position:relative; z-index: ">
          <!-- <input type="file" id="thefile" accept="audio/*" /> -->
          <canvas id="canvas"></canvas>
          <!-- <audio id="audio" controls></audio> -->       
        </div>

        <!-- <script  src="js/index.js"></script> -->

        <!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->


       


        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-35593052-1']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </div>

    
    <!-- TweenMax-->
    <script src="js/TweenMax/Tweenmax.js"></script>
    <script src="js/Logo_neon.js"></script>
    <script src="js/stepProgress.js"></script>
    <script src="js/memLogin.js"></script>
    <script>
        $(window).scroll(function () {

            var $srrollY = $(window).scrollTop();
            // console.log($srrollY);  //打開查看頁面高度

            var $Lsidebar = $('.H_web_sidebar');  //自己命名一個標籤

            if ($srrollY < 750) {  //頁面高度切換點
                // console.log(':D');
                $Lsidebar.children().html("熱銷排行");  //sidebar文字

            } else {
                $Lsidebar.children().html("強打專輯");
            }
        })
    </script>
</body>

</html>