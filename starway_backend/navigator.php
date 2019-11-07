<div id="menu_header"> 
    管理員：<?php echo isset(  $_SESSION["adminName"]  )?  $_SESSION["adminName"] :"錯誤"?>
</div>
<ul id="menu_ul">
    <li class="_server"><a href="info_server_b.php">後台人員管理</a></li>
    <li class="_member"><a href="info_member_b.php">會員管理</a></li>
    <li class="_cdWall"><a href="cdwall_msg_b.php">唱片牆管理</a></li>
    <li class="_albumsell">專輯相關
        <div class="bd">
             <a href="CDwall_sell_back.php">專輯資訊</a><br>
             <a href="album_track_b.php">專輯曲目</a><br>
             <a href="CDwall_sell_order_back.php">專輯訂單管理</a><br>
        </div>
    </li>
    <li class="_albumImg">素材相關
        <div class="bd">
            <a href="album_bgimg_b.php">封面版型管理</a><br>
            <a href="album_icon_b.php">ICON管理</a><br>
        </div>
    </li>
    <li class="_fund">募資相關
        <div class="bd">
             <a href="fund_plan_b.php">方案管理</a><br>
             <a href="order_fund.php">募資管理</a><br>
             <a href="orderdetail_fund.php">贊助管理</a><br>
        </div>
    </li>
    <li class="_class">課程相關 
        <div class="bd">
            <a href="info_class_b.php">課程管理</a><br>
            <a href="info_teacher_b.php">教師管理</a><br>
            <!-- <a href="order_class_b.html">課程訂單管理</a><br> -->
        </div> 
    </li> 
</ul>
<div id="menu_footer">
<a style="cursor: pointer;" onclick="

    var xhr = new XMLHttpRequest();
    xhr.open('get','adminLogout.php',true);
    xhr.send(null);

    xhr.onload = function(){
        if( xhr.status == 200){ 
            location.href='login.html'; 
        }else{
        alert( xhr.status);
        }
    };
">登出</a>
</div>