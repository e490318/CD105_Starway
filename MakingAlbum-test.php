<?php
ob_start();
session_start();

$err ='';
try {
    require_once('Star_Way_Database.php');
    $bgimg ='SELECT * FROM album_bgimg' ;
    $album_bgimg = $pdo->query($bgimg);
    // $row = $info_album ->fetch();
    $bgimgRows = $album_bgimg -> fetchAll(PDO::FETCH_ASSOC);
    // print_r($row);
} catch (Exception $e) {
    $err .= "錯誤 : ".$e -> getMessage()."<br>";
    $err .= "行號 : ".$e -> getLine()."<br>"; 
}
?>
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
    <!-- <script src="js/cuDrag.js"></script> -->

    <!-- Draggable -->
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

    <!--preloader CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/3/turn.min.js"></script>
    <!--turnJS CDN -->
    <script src="./js/plugin/modernizr.2.5.3.min.js"></script>
    <!--modernizr -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/odometer.js/0.4.8/odometer.min.js"></script> -->
    <!--odometer  JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/vendors/scrolloverflow.min.js"></script>

    <script src="js/TweenMax/ScrollToPlugin.min.js"></script>
    <!-- 搭配Scroll的ScrollMagic套件-->
    <script src="js/ScrollMagic/ScrollMagic.min.js"></script>
    <script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
    <script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
</head>

<body>
<?php 
if ($err !='') {
    echo  "<div style='color: #fff'>$err</div>";
}else{
?>
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
                    <li><a class="menu_items" href="CDWall.html">購唱片</a></li>
                    <li><a class="menu_items" href="Record.html">做專輯</a></li>
                    <li><a class="menu_items" href="Game.html">賺酷碰</a></li>
                    <li><a class="menu_items" href="Class.html">買課程</a></li>
                    <li><a class="menu_items" href="About.html">說星路</a></li>
                    <li class="login_mobile">
                        <a class="menu_items " href="user.html">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                    <li class="login_mobile">
                        <a class="menu_items " href="#">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="nav_user">
                <a href="user.html"><i class="fas fa-user"></i></a>
                <a href=""><i class="fas fa-shopping-cart"></i></a>
            </div>
            <!-- <div class="sidebar"> -->
            <!-- 左側每屏導覽 -->
            <!-- <p>專輯客製</p> -->
            <!-- </div> -->
        </section>
    </header>

    <!-- 我是電腦版  start-->
    <!-- 步驟二：專輯封面 -->
    <section>
        <div class="section A-record">
            <div class="width1200 A-page1st">
                <div class="sidebar1">
                    <!-- 左側每屏導覽 -->
                    <p>專輯封面製作</p>
                </div>
                <!--步驟流程 start-->
                <div class="cuProcrss">
                    <div class="cuPro cuPro1">
                        <img src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-1-01-01.png" alt="star-with-number-1">
                        <p>錄製聲音</p>
                    </div>
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro2">
                        <img src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-2-02-02.png" alt="star-with-number-1">
                        <p>專輯封面</p>
                    </div>
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro3">
                        <img src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-3-03-03.png" alt="star-with-number-1">
                        <p>專輯介紹</p>
                    </div>
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <img class="A-star" src="images/star.png" alt="star.png">
                    <div class="cuPro cuPro4">
                        <img src="images/Login/vinil.png" alt="blackCD">
                        <img class="A-starStep" src="images/Record/star-with-number-4-04-04.png" alt="star-with-number-1">
                        <p>確認資料</p>
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
                    </div>

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
                                        <!-- <img src="images/Record/newbg.png" alt="small"> -->
                                        <!-- <label for="theFile"> -->
                                        <!-- <input type="file" id="theFile" onClick="document.form1.submit()"><img
                                                src="images/Record/newbg.png"> -->
                                        <!-- <input type="file" id="mobfileUpload onchange="readURL(this)" targetID="preview_progressbarTW_img" accept="image/gif, image/jpeg, image/png"/ ><img
                                            src="images/Record/newbg.png"> -->





                                        <!-- <p class="lineheight">三、上傳您的圖案</p> -->
                                        <!-- <button class="btn nonefountion">上傳</button> -->
                                        <!-- <p>8M內，jpg、png之圖檔。</p> -->
                                        <!-- <p>8M內，jpg、png</p> -->
                                        <!-- <p>之圖檔。</p> -->
                                        <!-- </label> -->
                                        <img src="images/Record/small/<?php echo $bgimgRows[0]['bgImg'] ?>" class="small" alt="small">
                                        <img src="images/Record/small/<?php echo $bgimgRows[1]['bgimg'] ?>" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_010.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_011.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_009.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_003.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_004.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_005.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_006.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_007.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_008.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_012.jpg" class="small" alt="small">

                                        <div class="labelBox">
                                            <label>
                                                <input type="file" name="upFile" id="upFile">
                                                <!-- <img src="images/Record/newbg.png"> -->
                                                <!-- <p>8M內，jpg、png之圖檔。</p> -->

                                                <p><img src="images/Record/cuLogoPlus.png" alt="Plus">8M內，jpg、png之圖檔。</p>
                                            </label>
                                        </div>

                                    </div>
                                    <script>
                                        function readURL(input){

                                    if(input.files && input.files[0]){

                                    var imageTagID = input.getAttribute("targetID");

                                    var reader = new FileReader();

                                    reader.onload = function (e) {

                                        var img = document.getElementById(imageTagID);

                                        img.setAttribute("src", e.target.result)

                                    }

                                    reader.readAsDataURL(input.files[0]);

                                    }

                                    }

                                    </script>
                                    <div class="A-bgBox2">
                                        <!-- <img src="images/Record/small/M1_SP_003.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_004.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_005.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_006.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_007.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_008.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_006.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_007.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_008.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_010.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_011.jpg" class="small" alt="small">
                                        <img src="images/Record/small/M1_SP_009.jpg" class="small" alt="small"> -->
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="content__wrapper A-rightCont">
                                    <div class="A-text">
                                        <h2>－輸入文字－</h2>
                                        <form class="textform" method="post" accept-charset="utf-8" name="form1">
                                            <input name="hidden_data" id='hidden_data' type="hidden" />
                                            <span>&nbsp;</span><input type="text" id="myWord" maxlength="6" />
                                            <!-- <input type="button" class="putWord btn" id="putWord" value="送出" /> -->
                                            <!-- 文字顏色：<input type="color" class="fontChange" name="color"><br>
                                            文字大小：<input type="number"  min="10" max="20" class="fontChange" name="number"> px<br>
                                            文字字型：<select class="fontChange" name="fontFace" id="">
                                                <option value="Tahoma">Tahoma</option>
                                                <option>Comic Sans MS</option>
                                                <option>標楷體</option>
                                            </select> -->
                                            <input type="button" class="putWord btn" id="putWord" value="送出" />
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
                                    <h2>－拖曳你想要的專輯圖案－</h2>
                                    <div class="A-iconImg">
                                        <div id="imgBox" class="A-iconbg">
                                            <img src="images/Record/icon1.svg" class="SS1 mobtattooss img" id="img0"
                                                alt="icon">
                                            <img src="images/Record/icon2.svg" class="SS2 mobtattooss img" id="img1"
                                                alt="icon">
                                            <img src="images/Record/icon3.svg" class="SS3 mobtattooss img" id="img2"
                                                alt="icon">
                                            <img src="images/Record/icon4.svg" class="SS4 mobtattooss img" id="img3"
                                                alt="icon">
                                            <img src="images/Record/icon5.svg" class="SS5 mobtattooss img" id="img4"
                                                alt="icon">
                                            <img src="images/Record/icon6.svg" class="SS6 mobtattooss img" id="img5"
                                                alt="icon">
                                            <img src="images/Record/icon7.svg" class="SS7 mobtattooss img" id="img6"
                                                alt="icon">
                                            <img src="images/Record/icon8.svg" class="SS8 mobtattooss img" id="img7"
                                                alt="icon">
                                            <img src="images/Record/icon9.svg" class="SS9 mobtattooss img" id="img8"
                                                alt="icon">
                                            <img src="images/Record/icon10.svg" class="SS10 mobtattooss img" id="img9"
                                                alt="icon">
                                            <img src="images/Record/icon11.svg" class="SS11 mobtattooss img" id="img10"
                                                alt="icon">
                                            <img src="images/Record/icon12.svg" class="SS12 mobtattooss img" id="img11"
                                                alt="icon">
                                            <img src="images/Record/icon9.svg" class="SS9 mobtattooss img" id="img8"
                                                alt="icon">
                                            <img src="images/Record/icon10.svg" class="SS10 mobtattooss img" id="img9"
                                                alt="icon">
                                            <img src="images/Record/icon11.svg" class="SS11 mobtattooss img" id="img10"
                                                alt="icon">

                                            <label class="iconLabel">
                                                <input type="file" name="upFile" id="fileUpload" style="display:none">
                                                <!-- <img src="images/Record/newbg.png"> -->
                                                <!-- <p>8M內，jpg、png之圖檔。</p> -->
                                                <img src="images/Record/cuLogoPlus.png" alt="Plus">
                                                <p>8M內，jpg</p>
                                                <p>png之圖檔。</p>
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
                                        <div id="mob-btns">
                                            <img id="scaleBig" class="culargeButton" src="images/Record/cuControlBig.png"
                                                alt="big">
                                            <img id="scaleSmall" class="cusmallButton" src="images/Record/cuControlSmall.png"
                                                alt="small">
                                            <img id="clockwise" class="cuturnrightButton" src="images/Record/cuControlRight.png"
                                                alt="turn right">
                                            <img id="clockwiseReverse" class="cuturnleftButton" src="images/Record/cuControlLeft.png"
                                                alt="turn left">
                                            <img id="removeImg" class="cudeleteButton" src="images/Record/cuControlDelete.png"
                                                alt="delete">
                                            <!-- <i class="fas fa-search-plus" id="scaleBig"></i>
                                                <i class="fas fa-search-minus" id="scaleSmall"></i>
                                                <i class="fas fa-undo" id="clockwise"></i>
                                                <i class="fas fa-undo" id="clockwiseReverse"></i>
                                                <i class="fas fa-trash-alt" id="removeImg"></i> -->
                                        </div>
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
                <a href="Record1.html">
                    <button id="A-beforeButton">上一步</button>
                </a>

                <form action="MakingAlbum2.php" method="post">
                    <p>帳號: <input type="text" name="memId" value="aaaa"></p>
                    <p><input type="submit" value="下一步"></p>
                </form>
                
                <!-- <a href="MakingAlbum2.html">
                    <button id="A-nextButton">下一步</button>
                </a> -->
            </div>
        </div>
    </section>
    <!-- 我是電腦版  end-->




    <footer>
        <section class="footer width1700">
            <div class="copyright">
                <div>copyright © </div>
                <span>starway</span>
            </div>
            <div class="trd">
                <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
                <a href="https://www.google.com/"><img src="images/g+.png" alt="g+.png"></a>
                <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
            </div>
        </section>
    </footer>

    <!-- //點小圖換大圖 start -->
    <script>
        function showLarge(e) {
            var small = e.target;


            var src = small.src.replace("small", "big").replace("SP_", "");

            var dropZone = document.getElementById("dropZone");
            dropZone.style.backgroundImage = "url(" + src + ")";
            // document.getElementById("large").src = src;
        }

        function init() {
            var imgs = document.getElementsByClassName("small");
            for (var i = 0; i < imgs.length; i++) {
                imgs[i].onclick = showLarge;
            }
        }

        window.onload = init;
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var imageTagID = input.getAttribute("targetID");
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = document.getElementById(imageTagID);
                    img.setAttribute("src", e.target.result)
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <!-- //點小圖換大圖 end -->

    <!-- drag icon start -->
    <script src="js/A-drag.js"></script>

    <!-- 圖片換顏色 start -->
    <script>
        var inputs = document.querySelectorAll('input');
        inputs.forEach(input => input.addEventListener('change', handleUpdate, false));
        inputs.forEach(input => input.addEventListener('mousemove', handleUpdate, false));

        function handleUpdate() {
            var suffix = this.dataset.sizing || '';
            document.querySelector('.A-box').style.filter = `hue-rotate(${this.value + suffix})`;
        }
    </script>
    <!-- 圖片換顏色 end -->

    <!-- <script src="./js/self/cust.js"></script>  -->

    <!-- 點擊看更多 -->
    <!-- <script>
        var i = 1;
        function trigger() {
            var mydiv = document.getElementsByClassName("A-bgBox");
            if (i % 2 == 1) {
                mydiv.style.display = 'block';
            }
            if (i % 2 == 0) {
                mydiv.style.display = 'none';
            }
            i++;
        }
    </script> -->


    <!-- <script>
        var showLinkA = document.querySelector('.A-bgBox a')
        showLinkA.addEventListener('click', function (event) {
            event.preventDefault();
            var aText = event.target;
            // console.log(aText);
            if (aText.innerText == '看更多') {
                aText.innerText = '看更少'
            } else {
                aText.innerText = '看更多'
            }
        }, false)

        $('.A-bgBox a').on('click', function (event) {
            event.preventDefault();
            $('.hide').slideToggle(300);
            $(this).toggleClass('active2');
        });
    </script> -->



    <!-- 點擊步驟二下一步觸發事件 start -->
    <script type="text/javascript">
        $(document).ready(function () {
            memNo = 0;
            memName = '0';
            memTel = 0;
        })
    </script>


    <script>
        $(document).ready(function () {

            // console.log(1);
            $('.cuNext3').on('click', function (e) {
                event.preventDefault();

                if (memNo != 0) {
                    $('#cuUserName').attr('value', memName);
                    $('#cuUserPhone').attr('value', memTel);
                    var memNum = memNo;
                    // console.log(memNum);

                    $('.cuSelectPanel').css('display', 'none');
                    $('.cuPVwrap').css('display', 'none');
                    $('.cuWrite').css('display', 'block');
                    $('.cuButtons').css('display', 'none');

                    if ($('body').width() < 1200) {
                        $('.cuWetwrap').css('left', '5%');
                    } else {
                        $('.cuWetwrap').css('left', '25%');
                    }

                    if ($('body').width() < 768) {
                        $('.cuWetsuit').css('display', 'none');
                        $('svg').css('display', 'none');
                    } else {
                        $('.cuWetsuit').css('display', 'block');
                        $('svg').css('display', 'block');
                    }

                    $(window).resize(function () {
                        if ($('body').width() < 1200) {
                            $('.cuWetwrap').css('left', '5%');
                        } else {
                            $('.cuWetwrap').css('left', '25%');
                        }
                    });

                    $(window).resize(function () {
                        // console.log('2');
                        if ($('body').width() < 768) {
                            $('.cuWetsuit').css('display', 'none');
                            $('svg').css('display', 'none');
                        } else {
                            $('.cuWetsuit').css('display', 'block');
                            $('svg').css('display', 'block');
                        }
                    });

                    $('.cuPro3 span').css('color', '#333');
                    $('.cuPro3 p').css('color', '#333');

                    $('.cuPriceTotal span').html(storage['PriceTotal']);

                    $("#cuWetsuitImg").draggable('disable').css('cursor', 'auto');

                    // var storage = sessionStorage;
                    // console.log($('#userofficialImg').val());
                    // storage['color'] = $('#usercolor').val();
                    // storage['officialImg'] = $('#userofficialImg').val();
                    // storage['version'] = $('#userversion').val();
                    // storage['size'] = $('#usersize').val();

                    // 判斷是否已經登入會員

                } else {
                    $('#NotLogged').fadeIn(500);
                    var memNum = 0;
                    // alert("還未登入");
                    console.log(memNum);
                }

            });
        });
    </script>
    <!-- 點擊步驟二下一步觸發事件 end -->

    <!-- 點擊步驟三上一步觸發事件 start -->
    <script>
        $(document).ready(function () {
            // console.log(1);
            $('.cuPrev2').on('click', function (e) {
                event.preventDefault();
                $('.cuSelectPanel').css('display', 'block');
                $('.cuPVwrap').css('display', 'block');
                $('.cuWrite').css('display', 'none');
                $('.cuButtons').css('display', 'block');

                if ($('body').width() < 1200) {
                    $('.cuWetwrap').css('left', '60%');
                } else {
                    $('.cuWetwrap').css('left', '50%');
                }

                if ($('body').width() < 768) {
                    $('.cuWetsuit').css('display', 'block');
                    $('svg').css('display', 'none');
                } else {
                    $('.cuWetsuit').css('display', 'block');
                    $('svg').css('display', 'block');
                }

                $(window).resize(function () {
                    if ($('body').width() < 1200) {
                        $('.cuWetwrap').css('left', '60%');
                    } else {
                        $('.cuWetwrap').css('left', '50%');
                    }
                });

                $(window).resize(function () {
                    if ($('body').width() < 768) {
                        $('.cuWetsuit').css('display', 'block');
                        $('svg').css('display', 'block');
                    } else {
                        $('.cuWetsuit').css('display', 'block');
                    }
                });

                $('.cuPro3 span').css('color', '#fff');
                $('.cuPro3 p').css('color', '#fff');

                $("#cuWetsuitImg").draggable({
                    disabled: false
                }).css('cursor', 'pointer');
                $("#cuWetsuitImg").draggable({
                    containment: "#containment-wrapper",
                    scroll: false
                });
            });
        });
    </script>
    <!-- 點擊步驟三上一步觸發事件 end -->

    <!-- 點擊步驟三下一步觸發事件 start -->
    <script>
        $(document).ready(function () {

            var storage = sessionStorage;

            $('.cuWriteColor').html(storage['color']);
            $('.cuWriteImg').html(storage['officialImg']);
            $('.cuWriteVersion').html(storage['version']);
            $('.cuWriteSize').html(storage['size']);

            // console.log(1);
            $('.cuNext4').on('click', function (e) {
                event.preventDefault();

                if ($('.cuWriteContent').val() == '') {
                    alert('請填寫您的資料');
                } else if ($('#cuUserPhone').val() == '') {
                    alert('請填寫您的資料');
                } else if ($('#cuUserAddr').val() == '') {
                    alert('請填寫您的資料');
                } else {
                    // console.log(2);
                    $('.cuWrite').css('display', 'none');
                    $('.cuWriteConfirm').css('display', 'block');

                    if ($('body').width() < 1200) {
                        console.log(1);
                        $('.cuWetwrap').css('left', '5%');
                    } else {
                        $('.cuWetwrap').css('left', '25%');
                    }

                    if ($('body').width() < 768) {
                        console.log(1);
                        $('.cuWetsuit').css('display', 'none');
                    } else {
                        $('.cuWetsuit').css('display', 'block');
                    }

                    $(window).resize(function () {
                        // console.log('2');
                        if ($('body').width() < 1200) {
                            $('.cuWetwrap').css('left', '5%');
                        } else {
                            $('.cuWetwrap').css('left', '25%');
                        }
                    });

                    $(window).resize(function () {
                        // console.log('2');
                        if ($('body').width() < 768) {
                            $('.cuWetsuit').css('display', 'none');
                        } else {
                            $('.cuWetsuit').css('display', 'block');
                        }
                    });

                    $('.cuPro4 span').css('color', '#333');
                    $('.cuPro4 p').css('color', '#333');

                    $('.cuWriteConfirmPriceTotal span').html(storage['PriceTotal']);

                    $("#cuWetsuitImg").draggable('disable').css('cursor', 'auto');

                    // 抓到使用者填寫資訊的值
                    $('.cuWriteName').html(storage['UserName']);
                    $('.cuWriteTel').html(storage['UserPhone']);
                    $('.cuWriteAddr').html(storage['UserAddr']);

                }

            });

        });
    </script>
    <!-- 點擊步驟三下一步觸發事件 end -->

    <!-- 點擊步驟四上一步觸發事件 start -->
    <script>
        $(document).ready(function () {
            // console.log(1);
            $('.cuPrev3').on('click', function (e) {
                event.preventDefault();
                $('.cuWrite').css('display', 'block');
                $('.cuWriteConfirm').css('display', 'none');

                if ($('body').width() < 1200) {
                    console.log(1);
                    $('.cuWetwrap').css('left', '5%');
                } else {
                    $('.cuWetwrap').css('left', '25%');
                }

                if ($('body').width() < 768) {
                    console.log(1);
                    $('.cuWetsuit').css('display', 'none');
                } else {
                    $('.cuWetsuit').css('display', 'block');
                }

                $(window).resize(function () {
                    // console.log('2');
                    if ($('body').width() < 1200) {
                        $('.cuWetwrap').css('left', '5%');
                    } else {
                        $('.cuWetwrap').css('left', '25%');
                    }
                });

                $(window).resize(function () {
                    // console.log('2');
                    if ($('body').width() < 768) {
                        $('.cuWetsuit').css('display', 'none');
                    } else {
                        $('.cuWetsuit').css('display', 'block');
                    }
                });

                $('.cuPro4 span').css('color', '#fff');
                $('.cuPro4 p').css('color', '#fff');

                $("#cuWetsuitImg").draggable('disable').css('cursor', 'auto');
            });
        });
    </script>
    <!-- 點擊步驟四上一步觸發事件 end -->

    <!-- <script src="js/cuDrag.js"></script>

    <script src="js/cust1.js"></script> -->

    <!-- TweenMax-->
    <script src="js/TweenMax/Tweenmax.js"></script>

    <!-- logo墜落 -->
    <script src="js/Logo_neon.js"></script>

    <?php
}
 ?>


</body>



</html>