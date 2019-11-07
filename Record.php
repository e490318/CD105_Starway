<?php
ob_start();
session_start();

if(isset($_SESSION["memNo"]) ==true){ //從session裡確認是否有memNo的變數。若有該變數，則宣告一個Session_memNo變數等於session裡的memNo,目的是要讓javascript去抓可以用這個PHP的變數，來判斷是否有登入
    $Session_memNo = $_SESSION["memNo"];
}else{
    $Session_memNo = 0;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>星路-做專輯</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/scrolloverflow.min.js"></script>

    <!-- Tweenmax的Scroll套件-->
    <script src="js/TweenMax/ScrollToPlugin.min.js"></script>
    <!-- 搭配Scroll的ScrollMagic套件-->
    <script src="js/ScrollMagic/ScrollMagic.min.js"></script>
    <script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
    <script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
    <!-- <script src="js/app2.js"></script> -->
    <script src="js/notLoginYet.js"></script>
    <script src="js/jQueryRotate.2.1.js"></script>
    <!-- <style>
    .cuProCD1{
        animation: A-rotateCD 0.5s infinite;
    }
    @keyframes A-rotateCD {
        0% { 
            transform: rotate(30deg); 
        }
        10% { 
            transform: rotate(60deg); 
        }
        20% { 
            transform: rotate(90deg); 
        }
        30% {
            transform: rotate(120deg); 
        }
        40% {
            transform: rotate(150deg); 
        }
        50% {
            transform: rotate(180deg); 
        }
        55% { 
            transform: rotate(210deg); 
        }
        60% { 
            transform: rotate(240deg); 
        }
        70% {
            transform: rotate(270deg); 
        }
        80% { 
            transform: rotate(300deg); 
        }
        90% { 
            transform: rotate(330deg); 
        }
        100%{ 
            transform: rotate(360deg); 
        }
    }
    </style> -->
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


    <section>
    	<div class="sidebar1">
            <!-- 左側每屏導覽 -->
            <p>做專輯</p>
        </div>
    	<!-- 桌機 -->
        <!-- 第一屏：錄音 -->
        <div class="section A-record">
            <div class="width1200 A-page1st">
                
                <!--步驟流程 start-->
                <div class="cuProcrss">
                    <div class="cuPro cuPro1">
                        <img class="cuProCD1" src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-1-01-01.png" alt="star-with-number-1">
                        <p>錄音10秒Demo</p>
                    </div>
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro2">
                        <img src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-2-02-02.png" alt="star-with-number-1">
                        <p>製作專輯封面</p>
                    </div>
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro3">
                        <img src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-3-03-03.png" alt="star-with-number-1">
                        <p>填寫專輯介紹</p>
                    </div>
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro4">
                        <img src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-4-04-04.png" alt="star-with-number-1">
                        <p>上架至募資牆</p>
                    </div>
                </div>
                <!--步驟流程 end-->
                <div class="A-recAll">
                    <form action="MakingAlbum.php" method="post">
                        <div class="A-songTitle">
                            <div class="A-sTp">
                                <h2><img class="A-starStep01" src="images/Record/star-with-number-1-01-01.png" alt="star-with-number-1">先來填寫你的歌曲名稱</h2>
                                <h4>歌曲名稱</h4>
                                <p>請輸入你的歌曲名稱</p>
                                <!-- <input name="hidden_data" id='hidden_data' type="hidden" /> -->
                                <input type="text" name="demoLinkName" id="myWord" />
                                <input type="button" class="putWord btn" id="putWord" value="送出" />
                                <!-- <input id="A-nextButton" type="button" class="putWord btn" id="putWord" value="送出" /> -->
                            </div>
                            <div class="A-sCf">
                                <h2><img class="A-starStep01" src="images/Record/star-with-number-1-01-01.png" alt="star-with-number-1">先來填寫你的歌曲名稱</h2>
                                <h4>歌曲名稱</h4>
                                <p>你的歌曲名稱&nbsp:&nbsp&nbsp<span class="cuWriteSongTitle"></span></p>
                                <input type="button" id="beforePutWord" value="上一步" />
                            </div>
                        </div>

                        <div class="A-recordBox">
                            <h2><img class="A-starStep02" src="images/Record/star-with-number-2-02-02.png" alt="star-with-number-1">接著來錄製一段10秒的Demo</h2>
                            <div class="record">
                                <!-- <img src="images/Record/microphone.svg" alt="錄音"> -->
                                <div class="A-micphone">
                                    <img src="images/Record/micphone.png" alt="micphone">
                                </div>
                            </div>

                            <canvas id='canvas' width='200' height='200'></canvas>
                            <div id="controls">
                                <input id="recordButton" value="錄音">
		                        <!-- <button id="recordButton">錄音</button> -->
		                        <button id="stopButton" disabled style="display: none">結束</button>
		                        <!-- style="display: none" -->
		                    </div>
                            
                            <div id="formats"></div>
                            <ol id="recordingsList">
                            </ol>

                            <p><input class="step2ndBnt" type="submit" value="下一步"></p>
                        </div>   
                    </form>

                    
                    <!-- <a href="MakingAlbum-test.html">
                        <button id="A-nextButton">下一步</button>
                    </a> -->
                </div>

                
                <!-- <div id="content">
                            <input type="file" id="thefile" accept="audio/*" />
                            <canvas id="canvas"></canvas>
                            <audio id="audio" controls></audio>
                </div> -->

            </div>
        </div>

        <!-- 我是手機板 -->
        <!-- 第一屏：錄音 -->
        <div class="section A-record mob-A-A-record">
            <div class="width1200 A-page1st">
                <div class="mob-A-recAll">
                    <form action="MakingAlbum.php" method="post" enctype="multipart/form-data">
                        <!-- <div class="mob-A-songTitle">
                            <div class="mob-A-sTp">
                                <h2><img class="mob-A-starStep01" src="images/Record/star-with-number-1-01-01.png" alt="star-with-number-1">先來填寫你的歌曲名稱</h2>
                                <h4>歌曲名稱</h4>
                                <p>請輸入你的歌曲名稱</p>
                                
                                <input type="text" name="demoLinkName" id="mob-myWord" />
                                <input type="button" class="putWord btn" id="mob-putWord" value="送出" />
                                
                            </div>
                            <div class="mob-A-sCf">
                                <h2><img class="mob-A-starStep01" src="images/Record/star-with-number-1-01-01.png" alt="star-with-number-1">先來填寫你的歌曲名稱</h2>
                                <h4>歌曲名稱</h4>
                                <p>你的歌曲名稱&nbsp:&nbsp&nbsp<span class="mob-cuWriteSongTitle"></span></p>
                                <input type="button" id="mob-beforePutWord" value="上一步" />
                            </div>
                        </div> -->

                        <div class="mob-A-recordBox">
                            <h2><!-- <img class="mob-A-starStep01" src="images/Record/star-with-number-1-01-01.png" alt="star-with-number-1"> -->上傳一段你的音樂Demo</h2>
                            <div class="mob-record">
                                <!-- <img src="images/Record/microphone.svg" alt="錄音"> -->
                                <div class="mob-A-micphone">
                                    <img src="images/Record/micphone.png" alt="micphone">
                                </div>
                            </div>

                            <!-- <canvas id='canvas' width='200' height='200'></canvas> -->
                            
                            
                            <div id="formats"></div>
                            <!-- <ol id="recordingsList">
                            </ol> -->
                            <label class="" id="music-upfile" for="filename">
                            	<img src="images/Record/upload.png">
                            	上傳音樂檔
                            	<input type="file" name="upFile" id="upfile">
                            </label>
                            

                            <p><input class="step2ndBnt" type="submit" value="下一步"></p>
                        </div>

                        
                    
                        
                    </form>

                    <!-- <div id="controls">
                        <button id="recordButton">錄音</button>
                        <button id="stopButton" disabled style="display: none">結束</button>
                        style="display: none"
                    </div> -->
                    <!-- <a href="MakingAlbum-test.html">
                        <button id="A-nextButton">下一步</button>
                    </a> -->
                </div>

            </div>
        </div>

    </section>>


    <footer>
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
    </footer>

    <!-- inserting these scripts at the end to be able to use all the elements in the DOM -->
    <script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
    <script src="js/app.js"></script>
    <!-- TweenMax -->
    <script src="js/TweenMax/Tweenmax.js"></script>

    <!-- logo墜落 -->
    <script src="js/Logo_neon.js"></script>

    <!-- 步驟1 CD旋轉 -->
    <script>
    var angle = 0;
    setInterval(function(){
        angle+=3;
        $(".cuProCD1").rotate(angle);
    },10);
    </script>

    <!-- <script>
    $(document).ready(function(){
        $('#putWord').on('click', function(e){
            alert('輸入完成');
        });
    });
    </script> -->
    
    <!-- 手機版 start-->
    <script>
     // 點選歌曲名稱輸入完成按鈕  start  
    $(document).ready(function(){
        myWord = $('#mob-myWord').val();

        $('#mob-putWord').on('click', function(e){
            // event.preventDefault();
            myWord = $('#mob-myWord').val();

            if ($('#mob-myWord').val()==''){
                alert('請填寫您的歌曲名稱');
            // }else if ($('#cuUserAlbumTitle').val()==''){
            //     alert('請填寫您的資料');
            // }else if ($('#cuUserAlbumContent').val()==''){
            //     alert('請填寫您的資料');
            }else{
                $('.mob-A-sTp').css('display','none');
                $('.mob-A-sCf').css('display','block');
                $('.mob-cuWriteSongTitle').text(myWord);
                $('.mob-A-recordBox').css('display','block');
                // $('#canvas').css('display','');
                // $('.step2ndBnt').css('display','block');

                
            // $('.cuWriteContent').text(cuUserAlbumContent);
            }
        });
    });
    // 點選歌曲名稱輸入完成按鈕 end

    // 點選歌曲名稱上一步 start
    $(document).ready(function(){
        $('#mob-beforePutWord').on('click', function(e){
            $('.mob-A-sTp').css('display','block');
            $('.mob-A-sCf').css('display','none');
        });
    });
    // 點選歌曲名稱上一步 end   
    </script>
    <!-- 手機版 end-->
    

    <!-- 桌機版 start-->
    <script>
    // 點選歌曲名稱輸入完成按鈕  start  
    $(document).ready(function(){
        myWord = $('#myWord').val();

        $('#putWord').on('click', function(e){
            // event.preventDefault();
            myWord = $('#myWord').val();
            // console.log(myWord);
                $.ajax({
                url: 'updateDemoLink.php',
                type: 'POST',
                dataType: 'text',
                data:
                {
                    demoLinkName:myWord
                },
                 success: function(data){
                 }
            });

            if ($('#myWord').val()==''){
                alert('請填寫您的歌曲名稱');
            // }else if ($('#cuUserAlbumTitle').val()==''){
            //     alert('請填寫您的資料');
            // }else if ($('#cuUserAlbumContent').val()==''){
            //     alert('請填寫您的資料');
            }else{
                $('.A-sTp').css('display','none');
                $('.A-sCf').css('display','block');
                $('.cuWriteSongTitle').text(myWord);
                $('.A-recordBox').css('display','block');
                // $('#canvas').css('display','');
                // $('.step2ndBnt').css('display','block');

                
            // $('.cuWriteContent').text(cuUserAlbumContent);
            }
        });
    });
    // 點選歌曲名稱輸入完成按鈕 end

    // 點選歌曲名稱上一步 start
    $(document).ready(function(){
        $('#beforePutWord').on('click', function(e){
            $('.A-sTp').css('display','block');
            $('.A-sCf').css('display','none');
            $('.A-recordBox').css('display','none');
        });
    });
    // 點選歌曲名稱上一步 end

    //點選錄音 start
    $(document).ready(function(){
        $('#recordButton').on('click', function(e){
            $('.step2ndBnt').css('display','block');
        });
    });

    //點選錄音 end


    // $(document).ready(function(){

    //     $('#recordButton').on('click', function(e){
    //         // event.preventDefault();
    //         myWord = $('#myWord').val();

    //         if ($('#recordButton').val()==''){
    //             alert('請填寫您的歌曲名稱');
    //         // }else if ($('#cuUserAlbumTitle').val()==''){
    //         //     alert('請填寫您的資料');
    //         // }else if ($('#cuUserAlbumContent').val()==''){
    //         //     alert('請填寫您的資料');
    //         }else{
    //             $('#cuWriteSongTitle').text(cuWriteSongTitle);
    //         // $('.cuWriteContent').text(cuUserAlbumContent);
    //         }
    //     });
    // });
    </script>
    <!-- 桌機版 end-->



    <script src="js/memLogin.js"></script>

    <script>
    //在JS先宣告一個memNo變數，用來確認該變數在session是否有會memNo
     var memNo = <?php echo $Session_memNo;?>;

    $(document).ready(function() {
         $('.Y_check').on('click', function(event) {
            event.preventDefault();
            if( memNo != 0){ //若有登入會員，則跳出付款畫面
                alert('hi');
               console.log(memNum); 

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