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
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
<title>募資唱片</title>
<!-- favicon -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="swiper-master/dist/css/swiper.min.css">

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
                    <li class="login_mobile"><a class="menu_items " href="cartPage.php"><i class="fas fa-shopping-cart"></i></a></li>
                </ul>
            </nav>
            <div class="nav_user">
                <a onclick="checkToUser()" style="cursor: pointer;"><i class="fas fa-user"></i></a>
                 <span id="memName">&nbsp;</span>   <!-- 使用者姓名 -->
                 <span id="spanLogin" onclick="document.getElementById('memLoginShow').style.display='block'" style="width:auto;">登入</span>
                <a href="cartPage.php"><i class="fas fa-shopping-cart"></i></a>
            </div>
            <!-- 左側每屏導覽 -->
            <div class="sidebar L_web_sidebar"> 
                <p>即將達標</p>
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

    <!-- 第一屏：即將達標 -->
    <!-- Swiper -->
    <section class="L_dona_slider">
        <div class="L_wall_fin_sidebar">即將達標</div>
        <div class="swiper-container">
            <!-- <div class="swiper-slide">Slide 1</div> -->
            
            <!-- php開始 -->
            <section class="swiper-wrapper L_CDWall_Fin">
            </section>
            <script>
                $(document).ready(function() {
                    $.ajax({
                        url: 'CDWall_Fin_L.php',
                        dataType: 'text',
                        success: function(data){
                            $('.L_CDWall_Fin').html(data);
                        }
                    });
                });
            </script>
            <!-- php結束 -->

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Swiper JS -->
     <script src="swiper-master/dist/js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

    <!-- 第二屏：新歌報到 -->
    <section class="L_dona_pop">
        <div class="L_wall_new_sidebar">新歌報到</div>
        <div class="L_dona_pop_sidebar">人氣專輯</div>
        <div class="L_dona_pop_wrap">
            <div class="L_dona_pop_newarival">
                <img src="images/CDwall/new.png" alt="new.png">
            </div>
            <span class="L_dona_pop_btnLeft">
                <img class="L_btnLeft" src="images/CDWall/btnLeft.png" alt="btnLeft.png">
            </span>
            <span class="L_dona_pop_btnright">
                <img class="L_btnright" src="images/CDWall/btnRight.png" alt="btnRight.png">
            </span>
            <div class="L_dona_pop_carousel">
            
                <!-- php開始 -->
                <section id="L_CDWall_New">
                </section>
                <script>
                    $(document).ready(function() {
                        $.ajax({
                            url: 'CDWall_New_L.php',
                            dataType: 'text',
                            success: function(data){
                                $('#L_CDWall_New').html(data);
                            }
                        });
                    });
                </script>
                <!-- php結束 -->

            </div>
        </div>      
    </section>

    <!-- 第三屏：強打唱片 -->
    <section class="L_wall width1200">
        <div class="L_wall_sidebar">募資唱片</div>

        <!-- php開始 -->
        <section id="L_CDWall_Wall">
        </section>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: 'CDWall_Wall_L.php',
                    dataType: 'text',
                    success: function(data){
                        $('#L_CDWall_Wall').html(data);
                        LCD();
                        LCDBiger();
                    }
                });
            });
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

    
    <!-- 開專輯 -->
    <script src="js/CDwall_openCD.js"></script>

    <!-- swirl動態背景 -->
    <div class="swirl">
        <div class="swirl_content swirl_content--canvas"></div>
    </div>

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
    
    <!-- TweenMax -->
    <script src="js/TweenMax/Tweenmax.js"></script>
    
    <!-- Logo_neon --> 
    <script src="js/Logo_neon.js"></script>   
   
    <!-- Swirl --> 
    <script src="js/Swirl/noise.min.js"></script>
    <script src="js/Swirl/util.js"></script>
    <script src="js/Swirl/swirl.js"></script>

    <!-- sidebar -->
    <script>
        $(window).scroll(function(){
        
            var $srrollY = $(window).scrollTop();
            console.log($srrollY);  //打開查看頁面高度
        
            var $Lsidebar = $('.L_web_sidebar'); //
        
            if( $srrollY < 435){  //頁面高度切換點
                // console.log(':D');
                $Lsidebar.children().html("即將達標");  //sidebar文字
        
            }else if( $srrollY > 435 && $srrollY < 1090){
                $Lsidebar.children().html("新歌報到");

            }else{
                $Lsidebar.children().html("強打專輯");
            }
        })
    </script>

    <!-- New arrival --> 
    <script>
        function LCDBiger(){

            if( window.screen.width > 768 ){
                console.log('桌機');
                var LCDForm = document.getElementsByClassName('L_dona_pop_form');
            
                for( i = 0; i < LCDForm.length; i++ ){

                    LCDForm[i].onmouseover = function(){

                        this.style.width = '22%';
                        this.style.paddingTop = '0%';
                        this.lastElementChild.lastElementChild.previousElementSibling.style.display = 'block';
                        this.lastElementChild.lastElementChild.previousElementSibling.previousElementSibling.style.display = 'block';
                        // console.log(this.lastElementChild.lastElementChild.previousElementSibling);

                    }
                    LCDForm[i].onmouseout = function(){

                        this.style.width = '12%';
                        this.style.paddingTop = '8%';
                        this.lastElementChild.lastElementChild.previousElementSibling.style.display = 'none';
                        this.lastElementChild.lastElementChild.previousElementSibling.previousElementSibling.style.display = 'none';
                    }
                }

            }else{
                console.log('手機');
                var LCDForm = document.getElementsByClassName('L_dona_pop_form');

                for( i = 0; i < LCDForm.length; i++ ){
                    console.log('LCDForm',LCDForm);

                    LCDForm[i].lastElementChild.lastElementChild.previousElementSibling.style.display = 'block';
                    LCDForm[i].lastElementChild.lastElementChild.previousElementSibling.previousElementSibling.style.display = 'block';

                }
            }
        }

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
                // console.log(memNum); 

                }else {//若有還未登入，則跑出會員登入視窗
                    var memNum = 0;
                    // console.log(memNum); 
                    $('#NotLogged').css({"display":"block"});
                }
            });
        });
    </script>

</body>
</html>