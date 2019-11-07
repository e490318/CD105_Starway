<?php
ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="
    sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">


    <!-- 自己的CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style_J_backend.css">
    <!-- jQuery-->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <!-- Tweenmax的Scroll套件-->
    <script src="../js/TweenMax/ScrollToPlugin.min.js"></script>
    <!-- 搭配Scroll的ScrollMagic套件-->
    <script src="../js/ScrollMagic/ScrollMagic.min.js"></script>
    <script src="../js/ScrollMagic/plugins/animation.gsap.min.js"></script>
    <script src="../js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>

    <title>星路後端管理系統-唱片訂單管理</title>
    <style>
        
</style>
</head>

<body>
    <!--側邊選單-->
    <div id="menu">
        <div id="logo_container">
            <img id="logo" src="../images/StarWay_Backend/logo_d_2x.png" width="220" height="65" />
     </div> 
            <?php include("navigator.php"); ?> 
            <script type="text/javascript"> 
                document.addEventListener("DOMContentLoaded", function(){
                 document.getElementsByClassName("_class")[0].id="menu_now";
                });
            </script> 
        </div>
        <!--menu-->
        <div id="content_wrap">
            <div id="container">
                <div id="content_topic">
                    <!--標題-->
                    <div id="topic">教師管理</div>
                </div>
                <div id="add">
                    <div id="addgap">
                        <form action="#">
                            <select name="field">
                                <option value="record_no">訂單編號</option>
                                <option value="record_peo">會員姓名</option>
                                <option value="record_date">訂單日期</option>
                                <option value="record_date">出貨狀態</option>
                            </select>
                            <input type="text" name="data" />
                            <input type="submit" value="搜尋" />
                        </form>
                    </div>
                </div>
                <!--新增按鈕-->
                <div id="content_table">
                    <!--表格內容-->
                    <table border="0" class="data_table">
                        <form action="#" method="post">
                            <thead>
                                <th>教師編號</th>
                                <th>教師姓名</th>
                                <th>教師圖片</th>
                                <th>教師描述</th>
                                <th>上下架狀態</th>                        
                            </thead>
                            <tbody id="info_teacher">
                             
                            
                            </tbody>
                            
               
                        </form>
                            <script>
                                $(document).ready(function() {
                                 $.ajax({
                                    url: 'info_teacher_b(ajax).php',
                                    dataType: 'text',
                                    success: function(data){
                                        $('#info_teacher').html(data);
                                    }
                                });
                            });
                            </script>
                    </table>
                    <!-- 以下印頁碼區 -->
                    <table class="data_table2" id="pagecss">
                        <tr>
                            <td> <a href='#'><font color='#8f2b2b'><u>1</u></font>　</a> <a href='#'>2　</a> <a href='#'>3　</a> <a href='#'>next　</a> <a href='#'>>>　</a> </td>
                        </tr>
                    </table>
                    <!-- 以上印頁碼區 -->
                </div>
                <!--content_table-->
            </div>
            <!--container-->
            <div id="content_footer">
                <!--頁尾--> 
                copyright &copy starway All Rights 2019 Reserved
            </div>
        </div>
        <!--content_wrap-->
</body>

</html>