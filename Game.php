<?php
ob_start();
session_start();
if (isset($_SESSION["couponNo"])) {
    $coupon = $_SESSION["couponNo"];
}
// $_SESSION["couponNo"]


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>星路-賺酷碰</title>
    <!-- favicon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <!-- 自己的CSS -->
    <link rel="stylesheet" type="text/css" href="css/style_H.css">
    <!-- jQuery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- jQuery.js v1.11.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Tweenmax的Scroll套件-->
    <script src="js/TweenMax/ScrollToPlugin.min.js"></script>
    <!-- 搭配Scroll的ScrollMagic套件-->
    <script src="js/ScrollMagic/ScrollMagic.min.js"></script>
    <script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
    <script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
    <!-- OwlCarousel -->
   <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css">
    </link> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.min.css"> -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js'></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/owl.carousel.min.js"></script> -->
    <script src="js/jquery-ui.min.js">
    </script>
    <!-- <script src="js/carousel.js"></script> -->
    <!-- This following line is optional. Only necessary if you use the option css3:false and you want to use other easing effects rather than "linear", "swing" or "easeInOutCubic". -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/jquery.easings.min.jss"></script> -->

    <!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/scrolloverflow.min.js"></script>

    <!-- fullPage.js v2.9.5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.js"></script>
<!--     <script src="js/3.js"></script>
 -->
    <script>
        var bleep = new Audio();
        bleep.src = 'sfx.mp3';
    </script>
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
                    <li class="login_mobile"><a class="menu_items " href="cartPage.php"><i class="fas fa-shopping-cart"></i></a></li>
                </ul>
            </nav>
            <div class="nav_user">
                <a onclick="checkToUser()" style="cursor: pointer;"><i class="fas fa-user"></i></a>
                 <span id="memName">&nbsp;</span>   <!-- 使用者姓名 -->
                 <span id="spanLogin" onclick="document.getElementById('memLoginShow').style.display='block'" style="width:auto;">登入</span>
                <a href="cartPage.php"><i class="fas fa-shopping-cart"></i></a>
            </div>
            <div class="sidebar">
                <p>賺酷碰</p>
            </div>
        </section>
    </header>



        <!-- 燈箱顯示 - 還未登入 -->
    <!-- <section id="NotLogged">
        <div id="NotBtnBox">
            <p>您尚未登入</p>
            <button id="reBtn">取消</button>
            <button id="GoToBtn">登入</button>
        </div>
    </section>   -->




    <!-- <?php //include("memLoginShow.php"); ?> -->
    <!-- showLoginForm -->
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
                <button type="button" id="btnLogin" onclick="
                document.getElementById('memLoginShow').style.display='none';
                sendForm();

                ">登入</button>
            </div>
            <div id="memInfoReg">
                <a class="forgotPsw" href="#">忘記密碼</a>
               <a class="memberReg" href="memRegister.html">會員註冊</a>
            </div>
       </form>
    </section> 

    <style type="text/css">
       
    </style>

   

    <!-- 彈出對話 - 評論 -->
    <div id="comment">
        <p>彈跳系統審核提示句</p>
    </div>    

    <!-- 桌機選取區 -->
    <div id="gameLobby" class="H_selectarea width1700">
        <audio controls autoplay loop>
            <source src="sounds/8bitBGmusic.mp3" type="audio/mp3">
        </audio>
        <div class="H_soundPratice">
            <a href="SoundTest.php" onmouseover="bleep.play();">
                <img src="images/Test/soundTest.png" alt="mic">
                <div class="H_gameText1">
                    <p>聆聽示範音檔後跟著模仿，系統將會匹配你的吻合度並給出評語及分數來獲取酷碰券。</p>
                </div>
            </a>
        </div>
        <div class="H_rhythmGame">
            <a href="RhythmGame.php" onmouseover="bleep.play();">
                <img src="images/Test/rhyme.png" alt="rhyme">
                <div class="H_gameText2">
                    <p>玩家配合遊戲內的音樂節奏，依照指示做出相對應的動作，與節奏吻合即可獲得分數與酷碰券。</p>
                </div>
            </a>
        </div>
    </div>
        <div class="neonstar">
            <img src="images/Test/neonstar.png" alt="neonstar">
            <img src="images/Test/neonstar.png" alt="neonstar">
            <img src="images/Test/neonstar.png" alt="neonstar">
        </div>
        
        <style>
            .H_soundpratice p{
                margin-left: 32%;
            }
        </style>
    <!-- 手機選取區 -->
    <div class="rwdwrap">
        <div class="H_rwd-selectarea">
            <a href="RhythmGame.php">
                <img class="dj" src="images/Test/rhyme.png" alt="rhythm">
                <p>玩家配合遊戲內的音樂節奏，依照指示做出相對應的動作，與節奏吻合即可獲得分數與酷碰券。</p>
            </a>
        </div>
    </div>
       <style>
           .rwdwrap img{
               margin-left: 10%;
           }
       </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- <script src="js/owl.js"></script> -->









    <script type="text/javascript">

     //php echo文字 轉Js注意:
     //php "" 內包的，是之後要給javascript讀的值，若javascript要判讀字串
     // 需要再附上 '' ,才正式將原先的「變數」狀態轉成字串 
     // 否則''沒包起來，對javascript來說還是變數

     // 兩種讓a失效的方法
     // <a href="#" onclick="return false;">link1</a>  
     // <a href="javascript:void(0);">link2</a>   

     var couponState = <?php echo 
     isset($_SESSION["couponNo"])? $_SESSION["couponNo"] : "'nocoupon'" ?>;
     
        var loginState = <?php echo 
        isset($_SESSION["memNo"])? $_SESSION["memNo"]:"'nologin'" ?>;

        var couponState = <?php echo 
        isset($_SESSION["couponNo"])? $_SESSION["couponNo"] : "'nocoupon'" ?>;

        // basic_state_tip
        // alert(loginState);  
        // alert(couponState); 

        var conversation;

        //守門員取消 連結直接進入
        linkOpen(); 

        //-----
        //守門員
        //-----
        // if(loginState != "nologin"){ 
        //      conversation = 
        //      "會員 "+'<?php //echo isset($_SESSION["memName"])? $_SESSION["memName"]:"" ?>'+" 您好，歡迎您登入本遊戲大廳！您可以透過遊戲，來取得折價券。 ";
        //      // alert(conversation);  
        //      callComment(conversation)
        //      //允許進入
        //      linkOpen(); 


        //         // // alert("很好 你有登入 看你有沒有折價券");  
        //         // if(couponState==0){
        //         //      conversation = "會員您好，恭喜您符合遊玩條件！您可以透過遊戲取得折價券。 "
        //         //      // alert(conversation);  
        //         //      callComment(conversation)
        //         //      //允許進入
        //         //      linkOpen();
        //         // }
        //         // else{
        //         //     conversation = "會員您好，很抱歉！  您有尚未使用的折價券，請您消費後再行遊玩，謝謝。"
        //         //     // alert(conversation);  
        //         //     callComment(conversation)
        //         //     //禁止進入
        //         //     linkClose();
        //         // }

        // }else{
        //     conversation = "會員您好，很抱歉！  您尚未登入，請您登入後再行遊玩，謝謝。"
        //     // alert(conversation);  
        //     // callComment(conversation)
        //     //禁止進入
        //     linkClose();
        //     //登入提問
        //     //  setTimeout(function(){ 
        //     //     loginQuestion();
        //     // }, 8000);
             
        // }

        //  document.getElementById("btnLogin").
        //          addEventListener("click", function(){
        //             // alert("HELLO"); 
        //             // console.log("登入狀態:已登入"); 
        //             setTimeout(location.reload(),2000);
                     
        //         });
 

        function loginQuestion(){
           console.log("登入狀態:尚未登入"); 

           $('#NotLogged').css({"display":"block"});

               $('#reBtn').click(function(){
                $('#NotLogged').css('display','none'); 
                   //禁止進入
                   linkClose(); 
                });
                 $('#GoToBtn').click(function(){
                $('#NotLogged').css('display','none');
                    //帳密輸入燈箱
                    showLoginForm(); 
                    //允許進入
                    linkOpen();
                 });
                  
                 document.getElementById("btnLogin").
                 addEventListener("click", function(){
                    // alert("HELLO"); 
                    // console.log("登入狀態:已登入"); 
                    // setTimeout(location.reload(),1000);
                     
                });
  
        }

        //簡化
        function linkOpen(){//允許進入
            document.querySelector(".H_soundPratice a").href="SoundTest.php"
            document.querySelector(".H_rhythmGame a").href="RhythmGame.php"
        }
        function linkClose(){//禁止進入
            
            document.querySelector(".H_soundPratice a").href="#" 
            document.querySelector(".H_rhythmGame a").href="#"
            addClickTip(); 
        }

        function addClickTip(){
            document.querySelector(".H_soundPratice a").
             addEventListener("click", function(){
                
                 callComment(conversation) 
                
             }); 
             document.querySelector(".H_rhythmGame a").
             addEventListener("click", function(){
                 
                 callComment(conversation) 

             }); 

        }

        function callComment(conversation){
             var comment = document.querySelector('#comment');
             comment.firstElementChild.innerText = conversation;
             comment.style.opacity = '1' ; 
             comment.style.transform = 'translate(-50%,480px)'; 
             comment.style.padding  = '20px 20px';
             if(window.screen.width<767){
                comment.style.transform = 'translate(-50%,350px)';
            };
             setTimeout(function(){ 
                comment.style.transform = 'translate(-50%,-65px)';
            }, 7000);
        } 
</script>
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
    <!-- TweenMax -->
    <script src="js/TweenMax/Tweenmax.js"></script>
    <script src="js/Logo_neon.js"></script>
    <script src="js/memLogin.js"></script>
</body>

</html>

