<?php
ob_start();
session_start(); 


// $fundNo = $_REQUEST['fundNo'];
// WHERE `fundNo` < ".$fundNo."
// LIMIT ".$fundNo.",100";
// $sql="UPDATE  order_fund set shelfStatus='0'";

// -- -- $_REQUEST_SECTION -- --
// $memNo = $_REQUEST["memNo"];
// -- -- $_REQUEST_SECTION -- --

$fundStatusChosen = isset($_GET["fundStatusChosen"])?$_GET["fundStatusChosen"]:"";


$errMsg = ""; 
try {
    require_once("../Star_Way_Database.php");

     if($fundStatusChosen!=""){
   // echo $_GET["fundStatusChosen"];
     
    switch ($fundStatusChosen) {
        case 'seeAll': 
         $sql_1="select * from order_fund  
          order by fundNo asc";   
            break;
        case 'seeON': 
         $sql_1="select * from order_fund 
          where fundStatus = 0
          order by fundNo asc";  
            break;
        case 'seeOFF': 
         $sql_1="select * from order_fund 
          where fundStatus = 1
          order by fundNo asc";            
            break;        
        default:
         $sql_1="select * from order_fund  
          order by fundNo asc";    
            break;
    }
 }else{
     $sql_1="select * from order_fund 
          where fundStatus = 0
          order by fundNo asc";   
 }


    //全筆數查詢
    // $sql="select * from order_fund 
    //       order by fundNo asc";          
    $order_fundAll = $pdo->query($sql_1); 

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




if($fundStatusChosen!=""){
     switch ($fundStatusChosen) {
        case 'seeAll':  
         $sql_2="select * from order_fund  
          order by fundNo asc limit $start,$PerPage";
            break;
        case 'seeON':  
         $sql_2="select * from order_fund 
          where fundStatus = 0 
          order by fundNo asc limit $start,$PerPage"; 
            break;
        case 'seeOFF':  
         $sql_2="select * from order_fund 
          where fundStatus = 1 
          order by fundNo asc limit $start,$PerPage";            
            break;        
        default: 
         $sql_2="select * from order_fund  
          order by fundNo asc limit $start,$PerPage";
            break;
    }
 }else{ 
         $sql_2="select * from order_fund 
          where fundStatus = 0 
          order by fundNo asc limit $start,$PerPage";  
 }

    //分頁筆數查詢
    // $sql =  "select * from order_fund 
    //          order by fundNo limit $start,$PerPage";
    $order_fund = $pdo->query($sql_2); 

    $fundRow = "";
   
 

} catch (PDOException $e) {
$errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
$errMsg .= "行號 : ".$e -> getLine()."<br>";
}
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
<style type="text/css">
        .content_wrap{
        border:1px solid black;
        width:500px;
        height:200px;
        overflow: scroll;
        }
        .container{ 
           width: 800px;
        }
        .seeMore { 
            width: 40px;
            height: 40px;
            background-size: cover;
            /*background-image: url(../images/StarWay_Backend/edit.png);*/
            background-image: url(../images/StarWay_Backend/seemore.png);
            background-color: transparent;
            margin-bottom: 5px;
        }
        .data_table {
            width: 95%;
        }

        .data_table td {
          padding-top: 1%;
          padding-right: 10px;
          padding-bottom: 1%;
          padding-left: 10px;
          font-size: 14px; 
        }
        .data_table th { 
            width: 40px;
        }
        .demoDescript{
            width: 300px;
        }
        .fundStatus,.fundStatus_edit{
            width:70px;
        }
        .fundStatus_edit{
            /*background-color: rgba(255, 148, 48,0.7);
            border-bottom: bottom: 6px solid rgb(249, 120, 0);
            line-height: 40px;
            width:100px;*/
        }
        .data_table img {
            width: 150px;
        }
        table th{
            word-break:break-all; 
            word-wrap:break-all;
        } 
        .edit_fundStatus div{
            line-height: 50px;
            width:100%;
        }
        .edit_fundStatus div:hover{
            line-height: 50px;
            width:100%;
        }
        




        /*.seeMore {
            position: absolute;
            left: 294px;
            width: 1321px;
            height: 100px;
            margin-top: -72px; 
            background-size: cover; 
            background-color: transparent;
        }*/

        /*tbody  :nth-of-type(even){ background: #E16F6F;}*/
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
                    <div id="topic">募資管理</div>
                </div>
                <label>
                    <input type="button" name="" class="main_edit" onclick="allEditMode()"> 
                </label>
                <div id="add">
                    <div id="addgap">
                        <form action="#">
                            <select id="fundStatus_field">
                                <option value="seeAll">全部</option>
                                <option value="seeON" selected="selected">進行中</option>
                                <option value="seeOFF">已結案</option>
                            </select><!-- 
                            <input type="text" name="data" />
                            <input type="submit" value="搜尋" /> -->
                        </form>
                    </div>
                </div> 

                <script type="text/javascript"> 
                  var fundStatusChosen = "<?php echo $fundStatusChosen ?>"; 
                  var Index;
                  switch(fundStatusChosen){
                    case "seeAll":
                      Index="0";
                    break;
                    case "seeON":
                      Index="1";                    
                    break;
                    case "seeOFF":
                      Index="2";                    
                    break;
                  }  
                 document.getElementById("fundStatus_field").selectedIndex = Index;
                </script>

                <!--新增按鈕-->
                <div id="content_table">
                    <!--表格內容-->
                    <table border="0" class="data_table">                        
                        <!-- <form action="#" method="post"> -->
                            <thead>
                                <th>功能列</th> 
                                <th>募資<br>編號</th><!-- 案件 -->
                                <th>會員<br>編號<br>(募)</th>
                                <th>案件日期</th>
                                <th>募資<br>開始日期</th>
                                <th>募資<br>期限日期</th>
                                <th>募資<br>達標金額</th>
                                <th>當前<br>累計金額</th>
                                <th>募資專輯<br>名稱</th>
                                <th>募資專輯<br>封面圖片</th>
                                <th>募資專輯<br>描述內容</th>    
                                <th>音源鏈結</th>   
                                <th>處理狀態</th><!-- 案件 -->
                            </thead>   
                            <tbody id="order_fund"> 
        <?php  
         while($fundRow = $order_fund->fetch(PDO::FETCH_ASSOC)){ 
        ?>
        <tr>
        <form class="formParent" action="orderdetail_fund.php" method="get"> 
            <td><!-- 0 -->
            <label>
                <input type="hidden" name="fundNo" value="<?php echo $fundRow['fundNo'] ?>">
                <input type="submit" name="" value="" class="seeMore" onclick="">
                <!-- alert(<?php //echo $fundRow['fundNo'] ?>) -->
            </label>
            <label> 
                <input type="hidden" name="" class="fundNo" value="<?php echo $fundRow['fundNo'] ?>">
                <input type="button" name="" class="sub_edit" onclick=" 
                // var checked=$(this).closest('.formParent').find('td.edit_fundStatus').html();
                // console.log(checked);

                editMode(this)"> 
            </label>
            </td>
            <td><!-- 1 -->
                <?php echo $fundRow['fundNo'] ?></td>
            <td><!-- 2 -->
                <?php echo $fundRow['memNo'] ?></td>
            <td><!-- 3 -->
                <?php echo $fundRow['fundDate'] ?></td>
            <td><!-- 4 -->
                <?php echo $fundRow['fundStartDate'] ?></td>
            <td><!-- 5 -->
                <?php echo $fundRow['fundEndDate'] ?></td>       
            <td><!-- 6 -->
                <?php echo number_format($fundRow['fundGoal']) ?></td>
            <td><!-- 7 -->
                <?php echo number_format($fundRow['fundTotal']) ?></td> 
            <td><!-- 10 -->
                <?php echo $fundRow['demoName'] ?></td>
            <td><img src="../images/Record/demo/<?php echo $fundRow['demoCover'] ?>"></td>
            <td class=demoDescript><!-- 11 -->
                <?php echo $fundRow['demoDescript'] ?></td>
            <td><!-- 11 -->
                <?php echo $fundRow['demoLink'] ?></td>
            <td class=fundStatus ondblclick="
               $(this).parent().find('.sub_edit').click()             // closest('td').parent().find('.edit_fundStatus').find('.caseON').is(':checked') ;

            "><!-- 8 -->
                <strong><?php
                switch ($fundRow['fundStatus']) {
                    case 0:
                        echo "進行中";
                        break;
                    case 1:
                        echo "已結案";//成功
                        break;
                    // case 2:
                    //     echo "已結案";//失敗
                    //     break;
                } 
                ?></strong>     
            </td>
            <td class=edit_fundStatus 
                ondblclick="$(this).parent().find('.sub_edit').click()"><!-- 9 -->
                <!-- 隱藏變數 -->
                <input type="hidden" class="radioValue"   value="<?php echo $fundRow['fundStatus'] ?>">
                <div>
                <input type="radio" class="caseON" name="<?php echo $fundRow['fundNo'] ?>" ng-model="fundStatus" ng-value="1"  > 進行中  
                </div>
                <div>
                <input type="radio" class="caseOFF" name="<?php echo $fundRow['fundNo'] ?>" ng-model="fundStatus" ng-value="0"  > 已結案
                </div>     
            </td>
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
        echo "<a href='?pageNo=1&fundStatusChosen=$fundStatusChosen'> <<< </a>&nbsp";
        for($i=1; $i <= $TotalPage;$i++){ 
          if($i==$pageNo)
            echo "<a href='?pageNo=$i&fundStatusChosen=$fundStatusChosen' style='color:deepPink'>",$i,"</a>&nbsp&nbsp";
          else
            echo "<a href='?pageNo=$i&fundStatusChosen=$fundStatusChosen'>",$i,"</a>&nbsp&nbsp";
        }
        echo "<a href='?pageNo=$TotalPage&fundStatusChosen=$fundStatusChosen'> >>> </a>&nbsp";

        // echo "<a href='?pageNo-=1'> <<< </a>&nbsp";
        // echo "<a href='?pageNo+=1'> >>> </a>&nbsp";
        ?>
        </div>
        <!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --> 
                           </tfoot>
                        <!-- </form> -->
                    </table>
                    <!-- 以下印頁碼區 -->
                   <!--  <table class="data_table2" id="pagecss">
                        <tr>
                            <td> <a href='#'><font color='#8f2b2b'><u>1</u></font>　</a> <a href='#'>2　</a> <a href='#'>3　</a> <a href='#'>next　</a> <a href='#'>>>　</a> </td>
                        </tr>
                    </table> -->
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




         <script type="text/javascript">
              var selectfield=document.getElementById("fundStatus_field")
              selectfield.onchange=function(){ //run some code when "onchange" event fires
              var c_option=this.options[this.selectedIndex] //this refers to "selectfield"
         
                switch (c_option.value) {            
                    case "seeAll":  
                    location.href = '?fundStatusChosen=seeAll'; 
                    break;
                    case "seeON":              
                    location.href = '?fundStatusChosen=seeON';
                    break;
                    case "seeOFF":  
                    location.href = '?fundStatusChosen=seeOFF';
                    break;
                }
            } 


            var id = document.getElementById("fundStatus_field");
            id.addEventListener('change',function(){ 
            });//单一添加下拉改变事件
            id.onmousedown = function(){//当按下鼠标按钮的时候
                this.sindex = this.selectedIndex;//把当前选中的值得索引赋给下拉选中的索引
                this.selectedIndex = -1;//把下拉选中的索引改变为-1,也就是没有!
            }
            id.onmouseout = function(){//当鼠标移开的时候
                var index = id.selectedIndex;//获取下拉选中的索引
                if(index == -1){//如果为-1,就是根本没有选
                    this.selectedIndex = this.sindex;//就把下拉选中的索引改变成之前选中的值得索引,就默认选择的是之前选中的值
                }
                
            }
        </script>




        <script type="text/javascript">
            
            // function $id(id){
            //     return document.getElementById(id);
            // } 

            function $NAME(name,no){
                return document.getElementsByName(name)[no];
            } 

            function editRow(){
                 var fundNo=$(this).parent().children('input')[0].value;

                //1
                     // console.log('獲取編號'+fundNo);
                // var fundNo=$(this).parent().children('input')[0].value;
                //      alert('獲取本頁第幾筆'+fundNo);

                //2
                // var fundStatus=
                $(this).parent().parent().parent()
                .children('td')[12].style.display='none';
                $(this).parent().parent().parent()
                .children('td')[13].style.display='';
                     // alert('SWITCH下拉選單'+fundStatus);

                //3
                alert($('.sub_edit').closest('.aa')[0].value);
            }


            //畫面初始布置
            window.onload=init;
            function init(){

                var edit_fundStatus = document.getElementsByClassName("edit_fundStatus"); 
                for (i = 0; i < edit_fundStatus.length; i++) {
                  edit_fundStatus[i].style.display = "none";
                }

                // $(this).parent().parent().parent()
                // .children('td')[13].style.display='none';
                // $NAME("fundStatus_edit",i).style.display = "none"  
            }   

            //radio按鈕初始布置
            radioValue = document.getElementsByClassName("radioValue");
            for(i=0;i<radioValue.length;i++){ 
                init=parseInt(radioValue[i].value); 
                switch (init){
                    case 0:
                        radiobtn = document.getElementsByClassName("caseON")[i];
                        radiobtn.checked="true"; 
                        break;
                    case 1:
                        radiobtn = document.getElementsByClassName("caseOFF")[i];
                        radiobtn.checked="true"; 
                        break;
                }
            } 

            

            //開啟全項目修改模式
            var EditAllFlag=0;
            function allEditMode(){

            var sub_edit = document.getElementsByClassName("sub_edit"); 
            for (i = 0; i < sub_edit.length; i++) {
              // sub_edit[i].background-image = "none";
              sub_edit[i].style.backgroundImage = "url(../images/StarWay_Backend/ok.png)";

            }

            var fundStatus = document.getElementsByClassName('fundStatus')
            var edit_fundStatus = document.getElementsByClassName('edit_fundStatus')
 
                    if(EditAllFlag==0){
                        for(i=0;i<fundStatus.length;i++){
                          fundStatus[i].style.display ="none"; 
                          edit_fundStatus[i].style.display =""; 
                          edit_fundStatus[i].style.width='100px'; 
                          edit_fundStatus[i].style.background='rgba(170, 221, 221, .8)'; 
                          edit_fundStatus[i].style.padding='0px 0px'; 
                          EditAllFlag=1
                       }
                    }
                    else{
                        for(i=0;i<fundStatus.length;i++){ 
                        fundStatus[i].style.display ="" 
                        edit_fundStatus[i].style.display ="none" 
                        EditAllFlag=0; 

                        var sub_edit = document.getElementsByClassName("sub_edit") 
                        for(i=0;i<sub_edit.length;i++)
                        sub_edit[i].click();
                        sub_edit[0].click();
                       }
                    }
            }

            //開啟特定單項目修改模式
            function editMode(context){

                // document.getElementsByClassName('sub_edit') 
                $(context).css("background-image","url(../images/StarWay_Backend/ok.png)"); 
                var fundNo=$(context).siblings('.fundNo').val();
                var checked=$(context).closest('td').parent().find('.edit_fundStatus').find('.caseON').is(':checked') ;
      
                var fundStatus =
                $(context).parent().parent().parent()
                .children('td')[12];

                var edit_fundStatus =
                $(context).parent().parent().parent()
                .children('td')[13];

                
                    if(fundStatus.style.display!='none') { 
                        fundStatus.style.display='none';
                        edit_fundStatus.style.display=''; 
                        edit_fundStatus.style.width='100px';                     
                        edit_fundStatus.style.background='rgba(170, 221, 221, .8)'; 
                        edit_fundStatus.style.padding='0px 0px'; 
                    }else{ 
                        fundStatus.style.display='';
                        edit_fundStatus.style.display='none';  
                           //儲存修改
                           saveCheck(fundNo,checked); 
                    } 
                
            }

            //儲存修改
            function saveCheck(fundNo,fundStatus_checked){ 
                // var radio_caseON = document.getElementsByClassName("caseON")
                //alert(radio_caseON.length)
                // alert(fundNo)
                // alert(fundStatus_checked)

                // for(i=0 ; i< radio_caseON.length ;i++){ 
                //     console.log(radio_caseON[i].checked)
                //     // if(radio_caseON[i].checked!=true){
                //     //     alert(55);
                //     //     // radio_caseON[i].checked == true?$status=0:$status=1;
                //     //     var status = 1;
                //     //     console.log("at rank :"+i+"found checked / status: "+status);
                //     // }
                // }
                      
                      fundStatus_checked==true ? fundStatus_checked=0 : fundStatus_checked=1;
                      // alert(fundNo)
                      // alert(fundStatus_checked)

                      var xhr = new XMLHttpRequest();
                      xhr.open("Post", "order_fund(update).php", true);
                      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                      var UPDATE_order_fund = {
                        fundNo  :fundNo,
                        fundStatus :fundStatus_checked, 
                      }
                      
                      xhr.send("UPDATE_order_fund="+ JSON.stringify(UPDATE_order_fund)); 
                        // // console.log(document.getElementById('_memName').value);
                        // console.log($id("phone").value);
                        // console.log($id("email").value);
                        console.log(JSON.stringify(UPDATE_order_fund)); 


                      xhr.onload = function(){
                        // alert(xhr.responseText);                        
                        location.reload(); 
                      }
                        
            }
            

             
                 // //處理狀態勾選判斷    
                 // var $status;
                 // radio_caseON = document.getElementsByName("caseON");
                 // radio_caseON.checked == true?$status=0:$status=1;

                 // //送出會員資料更新值 
                 // sendForm();

                 //  function sendForm(){
                 //      xhr.open("Post", "UpdateMemberInfo.php", true);
                 //      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                 //      var memberInfo = {
                 //        memAvatar  :$fileName,
                 //        memName :$id("_memName").value,
                 //        phone   :$id("phone").value,
                 //        email   :$id("email").value,
                 //        sex     :$sex,
                 //        birthDate :$id("birthDate").value
                 //      }
                      
                 //      xhr.send("memberInfo="+ JSON.stringify(memberInfo)); 
                 //        console.log(document.getElementById('_memName').value);

                 //        console.log($id("phone").value);
                 //        console.log($id("email").value);
                 //        console.log(JSON.stringify(memberInfo));

                 //        //刷新頁面->讀取新會員資料
                 //        //(若只單獨改文字資料 未上傳圖檔)
                 //        if(file==null)
                 //        location.reload()
                        
                 //    }//sendForm  






                   // if(fundStatus.style.display!='none') { 
                    //     fundStatus.style.display='none';
                    //     fundStatus_edit.style.display=''; 
                    //     fundStatus_edit.style.width='100px';                     
                    //     fundStatus_edit.style.background='rgba(170, 221, 221, .8)'; 
                    // }else{
                    //     fundStatus.style.display='';
                    //     fundStatus_edit.style.display='none'; 
                    //     saveCheck();
                    // } 

               

                // $("form.formParent").children(".td")[2].css("display", "none");
                // $("formParent").children(".fundStatus_edit").css("display", "block");


                // $("formParent").children(".fundStatus").css("display", "none");
                // $("formParent").children(".fundStatus_edit").css("display", "block");

                //  //狀態                
                // var fundStatus =
                // $("fundStatus").parent().parent().parent()
                // .children('td')[12];

                // var fundStatus_edit =
                // $("fundStatus").parent().parent().parent()
                // .children('td')[13];
 
                // for(i=0;i<fundStatus.length-1;i++){

                //     if(fundStatus.style.display!='none') { 
                //         fundStatus.style.display='none';
                //         fundStatus_edit.style.display=''; 
                //         fundStatus_edit.style.width='100px';                     
                //         fundStatus_edit.style.background='rgba(170, 221, 221, .8)'; 
                //     }else{
                //         fundStatus.style.display='';
                //         fundStatus_edit.style.display='none'; 
                //         saveCheck();
                //     } 
                // }

            








             // //性別勾選判斷    
             //         var $sex;
             //         radiobtn_m = document.getElementById("sex_m");
             //             radiobtn_m.checked == true?$sex=1:$sex=0; 
             //         //送出會員資料更新值 
             //         sendForm();
                        

             //        //-- -- -- -- -- -- -- -- -- -- -- -- 
             //        function sendForm(){
             //          //=====使用Ajax 回server端,取回登入者姓名, 放到頁面上 
             //          var xhr = new XMLHttpRequest();
             //          xhr.onload = function(){
             //            console.log(xhr.responseText);
             //          }

             //          if(file!=null)
             //          $fileName = file.name;
             //          else
             //          $fileName = null;
                    
             //          xhr.open("Post", "UpdateMemberInfo.php", true);
             //          xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
             //          var memberInfo = {
             //            memAvatar  :$fileName,
             //            memName :$id("_memName").value,
             //            phone   :$id("phone").value,
             //            email   :$id("email").value,
             //            sex     :$sex,
             //            birthDate :$id("birthDate").value
             //          }
                      
             //          xhr.send("memberInfo="+ JSON.stringify(memberInfo)); 
             //            console.log(document.getElementById('_memName').value);

             //            console.log($id("phone").value);
             //            console.log($id("email").value);
             //            console.log(JSON.stringify(memberInfo));

             //            //刷新頁面->讀取新會員資料
             //            //(若只單獨改文字資料 未上傳圖檔)
             //            if(file==null)
             //            location.reload()
                        
             //        }//sendForm  
             //        //-- -- -- -- -- -- -- -- -- -- -- -- 

           
 





            // console.log(<?php //echo $memRow["sex"];?>);



        //-- -- -- -- --    
        //@@會員性別修改
        //-- -- -- -- --    

        // $sex = '';
        // $memRow["sex"] == 1 ? $sex='男':$sex='女';
        //預設原會員性別
        // sexNum = <?php //echo $memRow["sex"];?>;
        // console.log(sexNum);
        // switch (sexNum){
        //         case 0:
        //         radiobtn = document.getElementById("sex_f");
        //         radiobtn.checked = true;
        //         console.log("sex_f: "+radiobtn.value);
        //         break;
        //     case 1:
        //         radiobtn = document.getElementById("sex_m");
        //         radiobtn.checked = true;
        //         console.log("sex_m: "+radiobtn.value);
        //         break;
        // }

            
            

        </script>
</body>

</html>




    <!-- var fundNo=$(this).parent().children('input')[0].value;
    // alert('獲取編號'+fundNo);

    //1
    // var fundNo=$(this).parent().children('input')[0].value;
    //      alert('獲取本頁第幾筆'+fundNo);

    //2
    // var fundStatus=
    $(this).parent().parent().parent()
    .children('td')[12].style.display='none';
    $(this).parent().parent().parent()
    .children('td')[13].style.display='';
         // alert('SWITCH下拉選單'+fundStatus);

    //3
    // alert($('.sub_edit').closest('.aa')[0].value); -->
