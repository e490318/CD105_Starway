<?php 
ob_start();
session_start();
if(isset($_SESSION["memNo"]) ==true){ //從session裡確認是否有memNo的變數。若有該變數，則宣告一個Session_memNo變數等於session裡的memNo,目的是要讓javascript去抓可以用這個PHP的變數，來判斷是否有登入
 $Session_memNo = $_SESSION["memNo"];
 }
else{
  $Session_memNo = 0;
}

$err ='';
try {
    require_once('Star_Way_Database.php');
    $plan ='SELECT * FROM fund_plan' ;
    $fund_plan = $pdo->query($plan);
    // $row = $info_album ->fetch();
    $planRows = $fund_plan -> fetchAll(PDO::FETCH_ASSOC);
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
<!-- 會員登入notLoginYet -->
<script src="js/notLoginYet.js"></script>
<!-- blurrymenu套件 -->
<!-- <script src="jquery-1.11.3.min.js"></script> -->
<!-- <script src="js/BlurryMenu/jquery.min.js"></script>
<script src="js/BlurryMenu/ext_html2canvas.js"></script>
<script src="js/BlurryMenu/ext_fastblur.js"></script>
<script src="js/BlurryMenu/blurry-menu.js"></script>  -->

</head>
<body class="L_body">
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
            <div class="logo">
                <a href="starway.php" id="logo" class="L_btn"></a>
                <img class="logo_b" src="images/logo_b.png" alt="logo.png">
                <audio id="neonSound" src="sounds/neon.mp3"></audio>
                <div id="L_box"></div>
            </div>
            <nav>
            <ul class="menu">
                    <li><a class="menu_items" href="CDWall.php">募唱片</a></li>
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
                <a href="user.php"><i class="fas fa-user"></i></a>
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


        <!-- 第二區塊：簡介唱片 -->


        <?php
$albumNo = $_REQUEST['albumNo'];
// printf($data)['albumNo'];
// exit();
try {
require_once("Star_Way_Database.php");
$sql="SELECT * from info_album where albumNo='$albumNo'";
$albumInfo = $pdo->query($sql);  //gearlist 是 PDOStatement物件
$albumRow = $albumInfo->fetchAll(PDO::FETCH_ASSOC);

foreach ($albumRow as $data) {
    // print_r($data['albumNo']);？
    // exit();
    ?>


    <form class="L_reco_hot" action="cartAdd.php" method="post">
            <input type="hidden" name="albumNo" value="<?php echo $data['albumNo'] ?>">
            <input type="hidden" name="albumName" value="<?php echo $data['albumName'] ?>">
            <input type="hidden" name="singer" value="<?php echo $data['albumSinger'] ?>">
            <input type="hidden" name="price" value="<?php echo $data['diskPrice'] ?>">
            <input type="hidden" name="Cover" value="<?php echo $data['albumCover'] ?>">
        <div class="L_recordInfo">
            <div class="L_CDsell_recordInfo_info">
                <div class="L_recordInfo_img">
                    <img src="images/CDWall/records/<?php echo $data['albumCover'] ?>" alt="singer_reco.png">
                </div>
                <ul>
                      <li><?php echo $data['albumName'] ?></li>
                      <li><?php echo $data['albumSinger'] ?></li>
                      <li><?php echo $data['albumDescript'] ?></li>
                      <li>售價： <?php echo $data['diskPrice'] ?> 元</li>
                    <input type="submit" name="" value="加購物車">
                </ul>
            </div>
    </form>
     <?php 
 }  
            //<!-- 曲目 -->
          
$sql="SELECT * from album_track where albumNo=$albumNo";
$trackInfo = $pdo->query($sql);
$trackRow = $trackInfo->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="L_recordInfo_track">
    <div>曲目</div>
<?php

foreach ($trackRow as $track) {
    ?>     
        <ul>
            <li class="L_recordInfo_track_index"><?php echo $track['trackIndex'] ?></li>
            <li><?php echo $track['trackName'] ?></li>
            <li><?php echo $track['trackLength'] ?></li>
            <div class="L_recordInfo_track_play"><i class="fas fa-play"></i><i class="fas fa-pause"></i>試聽</div>
            <audio src="sounds/music/<?php echo $track['trackName'] ?>"></audio>
        </ul>
<?php
}

}catch (PDOException $e) {
    echo "錯誤原因 : " , $e->getMessage(), "<br>";
    echo "錯誤行號 : " , $e->getLine(), "<br>"; 
}
?>
        </div>
            <!-- 留言 -->
            <div class="L_record_comm">
                <div>留言</div>
                <div class="L_record_comm_board">
                    <div class="L_record_comm_board_head">
                        <div><img src="images/CDWall/comm_head1.png" alt="comm_head1.png"></div>
                        <div>Amber</div>
                    </div>
                    <ul>
                        <li>喔喔喔等一年了！</li>
                        <li>2019/05/27</li>
                        <li>
                            <img src="images/CDWall/ellipsis.png" alt="ellipsis.png">
                            <div class="L_record_comm_board_head_report_div">檢舉</div>
                            <span></span>
                        </li>
                    </ul>
                </div>

                <div class="L_record_comm_board">
                    <div class="L_record_comm_board_head">
                        <div><img src="images/CDWall/comm_head2.png" alt="comm_head2.png"></div>
                        <div>陳博伯</div>
                    </div>
                    <ul>
                        <li>喜歡：Ｄ</li>
                        <li>2019/04/18</li>
                        <li>
                            <img src="images/CDWall/ellipsis.png" alt="ellipsis.png">
                            <div class="L_record_comm_board_head_report_div">檢舉</div>
                            <span></span>
                        </li>
                    </ul>
                </div>

                <div class="L_record_comm_board">
                    <div class="L_record_comm_board_head">
                        <div><img src="images/CDWall/comm_head3.png" alt="comm_head3.png"></div>
                        <div>老彭</div>
                    </div>
                    <ul>
                        <li>這曲風是不是在抄黑莓啊？</li>
                        <li>2019/03/30</li>
                        <li>
                            <img src="images/CDWall/ellipsis.png" alt="ellipsis.png">
                            <div class="L_record_comm_board_head_report_div">檢舉</div>
                            <span></span>
                        </li>
                    </ul>
                </div>

                <div class="L_record_comm_more"><i class="fas fa-caret-down"></i>看更多</div>

                <div class="L_record_comm_write">
                        <div class="L_record_comm_write_head">
                            <div><img src="images/CDWall/comm_head4.png" alt="comm_head4.png"></div>
                            <div>異香人</div>
                        </div>
                        <input type="textarea" name="" placeholder="寫下你的留言...">
                    </div>

            </div>
        </div>
    </div>

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

 
    <!-- footer -->   
    <section class="footer width1700">
        <div class="copyright">
            <div>copyright © </div>
            <span>starway</span>
        </div>
        <div class="trd">
            <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
            <a href="https://www.google.com/"><img src="images/g+.png" alt="g.png"></a>
            <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
        </div>
    </section>


    <!-- TweenMax -->
    <script src="js/TweenMax/Tweenmax.js"></script>

    <!-- JS --> 
    <script src="js/Logo_neon.js"></script>
    
    <!-- 曲目播放 -->

    <script>

        var LTrackPlay = document.getElementsByClassName('L_recordInfo_track_play');


        for( i = 0; i < LTrackPlay.length; i++ ){

            LTrackPlay[i].onclick = function(){

                if(this.firstElementChild.style.display != 'none'){
                  //若為暫停中
                  console.log('暫停中');

                    this.firstElementChild.style.display = 'none';
                    this.lastElementChild.style.display = 'inline-block';
                    this.lastElementChild.nextSibling.nodeValue = '暫停';
                    this.nextElementSibling.play();
                
                }else{
                   //若為播放中
                    console.log('播放中');

                    this.firstElementChild.style.display = 'inline-block';
                    this.lastElementChild.style.display = 'none';
                    this.lastElementChild.nextSibling.nodeValue = '試聽';
                    this.nextElementSibling.pause();
                    this.nextElementSibling.load();
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

</body>
</html>