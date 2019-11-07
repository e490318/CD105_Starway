<?php 
ob_start();
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>墜落｜南瓜寶寶泥</title>
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
<body class="L_body">
    <header>
        <section class="mainBar">
            <input type="checkbox" id="menu_ctr">
            <label class="menu_ctr" for="menu_ctr"></label>
            <div class="logo">
                <a href="index.html" id="logo" class="L_btn"></a>
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
        </section>
    </header>
    
    <div class="width1200">
        <!-- 第一區塊：歌手簡介 -->
        <div class="L_singer">
            <div><img src="images/CDWall/signer_head.png" alt="signer_head.png"></div>
            <div class="L_singer_wrap">
                <div class="L_singer_info">
                    <div>歌手</div>
                    <div>南瓜寶寶泥</div>
                    <span>稚嫩音色、日系演唱，轉眼成了自娛娛人的家貓，台上台下智商都只有三歲。</span>
                </div>
                <div class="L_singer_track">
                    <div>歷年專輯</div>
                    <a href="#" class="L_singer_track_s">
                        <div class="L_singer_track_s_img"><img src="images/CDWall/singer_reco1.png" alt="singer_reco1.png"></div>
                        <ul>
                            <li>墜落</li>
                            <li>2019</li>
                        </ul>
                    </a>
                    <a href="#" class="L_singer_track_s">
                        <div class="L_singer_track_s_img"><img src="images/CDWall/singer_reco2.png" alt="singer_reco2.png"></div>
                        <ul>
                            <li>台南的左手邊</li>
                            <li>2017</li>
                        </ul>
                    </a>
                    <a href="#" class="L_singer_track_s">
                        <div class="L_singer_track_s_img"><img src="images/CDWall/singer_reco3.png" alt="singer_reco3.png"></div>
                        <ul>
                            <li>綠色南瓜無添加</li>
                            <li>2014</li>
                        </ul>
                    </a>
                </div>
            </div>
        </div>

<!-- 下面這些是用PHP撈資料 - 專輯相關資訊 -->
<?php
$albumNo = $_REQUEST['albumNo'];

try {
require_once("Star_Way_Database.php");
$sql="SELECT * from info_album where albumNo='$albumNo'";
$albumInfo = $pdo->query($sql);  //gearlist 是 PDOStatement物件
$albumRow = $albumInfo->fetchAll(PDO::FETCH_ASSOC);

foreach ($albumRow as $data) {
    ?>
        <!-- 第二區塊：簡介唱片 -->
      <form action="cartAdd2.php" method="post">
            <input type="hidden" name="albumNo" value="<?php echo $data['albumNo'] ?>">
            <input type="hidden" name="albumName" value="<?php echo $data['albumName'] ?>">
            <input type="hidden" name="singer" value="<?php echo $data['albumSinger'] ?>">
            <input type="hidden" name="price" value="<?php echo $data['diskPrice'] ?>">
            <input type="hidden" name="Cover" value="<?php echo $data['albumCover'] ?>">
            <div class="L_recordInfo">
              <div class="L_CDsell_recordInfo_info">
                  <div class="L_recordInfo_img" style="display: inline">
                      <!-- <img src="images/CDWall/singer_reco.png" alt="singer_reco.png"> -->
                      <img src="images/CDWall/records/<?php echo $data['albumCover'] ?>" style="max-width: 43%">
                  </div>
                  <ul>
                      <li><?php echo $data['albumName'] ?></li>
                      <li><?php echo $data['albumSinger'] ?></li>
                      <li><?php echo $data['albumDescript'] ?></li>
                      <li style="color:#ffc107 ">價格: <?php echo $data['diskPrice'] ?></li>

                      <!-- <a href="#">放入購物車</a> -->
                      <input type="submit" name="" value="加購物車">

                  </ul>
              </div>
      </form>
    <?php 
}
//<!-- 下面這些是用PHP撈資料 - 歌曲名稱資訊 -->

$sql="SELECT * from album_track where albumNo=$albumNo";
$trackInfo = $pdo->query($sql);
$trackRow = $trackInfo->fetchAll(PDO::FETCH_ASSOC);
?>
<h5>曲目</h5>
<hr>
<?php

foreach ($trackRow as $track) {
    ?>
            <div class="L_recordInfo_track" style="padding-bottom: 0px">
                <ul style="padding-bottom:25px">
                    <li><?php echo $track['trackIndex'] ?></li>
                    <li><?php echo $track['trackName'] ?></li>
                    <li><?php echo $track['trackLength'] ?></li>
                    <div class="L_recordInfo_track_play"><i class="fas fa-play"></i><i class="fas fa-pause"></i>試聽</div>
                    <audio src="sounds/music/Dont_Hate_Me.mp3"></audio>
                </ul>

            </div>
<?php
}

}catch (PDOException $e) {
    echo "錯誤原因 : " , $e->getMessage(), "<br>";
    echo "錯誤行號 : " , $e->getLine(), "<br>"; 
}
?>
            <!-- 曲目 -->

            

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
            <span>
                <div></div>
            </span>
        </div>
        <div class="L_playbar_bg"></div>
    </div>


    <!-- TweenMax -->
    <script src="js/TweenMax/Tweenmax.js"></script>

    <!-- JS --> 
    <script src="js/Logo_neon.js"></script>
    
    <!-- 曲目播放 -->
    <script>
        var Ltrackplay = document.getElementsByClassName('L_recordInfo_track_play');
        var Lplaybar = document.getElementById('L_playbar');
        var LPlayPP = document.getElementById('L_playbar_ctrl_PP');

        for( let i = 0; i < Ltrackplay.length; i++ ){
            //點擊曲目播放鈕
            
            Ltrackplay[i].onclick = function(){

                if(this.firstElementChild.style.display != 'none'){

                    //顯示播放列表
                    Lplaybar.style.display = 'flex';

                    //切換文字
                    this.innerHTML = '<i class="fas fa-play"></i><i class="fas fa-pause"></i>暫停';
                    this.firstElementChild.style.display = 'none';
                    this.firstElementChild.nextElementSibling.style.display = 'inline-block';

                    //播放音樂
                    this.nextElementSibling.play();

                    //改變播放列表PP
                    LPlayPP.firstElementChild.style.display = 'none';
                    LPlayPP.lastElementChild.style.display = 'inline-block';

                }else{
                    //隱藏播放列表
                    setTimeout(function(){
                        Lplaybar.style.display = 'none';
                    },3000)

                    //切換文字
                    this.innerHTML = '<i class="fas fa-play"></i><i class="fas fa-pause"></i>播放';
                    this.firstElementChild.style.display = 'inline-block';
                    this.firstElementChild.nextElementSibling.style.display = 'none';

                    //音樂暫停
                    this.nextElementSibling.pause();

                    //改變播放列表PP
                    LPlayPP.firstElementChild.style.display = 'inline-block';
                    LPlayPP.lastElementChild.style.display = 'none';
                }
            }            
        }
    </script>

    <!-- 留言區檢舉 --> 
    <script>
        var LReport = document.getElementsByClassName('L_record_comm_board_head_report');
        var LReportDiv = document.getElementsByClassName('L_record_comm_board_head_report_div');
        var divIndd;
        
        for( let i = 0; i < LReport.length; i++ ){
            
            if(window.outerWidth > 768){
                // console.log('Width > 768');

                //桌機，hover到...就開啟檢舉
                LReport[i].onmouseover = function () {

                    // console.log(LReport);
                    this.firstElementChild.style.display = 'none';
                    this.firstElementChild.nextElementSibling.style.display = 'block';

                    //按下檢舉就alert
                    this.firstElementChild.nextElementSibling.onclick = function(){
                        alert('確定要檢舉此留言嗎？');
                    }
                }
                //桌機，out就關閉檢舉
                LReport[i].onmouseout = function () {
                    this.firstElementChild.style.display = 'block';
                    this.firstElementChild.nextElementSibling.style.display = 'none';
                }
                
            }else{

                //手機，click...就開啟檢舉
                LReport[i].onclick = function () {
                    this.firstElementChild.style.display = 'none';
                    this.firstElementChild.nextElementSibling.style.display = 'block';
                    // this.firstElementChild.nextElementSibling.nextElementSibling.style.display = 'block';

                    //手機，先寫假的3秒後關閉檢舉
                    setTimeout(function(){

                        for( j = 0; j < LReportDiv.length; j++ ){
                            LReportDiv[j].style.display = 'none';
                            LReport[j].firstElementChild.style.display = 'block';
                            // this.firstElementChild.style.display = 'block';
                        }
                    },3000)
                }
                //手機，click檢舉就alert
                LReport[i].firstElementChild.nextElementSibling.onclick = function(){
                    alert('確定要檢舉此留言嗎？');
                }


                //手機，click檢舉以外的地方就關閉檢舉 失敗!!
                // LReport[i].firstElementChild.nextElementSibling.nextElementSibling.onclick = function(){
                // console.log(this);

                //     this.style.display = 'none';//失敗
                //     // this.firstElementChild.nextElementSibling.style.display = 'none';
                //     // this.firstElementChild.style.display = 'block';
                // }
            }
        }
    </script>

</body>
</html>