<?php 
ob_start();
session_start();
if(isset($_SESSION["memNo"]) ==true){ //從session裡確認是否有memNo的變數。若有該變數，則宣告一個Session_memNo變數等於session裡的memNo,目的是要讓javascript去抓可以用這個PHP的變數，來判斷是否有登入
 $Session_memNo = $_SESSION["memNo"];
 }
 else{
  $Session_memNo = 0;
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
<!-- jQuery-->
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Tweenmax的Scroll套件-->
<script src="js/TweenMax/ScrollToPlugin.min.js"></script>
<!-- 搭配Scroll的ScrollMagic套件-->
<script src="js/ScrollMagic/ScrollMagic.min.js"></script>
<script src="js/ScrollMagic/plugins/animation.gsap.min.js"></script>
<script src="js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>
<script src="js/notLoginYet.js"></script>
<style>
    .Y_ccartDel{
        position: relative;
    }
    .Y_ccartDel span{
        font-size: 40px;
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
</style>
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
                <a href="index.html" id="logo" class="L_btn"></a>
                <img class="logo_b" src="images/logo_b.png" alt="logo.png">
                <audio id="neonSound" src="sounds/neon.mp3"></audio>
                <div id="L_box"></div>
            </div>
            <nav>
                <ul class="menu">
                    <li><a class="menu_items L_CD" href="CDWall.html">募唱片</a></li>
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
            <p><?php echo "您還沒買任何東西哦 !" ?><strong><a href="CDWall_test.html"> 請到我們的唱片牆</a></strong></p>
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
            <span>
            <?php echo $albumNo?>
            </span>
             <img src="images/delete.png" style="cursor: pointer">

            <!-- <input class="Y_deleteSess" type="image" src="images/delete.png"> -->
            </div>
        </div>
     </form>

            <?php
          }
            ?>
            <script>
                    $(document).ready(function() {
                    Y_ccartDel = document.querySelectorAll('.Y_ccartDel');
                    for (var i = 0; i < Y_ccartDel.length; i++) {
                    $(Y_ccartDel[i]).on('click', function (event) {
                        var albumNo = event.target.innerText;
                        console.log(albumNo);
                        $.ajax({
                        url:'cartUpdate.php',
                        type:'post',
                        data:{albumNo:albumNo},
                            success:function (data) {
                         window.location.reload();
                        }
                             });
                         });
                     }
                 });
            </script>

   
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
         <a href="CDWall_test.html"><p>繼續瀏覽</p></a>
        </div>    

        <div class="Y_check">
         <a href="#"><p>現在下單</p></a>
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
               
                <span>
                 <input id="payATM" type="radio" name="payMethod" value="ATM匯款">
                 <label for="payATM">ATM匯款</label>
               </span>


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
     總&nbsp&nbsp金&nbsp&nbsp額&nbsp:&nbsp<span id="confirmTotal"></span>元<br>
     付款方式&nbsp:&nbsp<span id=paymentStatus></span><br>
     姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名&nbsp:&nbsp<span id="receiveName"></span><br>
     電&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp話&nbsp:&nbsp<span id="receiverPhonrNo"></span><br>
     地&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp址&nbsp:&nbsp<span id="receiveAddress"></span><br>
     </div>
      <div class="Y_NextBefore">
           <button>上一步</button>
           <input id="albumOrderConfirmed"  type="submit" name="" value="確認下單">
        </div>
   </div>
    </section> 
    <div id="thanksMsgBox">
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
    <script>
    
    //在JS先宣告一個memNo變數，用來確認該變數在session是否有會memNo
     var memNo = <?php echo $Session_memNo;?>;
     var cartTotal = <?php echo $cartTotal ?>;
    $(document).ready(function() {
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
         });

          $('.L_pay_payinfo_adres_formBtn button:nth-of-type(2)').on('click', function(event) {
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
                $('#Y_payInfo').fadeOut();
                $('#Y_albumOrder').fadeIn();

                $('#confirmTotal').text(cartTotal);
                $('#paymentStatus').text($('input[name=payMethod]:checked').val());
                $('#receiveName').text($('input[name=customerName]').val());
                $('#receiverPhonrNo').text($('input[name=customerContact]').val());
                $('#receiveAddress').text($('input[name=customerAdd]').val());


                 }
           });
          $('.Y_NextBefore button').on('click', function(event) {
            $('#Y_albumOrder').fadeOut();
             $('#Y_payInfo').fadeIn();
          });

     });

    </script>
</body>
</html>