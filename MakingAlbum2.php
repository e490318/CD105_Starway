<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>星路-專輯製作</title>
    <!-- favicon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <!-- 自己的CSS -->
    <link rel="stylesheet" type="text/css" href="css/style_A.css">
    <!-- jQuery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- jQuery.js v1.11.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- This following line is optional. Only necessary if you use the option css3:false and you want to use other easing effects rather than "linear", "swing" or "easeInOutCubic". -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/jquery.easings.min.jss"></script> -->

    <!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/scrolloverflow.min.js"></script>

    <!-- fullPage.js v2.9.5 -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.js"></script> -->
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

            <!-- <div class="nav_logo">
                        <a href="index.html" id="logo"></a>
                        <img class="nav_logo_b" src="images/logo_b.png" alt="logo.png">
                        <img class="nav_logo_d" src="images/logo_d.png" alt="logo.png">
                    </div> -->

            <div class="logo">
                <a href="index.html" id="logo" class="L_btn"></a>
                <img class="logo_b" src="images/logo_b.png" alt="logo.png">
                <audio id="neonSound" src="sounds/neon.mp3"></audio>
                <div id="L_box"></div>
            </div>
            <nav>
                <ul class="menu">
                    <li><a class="menu_items" href="CDWall.html">募唱片</a></li>
                    <li><a class="menu_items" href="CDWall.html">購唱片</a></li>
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
                <a href=""><i class="fas fa-shopping-cart"></i></a>
            </div>
        </section>
    </header>

    <!-- 第三屏：專輯內容 -->
    <section>
        <div class="section A-record A-albumTextarea">
            <div class="width1200 A-page1st A-page3rd">
                <div class="sidebar3">
                    <!-- 左側每屏導覽 -->
                    <p>專輯內容</p>
                </div>
                <!--步驟流程 start-->
                <div class="cuProcrss">
                    <div class="cuPro cuPro1">
                        <span>1</span>
                        <p>錄製聲音</p>
                    </div>
                    <img src="images/star.png" alt="star.png">
                    <img src="images/star.png" alt="star.png">
                    <img src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro2">
                        <span>2</span>
                        <p>專輯封面</p>
                    </div>
                    <img src="images/star.png" alt="star.png">
                    <img src="images/star.png" alt="star.png">
                    <img src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro3">
                        <span>3</span>
                        <p>專輯介紹</p>
                    </div>
                    <img src="images/star.png" alt="star.png">
                    <img src="images/star.png" alt="star.png">
                    <img src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro4">
                        <span>4</span>
                        <p>確認資料</p>
                    </div>
                </div>
                <!--步驟流程 end-->
                <div class="A-box1">
                    <img class="A-recordBG" src="images/Record/BG.png" alt="album">
                    <img class="A-recordCD" src="images/Record/cd.png" alt="cd">
                </div>
                <div class="clear-fix"></div>
                <div class="A-textarea">
                    <form class="textform" method="post" accept-charset="utf-8" name="form1">
                        <h4>專輯名稱</h4>
                        <!-- <input name="hidden_data" id='hidden_data' type="hidden" /> -->
                        <input type="text" id="myWord" maxlength="6" />
                        <!-- <input type="button" class="putWord btn" id="putWord" value="送出" /> -->
                        <h4>專輯內容</h4>
                        <textarea name="" id="A-albumcon" cols="45" rows="6" placeholder="請輸入專輯介紹內容...">
                        
                        </textarea>
                        <input type="button" class="putWord btn" id="putWord" value="送出" />
                    </form>
                    
                </div>
                <a href="MakingAlbum-test.html">
                    <button id="A-beforeButton">上一步</button>
                </a>
                <a href="MakingAlbum3.html">
                    <button id="A-nextButton">下一步</button>
                </a>
            </div>
        </div>

        <!-- <script>
            TweenMax.from(".A-box", 1.5, {x:50, y: 50, opacity:0, scale:0.5});
            TweenMax.fromTo("A-box", 1.5, {opacity:0, width:0}, {opacity:1, width: 200 });
            </script> -->
        </div>
    </section>

    <section class="footer width1700">
        <div class="copyright">
            <div>copyright © </div>
            <span>starway</span>
        </div> -->
        <div class="trd">
            <!-- 暫連官網 -->
            <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
            <a href="https://www.google.com/"><img src="images/g+.png" alt="g+.png"></a>
            <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
        </div>
    </section>
    <!-- TweenMax-->
    <script src="js/TweenMax/Tweenmax.js"></script>

    <!-- logo墜落 -->
    <script src="js/Logo_neon.js"></script>
</body>

</html>