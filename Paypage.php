<?php 
session_start();
ob_start();
$fundplanNo = $_REQUEST['fundplanNo'];
$fundNo = $_REQUEST['fundNo'];
$memNo = $_REQUEST['memNo'];
$errMsg = "";

if(isset($_SESSION["memNo"]) ==true){ //從session裡確認是否有memNo的變數。若有該變數，則宣告一個Session_memNo變數等於session裡的memNo,目的是要讓javascript去抓可以用這個PHP的變數，來判斷是否有登入
 $Session_memNo = $_SESSION["memNo"];
 }
 else{
  $Session_memNo = 0;
 }

try {
require_once("Star_Way_Database.php");

$sql="SELECT * from fund_plan where fundplanNo=$fundplanNo and shelfStatus=1";
// $sql="UPDATE  info_album set shelfStatus='0'";

    $fund_plan = $pdo->query($sql);  
    $fund_planRow = $fund_plan->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}


 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>付款頁面</title>
<!-- favicon -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<!-- 自己的CSS -->
<link rel="stylesheet" type="text/css" href="css/style_L.css">
<!-- <link rel="stylesheet" type="text/css" href="css/style_YL.css"> -->
<!-- Animate -->
<link rel="stylesheet" type="text/css" href="css/animate/animate.css">
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
<style>
    .L_pay_payinfo_pay{
        dis
    }
</style>
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
                    <li class="login_mobile"><a class="menu_items " href="#"><i class="fas fa-shopping-cart"></i></a></li>
                </ul>
            </nav>
            <div class="nav_user">
                <a onclick="checkToUser()"><i class="fas fa-user"></i></a>
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

    <!-- 左側每屏導覽 -->
    <div class="sidebar L_pay_web_sidebar">
        <p>付款資訊</p>
    </div>

    <div class="width1200 L_pay_plan_wrap">
        <!-- 第一區塊：方案 -->
        <div class="L_pay_plan_sidebar">付款資訊</div>
        <?php 
              foreach($fund_planRow as $fundData){
             ?>
            <div class="L_pay_plan">
            <div><img src="images/<?php echo $fundData['planImg'] ?>" alt=""></div>
            <div class="L_pay_plan_detil">
                <div><?php echo $fundData['planName'] ?></div>
                <span>NT. <?php echo $fundData['planPrice'] ?> 元</span>
                <div><?php echo $fundData['planContent'] ?><br><?php echo $fundData['planContentTwo'] ?></div>
                <div><?php echo $fundData['planDescription'] ?></div>
                <span><?php echo $fundData['planNotice'] ?></span>
            </div>
           </div>
           <script>
               var planPrice = <?php echo $fundData['planPrice'] ?>;
           </script>
                <?php 
                }
         ?>

        <!-- 第三區塊：付款資訊確認 -->
        <div class="L_pay_payConfirm">
            <!-- 付款方式 -->
            <div class="L_pay_payConfirm_pay">
                <div>付款方式</div>
                <p>信用卡付款</p>
            </div>
            <!-- 寄件資訊 -->
            <div class="L_pay_payConfirm_adres">
                <div>寄件資訊</div>
                <ul class="L_pay_payConfirm_adres_form">
                    <li>
                        <span>收件人</span>
                        <p id="receiveName" class="L_pay_payConfirm_adres_form_text"></p>  
                    </li>
                    <li>
                        <span>收件地址</span>
                        <p id="receiveAddress" class="L_pay_payConfirm_adres_form_text"></p>
                    </li>
                    <li>
                        <span>聯絡電話</span>
                        <p id="receiverPhonrNo" class="L_pay_payConfirm_adres_form_text"></p>
                    </li>
                </ul>
                <button id="backToPayInfo">上一步</button>
                <button id="fundOrderConfirmed">確認募款</button>
            </div>
            
        </div>


        <!-- 第二區塊：付款資訊 -->
        <div class="L_pay_payinfo">
            <!-- 付款方式 -->
            <div class="L_pay_payinfo_pay">
                <div>付款方式</div>
                <span>
                 <input id="payCredit" type="radio" name="payMethod" value="0">
                 <label for="payCredit">信用卡付款</label>
               </span>
                <span>
                 <input id="payATM" type="radio" name="payMethod" value="1">
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

            <!-- 寄件資訊 -->
            <div class="L_pay_payinfo_adres">
                <div>寄件資訊</div>
                <ul class="L_pay_payinfo_adres_form">
                    <li>
                        <span>收件人</span>
                        <input type="text" name="customerName" placeholder="請填寫真實姓名">   
                    </li>
                    <li>
                        <span>收件地址</span>
                        <input type="text" name="customerAdd" placeholder="您的收件地址">
                    </li>
                    <li>
                        <span>聯絡電話</span>
                        <input type="text" name="customerContact" placeholder="請以「-」分開，ex.0912-345-678">
                    </li>

                </ul>
                <div class="L_pay_payinfo_adres_formBtn">
                    <a href="CDPage.php?fundNo=<?php echo $fundNo ?>#L_record_plan_title">更改資助方案</a>
                    <button class="L_pay_payinfo_adres_formBtn_input"> 進行付款</button>
                </div>
            </div>
        </div>

 </div>

 <!-- 訂單送出後，感謝訊息 -->
<div id="Y_thanksMsgBox">
</div>
</div>

    <!-- footer -->
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

    <!-- TweenMax -->
    <script src="js/TweenMax/Tweenmax.js"></script>
    <script src="js/Textillate/jquery.lettering.js"></script>
    <script src="js/Textillate/jquery.textillate.js"></script>
    <script src="js/jQuery-canvas-sparkle/jquery-canvas-sparkles.js"></script>
     <script src="js/memLogin.js"></script>

    <!-- logo --> 
    <script src="js/Logo_neon.js"></script>

    <script>
        var memNo = <?php echo $memNo;?>;
        var fundNo = <?php echo $fundNo?>;
        var fundplanNo = <?php echo $fundplanNo?>;

       //若點擊信用卡付款，則展開信用卡輸入相關，並將ATM匯款的輸入收起來
        $('#payCredit').on('click', function (event) {
            $('#Y_payATMInput').slideUp(20);
            $('#Y_payCreditInput').slideToggle();
        });

         //若點擊ATM付款，則展開ATM輸入相關，並將信用卡的輸入收起來
          $('#payATM').on('click', function (event) {
            $('#Y_payCreditInput').slideUp(20);
            $('#Y_payATMInput').slideToggle();
        });


        $('.L_pay_payinfo_adres_formBtn_input').on('click', function(event) {
                    payMethod = $('input[name=payMethod]:checked').val();
                    customerName = $('input[name=customerName]').val();
                    customerContact = $('input[name=customerContact]').val();
                    customerAdd = $('input[name=customerAdd]').val();
                    // console.log($('input[name=payMethod]:checked'));
                    // console.log($('input[name=useCupon]').is(':checked'));

                    if ($('input[type="radio"]').is(':checked')==""){
                    alert("請選擇付款方式");
                    }else if($('input[name=customerName]').val()==""){
                    alert("請輸入收件人名字")
                    }else if($('input[name=customerAdd]').val()==""){
                    alert("請輸入收件人地址")
                    }else if($('input[name=customerContact]').val()==""){
                    alert("請輸入收件人聯絡電話")
                    }



                    else{
                        //******** 所有欄位填寫完後，按下進行付款可以跳到捐款明細確認 ********
                    $('.L_pay_payinfo').fadeOut();
                    $('.L_pay_payConfirm').fadeIn();
        

                    //  //******** 將所輸入的欄位放到訂單明細資料確認 ********
                    $('.L_pay_payConfirm_pay p').text(payMethod);
                    $('#receiveName').text(customerName);
                    $('#receiverPhonrNo').text(customerContact);
                    $('#receiveAddress').text(customerAdd);
                    }
            });

                //上一步- 返回到付款方式
            $('#backToPayInfo').on('click', function(event) {
                $('.L_pay_payConfirm').fadeOut();
                $('.L_pay_payinfo').fadeIn();

                // alert('test');
            });

                //******** 將募資寫回到PHP ********
            $('#fundOrderConfirmed').on('click', function(event) {
                    $.ajax({
                    url:'fundToDb.php',
                    data:
                    {
                        memNo:memNo,
                        fundNo:fundNo,
                        fundplanNo:fundplanNo,
                        planPrice:planPrice,
                        payMethod:payMethod,
                        customerName:customerName,
                        customerAdd:customerAdd,
                        customerContact:customerContact,
                    },
                    type:'POST',
                    dataType:'text',
                    success:function (data) {
                        $('.L_pay_plan').fadeOut();
                        $('.L_pay_payConfirm').fadeOut();
                        $('#Y_thanksMsgBox').fadeIn();

                    //寫入資料庫的訂單及訂單明細後，將訂單編號及訂單日期顯示在感謝購買的對話框
                    $.ajax({
                    url: 'thanks2.php',
                    dataType: 'text',
                    //下面為文字效果
                    success: function(data){
                    $('#Y_thanksMsgBox').html(data);
                            $("#Y_thanksMsgBox").sparkle({
                        color: ["#FFFFFF","#FF0000","#00FFFF"]
                        });
                        $('#Y_thanksMsgBox').trigger("start.sparkle").on("click", function() {
                        $(this).trigger("stop.sparkle");
                            });
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
                            // $('.Y_Ltitle p:nth-of-type(1)').css('font-style', 'italic');
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
    });
    </script>


    <!-- 進行付款切換 --> 
<!--     <script>
            var LpayWrap = document.querySelector('.L_pay_plan_wrap');
            var LpayPlan = document.querySelector('.L_pay_plan');
            var LpayInfo = document.querySelector('.L_pay_payinfo');
            var LpayConf = document.querySelector('.L_pay_payConfirm');
            
            var LpayInput = document.querySelector('.L_pay_payinfo_adres_formBtn_input');
            
            console.log(':D');
    
            LpayInput.onclick = function(){
                console.log(':D');
                LpayInfo.style.display = 'none';
                LpayConf.style.display = 'block';
                LpayConf.style.width = '30%';

                LpayWrap.style.backgroundImage = 'linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.1) 30%, rgba(255, 255, 255, 0.1) 60%, rgba(255, 255, 255, 0) 100%)';
                LpayPlan.style.backgroundImage = 'none';
                LpayPlan.style.paddingLeft = '10%';
            }
    
        </script> -->
</body>
</html>