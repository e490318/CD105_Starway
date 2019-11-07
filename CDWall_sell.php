<?php
ob_start();
session_start();
if(isset($_SESSION["memNo"]) ==true){ //從session裡確認是否有memNo的變數。若有該變數，則宣告一個Session_memNo變數等於session裡的memNo,目的是要讓javascript去抓可以用這個PHP的變數，來判斷是否有登入
 $Session_memNo = $_SESSION["memNo"];
 }
 else{
  $Session_memNo = 0;
 }
 ?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>銷售唱片</title>
<!-- favicon -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<!-- 自己的CSS -->
<link rel="stylesheet" type="text/css" href="css/style_L.css">
<!-- 背景動態swirl -->
<link rel="stylesheet" type="text/css" href="css/swirl_base.css" />
<script>document.documentElement.className="js";var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};supportsCssVars()||alert("Please view this demo in a modern browser that supports CSS Variables.");</script>
<!-- jQuery-->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Tweenmax的Scroll套件-->
<script src="js/TweenMax/ScrollToPlugin.min.js"></script>
<!-- 搭配Scroll的ScrollMagic套件-->
<script src="js/ScrollMagic/ScrollMagic.min.js"></script>
<script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
<script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
<!-- 會員登入notLoginYet -->
<script src="js/notLoginYet.js"></script>
<!-- blurrymenu套件 -->
<!-- <script src="jquery-1.11.3.min.js"></script> -->
<!-- <script src="js/BlurryMenu/jquery.min.js"></script>
<script src="js/BlurryMenu/ext_html2canvas.js"></script>
<script src="js/BlurryMenu/ext_fastblur.js"></script>
<script src="js/BlurryMenu/blurry-menu.js"></script>  -->
<style>
    .mainTitle{
        color: #ddd;
    }

    .L_pop_pin_track_{
        font-size: 28px!important;
        color:red;
        animation: changeColor 2s linear infinite alternate;
        font-weight: bold;

    }

     @keyframes changeColor {
        0% {
            color: #0f0;
        }
         33% {
            color: #00f;
        }
         66% {
            color: #f00;
        }
         100% {
            color: yellow
        }
    
    
    }
</style>
</head>
<body>
    <!-- 燈箱顯示 - 還未登入 -->
    <section id="NotLogged">
        <div id="NotBtnBox">
        <p>您還沒登入</p>
        <button id="reBtn">返回</button>
        <button id="GoToBtn">登入</button>
        </div>
    </section> 

    <header id="Lpin">
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
                    <li><a class="menu_items" href="CDWall.php">募唱片</a></li>
                    <li><a class="menu_items L_CD" href="CDWall_sell.php">購唱片</a></li>
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
                <a onclick="checkToUser()" style="cursor: pointer;"><i class="fas fa-user"></i></a>
                 <span id="memName">&nbsp;</span>   <!-- 使用者姓名 -->
                 <span id="spanLogin" onclick="document.getElementById('memLoginShow').style.display='block'" style="width:auto;">登入</span>
                <a href="cartPage.php"><i class="fas fa-shopping-cart"></i></a>
            </div>
            <div class="sidebar L_web_sidebar">  <!-- 左側每屏導覽 -->
                <p>熱銷排行</p>
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

    <!-- 第一屏：人氣唱片 -->
    <div class="L_pop_pin"></div>
    <section class="L_pop">
        <div class="L_pop_sidebar">人氣專輯</div>

        <!-- php開始 -->
        <section id="L_CDWallSellNew">
       <!-- <div class="L_pop_record">
                <a href="#"></a>
                <img src="images/CDWall/reco.png" alt="reco.png">
            </div>
            <div class="L_pop_cont">  
                <input type="hidden" name="PHPalbemName" id="albemName" value="墜落">
                <input type="hidden" name="PHPsinger" id="singer" value="南瓜寶寶泥">
                <input type="hidden" name="PHPprice" id="price" value="350">
                <input type="hidden" name="PHPimageName" id="imageName" value="reco_03.png">
                <span>墜落</span>
                <a href="#">南瓜寶寶泥</a>
                <a href="#">01 There's nothing to prove</a>
                <a href="#">02 看不見</a>
                <a href="#">03 在那邊境</a>
                <a href="#">04 我們像朋友般一直走然後死去</a>
                <span id="Y_cdPrice">NT$ 350</span><br>
                <input class="L_addCart" type="submit" value="放入購物車">
            </div> -->
        </section>    
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'CDWall_sell_New_L.php',
                    dataType: 'text',
                    success: function(data){
                        $('#L_CDWallSellNew').html(data);
                        LPOPchange();
                        // LAll();
                    }
                });
            });
        </script>
        <!-- php結束 -->
    </section>

    <!-- 第二屏：強打唱片 -->
    <section class="L_wall L_sell_wall">
        <div class="L_wall_sidebar">銷售唱片</div>

        <!-- php開始 -->
        <section id="L_CDWallSell">
        <!-- <div class="L_wall_card">  
            <div class="L_wall_card_cont">
                <div class="L_wall_card_cont_img">
                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/reco8.png" alt="reco8.png">
                    <div class="L_wall_card_cont_img_playpause">
                        <i class="fas fa-play">播放</i>
                        <i class="fas fa-pause">暫停</i>
                    </div>
                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/reco8.png" alt="reco8.png">
                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </div>
                <a href="CDPage_sell.html">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </a>
            </div>
        </div>

        <div class="L_wall_card">  
            <div class="L_wall_card_cont">
                <div class="L_wall_card_cont_img">
                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/reco8.png" alt="reco8.png">
                    <div class="L_wall_card_cont_img_playpause">
                        <i class="fas fa-play">播放</i>
                        <i class="fas fa-pause">暫停</i>
                    </div>
                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/reco8.png" alt="reco8.png">
                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </div>
                <a href="CDPage_sell.html">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </a>
            </div>
        </div>


        <div class="L_wall_card">  
            <div class="L_wall_card_cont">
                <div class="L_wall_card_cont_img">
                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/reco2.png" alt="reco2.png">
                    <div class="L_wall_card_cont_img_playpause">
                        <i class="fas fa-play">播放</i>
                        <i class="fas fa-pause">暫停</i>
                    </div>
                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/reco2.png" alt="reco2.png">
                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </div>
                <a href="CDPage_sell.html">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </a>
            </div>
        </div>


        <div class="L_wall_card">  
            <div class="L_wall_card_cont">
                <div class="L_wall_card_cont_img">
                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/reco1.png" alt="reco1.png">
                    <div class="L_wall_card_cont_img_playpause">
                        <i class="fas fa-play">播放</i>
                        <i class="fas fa-pause">暫停</i>
                    </div>
                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/reco1.png" alt="reco1.png">
                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </div>
                <a href="CDPage_sell.html">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                        <p class="L_wall_card_cont_wrap_p">伍悅渾然天成的氣場與稚嫩音色配上徐子權咬字、編排帶著些許日系特色的演唱，讓海豚刑警成...</p>
                    </div>
                </a>
            </div>
        </div>


        <div class="L_wall_card">  
            <div class="L_wall_card_cont">
                <div class="L_wall_card_cont_img">
                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/reco4.png" alt="reco4.png">
                    <div class="L_wall_card_cont_img_playpause">
                        <i class="fas fa-play">播放</i>
                        <i class="fas fa-pause">暫停</i>
                    </div>
                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/reco4.png" alt="reco4.png">
                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </div>
                <a href="CDPage_sell.html">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </a>
            </div>
        </div>


        <div class="L_wall_card">  
            <div class="L_wall_card_cont">
                <div class="L_wall_card_cont_img">
                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/reco6.png" alt="reco6.png">
                    <div class="L_wall_card_cont_img_playpause">
                        <i class="fas fa-play">播放</i>
                        <i class="fas fa-pause">暫停</i>
                    </div>
                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/reco6.png" alt="reco6.png">
                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </div>
                <a href="CDPage_sell.html">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </a>
            </div>
        </div>


        <div class="L_wall_card">  
            <div class="L_wall_card_cont">
                <div class="L_wall_card_cont_img">
                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/reco5.png" alt="reco5.png">
                    <div class="L_wall_card_cont_img_playpause">
                        <i class="fas fa-play">播放</i>
                        <i class="fas fa-pause">暫停</i>
                    </div>
                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/reco5.png" alt="reco5.png">
                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </div>
                <a href="CDPage_sell.html">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </a>
            </div>
        </div>


        <div class="L_wall_card">  
            <div class="L_wall_card_cont">
                <div class="L_wall_card_cont_img">
                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/reco7.png" alt="reco7.png">
                    <div class="L_wall_card_cont_img_playpause">
                        <i class="fas fa-play">播放</i>
                        <i class="fas fa-pause">暫停</i>
                    </div>
                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/reco7.png" alt="reco7.png">
                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </div>
                <a href="CDPage_sell.html">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                        <p class="L_wall_card_cont_wrap_p">伍悅渾然天成的氣場與稚嫩音色配上徐子權咬字、編排帶著些許日系特色的演唱，讓海豚刑警成...</p>
                    </div>
                </a>
            </div>
        </div>


        <div class="L_wall_card">  
            <div class="L_wall_card_cont">
                <div class="L_wall_card_cont_img">
                    <img class="L_wall_card_cont_img_cover" src="images/CDWall/records/reco5.png" alt="reco5.png">
                    <div class="L_wall_card_cont_img_playpause">
                        <i class="fas fa-play">播放</i>
                        <i class="fas fa-pause">暫停</i>
                    </div>
                    <img class="L_wall_card_cont_img_round" src="images/CDWall/records/reco5.png" alt="reco5.png">
                    <img class="L_wall_card_cont_img_reco" src="images/CDWall/records/reco_inner.png" alt="reco_inner.png">
                    <audio class="L_wall_card_cont_img_reco1" src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </div>
                <a href="CDPage_sell.html">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </a>
            </div>
        </div> -->
        </section>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'CDWall_sell_Wall_L.php',
                    dataType: 'text',
                    success: function(data){
                        $('#L_CDWallSell').html(data);
                        LCD();
                    }
                });
            });
            // function loadCDwall(){
            //     $.ajax({
            //         url: 'CDWall_sell_data_L.php',
            //         dataType: 'text',
            //         success: function(data){
            //             $('#CDWallSell').html(data);
            //         }
            //     });
            // }
        </script>
        <!-- php結束 -->
        
    </section>


     <!-- 播放列表 -->
     <div class="L_playbar" id="L_playbar">
        <span>
            <div></div>
        </span>
        <div class="L_playbar_img">
            <img src="images/CDWall/records/reco7_s.png" alt="reco7_s.png">
        </div>
        <div class="L_playbar_text">
            <p>老舊壞門</p>
            <p>把山姆</p>
        </div>
        <div class="L_playbar_ctrl">
            <img src="images/CDWall/backward.png" alt="backward.png">
            <div id="L_playbar_ctrl_PP">
                <img src="images/CDWall/play.png" alt="play.png">
                <img src="images/CDWall/pause.png" alt="pause.png">
            </div>
            <img src="images/CDWall/forward.png" alt="forward.png">
        </div>
        <div class="L_playbar_vol">
            <i class="fas fa-volume-off"></i>
            <span id="L_playbar_vol_ctrl">
                <div id="L_playbar_vol_line"></div>
            </span>
        </div>
    </div>


    




    <!-- blurrymenu -->
    <!-- http://www.htmleaf.com/Demo/201507172247.html -->
    <div id="Bmenu">  <!-- 原為menu，防衝突先改Bmenu -->
    <!--这个图片不会被显示。-->
        <img id="captured-image" src="images/test.jpg">
    
        <!--canvas占位，模糊的图形会设置在这里-->
        <canvas id="blurred-bg-canvas"></canvas>
    
        <!-- 侧边栏的内容 -->
        <div id="menu-content">
            <ul>
                <li class="first">Menu 1</li>
                <li>Menu 2</li>
                <li>Menu 3</li>
            </ul>
        </div>
    </div>

    <!-- 原為hamburger，防衝突先改Bhamburger -->
    <!-- <div id="Bhamburger" onclick="BlurryMenu.openMenu()">
        <div></div> 
        <div></div>
        <div></div>
    </div>  -->


    <!-- footer -->
    <section class="footer width1700">
        <div class="copyright">
            <div>copyright © </div>
            <span>starway</span>
        </div>
        <div class="trd">
            <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
            <a href="https://www.google.com/"><img src="images/g.png" alt="g.png"></a>
            <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
        </div>
    </section>

    
    <!-- swirl動態背景 -->
    <div class="swirl">
        <div class="swirl_content swirl_content--canvas"></div>
    </div>


    <!-- TweenMax -->
    <script src="js/TweenMax/Tweenmax.js"></script>

    <!-- Logo_neon --> 
    <script src="js/Logo_neon.js"></script>

    <!-- Swirl --> 
    <script src="js/Swirl/noise.min.js"></script>
    <script src="js/Swirl/util.js"></script>
    <script src="js/Swirl/swirl.js"></script>

    <!-- 開專輯 -->
    <script src="js/CDwall_openCD.js"></script>

    <!-- 熱門唱片PIN -->
    <script>

    // window.onload = onload();

    // function onload(){
    //     LAll();
    //     initLayout();
    //     console.log('XD');
    // }
        
    // function LAll(){
    //     window.onresize = function (){
    //         alert("99");
    //         initLayout();

            

    //     }
    // }

    // function initLayout(){

        // // var w = windows.innerWidth;
        // if(window.screen.width > 768){
        //         window.location.reload();

            function LPOPchange(){

                //圖片切換
                var controller = new ScrollMagic.Controller();
                var Lchange = new TimelineMax();
                
                //文字切換
                var $LpopCont1 = $('.L_pop_cont_1');
                var $LpopCont2 = $('.L_pop_cont_2');
                var $LpopCont3 = $('.L_pop_cont_3');
                // console.log($LpopCont2);
                $LpopCont2.css('display','none');
                $LpopCont3.css('display','none');
                
                Lchange.to(['.L_pop_pin_img_1','.L_pop_pin_name_1'], 1, {clip: "rect(0px 600px 0px 0px)"})
                    .to(['.L_pop_pin_img_2','.L_pop_pin_name_2'], 1, {clip: "rect(0px 600px 0px 0px)"} );

                var scene03 = new ScrollMagic.Scene({
                    triggerElement: '.L_pop_pin', //以哪個元素為指標
                    duration: '50%',       //過渡區間為triggerElement總長的幾倍
                    triggerHook: 0,       //畫面pin住的地方0為頂，1為底
                    // reverse: true
                }).setPin('#L_CDWallSellNew')    //pin起始
                .setTween(Lchange)            //pin動畫
                //指標線名稱
                // .addIndicators({
                //     name: 'pin'
                // })

                .addTo(controller); 
            }

    

        $(window).scroll(function(){

            //文字切換
            var $LpopCont1 = $('.L_pop_cont_1');
            var $LpopCont2 = $('.L_pop_cont_2');
            var $LpopCont3 = $('.L_pop_cont_3');
            

            var $srrollY = $(window).scrollTop();
            // console.log($srrollY);

            if( $srrollY > 125 && $srrollY < 350 ){
                // console.log($LpopCont2.css);
                $LpopCont1.css('display','none');
                $LpopCont2.css('display','inline-block');
                $LpopCont3.css('display','none');

            }else if( $srrollY > 350){
                // console.log($srrollY);
                $LpopCont1.css('display','none');
                $LpopCont2.css('display','none');
                $LpopCont3.css('display','inline-block');

            }else{
                $LpopCont1.css('display','inline-block');
                $LpopCont2.css('display','none');
                $LpopCont3.css('display','none');

            }


            var $Lsidebar = $('.L_web_sidebar');

            if( $srrollY > 750){
                // console.log(':D');
                $Lsidebar.children().html("強打專輯");

            }else{
                $Lsidebar.children().html("熱銷排行");
            }

        })

    </script>

    <!-- memLogin -->
    <script src="js/memLogin.js"></script>
    <script>
        
        //在JS先宣告一個memNo變數，用來確認該變數在session是否有會memNo
        var memNo = <?php echo $Session_memNo;?>;

        $(document).ready(function() {
            $('.Y_check').on('click', function(event) {
                event.preventDefault();
                if( memNo != 0){ //若有登入會員，則跳出付款畫面
                var memNum = memNo;
                // alert('test');
                console.log(memNum); 

                }else {//若有還未登入，則跑出會員登入視窗
                    var memNum = 0;
                    // console.log(memNum); 
                    $('#NotLogged').css({"display":"block"});
                }
            });
        });

    </script>


    <!-- 專輯封面開關 -->
    <!-- <script>
        function LCDopen(){
                    
            var CDwallImg = document.getElementsByClassName('L_wall_card_cont_img');

            for( i = 0; i < CDwallImg.length; i++ ){
                //開專輯
                CDwallImg[i].onmouseover = function () { 
                    this.firstElementChild.style.left = "-95%";
                }
                //關專輯
                CDwallImg[i].onmouseout = function () {
                    this.firstElementChild.style.left = "0%";
                }
            }
        }
    </script> -->

</body>
</html>