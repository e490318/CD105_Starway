<?php 
ob_start();
session_start();
require_once("../Star_Way_Database.php");

//募資傳值查詢法
if(isset($_REQUEST['fundNo']))
{
    // $_SESSION['fundNo'] = $_REQUEST['fundNo'];
    $fundNo = $_REQUEST['fundNo'] ; 

    $errMsg = ""; 
    try {

        //全筆數查詢
        $sql="select * from orderdetail_fund 
              where fundNo = $fundNo
              order by fundNo DESC";          
        $order_fundAll = $pdo->query($sql); 

        //取得全部有幾筆
        $totalData = $order_fundAll->rowCount();
        //每頁有幾筆
        $PerPage = 5; 
        //共有幾頁
        $TotalPage = ceil($totalData/$PerPage); // -->  7/2...>3.5    
 
        //設定好要開始抓取的位置
        if(isset($_GET["pageNo"])==false)
          $pageNo=1;
        else  //有提供pageNo
          $pageNo=$_GET["pageNo"];
        //設定該頁開始號碼  
        $start = ($pageNo-1) * $PerPage; 

        //分頁筆數查詢
        $sql =  "select * 
                 from orderdetail_fund f
                 join info_member m on f.memNo = m.memNo
                 where f.fundNo = $fundNo
                 order by f.fundNo limit $start,$PerPage";
        $order_fund = $pdo->query($sql);  

    } catch (PDOException $e) {
    $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
    $errMsg .= "行號 : ".$e -> getLine()."<br>";
    }
}//募資傳值查詢法
else{ 
        //全筆數查詢
        $sql="select * from orderdetail_fund 
              order by fundNo DESC";          
        $order_fundAll = $pdo->query($sql); 

        //取得全部有幾筆
        $totalData = $order_fundAll->rowCount();
        //每頁有幾筆
        $PerPage = 5; 
        //共有幾頁
        $TotalPage = ceil($totalData/$PerPage); // -->  7/2...>3.5    

        // echo $totalData;

        //設定好要開始抓取的位置
        if(isset($_GET["pageNo"])==false)
          $pageNo=1;
        else  //有提供pageNo
          $pageNo=$_GET["pageNo"];
        //設定該頁開始號碼  
        $start = ($pageNo-1) * $PerPage; 

        //分頁筆數查詢
        $sql =  "select * 
                 from orderdetail_fund f
                 join info_member m on f.memNo = m.memNo
                 order by f.fundNo limit $start,$PerPage";
        $order_fund = $pdo->query($sql);  

    }





?>
<!-- $_REQUEST['fundNo'] = 1; -->
<!-- $fundNo = $_REQUEST['fundNo']; -->

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Tweenmax的Scroll套件-->
    <script src="../js/TweenMax/ScrollToPlugin.min.js"></script>
    <!-- 搭配Scroll的ScrollMagic套件-->
    <script src="../js/ScrollMagic/ScrollMagic.min.js"></script>
    <script src="../js/ScrollMagic/plugins/animation.gsap.min.js"></script>
    <script src="../js/ScrollMagic/plugins/debug.addIndicators.min.js"></script>

    <title>星路後端管理系統-唱片訂單管理</title>
     <style type="text/css">
            .seeMore {
                width: 50px;
                height: 50px;
                background-size: cover;
                background-image: url(../images/StarWay_Backend/edit.png);
                background-color: transparent;
            }

            .data_table td {
                padding-top: 1%;
                padding-right: 25px;
                /* padding-right: 0.5%; */
                padding-bottom: 1%;
                padding-left: 25px;
                font-size: 14px;
            }

            #memAvatar>img { 
                width:100px;
                 /*padding-right: 500px;*/
            }

            table th{
                word-break:break-all; 
                word-wrap:break-all;
            }
        }
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
                    document.getElementsByClassName("_fund")[0].id="menu_now";
                    });
                </script>  
        </div>
        <!--menu-->
        <div id="content_wrap">
            <div id="container">
                <div id="content_topic">
                    <!--標題-->
                    <div id="topic">贊助管理</div>
                </div>
                <div id="add">
                    <div id="addgap">
                      <!--   <form action="#">
                            <select name="field">
                                <option value="record_no">訂單編號</option>
                                <option value="record_peo">會員姓名</option>
                                <option value="record_date">訂單日期</option>
                                <option value="record_date">出貨狀態</option>
                            </select>
                            <input type="text" name="data" />
                            <input type="submit" value="搜尋" />
                        </form> -->
                    </div>
                </div>
                <!--新增按鈕-->
                <div id="content_table">
                    <!--表格內容-->
                    <table border="0" class="data_table">
                        <form action="#" method="get">                      
                            <thead>
                                <th>贊助編號</th><!-- <?php //echo $fundNo?> -->
                                <th>募資案件編號</th>
                                <th>會員編號<br>(贊)</th>
                                <th>會員頭像</th>
                                <th>會員名稱</th>
                                <th>會員帳號</th>
                                <th>贊助金額</th>
                                <th>贊助日期</th>
                            </thead>   
                             <tbody id="order_fund"> 
        <?php  
         while($fundRow = $order_fund->fetch(PDO::FETCH_ASSOC)){ 
        ?>

        <tr>
        <form action="orderdetail_fund.php" method="get">
            <td><?php echo $fundRow['donateNo'] ?></td>
            <td><?php echo $fundRow['fundNo'] ?></td>
            <td><?php echo $fundRow['memNo'] ?></td>
            <td id = memAvatar><img src="../images/user/memAvatar/<?php echo $fundRow['memAvatar'] ?>"></td>
            <td><?php echo $fundRow['memName'] ?></td>
            <td><?php echo $fundRow['memId'] ?></td>
            <td><?php echo $fundRow['donation'] ?></td>
            <td><?php echo $fundRow['donateDate'] ?></td>
           <!--  <td><?php //echo $fundRow['fundEndDate'] ?></td>       
            <td><?php //echo $fundRow['fundGoal'] ?></td>                         
            <td><?php //echo $fundRow['fundTotal'] ?></td>
            <td><?php //echo $fundRow['fundStatus'] ?></td>
            <td><?php //echo $fundRow['demoCover'] ?></td>
            <td><?php //echo $fundRow['demoDescript'] ?></td>                
            <td><?php //echo $fundRow['demoLink'] ?></td> -->
            <!-- <td>
             <label>
                <input type="hidden" name="fundNo" value="<?php //echo $fundRow['fundNo'] ?>">
                <input type="submit" name="" value="" class="seeMore" onclick="alert(<?php //echo $fundRow['fundNo'] ?>)">
            </label>
            </td> -->
        </form>
        </tr> 

        <?php 
            } 
        ?>
                            </tbody> 
                             <tfoot>
        <!-- -- -- -- -- -- -- -- 跳換資料頁-- -- -- -- -- -- -->
        <div style="display:compact;text-align:center">
        <?php
        //印可連結的頁數資料
        echo "<a href='?pageNo=1'> <<< </a>&nbsp";
        for($i=1; $i <= $TotalPage;$i++){
          if($i==$pageNo)
            echo "<a href='?pageNo=$i' style='color:deepPink'>",$i,"</a>&nbsp&nbsp";
          else
            echo "<a href='?pageNo=$i'>",$i,"</a>&nbsp&nbsp";
        }
        echo "<a href='?pageNo=$TotalPage'> >>> </a>&nbsp";

        // echo "<a href='?pageNo-=1'> <<< </a>&nbsp";
        // echo "<a href='?pageNo+=1'> >>> </a>&nbsp";
        ?>
        </div>
        <!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --> 
                           </tfoot>     
                        </form>
                    </table>                
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

<script>
    // alert(<?php //echo $_REQUEST['fundNo']?>);

    //     $(document).ready(function() {
    //         var fundNo=3;
    //      $.ajax({
    //         url: 'J_AJ_order_fund.php',
    //         dataType: 'text',
    //         data: {
    //             "fundNo":fundNo,
    //         },
    //         success: function(data){
    //             $('#order_fund').html(data);
    //         }
    //     });

    // });
</script>


<script type="text/javascript">
    // var before = document.referrer; 
    function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}
     
</script>
             <!-- // data:{"breedId":breedId,"prBreedId":prBreedId}, -->


<!--     1   donateNo主鍵  int(10)           贊助編號    AUTO_INCREMENT    
    2   fundNo  int(10)           募資案件編號        
    3   memNo   int(10)           會員編號(贊助者)         
    4   donation    int(10)           贊助金額          
    5   donateDate  date              贊助日期  -->         
