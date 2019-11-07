<?php
ob_start();
session_start();

if(isset($_SESSION["memNo"]) ==true){ //從session裡確認是否有memNo的變數。若有該變數，則宣告一個Session_memNo變數等於session裡的memNo,目的是要讓javascript去抓可以用這個PHP的變數，來判斷是否有登入
 $Session_memNo = $_SESSION["memNo"];
 }
 else{
  $Session_memNo = 0;
 }

//判斷目前登入的會員是否有優惠卷以及優惠卷種類
if(isset($_SESSION["couponNo"]) ==true){
switch ($_SESSION["couponNo"]) {
    case 0:
    $Session_couponNo = 0;
    break;

    case 1:
    $Session_couponNo = 50;
    break;

    case 2:
    $Session_couponNo = 100;
    break;
    
    case 3:
    $Session_couponNo = 150;
    break;
}
}else{
    $Session_couponNo = 0;
}
$err ='';
try {
    require_once('Star_Way_Database.php');
    $class ='SELECT * FROM info_class' ;
    $teacher ='SELECT * FROM info_teacher' ;
    $info_class = $pdo->query($class);
    $info_teacher = $pdo->query($teacher);
    // $row = $info_album ->fetch();
    $classRows = $info_class -> fetchAll(PDO::FETCH_ASSOC);
    $teacherRows = $info_teacher -> fetchAll(PDO::FETCH_ASSOC);
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
    <title>星路-加值課程</title>
    <!-- favicon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- 自己的CSS -->
    <link rel="stylesheet" type="text/css" href="css/style_W.css" />
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="css/animate/animate.css">
    <!-- 背景動態swirl -->
    <link rel="stylesheet" type="text/css" href="css/swirl_base.css" />
    <script>document.documentElement.className = "js"; var supportsCssVars = function () { var e, t = document.createElement("style"); return t.innerHTML = "root: { --tmp-var: bold; }", document.head.appendChild(t), e = !!(window.CSS && window.CSS.supports && window.CSS.supports("font-weight", "var(--tmp-var)")), t.parentNode.removeChild(t), e }; supportsCssVars() || alert("Please view this demo in a modern browser that supports CSS Variables.");</script>
    <!-- jQuery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Tweenmax的Scroll套件-->
    <script src="js/TweenMax/ScrollToPlugin.min.js"></script>
    <!-- 搭配Scroll的ScrollMagic套件-->
    <script src="js/ScrollMagic/ScrollMagic.min.js"></script>
    <script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
    <script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="js/notLoginYet.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
<?php 
if ($err !='') {
    echo  "<div style='color: #fff'>$err</div>";
}else{
?>
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

            <!-- <div class="nav_logo">
				<a href="index.html" id="logo"></a>
				<img class="nav_logo_b" src="images/logo_b.png" alt="logo.png">
				<img class="nav_logo_d" src="images/logo_d.png" alt="logo.png">
			</div> -->
        
            <div class="logo">
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
                左側每屏導覽
                <p>課程</p>
            </div>
            <!-- <div class="star">
				右側星星
				<img src="images/star.png" alt="star.png">
				<img src="images/star.png" alt="star.png">
				<img src="images/star.png" alt="star.png">
				<img src="images/star.png" alt="star.png">
				<img src="images/star.png" alt="star.png">
			</div> -->
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




    <!-- 日曆 -->
    <ul id="calendar">
        <li>
            <span id="date-text" class="expanded">
                <label id="date-label">請選擇日期</label>
                <div class="btn-nav" onclick="myFunction(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
                <table class="calendar">
                    <tbody>
                        <tr>
                            <td class="mm" colspan="2"><span id="mm-sp">月份</span> <i id="left-1"
                                    class="material-icons">keyboard_arrow_left</i></td>
                            <td class="yy" colspan="3"><span id="yy-sp">年份</span><i id="right-1"
                                    class="material-icons">keyboard_arrow_right</i></td>
                        </tr>
                        <tr>
                            <th>S</th>
                            <th>M</th>
                            <th>T</th>
                            <th>W</th>
                            <th>T</th>
                            <th>F</th>
                            <th>S</th>
                        </tr>
                    </tbody>

                    <tbody id="calendar-tb">

                    </tbody>
                </table>
                <input type="button" name="data" id="psgBd" value="確認日期">
            </span>
        </li>
    </ul>

    <!-- 影片 -->
    <section class="W_banner">
        <video loop="true" autoplay="autoplay" muted="true">
            <source type="video/mp4"
                src="images/Class/Polyester The Saint - To Be (Live At Truth Studios) (online-video-cutter.com).mp4">
            </source>
        </video>
    </section>

    <!-- 老師課程介紹 -->

    <!-- 第一個 -->
    <section class="W_info">
        <div class="W_bg1">
            <div class="width1200">

                <div class="W_info_A invisible">
                    <div class="W_class_info">
                    <h2><?php echo $classRows[0]['className'].'<br>'; ?></h2>
                        <p> <?php echo $classRows[0]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[6]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[7]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[8]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[9]['classDescript'].'<br>'; ?></p><br>
                        <div class="W_teacher_info_phone">
                        <h6><?php echo $teacherRows[0]['teacherName'].'<br>'; ?></h6>
                            <p><?php echo $teacherRows[0]['teacherDescriptTwo'].'<br>';?></p>
                        </div>
                        <span><?php echo 'NT$ ',$classRows[0]['classPrice'].'<br>'; ?></span>

                        <input type="button" id="btn" value="購買課程">
                        <div class="clearfix"></div>
                    </div>
                    <div class="W_teacher_info">
                    <h6><?php echo $teacherRows[0]['teacherName'].'<br>'; ?></h6>
                    <p><?php echo $teacherRows[0]['teacherDescript'].'<br>'; ?></p>
                        <div class="clearfix"></div>
                    </div>

                    <div class="W_img">
                    <img src="images/Class/<?php echo $teacherRows[0]['teacherPhoto'] ?>">
                    </div>

                </div>
            </div>
        </div>



        <!-- 第二個 -->
        <div class="width1200">
            <div class="W_info_B invisible">
                <div class="W_teacher_info">
                    <h6><?php echo $teacherRows[1]['teacherName'].'<br>'; ?></h6>
                    <p><?php echo $teacherRows[1]['teacherDescript'].'<br>'; ?></p>
                    <div class="clearfix"></div>
                </div>
                <div class="W_class_info">
                <h2><?php echo $classRows[1]['className'].'<br>'; ?></h2>
                    <p> <?php echo $classRows[1]['classDescript'].'<br>'; ?></p><br>
                    <div class="W_teacher_info_phone">
                    <h6><?php echo $teacherRows[1]['teacherName'].'<br>'; ?></h6>
                        <p><?php echo $teacherRows[1]['teacherDescriptTwo'].'<br>';?>
                        </p>
                    </div>
                    <span><?php echo 'NT$ ',$classRows[1]['classPrice'].'<br>'; ?></span>
                    <input type="button" id="btn2" value="購買課程">
                    <div class="clearfix"></div>
                </div>
                <div class="W_img">
                <img src="images/Class/<?php echo $teacherRows[1]['teacherPhoto'] ?>" alt="teacher7.png">
                </div>
            </div>
        </div>


        <!-- 第三個 -->
        <div class="W_bg2">
            <div class="width1200">
                <div class="W_info_C invisible">
                    <div class="W_class_info">
                    <h2><?php echo $classRows[2]['className'].'<br>'; ?></h2>
                        <p> <?php echo $classRows[2]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[10]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[11]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[12]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[13]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[14]['classDescript'].'<br>'; ?>
                            <?php echo $classRows[15]['classDescript'].'<br>'; ?>
                        </p><br>
                        <div class="W_teacher_info_phone">
                        <h6><?php echo $teacherRows[2]['teacherName'].'<br>';?></h6>
                            <p><?php echo $teacherRows[2]['teacherDescriptTwo'].'<br>';?>
                            </p>
                        </div>
                        <span><?php echo 'NT$ ',$classRows[2]['classPrice'].'<br>'; ?></span>
                        <input type="button" id="btn3" value="購買課程">
                        <div class="clearfix"></div>
                    </div>
                    <div class="W_teacher_info">
                    <h6><?php echo $teacherRows[2]['teacherName'].'<br>';?></h6>
                        <p><?php echo $teacherRows[2]['teacherDescript'].'<br>'; ?></p>
                        <div class="clearfix"></div>
                    </div>

                    <div class="W_img">
                    <img src="images/Class/<?php echo $teacherRows[2]['teacherPhoto'] ?>" alt="teacher3.png">
                    </div>
                </div>
            </div>
        </div>


        <!-- 第四個 -->
        <div class="width1200">
            <div class="W_info_D invisible">
                <div class="W_teacher_info">
                <h6><?php echo $teacherRows[3]['teacherName'].'<br>'; ?></h6>
                    <p><?php echo $teacherRows[3]['teacherDescript'].'<br>'; ?></p>
                    <div class="clearfix"></div>
                </div>
                <div class="W_class_info">
                <h2><?php echo $classRows[3]['className'].'<br>'; ?></h2>
                    <p><?php echo $classRows[3]['classDescript'].'<br>'; ?></p><br>
                    <div class="W_teacher_info_phone">
                    <h6><?php echo $teacherRows[3]['teacherName'].'<br>'; ?></h6>
                        <p><?php echo $teacherRows[3]['teacherDescriptTwo'].'<br>';?>
                        </p>
                    </div>
                    <span><?php echo 'NT$ ',$classRows[3]['classPrice'].'<br>'; ?></span>
                    <input type="button" id="btn4" value="購買課程">
                    <div class="clearfix"></div>
                </div>

                <div class="W_img">
                <img src="images/Class/<?php echo $teacherRows[3]['teacherPhoto'] ?>" alt="teacher4.png">
                </div>
            </div>
        </div>


        <!-- 第五個 -->
        <div class="W_bg3">
            <div class="width1200">

                <div class="W_info_E invisible">
                    <div class="W_class_info">
                    <h2><?php echo $classRows[4]['className'].'<br>'; ?></h2>
                        <p><?php echo $classRows[4]['classDescript'].'<br>';?></p><br>
                        <div class="W_teacher_info_phone">
                        <h6><?php echo $teacherRows[4]['teacherName'].'<br>'; ?></h6>
                            <p><?php echo $teacherRows[4]['teacherDescriptTwo'].'<br>';?>
                            </p>
                        </div>
                        <span><?php echo 'NT$ ',$classRows[4]['classPrice'].'<br>'; ?></span>
                        <input type="button" id="btn5" value="購買課程">
                        <div class="clearfix"></div>
                    </div>
                    <div class="W_teacher_info">
                    <h6><?php echo $teacherRows[4]['teacherName'].'<br>'; ?></h6>
                        <p><?php echo $teacherRows[4]['teacherDescript'].'<br>'; ?></p>
                        <div class="clearfix"></div>
                    </div>

                    <div class="W_img">
                    <img src="images/Class/<?php echo $teacherRows[4]['teacherPhoto'] ?>" alt="teacher5.png">
                    </div>
                </div>
            </div>
        </div>


        <!-- 第六個 -->
        <div class="width1200">
            <div class="W_info_F invisible">
                <div class="W_teacher_info">
                <h6><?php echo $teacherRows[5]['teacherName'].'<br>'; ?></h6>
                    <p><?php echo $teacherRows[5]['teacherDescript'].'<br>'; ?></p>
                    <div class="clearfix"></div>
                </div>
                <div class="W_class_info">
                <h2><?php echo $classRows[5]['className'].'<br>'; ?></h2>
                    <p> <?php echo $classRows[5]['classDescript'].'<br>'; ?></p><br>
                    <div class="W_teacher_info_phone">
                    <h6><?php echo $teacherRows[5]['teacherName'].'<br>'; ?></h6>
                        <p><?php echo $teacherRows[5]['teacherDescriptTwo'].'<br>';?>
                        </p>
                    </div>
                    <span><?php echo 'NT$ ',$classRows[5]['classPrice'].'<br>'; ?></span>
                    <input type="button" id="btn6" value="購買課程">
                    <div class="clearfix"></div>
                </div>

                <div class="W_img">
                <img src="images/Class/<?php echo $teacherRows[5]['teacherPhoto'] ?>" alt="teacher6.png">
                </div>
            </div>
        </div>

         <section id="Y_payInfo">
        <canvas id="canvas"></canvas>
       <div class="L_pay_payinfo">
            <div class="L_pay_payinfo_pay">
                <div class="Y_classInfo">
                    <h5>欲購課程</h5>
                    <p>上課日期 : <strong></strong></p>
                    <p>課程 : <strong></strong></p>
                    <p>價格 : <strong></strong></p>
                </div>
                
                <div class="Y_payMethod">
                <h5>付款方式</h5>
                <span>
                 <input id="payCredit" type="radio" name="payMethod" value="信用卡付款">
                 <label for="payCredit">信用卡付款</label>
                </span>
                 <span class="albumOrderConfirmedz"></span>
                <span>
                 <input id="payATM" type="radio" name="payMethod" value="ATM匯款">
                 <label for="payATM">ATM匯款</label>
               </span>
                </div>

                <!-- 信用卡卡號輸入相關 -->
                <div id="Y_payCreditInput">
                <img src="images/Cart/credit cards.png"><br>
                <div class="creadCardtext">
                    <span>請輸入卡號 :</span>
                    <input type="text" name="Credit_1" size="4" maxLength="4"> -
                    <input type="text" name="Credit_2" size="4" maxLength="4"> -
                    <input type="text" name="Credit_3" size="4" maxLength="4"> -
                    <input type="text" name="Credit_4" size="4" maxLength="4">
                </div>
                 到&nbsp&nbsp&nbsp期&nbsp&nbsp&nbsp日 : <input class="Y_expireDay" type="month" clname=""><br>
                 安&nbsp&nbsp&nbsp全&nbsp&nbsp&nbsp碼 : <input type="text" name="securityCode" size="3" maxLength="3">
                </div>

                <!-- ATM帳號輸入 -->
                <div id="Y_payATMInput">
                    <span>請輸入轉帳帳號 :</span> 
                    <input type="text" name="Y_ATM" size="30" maxLength="16">
                </div>
            </div>

            <div class="Y_pay_payinfo_pay">
          <!--       <h5>是否使用星路優惠卷</h5>
                 <input id="useCupon" type="radio" name="useCupon" value=50>
                 <label for="useCupon">使用50元折價卷</label> -->
            </div>

            <div class="L_pay_payinfo_adres_formBtn">
              <button>取消</button>
              <button>確認購買</button>
            </div>

       </div>
        <div id="Y_thanksMsgBox">
    <!--         <div class="Y_completeMsg">
        <strong>THANK YOU</strong><br>
        <strong>感謝您購買我們的課程</strong>
        <p>您的訂單編號:<span style="color: #f00">13412</span></p>
        <p>下單日期:<span>22222222</span></p>
        <div class="Y_checkBtn">
            <a href="CDWall_sell.php#L_CDWallSell">繼續購買</a>
             <a href="user.php#tab02">查詢您的訂單</a>
        </div>
        </div> -->
        </div>
     </section>
        <!-- swirl動態背景 -->
        <div class="swirl">
            <div class="swirl_content swirl_content--canvas"></div>
        </div>

        <!-- Swirl -->
        <script src="js/Swirl/noise.min.js"></script>
        <script src="js/Swirl/util.js"></script>
        <script src="js/Swirl/swirl.js"></script>
        <!-- 背景Canvas -->
         <script  src="js/about_canvas.js"></script>
             <!-- TweenMax-->
        <script src="js/TweenMax/Tweenmax.js"></script>
        <script src="js/memLogin.js"></script>
        <!-- LOGO效果-->
        <script src="js/Logo_neon.js"></script>
         <!-- 文字動畫效果-->
        <script src="js/Textillate/jquery.lettering.js"></script>
        <script src="js/Textillate/jquery.textillate.js"></script>
        <!-- 日曆開始 -->
        <script>

            window.addEventListener("load", () => {


                // $('#date-text').click(function (e) {
                //     e.preventDefault();
                //     e.stopPropagation();
                //     $(this).toggleClass('expanded');
                //     $('#' + $(e.target).attr('for')).prop('checked', true);
                // });
                // $(document).click(function () {
                //     $('#date-text').removeClass('expanded');
                // });
                $(".calendar").click((e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    $(this).toggleClass('expanded');
                    $('#' + $(e.target).attr('for')).prop('checked', true);
                    // console.log(e.target);
                })



                var yy = new Date().getFullYear(); //年
                var mm = new Date().getMonth(); //月份
                var dd = new Date().getDate();//今天日期
                var arrmm = new Array();
                arrmm[0] = "一月";
                arrmm[1] = "二月";
                arrmm[2] = "三月";
                arrmm[3] = "四月";
                arrmm[4] = "五月";
                arrmm[5] = "六月";
                arrmm[6] = "七月";
                arrmm[7] = "八月";
                arrmm[8] = "九月";
                arrmm[9] = "十月";
                arrmm[10] = "十一月";
                arrmm[11] = "十二月";
                document.querySelector("#mm-sp").innerText = arrmm[mm];
                document.querySelector("#yy-sp").innerText = yy;
                var dayall = new Date(yy, mm+1, 0).getDate();//總天數
                var bd = new Date(yy + "/" + (mm + 1) + "/1").getDay();//因為回傳月份是0-11 所以要+1  抓星期他只有1-12月
                var dayfunction = () => {
                    for (var i = 1; i < 7; i++) {
                        var text = "";
                        if (i == 1) {
                            if (i - bd < 1) {
                                for (var p = 0; p < bd; p++) {
                                    text += "<td class='tdclass-1'></td>";
                                }
                            }
                            for (var o = 1; o <= 7 - bd; o++) {
                                text += "<td class='tdclass'>" + o + "</td>";
                            }
                        }
                        else if (i == 2) {
                            for (var o = 8 - bd; o <= 14 - bd; o++) {
                                text += "<td class='tdclass'>" + o + "</td>";
                            }
                        }
                        else if (i == 3) {
                            for (var o = 15 - bd; o <= 21 - bd; o++) {
                                text += "<td class='tdclass'>" + o + "</td>";
                            }
                        }
                        else if (i == 4) {
                            for (var o = 22 - bd; o <= 28 - bd; o++) {
                                text += "<td class='tdclass'>" + o + "</td>";
                            }
                        }
                        else if (i == 5) {
                            if (bd > 4 && dayall > 28) {
                                for (var o = 29 - bd; o <= 35 - bd; o++) {
                                    text += "<td class='tdclass'>" + o + "</td>";
                                }
                                var tr = document.createElement("tr");
                                document.querySelector("#calendar-tb").appendChild(tr).innerHTML = text;
                                text = "";
                                for (var o = 36 - bd; o <= dayall; o++) {
                                    text += "<td class='tdclass'>" + o + "</td>";
                                }
                            } else {
                                for (var o = 29 - bd; o <= dayall; o++) {
                                    text += "<td class='tdclass'>" + o + "</td>";
                                }

                            }

                        }


                        var tr = document.createElement("tr");
                        document.querySelector("#calendar-tb").appendChild(tr).innerHTML = text;
                    }
                }
                dayfunction();
                document.querySelector("#left-1").addEventListener("click", (e) => {
                    var num = arrmm.indexOf(document.querySelector("#mm-sp").innerText);
                    dayall = new Date(yy, num, 0).getDate();//總天數
                    document.querySelector("#calendar-tb").innerHTML = "";
                    if (num - 1 < 0) {
                        num = 12;
                        yy--;
                    }
                    bd = new Date(yy + "/" + num + "/1").getDay();
                    dayfunction(bd, dayall);
                    // console.log(arrmm.indexOf( document.querySelector("#mm-sp").innerText));
                    document.querySelector("#mm-sp").innerText = arrmm[num - 1];
                    document.querySelector("#yy-sp").innerText = yy;
                    load();
                })
                document.querySelector("#right-1").addEventListener("click", (e) => {
                    var num = arrmm.indexOf(document.querySelector("#mm-sp").innerText);
                    if (num == 0) {
                        dayall = new Date(yy, 2, 0).getDate()
                        bd = new Date(yy + "/" + 2 + "/1").getDay();
                    } else if (num == 11) {
                        dayall = new Date(yy, num + 1, 0).getDate();//總天數
                        bd = new Date(yy + "/" + (num + 1) + "/1").getDay();
                    } else if (num == 10) {
                        dayall = new Date(yy, num, 0).getDate();//總天數
                        bd = new Date(yy + "/" + (num) + "/1").getDay();
                    }
                    else {
                        dayall = new Date(yy, num + 2, 0).getDate();//總天數
                        bd = new Date(yy + "/" + (num + 2) + "/1").getDay();
                    }
                    document.querySelector("#calendar-tb").innerHTML = "";
                    if (num + 1 > 11) {
                        num = -1;
                        yy++;
                    }
                    dayfunction(bd, dayall);
                    document.querySelector("#mm-sp").innerText = arrmm[num + 1];
                    document.querySelector("#yy-sp").innerText = yy;
                    load();
                })

                var len;
                var arr = new Array();
                function load() {
                    len = document.getElementsByClassName("tdclass");
                    var ss;
                    for (var k = 0; k <= len.length - 1; k++) {
                        ss = document.getElementsByClassName("tdclass")[k];
                        ss.addEventListener("click", tdclass);
                        arr[k] = ss;
                    }
                }
                var click = 0;
                var cl = false;
                function tdclass(e) {
                    if (!click) {
                        for (var i = 0; i <= len.length - 1; i++) {
                            arr[i].style.background = "rgba(100, 42, 65, 0)";
                        }
                        e.target.style.background = "rgba(255, 255, 255, 0.4)";
                        click++;
                        cl = arr.indexOf(e.target);




                        var value = document.querySelector("#mm-sp").innerText;

                        mmtext = Number(arrmm.indexOf(value));//月
                        mmtext += 1;

                        // console.log(mmtext);

                        datevalue = document.querySelector("#yy-sp").innerText + "-" + mmtext + "-" + e.target.innerText;

                        // console.log(datevalue);

                        // document.querySelector("#date-label-1").innerHTML = datevalue;
                        // $('#date-text').removeClass('expanded');
                        // document.querySelector("#psgBd").value = datevalue;

                        // console.log( "value:",document.querySelector("#psgBd").value);



                        // }else{
                        //     if(cl<arr.indexOf(e.target)){
                        //         for (var l = cl;l<arr.indexOf(e.target)+1;l++){
                        //             arr[l].style.background="red";
                        //         }
                        //     }else{
                        //         for (var l = cl;l>arr.indexOf(e.target)-1;l--){
                        //             arr[l].style.background="red";
                        //         }
                        //     }
                        click = false;
                    }
                }
                load();
            });
        </script>
        <!-- 日曆結束 -->

        <!-- 日曆滑出 -->
        <script type="text/javascript">
            $(document).ready(function () {
                    //先宣告每一堂課程的編號
                    var classNo1 = <?php echo $classRows[0]['classNo'] ?>;
                    var classNo2 = <?php echo $classRows[1]['classNo'] ?>;
                    var classNo3 = <?php echo $classRows[2]['classNo'] ?>;
                    var classNo4 = <?php echo $classRows[3]['classNo'] ?>;
                    var classNo5 = <?php echo $classRows[4]['classNo'] ?>;
                    var classNo6 = <?php echo $classRows[5]['classNo'] ?>;

                    //每一堂課程的名稱:
                    var className1 = "<?php echo $classRows[0]['className']?>";
                    var className2 = "<?php echo $classRows[1]['className']?>";
                    var className3 = "<?php echo $classRows[2]['className']?>";
                    var className4 = "<?php echo $classRows[3]['className']?>";
                    var className5 = "<?php echo $classRows[4]['className']?>";
                    var className6 = "<?php echo $classRows[5]['className']?>";

                    //宣告每一堂課價格
                    var classPrice1 = <?php echo $classRows[0]['classPrice'] ?>;
                    var classPrice2 = <?php echo $classRows[1]['classPrice'] ?>;
                    var classPrice3 = <?php echo $classRows[2]['classPrice'] ?>;
                    var classPrice4 = <?php echo $classRows[3]['classPrice'] ?>;
                    var classPrice5 = <?php echo $classRows[4]['classPrice'] ?>;
                    var classPrice6 = <?php echo $classRows[5]['classPrice'] ?>;

                    isHiden = true;	/*控制切换*/
                    $('#btn').click(function (event) {
                        sessionStorage['classNo'] = classNo1;
                        sessionStorage['classPrice'] = classPrice1;
                        sessionStorage['className'] = className1;
                        if (isHiden==true) {
                            $('#calendar').animate({ right: '+=414px' });//日曆向右移动
                        } else {
                            $('#calendar').animate({ right: '-=414px' }); //日曆向左移动
                        }
                        isHiden = !isHiden;
                    });
                    $('#btn2').click(function (event) {
                        sessionStorage['classNo'] = classNo2;
                        sessionStorage['classPrice'] = classPrice2;
                        sessionStorage['className'] = className2;
                        if (isHiden) {
                            $('#calendar').animate({ right: '+=414px' });//日曆向右移动
                        } else {
                            $('#calendar').animate({ right: '-=414px' }); //日曆向左移动
                        }
                        isHiden = !isHiden;
                    });
                    $('#btn3').click(function () {
                        sessionStorage['classNo'] = classNo3;
                        sessionStorage['classPrice'] = classPrice3;
                        sessionStorage['className'] = className3;
                        if (isHiden) {
                            $('#calendar').animate({ right: '+=414px' });//日曆向右移动
                        } else {
                            $('#calendar').animate({ right: '-=414px' }); //日曆向左移动
                        }
                        isHiden = !isHiden;
                    });
                    $('#btn4').click(function () {
                        sessionStorage['classNo'] = classNo4;
                        sessionStorage['classPrice'] = classPrice4;
                        sessionStorage['className'] = className4;
                        if (isHiden) {
                            $('#calendar').animate({ right: '+=414px' });//日曆向右移动
                        } else {
                            $('#calendar').animate({ right: '-=414px' }); //日曆向左移动
                        }
                        isHiden = !isHiden;
                    });
                    $('#btn5').click(function () {
                        sessionStorage['classNo'] = classNo5;
                        sessionStorage['classPrice'] = classPrice5;
                        sessionStorage['className'] = className5;
                        if (isHiden) {
                            $('#calendar').animate({ right: '+=414px' });//日曆向右移动
                        } else {
                            $('#calendar').animate({ right: '-=414px' }); //日曆向左移动
                        }
                        isHiden = !isHiden;
                    });
                    $('#btn6').click(function () {
                        sessionStorage['classNo'] = classNo6;
                        sessionStorage['classPrice'] = classPrice6;
                        sessionStorage['className'] = className6;
                        if (isHiden) {
                            $('#calendar').animate({ right: '+=414px' });//日曆向右移动
                        } else {
                            $('#calendar').animate({ right: '-=414px' }); //日曆向左移动
                        }
                        isHiden = !isHiden;
                    });
                    $('.btn-nav').click(function () {
                        if (isHiden) {
                            $('#calendar').animate({ right: '+=414px' });//日曆向右移动
                        } else {
                            $('#calendar').animate({ right: '-=414px' }); //日曆向左移动
                        }
                        isHiden = !isHiden;
                    });
  
            });

        </script>

        <!-- 日曆結束 -->

        <!-- 資訊 -->
        <script>
            $(window).scroll(function () {
                if ($(window).scrollTop() > $('.W_info_A').offset().top - 500) {
                    $('.W_info_A').removeClass('invisible').addClass('fade_in');
                }
            });
            $(window).scroll(function () {
                if ($(window).scrollTop() > $('.W_info_B').offset().top - 500) {
                    $('.W_info_B').removeClass('invisible').addClass('fade_in');
                }
            });
            $(window).scroll(function () {
                if ($(window).scrollTop() > $('.W_info_C').offset().top - 500) {
                    $('.W_info_C').removeClass('invisible').addClass('fade_in');
                }
            });
            $(window).scroll(function () {
                if ($(window).scrollTop() > $('.W_info_D').offset().top - 500) {
                    $('.W_info_D').removeClass('invisible').addClass('fade_in');
                }
            });
            $(window).scroll(function () {
                if ($(window).scrollTop() > $('.W_info_E').offset().top - 500) {
                    $('.W_info_E').removeClass('invisible').addClass('fade_in');
                }
            });
            $(window).scroll(function () {
                if ($(window).scrollTop() > $('.W_info_F').offset().top - 500) {
                    $('.W_info_F').removeClass('invisible').addClass('fade_in');
                }
            }); 
        </script>
        <!-- 資訊結束 -->
        
        <!-- 將訂單寫回到PHP -->
        <script>
        var memNo = "<?php echo $Session_memNo ?>";
        var coupon = <?php echo $Session_couponNo?>;
        var psgBd = document.querySelector("#psgBd");
        console.log(memNo);
        console.log(coupon);
        // console.log(classPrice);

       $(document).ready(function() {
         $('#psgBd').on('click', function(event) {
        classPrice = parseInt(sessionStorage['classPrice']);
        console.log(classPrice);

            // event.preventDefault();
            // alert('test');
            if( memNo != 0){ //若有登入會員，則跳出付款畫面
                // console.log(datevalue)
            $('#Y_payInfo').fadeIn();
             $('#calendar').animate({ right: '-=414px' });
             isHiden = !isHiden;

             //將課程資訊寫到付款頁面
             $('.Y_classInfo p:nth-of-type(1) > strong').text(datevalue);
             $('.Y_classInfo p:nth-of-type(2) > strong').text(`${sessionStorage['className']}`);
             $('.Y_classInfo p:nth-of-type(3) > strong').text(`${sessionStorage['classPrice']}`);
             $('.Y_classInfo p:nth-of-type(3) > strong').text(classPrice);


            //付款方式取消-回到課程列表頁
            $('.L_pay_payinfo_adres_formBtn button:nth-of-type(1)').on('click', function(event) {
            $('#Y_payInfo').fadeOut();

           });

            }else {//若有還未登入，則跑出會員登入視窗
                var memNum = 0;
                $('#NotLogged').css({"display":"block"});
            }

         if(coupon !=0){
            $('.Y_pay_payinfo_pay').html(`
                 <h5>是否使用星路優惠卷</h5>
                 <input id="useCupon" type="radio" name="useCupon" value=${coupon}>
                 <label for="useCupon">使用${coupon}元折價卷</label>`);
         }

        $('input[name=useCupon]').on('click', function(event) {
            $('.Y_classInfo p:nth-of-type(3) > strong').text(classPrice-coupon);
             // classPrice = classPrice-coupon;
        });
         });

         //若有優惠卷，則出現使用優惠卷的按鈕

        //若點擊信用卡付款，則展開信用卡輸入相關，並將ATM匯款的輸入收起來
        $('#payCredit').on('click', function (event) {
            $('#Y_payATMInput').slideUp(20);
            $('#Y_payCreditInput').slideToggle();
            // $('.L_pay_payinfo').css('height', '86%');
        });

         //若點擊ATM付款，則展開ATM輸入相關，並將信用卡的輸入收起來
          $('#payATM').on('click', function (event) {
            $('#Y_payCreditInput').slideUp(20);
            $('#Y_payATMInput').slideToggle();
            // $('.L_pay_payinfo').css('height', '67%');
        });

    


         //******** 確認欄位是否有空值 ********
          $('.L_pay_payinfo_adres_formBtn button:nth-of-type(2)').on('click', function(event) {
                 cardPattern = /^(?=^.{4}$)((?=.*[0-9]))^.*$/;
                 payMethod = $('input[name=payMethod]:checked').val();
                 customerName = $('input[name=customerName]').val();
                 customerContact = $('input[name=customerContact]').val();
                 customerAdd = $('input[name=customerAdd]').val();
                 Credit_1 = $('input[name=Credit_1]').val();
                 Credit_2 = $('input[name=Credit_2]').val();
                 Credit_3 = $('input[name=Credit_3]').val();
                 Credit_4 = $('input[name=Credit_4]').val();
                 securityCode = $('input[name=securityCode]').val();
 
                 if($('input[type="radio"]').is(':checked')==""){
                 alert("請選擇付款方式");
                 }

        //若是使用信用卡轉帳的付款方式
        if($('input[id="payCredit"]').is(':checked')==true) {
             if (!cardPattern.test(Credit_1)){
                alert('請輸入信用卡號請輸入16碼數字');
             }else if (!cardPattern.test(Credit_2)){
                 alert('請輸入信用卡號請輸入16碼數字');
             }else if (!cardPattern.test(Credit_3)){
                 alert('請輸入信用卡號請輸入16碼數字');
             }else if (!cardPattern.test(Credit_4)){
                 alert('請輸入信用卡號請輸入16碼數字');
            }else if (securityCode==""){
                 alert('請輸入安全碼');
            }else{
            if($('input[id=useCupon]').is(':checked')==true){
                //若有使用Cupon，則回資料庫將該會員的Cupon更新為0，並將課程金額扣除優惠卷金額
                classPrice = classPrice-coupon;
                $.ajax({
                        url: 'updateCoupon.php',
                        data: {memNo:memNo,},
                        type: 'get',
                        success: function(data){
                        }
                    });
                }
                //寫回將訂單資料庫
                    $.ajax({
                        url: 'classToDb.php',
                        type: 'POST',
                        data: 
                        {
                            memNo: memNo,
                            classNo:sessionStorage['classNo'],
                            classDate:datevalue,
                            payMethod:payMethod,
                            orderTotal:classPrice,
                        },
                        dataType: 'text',
                       success: function(data){
                           $('.L_pay_payinfo').fadeOut();
                           $('#Y_thanksMsgBox').fadeIn();

                        //寫入資料庫的訂單及訂單明細後，將訂單編號及訂單日期顯示在感謝購買的對話框
                        $.ajax({
                            url: 'thanks3.php',
                            dataType: 'text',
                            //下面為文字效果
                            success: function(data){
                            $('#Y_thanksMsgBox').html(data);
                             $('.Y_completeMsg strong:nth-of-type(1)').textillate({
                                loop: false,
                                minDisplayTime: 2000,
                                initialDelay: 0,
                                in: {
                                  effect: 'fadeInLeft',
                                  delayScale: 1.5,
                                  delay: 150,
                                  sync: false,
                                  reverse: false,
                                  shuffle: false,
                                  callback: function () {
                                     $('.Y_Ltitle p:nth-of-type(1)').css('font-style', 'italic');
                                  }
                                }
                              });

                             $('.Y_completeMsg strong:nth-of-type(2)').textillate({
                                loop: false,
                                minDisplayTime: 2000,
                                initialDelay: 0,
                                in: {
                                  effect: 'fadeInLeft',
                                  delayScale: 1.5,
                                  delay: 150,
                                  sync: false,
                                  reverse: true,
                                  shuffle: false,
                                  callback: function () {
                                     $('.Y_checkBtn').css({
                                         'transform': 'translateY(0%)',
                                         'opacity': '1',
                                         'transition':'all .7s',
                                     });
                                  }
                                }
                            });
                          }
                       });

                    }
                });
            }
        }
       
        //******** 若是使用ATM轉帳的付款方式 ********
         if($('input[id="payATM"]').is(':checked')==true) {
            if($('input[name=useCupon]').is(':checked')==true){
            //若有使用Cupon，則回資料庫將該會員的Cupon更新為0,並將課程金額扣除優惠卷金額
            classPrice = classPrice-coupon;
             $.ajax({
                url: 'updateCoupon.php',
                data: {memNo:memNo,},
                type: 'get',
                success: function(data){
                }
            });
         }
            //寫回將訂單資料庫
                    $.ajax({
                        url: 'classToDb.php',
                        type: 'POST',
                        data: 
                        {
                            memNo: memNo,
                            classNo:sessionStorage['classNo'],
                            classDate:datevalue,
                            payMethod:payMethod,
                            orderTotal:classPrice,
                        },
                        dataType: 'text',
                       success: function(data){
                           $('.L_pay_payinfo').fadeOut();
                           $('#Y_thanksMsgBox').fadeIn();

                        //寫入資料庫的訂單及訂單明細後，將訂單編號及訂單日期顯示在感謝購買的對話框
                        $.ajax({
                            url: 'thanks3.php',
                            dataType: 'text',
                            //下面為文字效果
                            success: function(data){
                            $('#Y_thanksMsgBox').html(data);
                             $('.Y_completeMsg strong:nth-of-type(1)').textillate({
                                loop: false,
                                minDisplayTime: 2000,
                                initialDelay: 0,
                                in: {
                                  effect: 'fadeInLeft',
                                  delayScale: 1.5,
                                  delay: 150,
                                  sync: false,
                                  reverse: false,
                                  shuffle: false,
                                  callback: function () {
                                     $('.Y_Ltitle p:nth-of-type(1)').css('font-style', 'italic');
                                  }
                                }
                              });

                             $('.Y_completeMsg strong:nth-of-type(2)').textillate({
                                loop: false,
                                minDisplayTime: 2000,
                                initialDelay: 0,
                                in: {
                                  effect: 'fadeInLeft',
                                  delayScale: 1.5,
                                  delay: 150,
                                  sync: false,
                                  reverse: true,
                                  shuffle: false,
                                  callback: function () {
                                     $('.Y_checkBtn').css({
                                         'transform': 'translateY(0%)',
                                         'opacity': '1',
                                         'transition':'all .7s',
                                     });
                                  }
                                }
                            });
                          }
                       });

                    }
                });
             }
        });
});
    </script>
    </section>
    <section class="footer width1700">
        <div class="copyright">
            <div>copyright © </div>
            <span>starway</span>
        </div>
        <div class="trd">
            <!-- 暫連官網 -->
            <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
            <a href="https://www.google.com/"><img src="images/g.png" alt="g.png"></a>
            <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
        </div>
    </section>


            <?php 
    }
     ?>
</body>

</html>