<?php
ob_start();
session_start();
if(isset($_FILES['upFile']['tmp_name']) ==true){
    $demoLinkName = $_FILES['upFile']['name'];
    $from = $_FILES['upFile']['tmp_name'];
    $to = "images/Record/demo/" . $_FILES['upFile']['name'];
    copy( $from, $to);
}else{
$demoLinkName = $_SESSION["demoLinkName"].".mp3";
}
echo $demoLinkName ;


if(isset($_SESSION["memNo"]) ==true){ //從session裡確認是否有memNo的變數。若有該變數，則宣告一個Session_memNo變數等於session裡的memNo,目的是要讓javascript去抓可以用這個PHP的變數，來判斷是否有登入
    $Session_memNo = $_SESSION["memNo"];
}else{
    $Session_memNo = 0;
}

    require_once("Star_Way_Database.php");
    $sql="SELECT * from album_bgimg where shelfStatus='1'";
    $info_album = $pdo->query($sql);  //gearlist 是 PDOStatement物件
    $albumRow = $info_album->fetchAll(PDO::FETCH_ASSOC);

// $err ='';
// try {
//     require_once('Star_Way_Database.php');
//     $bgimg ='SELECT * FROM album_bgimg' ;
//     $album_bgimg = $pdo->query($bgimg);
//     // $row = $info_album ->fetch();
//     $bgimgRows = $album_bgimg -> fetchAll(PDO::FETCH_ASSOC);
//     // print_r($row);
// } catch (Exception $e) {
//     $err .= "錯誤 : ".$e -> getMessage()."<br>";
//     $err .= "行號 : ".$e -> getLine()."<br>"; 
// }
?>
<!DOCTYPE html>
<html>
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
    <!-- <script src="js/cuDrag.js"></script> -->

    <!-- Draggable -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js" defer></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" defer></script>

    <!-- jQuery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.ui.touch-punch.js"></script>
    <!-- jQuery.js v1.11.1 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <!--jquery-uiCDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PreloadJS/1.0.1/preloadjs.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    
    <!-- 轉為圖檔 -->
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.js "></script>
    <script src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-3.0.0.js "></script>
    <!-- <script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>

    <!--preloader CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/3/turn.min.js"></script>
    <!--turnJS CDN -->
    <!-- <script src="./js/plugin/modernizr.2.5.3.min.js"></script> -->
    <!--odometer  JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/scrolloverflow.min.js"></script>

    <script src="js/TweenMax/ScrollToPlugin.min.js"></script>
    <!-- 搭配Scroll的ScrollMagic套件-->
    <script src="js/ScrollMagic/ScrollMagic.min.js"></script>
    <script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
    <script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
    <script src="js/notLoginYet.js"></script>
    <!-- <script src="js/cugetAlbum.js"></script> -->
    <script src="js/jQueryRotate.2.1.js"></script>
    
    <!-- <style>
    .cuProCD2{
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

        <!-- 製作完成效果 -->
        <div class="Y_cus_finish">
        <div class="Y_text_bg">
            <p class="text">恭喜！成功上架</p>
        </div>
        </div>

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
                    <li class="login_mobile"><a class="menu_items " href="#"><i class="fas fa-shopping-cart"></i></a></li>
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

    <!-- 步驟二：專輯封面 -->
    <section class="A-record">
        <div class="sidebar1">
            <!-- 左側每屏導覽 -->
            <p>做專輯</p>
        </div>
        <div class="section A-record">
            <div class="width1200 A-page1st A-albumArea">
                
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
                        <img class="cuProCD2" src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-2-02-02.png" alt="star-with-number-1">
                        <p>製作專輯封面</p>
                    </div>
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro3">
                        <img class="cuProCD3" src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-3-03-03.png" alt="star-with-number-1">
                        <p>填寫專輯介紹</p>
                    </div>
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro4">
                        <img class="cuProCD4" src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-4-04-04.png" alt="star-with-number-1">
                        <p>上架至募資牆</p>
                    </div>
                </div>
                <!--步驟流程 end-->

                <!-- <script>
                
                $('.A-bg').on('click',function(e){
                    e.preventDefault();
                    $(this).toggleClass('active');
                });
                </script> -->

                <h2>製作屬於自己的專輯封面</h2>


                <div class="A-albumAll">
                    <!-- 專輯畫布 -->
                    <div class="A-centerBox">
                        <div id="dropZone" class="A-box image">
                            <img id="imgPreview">
                            <div id="dropzoneContent1">
                                <!--文字-->
                                <span id="dropzoneContentimage1"></span>
                            </div>
                            <div id="dropzoneContent2" class="dropzoneContent2">
                                <img id="dropzoneContentimage2" class="dropzoneContentimage2" src="">
                                <!--官方貼圖-->
                            </div>
                            <div id="dropzoneContent3" class="dropzoneContent3">
                                <img id="dropzoneContentimage3" class="dropzoneContent3" src="">
                                <!--自傳貼圖-->
                            </div>
                            <!-- <img src="images//pay_reco4.png"> -->
                        </div>
                        <!-- <input type="file" id="theFile"> -->
                        <div class="controls">
                            <!-- <label for="hue">色相:</label> -->
                            <input id="hue" type="range" name="hue" min="0" max="360" value="0" data-sizing="deg" class="range blue"><br>
                            <img src="images/Record/color-bar.png" alt="color-bar">
                        </div>
                        <div id="mob-btns">
                            <img id="scaleBig" class="culargeButton" src="images/Record/cuControlBig.png"
                                alt="big">
                            <img id="scaleSmall" class="cusmallButton" src="images/Record/cuControlSmall.png"
                                alt="small">
                            <img id="clockwise" class="cuturnrightButton" src="images/Record/cuControlLeft.png "
                                alt="turn right">
                            <img id="clockwiseReverse" class="cuturnleftButton" src="images/Record/cuControlRight.png"
                                alt="turn left">
                            <img id="removeImg" class="cudeleteButton" src="images/Record/cuControlDelete.png"
                                alt="delete">
                        </div>
                        <!-- <button><a id="auto">下載圖片</a></button>
                        <input type="submit" value="轉為圖檔" />
                        <a></a>
                        <fieldset>
                            <legend>圖檔</legend>
                            <div>
                            </div>
                        </fieldset> -->
                    </div>
                    
                    <!-- 操作面板 -->
                    <section class="wrapper">
                        <ul class="tabs">
                            <li class="active">專輯背景</li>
                            <li>專輯標題</li>
                            <li>專輯圖案</li>
                        </ul>

                        <ul class="tab__content">
                            <li class="active A-bg">
                                <div class="content__wrapper A-bgBox">
                                    <h2 class="text-color">-請選擇你喜歡的背景圖-</h2>
                                    <!-- <form action="/somewhere/to/upload" enctype="multipart/form-data">
                                            <input type="file" onchange="readURL(this)" targetID="preview_progressbarTW_img" accept="image/gif, image/jpeg, image/png"/ >
                                            <img id="preview_progressbarTW_img" src="#" />
                                        </form> -->
                                    <div class="A-bgBox1">
                                        <!-- 撈取背景圖資料 -->
                                        <?php 
                                        foreach ($albumRow as $cusImg) {
                                            ?>
                                        <img src="images/Record/small/<?php echo $cusImg['bgImg'] ?>" id="srcImg" class="small" alt="small" onclick="loadImage()"/>
                                        <?php 
                                        }
                                         ?>

                                        <div class="labelBox">
                                            <label>
                                                <input type="file" name="upFile" id="upFile">
                                                <p><img src="images/Record/cuLogoPlus.png" alt="Plus">8M內，正方形，jpg、png之圖檔。</p>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="content__wrapper A-rightCont">
                                    <div class="A-text">
                                        <h2>－輸入文字－</h2>
                                        <form class="textform" method="post" accept-charset="utf-8" name="form1">
                                            <input name="hidden_data" id='hidden_data' type="hidden" />
                                            <span>&nbsp;</span><input type="text" id="myWord" maxlength="6">
                                            <!-- <input type="button" class="putWord btn" id="putWord" value="送出" /> -->
                                            <!-- 文字顏色：<input type="color" class="fontChange" name="color"><br>
                                            文字大小：<input type="number"  min="10" max="20" class="fontChange" name="number"> px<br>
                                            文字字型：<select class="fontChange" name="fontFace" id="">
                                                <option value="Tahoma">Tahoma</option>
                                                <option>Comic Sans MS</option>
                                                <option>標楷體</option>
                                            </select> -->
                                            <input type="button" class="putWord btn" id="putWord" value="送出" onclick="putTextCanvas()"/>
                                        </form>
                                        <div id="btns">
                                            <!-- <i class="fas fa-search-plus" id="scaleBig"></i>
                                            <i class="fas fa-search-minus" id="scaleSmall"></i>
                                            <i class="fas fa-undo" id="clockwise"></i>
                                            <i class="fas fa-undo" id="clockwiseReverse"></i>
                                            <i class="fas fa-trash-alt" id="removeImg"></i> -->
                                            <!-- <img id="scaleBig" class="WculargeButton" src="images/Record/cuControlBig.png"
                                                alt="big">
                                            <img id="scaleSmall" class="WcusmallButton" src="images/Record/cuControlSmall.png"
                                                alt="small">
                                            <img id="clockwise" class="WcuturnrightButton" src="images/Record/cuControlRight.png"
                                                alt="turn right">
                                            <img id="clockwiseReverse" class="WcuturnleftButton" src="images/Record/cuControlLeft.png"
                                                alt="turn left">
                                            <img id="removeImg" class="WcudeleteButton" src="images/Record/cuControlDelete.png"
                                                alt="delete"> -->
                                        </div>
                                        <!-- <label for="hue">色相:</label> -->
                                        <!-- <input id="hue" type="range" name="hue" min="0" max="360" value="0" data-sizing="deg">
                                        <img src="images/Record/color-bar.png" alt="color-bar"> -->
                                    </div>

                                </div>
                            </li>
                            <li>
                                <div class="content__wrapper A-rightCont">
                                    <h2>－點選你想要的專輯圖案－</h2>
                                    <div class="A-iconImg">
                                        <div id="imgBox" class="A-iconbg">
                                            <!-- <div class="culogobtns"></div> -->
                                            <img src="images/Record/logo_D.png" class="SS10 mobtattooss img" id="img9"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/LOGO-01.png" class="SS11 mobtattooss img" id="img10"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/LOGO-02.png" class="SS12 mobtattooss img" id="img11"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/LOGO-03.png" class="SS11 mobtattooss img" id="img10"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/LOGO-04.png" class="SS12 mobtattooss img" id="img11"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/starWaylogo.png" class="SS1 mobtattooss img" id="img0"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/LOGO-05.png" class="SS2 mobtattooss img" id="img1"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/LOGO-06.png" class="SS3 mobtattooss img" id="img2"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/StarWayIcon-08.png" class="SS4 mobtattooss img" id="img3"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/StarWayIcon-02.png" class="SS5 mobtattooss img" id="img4"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/StarWayIcon-03.png" class="SS6 mobtattooss img" id="img5"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/StarWayIcon-04.png" class="SS7 mobtattooss img" id="img6"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/StarWayIcon-05.png" class="SS8 mobtattooss img" id="img7"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/StarWayIcon-06.png" class="SS9 mobtattooss img" id="img8"
                                                alt="icon" onclick="loadImage22()"/>
                                            <img src="images/Record/StarWayIcon-07.png" class="SS10 mobtattooss img" id="img9"
                                                alt="icon" onclick="loadImage22()"/>

                                            <label class="iconLabel">
                                                <input type="file" name="upFile" id="fileUpload" style="display:none">
                                                <!-- <img src="images/Record/newbg.png"> -->
                                                <!-- <p>8M內，jpg、png之圖檔。</p> -->
                                                <p><img class="iconLabelImg" src="images/Record/cuLogoPlus.png" alt="Plus">8M內，jpg、png之圖檔。</p>
                                                <!-- <p>png之圖檔。</p> -->
                                            </label>
                                        </div>

                                        <div id="btns">
                                            <img id="big" class="culargeButton" src="images/Record/cuControlBig.png"
                                                alt="big">
                                            <img id="small" class="cusmallButton" src="images/Record/cuControlSmall.png"
                                                alt="small">
                                            <img id="rotate" class="cuturnrightButton" src="images/Record/cuControlRight.png"
                                                alt="turn right">
                                            <img id="reverse" class="cuturnleftButton" src="images/Record/cuControlLeft.png"
                                                alt="turn left">
                                            <img id="trash" class="cudeleteButton" src="images/Record/cuControlDelete.png"
                                                alt="delete">
                                        </div>
                                        <!-- </form>
                                            <input id="MyImage" type="button" value="製作完成" />
                                            <fieldset></fieldset>

                                            <form id="myForm">
                                            <input type="hidden" name="myImage" id="myImage">
                                        </form> -->
                                        <!-- <div id="mob-btns">
                                            <img id="scaleBig" class="culargeButton" src="images/Record/cuControlBig.png"
                                                alt="big">
                                            <img id="scaleSmall" class="cusmallButton" src="images/Record/cuControlSmall.png"
                                                alt="small">
                                            <img id="clockwise" class="cuturnrightButton" src="images/Record/cuControlLeft.png "
                                                alt="turn right">
                                            <img id="clockwiseReverse" class="cuturnleftButton" src="images/Record/cuControlRight.png"
                                                alt="turn left">
                                            <img id="removeImg" class="cudeleteButton" src="images/Record/cuControlDelete.png"
                                                alt="delete">
                                        </div> -->
                                        <!-- <button id="confirmCustResult" class="btn">
                                            設計完成
                                        </button> -->
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </section>
                    <script src="js/index.js"></script>

                </div>
                <div class="clear-fix"></div>
                <div class="step2ndBnt">
                    <a href="Record.php">
                        <button id="A-beforeButton">上一步</button>
                    </a>
                    <!-- <a href="MakingAlbum2.php"> -->
                        <button type="submit" id="A-nextButton" class="cuNext3">下一步</button>
                    <!-- </a> -->
                </div>
                    

                <!-- 第三步驟 -->
                <div class="A-step3box">
                    <img class="A-recordCD" src="images/Record/cd.png" alt="cd">
                </div>
                <div class="clear-fix"></div>
                <div class="A-textarea">
                    <form class="textform" method="post" accept-charset="utf-8" name="form1">
                        <h4>專輯名稱</h4>
                        <!-- <input name="hidden_data" id='hidden_data' type="hidden" /> -->
                        <input type="text" id="cuUserAlbumTitle" class="cuWriteContent" name="cuUserAlbumTitle" placeholder="您的專輯名稱" />
                        <!-- <input type="button" class="putWord btn" id="putWord" value="送出" /> -->
                        <h4>專輯內容</h4>
                        <textarea name="" id="cuUserAlbumContent" class="cuWriteContent" name="cuUserAlbumContent" cols="45" rows="6" placeholder="請輸入專輯介紹內容..." /></textarea><br>
                        <!-- <input type="button" class="putWord btn" id="putWord" value="製作完成" onclick="saveImage()" /> -->
                    </form>
                    <input id="MyImage" type="button" value="製作完成" />
                    <fieldset style="display:none;"></fieldset>

                    <form id="myForm">
                    <input type="hidden" name="myImage" id="myImage">
                    </form>
                    <!-- <script>
                    $(":button").click(function() { 
                    html2canvas($("#dropZone")[0]).then(function(canvas) { 
                    var $div = $("fieldset"); 
                    $div.empty(); 
                    $("<img />", { src: canvas.toDataURL("image/png") }).appendTo($div); 
                    //------------------- 
                    document.getElementById('myImage').value = canvas.toDataURL("image/png"); 
                    var formData = new FormData(document.getElementById("myForm")); 
                    
                    var xhr = new XMLHttpRequest(); 
                    xhr.open('POST', 'canvas_load_save.php', true); 
                    
                    xhr.onreadystatechange = function() { 
                    if (xhr.readyState == 4) { 
                    if( xhr.status == 200 ){ 
                    // alert('Succesfully uploaded'); 
                    }else{ 
                    alert(xhr.status); 
                    } 
                    } 
                    }; 
                    
                    xhr.send(formData); 
                    //------------------- 
                    }); 
                    });
                    </script> -->
                </div>
                <div class="step3rdBnt">
                        <button id="A-beforeButton" class="cuPrev2">上一步</button>
                        <button id="A-nextButton" class="cuNext4">下一步</button>   
                </div>
                
                <!-- 第四步驟 -->
                <!--確認資料 start-->
                <div class="cuWriteConfirm">
                    <h3 class="cuWriteTitle">請確認欲上架之專輯內容</h3>

                        <!-- <span class="cuWriteColor"></span>
                        <span class="cuWriteImg"></span>
                        <span class="cuWriteVersion"></span>	
                        <span class="cuWriteSize"></span> -->
                        <!-- <h4>姓名</h4>
                        <span class="cuWriteName"></span> -->
                        <h4>專輯名稱</h4>
                        <div class="cuWrite">
                            <span class="cuWriteAlbumTitle"></span>
                        </div>
                        <h4>專輯內容</h4>
                        <div class="cuWrite cuContentBox">
                        <span class="cuWriteContent"></span>
                        </div>
                        <!-- <button id="auto">下載圖片</button>	 -->
                </div>
                <div class="cuWriteConfirmButtons">
                        <button id="A-beforeButton" class="cuPrev3">上一步</button>
                        <input type="hidden" name="custorderStatus" value="0">
                        <button id='sendForm'>專輯上架</button>
                </div>	
                <input name="userwetsuit" id="userwetsuit" type="hidden">
                <!-- <canvas id="myCanvas" width="361" height="361"></canvas> -->

                <!-- style="display: none" -->
                <!--確認資料 end-->

                <!-- <div class="A-finish">
                    <h3>請確認你欲上架之專輯內容</h3>
                    <p>專輯名稱：NEW WAVE</p>
                    <p>專輯介紹：流行 不曾如此威脅 危險 從未這麼甜美 黑色性
                        感魅惑全球 當代樂壇頭號人物改寫全英音樂獎
                        歷史紀錄 冊封MTV歐洲音樂大獎「最佳新人」
                        2017 Spotify英國串流冠軍女王 2018 首度台北
                        演唱會全數完售 「英倫危險甜心」
                        杜娃黎波 DUA LIPA
                    </p>
                </div> -->
                
                <!-- <div class="step4thBnt">
                        <button id="A-beforeButton" class="cuPrev3">上一步</button>
                    <a href="MakingAlbum3.html">
                        <button id="A-nextButton" class="cuNext4">下一步</button>
                    </a>    
                </div>
                <button id="A-nextButton">專輯上架</button> -->
            </div>
        </div>
    </section>


    <footer>
        <section class="footer width1700">
            <div class="copyright">
                <div>copyright © </div>
                <span>starway</span>
            </div>
            <div class="trd">
                <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
                <a href="https://www.google.com/"><img src="images/g.png" alt="g+.png"></a>
                <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
            </div>
        </section>
    </footer>
    <!-- 轉為圖檔 -->
    <!-- <script>
    $(":submit").click(function() {
      html2canvas($("#dropZone")[0]).then(function(canvas) {
          var $div = $("fieldset div");
          $div.empty();
          $("<img />", { src: canvas.toDataURL("image/png/svg") }).appendTo($div);
          // alert(canvas.toDataURL("image/png/svg"));
      });
    });
    </script> -->

    <script>
    //點小圖換大圖 start
        memNo = <?php echo $Session_memNo?>;
        demoLinkName  = '<?php echo $demoLinkName ?>';
       

        function showLarge(e) {
            var small = e.target;


            var src = small.src.replace("small", "big").replace("SP_", "");

            var dropZone = document.getElementById("dropZone");
            dropZone.style.backgroundImage = "url(" + src + ")";
            dropZone.style.position = "relative";
            // document.getElementById("large").src = src;
        }

        function init() {
            var imgs = document.getElementsByClassName("small");
            for (var i = 0; i < imgs.length; i++) {
                imgs[i].onclick = showLarge;
            }
        }

        window.onload = init;
    //點小圖換大圖 end

    // 點擊圖進去右邊 
        var dropzoneContentimage2 = document.querySelector('#dropzoneContentimage2');
        var img = document.querySelectorAll('.mobtattooss');
        for (var i = 0; i < img.length; i++){
            img[i].addEventListener('click', function (event) {
            var imgSrc = event.target.src;
            dropzoneContentimage2.setAttribute("src", imgSrc)
            dropzoneContentimage2.style.maxHeight = '100px';
            dropzoneContentimage2.style.maxWidth = '100px';

            },false);
        }

    // 圖片換顏色 start
        var inputs = document.querySelectorAll('input');
        inputs.forEach(input => input.addEventListener('change', handleUpdate, false));
        inputs.forEach(input => input.addEventListener('mousemove', handleUpdate, false));

        function handleUpdate() {
            var suffix = this.dataset.sizing || '';
            document.querySelector('.A-box').style.filter = `hue-rotate(${this.value + suffix})`;
        }
    // 圖片換顏色 end

    // 下載圖片 start
        $(document).ready(function() {
            changlogo();        
        });
        function changlogo(){
            html2canvas($("#dropZone"), {width:361, height:361},{
                onrendered: function(canvas) {
                    $("#auto").attr('href', canvas.toDataURL("image/png"));
                    $("#auto").attr('download','myseatunnel.png');
                    var imagedata = canvas.toDataURL('image/png');
                    var imgdata = imagedata.replace(/^data:image\/(png|jpg);base64,/, "");
                    $("#userwetsuit").val(imgdata);  
                 }
             });
        };      
    // 下載圖片 end

    // 撈官方圖片資料庫
        // $.ajax({
        //  url: 'MakingAlbum-icon_data.php',       
        //  dataType: 'text',           
        //  success: function(data){
        //      $('.iconLabel').before(data);
        //      // $('.culogobtns').html(data);
        //      $('.culogobtns').click(function(e){
        //          event.preventDefault(); 
        //          $('.culogobtn').css('backgroundColor','transparent');
        //          $(this).css('backgroundColor','#07336e');
        //          no = $(this).children('input').val();
        //          $('#cuupfile').val('');
        //          // console.log($(this).children('input').val());
        //          $("#userofficialImg").val(no);                          
        //          officialimgajax(no);                    
        //      });     
        //  }
        // });
    // 撈官方圖片資料庫 end
 
    // 點擊步驟二下一步觸發事件 start
        var angle = 0;
        setInterval(function(){
            angle+=3;
            $(".cuProCD1").rotate(angle);
        },15);
        var angle = 0;
        setInterval(function(){
            angle+=3;
            $(".cuProCD2").rotate(angle);
        },15);
        $(document).ready(function () {

            // console.log(1);
            $('.cuNext3').on('click', function (e) {
                // event.preventDefault();

                if (memNo != 0) {
                    // $('#cuUserName').attr('value', memName);
                    // $('#cuUserPhone').attr('value', memTel);
                    var memNum = memNo;

                    $('.wrapper').css('display', 'none');
                    $('.controls').css('display', 'none');
                    $('.step2ndBnt').css('display', 'none');
                    $('#mob-btns').css('display','none');
                    $('.A-step3box').css('display', 'block');
                    $('.A-textarea').css('display', 'block');
                    $('.step3rdBnt').css('display', 'block');
                    
                    var angle = 0;
                    setInterval(function(){
                        angle+=3;
                        $(".cuProCD3").rotate(angle);
                    },8);


                    if($('body').width() < 1200 ){
                        $('#dropZone').css('right','0%');
                    }else{          
                        $('#dropZone').css('margin','auto');
                    }

                    // if($('body').width() < 768 ){
                    //     $('.cuWetsuit').css('display','none');
                    //     $('svg').css('display','none');
                    // }else{           
                    //     $('.cuWetsuit').css('display','block');
                    //     $('svg').css('display','block');}

                    $(window).resize(function(){
                        if($('body').width() < 1200 ){
                            $('#dropZone').css('right','0%');
                        }else{
                            $('#dropZone').css('margin','auto');
                        }
                    });

                    $(window).resize(function(){
                        // console.log('2');
                        if($('body').width() < 768 ){
                            $('.cuWetsuit').css('display','none');
                            $('svg').css('display','none');
                        }else{
                            $('.cuWetsuit').css('display','block');
                            $('svg').css('display','block');}
                    });


                    // $('.cuPro3 span').css('color', '#333');
                    // $('.cuPro3 p').css('color', '#333');

                    // $("#dropzoneContent2").draggable('disable').css('cursor', 'auto');

                      // 判斷是否已經登入會員

                } else {
                    $('#NotLogged').fadeIn(500);
                    var memNum = 0;
                    // alert("還未登入");
                    console.log(memNum);
                }

            });
        });
    // 點擊步驟二下一步觸發事件 end

    // 點擊步驟三上一步觸發事件 start
    $(document).ready(function(){
        // console.log(1);
        $('.cuPrev2').on('click', function(e){
            event.preventDefault();
            $('.A-albumArea').css('display','block');
            // $('.cuPVwrap').css('display','block');
            $('.A-albumTextarea').css('display','none');
            // $('.cuButtons').css('display','block');

            $('.wrapper').css('display', 'block');
            $('.controls').css('display', 'block');
            $('.step2ndBnt').css('display', 'block');
            $('#mob-btns').css('display','block');
            $('.A-step3box').css('display', 'none');
            $('.A-textarea').css('display', 'none');
            $('.step3rdBnt').css('display', 'none');
            $('.cuProCD2').css('animation','block');
            $('.cuProCD3').css('animation','none');
            // var angle = 0;
            // setInterval(function(){
            //     angle+=3;
            //     $(".cuProCD2").rotate(angle);
            // },5000);


            if($('body').width() < 1200 ){
                $('#dropZone').css('right','0%');
            }else{          
                $('#dropZone').css('right','0%');
            }

            // if($('body').width() < 768 ){
            //     $('.cuWetsuit').css('display','none');
            //     $('svg').css('display','none');
            // }else{           
            //     $('.cuWetsuit').css('display','block');
            //     $('svg').css('display','block');}

            $(window).resize(function(){
                if($('body').width() < 1200 ){
                    $('#dropZone').css('right','0%');
                }else{
                    $('#dropZone').css('right','0%');
                }
            });

            $(window).resize(function(){
                // console.log('2');
                if($('body').width() < 768 ){
                    $('.cuWetsuit').css('display','none');
                    $('svg').css('display','none');
                }else{
                    $('.cuWetsuit').css('display','block');
                    $('svg').css('display','block');}
            });

            // $('.cuPro3 span').css('color','#fff');
            // $('.cuPro3 p').css('color','#fff');

            // $("#cuWetsuitImg").draggable({disabled: false}).css('cursor','pointer');
            // $("#cuWetsuitImg").draggable({ containment: "#containment-wrapper", scroll: false });
        });
    }); 
    // 點擊步驟三上一步觸發事件 end

    // 點擊步驟三下一步觸發事件 start
    $(document).ready(function(){

        $('.cuNext4').on('click', function(e){
            // event.preventDefault();
            cuUserAlbumTitle = $('#cuUserAlbumTitle').val();
            cuUserAlbumContent = $('#cuUserAlbumContent').val();

            if ($('.cuWriteContent').val()==''){
                alert('請填寫您的資料');
            }else if ($('#cuUserAlbumTitle').val()==''){
                alert('請填寫您的資料');
            }else if ($('#cuUserAlbumContent').val()==''){
                alert('請填寫您的資料');
            }else{

            $('.A-textarea').css('display','none');
            $('.step3rdBnt').css('display','none');
            $('.cuWriteConfirm').css('display','block');
            $('.cuWriteConfirmButtons').css('display','block');

            $('.cuWriteAlbumTitle').text(cuUserAlbumTitle);
            $('.cuWriteContent').text(cuUserAlbumContent);
            // console.log(sessionStorage['demoCover']);
            // console.log(demoLinkName);
            // console.log(memNo);

            var angle = 0;
            setInterval(function(){
                angle+=3;
                $(".cuProCD4").rotate(angle);
            },10);
            
            
            // $('.cuPro4 span').css('color','#333');
            // $('.cuPro4 p').css('color','#333');
            $( "#cuWetsuitImg" ).draggable( 'disable' ).css('cursor','auto');
            }
        });

        $('#sendForm').on('click', function (event) {
            $.ajax({
                url: 'albumFundToDb.php',
                type: 'post',
                dataType: 'text',
                data: {
                memNo: memNo,
                demoName : cuUserAlbumTitle,
                demoCover: sessionStorage['demoCover'],
                demoDescript: cuUserAlbumContent,
                demoLink: demoLinkName,
                },
                success: function(data){
                    $('.Y_cus_finish').show();
                    setTimeout(function () {
                    window.location.href='CDWall.php';
                                    }, 3000);
                 }
            });
        });

    }); 



    // 點擊步驟三下一步觸發事件 end

    // 點擊步驟四上一步觸發事件 start
    $(document).ready(function(){
        // console.log(1);
        $('.cuPrev3').on('click', function(e){
            // event.preventDefault();
            $('.A-textarea').css('display','block');
            $('.step3rdBnt').css('display','block');
            // $('.A-nextButton').css('display','block');
            $('.cuWriteConfirm').css('display','none');
            $('.cuWriteConfirmButtons').css('display','none');

            // $('.cuWrite').css('display','block');
            // $('.cuWriteConfirm').css('display','none');

            if($('body').width() < 1200 ){
                console.log(1);
                $('.cuWetwrap').css('left','5%');
            }else{          
                $('.cuWetwrap').css('left','25%');}

            if($('body').width() < 768 ){
                console.log(1);
                $('.cuWetsuit').css('display','none');
            }else{          
                $('.cuWetsuit').css('display','block');}

            $(window).resize(function(){
                // console.log('2');
                if($('body').width() < 1200 ){
                    $('.cuWetwrap').css('left','5%');
                }else{
                    $('.cuWetwrap').css('left','25%');}
            });

            $(window).resize(function(){
                // console.log('2');
                if($('body').width() < 768 ){
                    $('.cuWetsuit').css('display','none');
                }else{
                    $('.cuWetsuit').css('display','block');}
            });

            // $('.cuPro4 span').css('color','#fff');
            // $('.cuPro4 p').css('color','#fff');

            $( "#cuWetsuitImg" ).draggable( 'disable' ).css('cursor','auto');
        });
    }); 
    // 點擊步驟四上一步觸發事件 end

    //點擊第三步驟製作完成 start
    $(document).ready(function(){
        $('#MyImage').on('click', function(e){
            alert("製作完成");
        });
    });
    //點擊第三步驟製作完成 end

    </script>
    <!-- drag icon start -->
    <script src="js/A-drag.js"></script>

    <!-- TweenMax -->
    <script src="js/TweenMax/Tweenmax.js"></script>

    <!-- logo墜落 -->
    <script src="js/Logo_neon.js"></script>
    <script src="js/memLogin.js"></script>
    <script>
    
    //在JS先宣告一個memNo變數，用來確認該變數在session是否有會memNo
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

    <!-- <script> 
        $(window).scroll(function(){ 

        var $srrollY = $(window).scrollTop(); 
        // console.log($srrollY); //打開查看頁面高度 

        var $Lsidebar = $('.sidebar1'); //自己命名一個標籤 

        if( $srrollY < 750){ //頁面高度切換點 
        // console.log(':D'); 
        $Lsidebar.children().html("做專輯"); //sidebar文字 

        }else{ 
        $Lsidebar.children().html("強打專輯"); 
        } 
        }) 
    </script> -->
</body>
</html>