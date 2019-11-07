<?php
$err ='';
try {
    require_once('Star_Way_Database.php');
    $sql ='SELECT * FROM info_album' ;
    $info_album = $pdo->query($sql);
    // $row = $info_album ->fetch();
    $albumRows = $info_album -> fetchAll(PDO::FETCH_ASSOC);
    // print_r($row);
} catch (Exception $e) {
    $err .= "錯誤 : ".$e -> getMessage()."<br>";
    $err .= "行號 : ".$e -> getLine()."<br>"; 
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
<!-- jQuery-->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Tweenmax的Scroll套件-->
<script src="js/TweenMax/ScrollToPlugin.min.js"></script>
<!-- 搭配Scroll的ScrollMagic套件-->
<script src="js/ScrollMagic/ScrollMagic.min.js"></script>
<script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
<script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
<!-- blurrymenu套件 -->
<!-- <script src="jquery-1.11.3.min.js"></script> -->
<!-- <script src="js/BlurryMenu/jquery.min.js"></script>
<script src="js/BlurryMenu/ext_html2canvas.js"></script>
<script src="js/BlurryMenu/ext_fastblur.js"></script>
<script src="js/BlurryMenu/blurry-menu.js"></script>  -->
</head>
<body>
<?php 
if ($err !='') {
    echo  "<div style='color: #fff'>$err</div>";
}else{
?>
    <?php  foreach ($albumRows as $data) {
    
?>
 
    <section class="mainBar">
        <div class="logo">
            <a href="index.html" id="logo" class="L_btn"></a>
            <img class="logo_b" src="images/logo_b.png" alt="logo.png">
            <img class="logo_d" src="images/logo_d.png" alt="logo.png">
            <audio id="neonSound" src="sounds/neon.mp3"></audio>
            <div id="L_box"></div>
        </div>
        <div class="width1200">
            <ul class="menu">
                <li><a class="L_CD" href="CDWall.html">唱片牆</a></li>
                <li><a href="Game.html">星錘百練</a></li>
                <li><a href="Record.html">專輯製作</a></li>
                <li><a href="Class.html">加值課程</a></li>
                <li><a href="About.html">關於我們</a></li>
            </ul>
        </div>
		<div class="nav_user">
            <a href="user.html"><i class="fas fa-user"></i></a>
            <a href="cartPage.php"><i class="fas fa-shopping-cart"></i></a>
        </div>
        <div class="sidebar">  <!-- 左側每屏導覽 -->
            <p>人氣專輯</p>
        </div>
        <div class="L_side_swich">
            <a class="L_side_swich_1">
                <p>銷售專輯</p>
                <img src="images/CDWall/buy.png" alt="buy.png">
            </a>
            <a  class="L_side_swich_2">
                <img src="images/CDWall/donate.png" alt="donate.png">
                <p>募資專輯</p>
            </a>
            <div id="switchBar"></div>
        </div>
    </section>

    <!-- 第一屏：人氣唱片 -->
    <div class="L_pop_bg">
        <img src="images/CDWall/3d_bcg.png" alt="3d_bcg.png">
    </div>
    <div class="L_pop_record">
        <a href="index.html" id="logo"></a>
        <!-- <img src="images/CDWall/reco.png" alt="reco.png"> -->
        <img src="images/CDWall/<?php echo $data['albumCover'] ?>">
    </div>
    
    <section class="L_pop">
     <form id="validationForm" action="cartAdd.php" method="post">
            <div class="L_pop_cont">  
            <input type="hidden" name="PHPalbemName" id="albemName" value="墜落">
            <input type="hidden" name="PHPsinger" id="singer" value="南瓜寶寶泥">
            <input type="hidden" name="PHPprice" id="price" value="350">
            <input type="hidd   `en" name="PHPimageName" id="imageName" value="reco_03.png">
            <!-- <span>墜落</span> -->
            <span><?php echo $data['albumName'].'<br>'; ?></span>
            <a href="#">南瓜寶寶泥</a>
            <a href="#">01 There's nothing to prove</a>
            <a href="#">02 看不見</a>
            <a href="#">03 在那邊境</a>
            <a href="#">04 我們像朋友般一直走然後死去</a>
            <span id="Y_cdPrice">NT$ 350</span><br>
            <input class="L_addCart" type="submit" value="放入購物車">
        </div>
    </form>
        <div class="L_pop_swich">
            <ul>
                <a href="#"><li></li></a>
                <a href="#"><li></li></a>
                <a href="#"><li></li></a>
                <a href="#"><li></li></a>
                <a href="#"><li></li></a>
            </ul>
        </div>
    </section>

    <!-- 第二屏：強打唱片 -->
    <section class="L_wall">


        <div class="L_wall_card">
            <a href="#">
                <div class="L_wall_card_cont">
                    <img src="images/CDWall/records/reco1.png" alt="reco1.png">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>


        <div class="L_wall_card">
            <a href="#">
                <div class="L_wall_card_cont">
                    <img src="images/CDWall/records/reco2.png" alt="reco2.png">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>


        <div class="L_wall_card">
            <a href="#">
                <div class="L_wall_card_cont">
                    <img src="images/CDWall/records/reco3.png" alt="reco3.png">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                        <p class="L_wall_card_cont_wrap_p">伍悅渾然天成的氣場與稚嫩音色配上徐子權咬字、編排帶著些許日系特色的演唱，讓海豚刑警成...</p>
                    </div>
                </div>
            </a>
        </div>


        <div class="L_wall_card">
            <a href="#">
                <div class="L_wall_card_cont">
                    <img src="images/CDWall/records/reco4.png" alt="reco4.png">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>


        <div class="L_wall_card">
            <a href="#">
                <div class="L_wall_card_cont">
                    <img src="images/CDWall/records/reco5.png" alt="reco5.png">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>


        <div class="L_wall_card">
            <a href="#">
                <div class="L_wall_card_cont">
                    <img src="images/CDWall/records/reco5.png" alt="reco5.png">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>


        <div class="L_wall_card">
            <a href="#">
                <div class="L_wall_card_cont">
                    <img src="images/CDWall/records/reco5.png" alt="reco5.png">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                        <p class="L_wall_card_cont_wrap_p">伍悅渾然天成的氣場與稚嫩音色配上徐子權咬字、編排帶著些許日系特色的演唱，讓海豚刑警成...</p>
                    </div>
                </div>
            </a>
        </div>


        <div class="L_wall_card">
            <a href="#">
                <div class="L_wall_card_cont">
                    <img src="images/CDWall/records/reco5.png" alt="reco5.png">
                    <div class="L_wall_card_cont_wrap">
                        <p>兩人路上遇見無名沙漠就邊走邊取名</p>
                        <p>珍妮 伯孜</p>
                        <span class="L_wall_card_cont_wrap_star">
                            <i class="fas fa-star"></i>
                            <span>購買次數：11</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </section>


     <!-- 播放列表 -->
    <div class="L_playabar">
        <span>
            <div></div>
        </span>
        <div class="L_playabar_img">
            <img src="images/CDWall/records/reco7_s.png" alt="reco7_s.png">
        </div>
        <div class="L_playabar_text">
            <p>老舊壞門</p>
            <p>把山姆</p>
        </div>
        <div class="L_playabar_ctrl">
            <img src="images/CDWall/backward.png" alt="backward.png">
            <div>
                <img src="images/CDWall/play.png" alt="play.png">
                <img src="images/CDWall/pause.png" alt="pause.png">
            </div>
            <img src="images/CDWall/forward.png" alt="forward.png">
        </div>
        <div class="L_playabar_vol">
            <i class="fas fa-volume-off"></i>
            <span>
                <div></div>
            </span>
        </div>
        
        <div class="L_playabar_bg"></div>
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



    <!-- <section class="footer width1700"> 先隱藏待寫js
        <div class="copyright">
            <div>copyright © </div>
            <span>starway</span>
        </div>
        <div class="trd">
            <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
            <a href="https://www.google.com/"><img src="images/g+.png" alt="g+.png"></a>
            <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
        </div>
    </section> -->



    <!-- TweenMax -->
    <script src="js/TweenMax/Tweenmax.js"></script>

    <!-- JS --> 
    <script src="js/Logo_neon.js"></script>
    <!-- <script src="js/logo_spark_test.js"></script> -->
    <?php 
    }
     ?>
<?php 
}
?>    
</body>
</html>