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


 ?>




<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>購物車</title>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<!-- 自己的CSS -->
<link rel="stylesheet" type="text/css" href="css/style_Y.css">
<!-- Animate -->
<link rel="stylesheet" type="text/css" href="css/animate/animate.css">
<!-- jQuery-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-stars.js"></script>
<!-- Tweenmax的Scroll套件-->
<script src="js/TweenMax/ScrollToPlugin.min.js"></script>
<!-- 搭配Scroll的ScrollMagic套件-->
<script src="js/ScrollMagic/ScrollMagic.min.js"></script>
<script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
<script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
<script src="js/notLoginYet.js"></script>

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
                <a a onclick="checkToUser()"><i class="fas fa-user"></i></a>
                 <span id="memName">&nbsp;</span>   <!-- 使用者姓名 -->
                 <span id="spanLogin" onclick="document.getElementById('memLoginShow').style.display='block'" style="width:auto;">登入</span>
                <a href=""><i class="fas fa-shopping-cart"></i></a>
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

    <!-- 購物車清單 -->
     <section class="Y_cartContent width1200">
            <h2>購物車清單</h2>
        <?php  
            if ( isset($_SESSION["albumName"]) === false or count($_SESSION['albumName'])===0 ) {
              $cartTotal =0;
        ?>
            <div class="Y_cartNull">
            <p><?php echo "您還沒買任何東西哦 !" ?><strong><a href="CDWall_sell.php"> 請到我們的唱片牆</a></strong></p>
            </div>
        <?php

        }else{
          $cartTotal =0;
          foreach($_SESSION["albumName"] as $albumNo => $albumName) {
            $intPrice  =(int)$_SESSION['price'][$albumNo];
            $cartTotal += $intPrice;
            ?>
        <form action="cartUpdate.php">
           <input type="hidden" name="albumNo" value="<?php echo $albumNo?>">
            <div class="Y_cartItem">
             <div class="Y_ccartImg">
              <img src="images/CDWall/records/<?php echo $_SESSION['imageName'][$albumNo] ?>">
             </div>
               <div class="Y_carInfo">
             <h3><?php echo $_SESSION['albumName'][$albumNo] ?></h3>
            <p><?php echo $_SESSION['singer'][$albumNo] ?></p>
            <strong>價格: $<?php echo $_SESSION['price'][$albumNo] ?></strong>
            </div>
             <div class="Y_ccartDel">
            <input class="Y_deleteSess" type="image" src="images/delete.png">
            </div>
        </div>
     </form>
            <?php
          }
            ?>
   
        <!-- 顯示總價 -->
        <div class="Y_amount">
          <?php 
          if (isset($cartTotal)==true) {
           ?>
          總計: <strong><?php echo $cartTotal; ?>元</strong>
          <?php
          }else{
            echo '';
          }
           ?>
       </div>

       <div id="Y_cartGo">
        <div class="Y_browse">
         <a href="CDWall_sell.php#L_CDWallSell"><p>繼續瀏覽</p></a>
        </div>    

        <div class="Y_check">
         <a href="#"><p>結帳</p></a>
        </div>    
        </div>
        <?php 
        }
         ?>
     </section>

    <!-- 付款方式 -->
     <section id="Y_payInfo">
       <div class="L_pay_payinfo">
            <div class="L_pay_payinfo_pay">
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

            <!-- 寄件資訊 -->
            <div class="L_pay_payinfo_adres">
              <h5>寄件資訊</h5>
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
                  <button>上一步</button>
                  <button>下一步</button>
                </div>
            </div>
        </div>
     </section>
    
    <!-- 訂單明細確認 -->
    <section id="Y_albumOrder">
    <div id="albumOrderInfo">
     <h5>請確認訂單細明及收件人資料</h5>
      <div id="Y_albumOrderDetails-left">
     <!-- <h5>請確認訂單細明及收件人資料:</h5> -->
     </div>
     <div id="Y_albumOrderDetails-right">
     <span id="use_Cupon"></span><br>
     總&nbsp&nbsp金&nbsp&nbsp額&nbsp:&nbsp<span id="confirmTotal"></span>元<br>
     付款方式&nbsp:&nbsp<span id=paymentStatus></span><br>
     姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名&nbsp:&nbsp<span id="receiveName"></span><br>
     地&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp址&nbsp:&nbsp<span id="receiveAddress"></span><br>
     電&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp話&nbsp:&nbsp<span id="receiverPhonrNo"></span><br>
     </div>
     
      <div class="Y_NextBefore">
           <button>上一步</button>
           <!-- <input id="albumOrderConfirmed"  type="submit" name="" value="確認下單"> -->
           <button id="albumOrderConfirmed">確認下單</button>
        </div>
   </div>
    </section> 

    <!-- 訂單送出後，感謝訊息 -->
    <div id="Y_thanksMsgBox">
    </div>



    <section class="footer width1700">
        <div class="copyright">
            <div>copyright © </div>
            <span>starway</span>
        </div>
        <div class="trd">
            <!-- 暫連官網 -->
            <a href="https://www.facebook.com/"><img src="images/fb.png" alt="fb.png"></a>
            <a href="https://www.google.com/"><img src="images/g+.png" alt="g+.png"></a>
            <a href="https://line.me/en/"><img src="images/line.png" alt="line.png"></a>
        </div>
    </section>
    <div class="bg">
        <!-- 背景要用js寫動態飄移呼吸 -->
        <div id="bg_dot1"></div>
        <div id="bg_dot2"></div>
    </div>

    <!-- TweenMax-->
    <script src="js/TweenMax/Tweenmax.js"></script>
    <script src="js/memLogin.js"></script>
    <!-- LOGO效果-->
    <script src="js/Logo_neon.js"></script>
    <script src="js/Textillate/jquery.lettering.js"></script>
    <!-- 文字動畫效果-->
    <script src="js/Textillate/jquery.textillate.js"></script>
    <script>
    
    //在JS先宣告一個memNo變數，用來確認該變數在session是否有會memNo
     var memNo = <?php echo $Session_memNo;?>;
     var cartTotal = <?php echo $cartTotal?>;
     var coupon = <?php echo $Session_couponNo?>;
     console.log(coupon);

    $(document).ready(function() {
$('body,html').jstars({
 image_path: 'images',
 // image: 'jstar-map.png',
 style: 'rand',
 width: 27,
 height: 27,
 frequency: 10,
 style_map: {
     white: 0,
     blue: -27,
     green: -54,
     red: -81,
     yellow: -108
 },
 delay: 300
});

// $('body,html').jstars({
//         image_path: 'images',
//          // image: 'jstar-map.png',
//         style: 'white',
//         frequency: 10   });
                
    


         $('.Y_check').on('click', function(event) {
            event.preventDefault();

            if( memNo != 0){ //若有登入會員，則跳出付款畫面
            $('.Y_cartContent').fadeOut();
            $('#Y_payInfo').fadeIn();

            //付款方式的上一步-回到購物車列表
            $('.L_pay_payinfo_adres_formBtn button:nth-of-type(1)').on('click', function(event) {
            $('#Y_payInfo').fadeOut();
            $('.Y_cartContent').fadeIn();
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
         });

         //若有優惠卷，則出現使用優惠卷的按鈕

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
   

         

            //******** 確認欄位是否有空值 ********
          $('.L_pay_payinfo_adres_formBtn button:nth-of-type(2)').on('click', function(event) {
                 cardPattern = /^(?=^.{4}$)((?=.*[0-9]))^.*$/
                 payMethod = $('input[name=payMethod]:checked').val();
                 customerName = $('input[name=customerName]').val();
                 customerContact = $('input[name=customerContact]').val();
                 customerAdd = $('input[name=customerAdd]').val();
                 Credit_1 = $('input[name=Credit_1]').val();
                 Credit_2 = $('input[name=Credit_2]').val();
                 Credit_3 = $('input[name=Credit_3]').val();
                 Credit_4 = $('input[name=Credit_4]').val();
                 securityCode = $('input[name=securityCode]').val();
                // console.log($('input[name=payMethod]:checked'));
                // console.log($('input[name=useCupon]').is(':checked'));

                 if($('input[type="radio"]').is(':checked')==""){
                 alert("請選擇付款方式");}

                //若是選擇信用卡付款- 卡號輸入及收件人姓名、地址、電話欄位判斷
                if ($('input[id="payCredit"]').is(':checked')==true) {
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
                    }
                 
                    else if($('input[name=customerName]').val()==""){
                       alert("請輸入收件人名字");
                     }else if($('input[name=customerAdd]').val()==""){
                       alert("請輸入收件人地址");
                     }else if($('input[name=customerContact]').val()==""){
                       alert("請輸入收件人聯絡電話");
                     }

                     else{
                    //******** 所有欄位填寫完後，按下下一步可以跳到訂單明細確認 ********
                    $('#Y_payInfo').fadeOut();
                    $('#Y_albumOrder').fadeIn();
                     }

                     }

             //******** 若是選擇ATM付款- 卡號輸入及收件人姓名、地址、電話欄位判斷 ********
                if ($('input[id="payATM"]').is(':checked')==true) {
                 if($('input[name=customerName]').val()==""){
                   alert("請輸入收件人名字");
                 }else if($('input[name=customerAdd]').val()==""){
                   alert("請輸入收件人地址");
                 }else if($('input[name=customerContact]').val()==""){
                   alert("請輸入收件人聯絡電話");
                 }

                     else{
                    //******** 所有欄位填寫完後，按下下一步可以跳到訂單明細確認 ********
                    $('#Y_payInfo').fadeOut();
                    $('#Y_albumOrder').fadeIn();
                     }
            }

                  //********判斷是否有按下使用優惠卷的按鈕，若有則將金額做折扣 ********
                if($('input[name=useCupon]').is(':checked')==true){
                $('#confirmTotal').text(cartTotal-coupon);
                $('#use_Cupon').text(`您要使用${coupon}元的優惠卷`);
                }else{
                $('#confirmTotal').text(cartTotal);
                }

                 //******** 將所輸入的欄位放到訂單明細資料確認 ********
                $('#paymentStatus').text(payMethod);
                $('#receiveName').text(customerName);
                $('#receiverPhonrNo').text(customerContact);
                $('#receiveAddress').text(customerAdd);
           });

          //******** 訂單明細資料確認的上一步，回到付款方式 ********
          $('.Y_NextBefore button:nth-of-type(1)').on('click', function(event) {
            $('#Y_albumOrder').fadeOut();
             $('#Y_payInfo').fadeIn();
          });

        //******** 將訂單寫回到PHP ********
        $('#albumOrderConfirmed').on('click', function(event) {
            //若有使用Cupon，則回資料庫將該會員的Cupon更新為0
            if($('input[name=useCupon]').is(':checked')==true){
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
                url:'cartToDb.php',
                data:
                {
                    memNo:memNo,
                    payMethod:payMethod,
                    cartTotal:cartTotal,
                    customerName:customerName,
                    customerAdd:customerAdd,
                    customerContact:customerContact,
                },
                type:'POST',
                dataType:'text',
                success:function (data) {
                    $('#Y_albumOrder').fadeOut();
                    $('#Y_thanksMsgBox').fadeIn();

                //寫入資料庫的訂單及訂單明細後，將訂單編號及訂單日期顯示在感謝購買的對話框
                $.ajax({
                url: 'thanks.php',
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
});
    </script>
</body>
</html>