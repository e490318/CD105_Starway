<?php
ob_start();
session_start();


$adminPmsChosen = isset($_GET["adminPmsChosen"])?$_GET["adminPmsChosen"]:"";

try {
    require_once("../Star_Way_Database.php");  

    if($adminPmsChosen!=""){
   // echo $_GET["adminPmsChosen"];
     
    switch ($adminPmsChosen) {
        case 'seeAll': 
         $sql_1="select * from info_server  
          order by adminNo asc";   
            break;
        case 'seeON': 
         $sql_1="select * from info_server 
          where adminPms = 1
          order by adminNo asc";  
            break;
        case 'seeOFF': 
         $sql_1="select * from info_server 
          where adminPms = 0
          order by adminNo asc";            
            break;        
        default:
         $sql_1="select * from info_server  
          order by adminNo asc";    
            break;
    }
 }else{
     $sql_1="select * from info_server 
          where adminPms
          order by adminNo asc";   
 }


    //全筆數查詢
    // $sql="select * from info_server 
    //       order by adminNo DESC";          
    $info_serverAll = $pdo->query($sql_1); 

    //取得全部有幾筆
    $totalData = $info_serverAll->rowCount(); 
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



if($adminPmsChosen!=""){
     switch ($adminPmsChosen) {
        case 'seeAll':  
         $sql_2="select * from info_server  
          order by adminNo asc limit $start,$PerPage";
            break;
        case 'seeON':  
         $sql_2="select * from info_server 
          where adminPms = 1 
          order by adminNo asc limit $start,$PerPage"; 
            break;
        case 'seeOFF':  
         $sql_2="select * from info_server 
          where adminPms = 0 
          order by adminNo asc limit $start,$PerPage";            
            break;        
        default: 
         $sql_2="select * from info_server  
          order by adminNo asc limit $start,$PerPage";
            break;
    }
 }else{ 
         $sql_2="select * from info_server 
          where adminPms 
          order by adminNo asc limit $start,$PerPage";  
 }

    //分頁筆數查詢
    // $sql =  "select * from info_server 
    //          order by adminNo limit $start,$PerPage";
    $info_server = $pdo->query($sql_2); 

    $info_serverRow = ""; 



    // $sql="SELECT * FROM info_server";
    // $sql="UPDATE  info_server set adminPms='0'";

    // $info_server = $pdo->query($sql);  //gearlist 是 PDOStatement物件
    // $adminRow = $info_server->fetchAll(PDO::FETCH_ASSOC);
 
    // exit();
    // foreach($adminRow as $data){
        /*?> 
           <!--  <tr>
                <td><?php //echo $data['adminNo'] ?></td>
                <td><?php //echo $data['adminName'] ?></td>
                <td><?php //echo $data['adminId'] ?></td>
                <td><?php //echo $data['adminPsw'] ?></td>
                <td><?php //echo $data['adminAvatar'] ?></td>
                <td><?php //echo $data['sex'] ?></td>
                <td><?php //echo $data['birthDate'] ?></td>
                <td><?php //echo $data['rgsDate'] ?></td>
                <td><?php //echo $data['phone'] ?></td>
                <td><?php //echo $data['email'] ?></td>
                <td><?php //echo $data['adminPms'] ?></td>
                <td><?php //echo $data['couponNo'] ?></td>
                <td>
                        <a href='#'><img src="../images/StarWay_Backend/edit.png" alt=""></a>
                        <input class="L_CDWallSell_back_input" type="submit" value="放入購物車" style='background-color: transparent;'>
                </td>
            </tr> -->

        
        <?php*/
    // }





}catch (PDOException $e) {
    echo "錯誤原因 : " , $e->getMessage(), "<br>";
    echo "錯誤行號 : " , $e->getLine(), "<br>"; 
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
    .data_table img {
        width: 150px;
    }
    .data_table td {
      padding-top: 1%;
      padding-bottom: 1%;
      /* padding-right: 15px;
      padding-left: 15px; */
      font-size: 14px;  
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
                 document.getElementsByClassName("_server")[0].id="menu_now";
                });
            </script> 
        </div>
        <!--menu-->
        <div id="content_wrap">
            <div id="container">
                <div id="content_topic">
                    <!--標題-->
                    <div id="topic">會員管理</div>
                </div> 
                 <label>
                    <input type="button" name="" class="main_edit" onclick="allEditMode()"> 
                </label>
                <div id="add">
                    <div id="addgap">
                        <form action="#">
                            <select id="adminPms_field">
                                <option value="seeAll">全部</option>
                                <option value="seeON" selected="selected">正常</option>
                                <option value="seeOFF">停權</option>
                            </select>
                            <!-- <input type="text" name="data" />
                            <input type="submit" value="搜尋" /> -->
                        </form>
                    </div>
                </div>
                <!--新增按鈕-->
                <div id="content_table">
                    <!--表格內容-->
                    <table border="0" class="data_table">
                        <!-- <form action="#" method="post"> -->
                            <thead>
                                <th>功能列</th>
                                <th>管理員編號</th>
                                <th>管理員姓名</th>
                                <th>管理員帳號</th>
                                <th>管理員密碼</th>
                                <th>管理員權限</th>           
                            </thead>
                            <tbody id="info_server">
        <?php  
         while($info_serverRow = $info_server->fetch(PDO::FETCH_ASSOC)){ 
        ?>
        <tr>
      <!--   <form class="formParent" action="info_server.php" method="get">  -->
            <td><!-- 0 -->           
            <label> 
                <input type="hidden" name="" class="adminNo" value="<?php echo $info_serverRow['adminNo'] ?>">
                <input type="button" name="" class="sub_edit" onclick=" 
                // var checked=$(this).closest('.formParent').find('td.edit_adminPms').html();
                // console.log(checked);

                editMode(this)"> 
            </label>
            </td>
                <td><?php echo $info_serverRow['adminNo'] ?></td>   
                <td><?php echo $info_serverRow['adminName'] ?></td>  
                <td><?php echo $info_serverRow['adminId'] ?></td>
                <td><?php echo $info_serverRow['adminPsw'] ?></td> 
            <td class=adminPms ondblclick="
               $(this).parent().find('.sub_edit').click()             // closest('td').parent().find('.edit_adminPms').find('.caseON').is(':checked') ;

            "><!-- 8 -->
                <strong><?php
                switch ($info_serverRow['adminPms']) {
                    case 0:
                        echo "停權";
                        break;
                    case 1:
                        echo "正常";//成功
                        break;
                    // case 2:
                    //     echo "已結案";//失敗
                    //     break;
                } 
                ?></strong>     
            </td>
            <td class=edit_adminPms
                ondblclick="$(this).parent().find('.sub_edit').click()"><!-- 9 -->
                <!-- 隱藏變數 -->
                <input type="hidden" class="radioValue"   value="<?php echo $info_serverRow['adminPms'] ?>">
                <div>
                <input type="radio" class="caseON" name="<?php echo $info_serverRow['adminNo'] ?>" ng-model="adminPms" ng-value="1"  > 正常  
                </div>
                <div>
                <input type="radio" class="caseOFF" name="<?php echo $info_serverRow['adminNo'] ?>" ng-model="adminPms" ng-value="0"  > 停權
                </div>     
            </td>   

        <!-- </form> -->
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
        echo "<a href='?pageNo=1&adminPmsChosen=$adminPmsChosen'> <<< </a>&nbsp";
        for($i=1; $i <= $TotalPage;$i++){
          if($i==$pageNo)
            echo "<a href='?pageNo=$i&adminPmsChosen=$adminPmsChosen' style='color:deepPink'>",$i,"</a>&nbsp&nbsp";
          else
            echo "<a href='?pageNo=$i&adminPmsChosen=$adminPmsChosen'>",$i,"</a>&nbsp&nbsp";
        }
        echo "<a href='?pageNo=$TotalPage&adminPmsChosen=$adminPmsChosen'> >>> </a>&nbsp";

        // echo "<a href='?pageNo-=1'> <<< </a>&nbsp";
        // echo "<a href='?pageNo+=1'> >>> </a>&nbsp";
        ?>
        </div>
        <!-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --> 
                           </tfoot>
                      <!-- </form> -->
                    </table>
                    <!-- 以下印頁碼區 -->
                    <!-- <table class="data_table2" id="pagecss">
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
              var selectfield=document.getElementById("adminPms_field")
              selectfield.onchange=function(){ //run some code when "onchange" event fires
              var c_option=this.options[this.selectedIndex] //this refers to "selectfield"
         
                switch (c_option.value) {            
                    case "seeAll":  
                    location.href = '?adminPmsChosen=seeAll'; 
                    break;
                    case "seeON":              
                    location.href = '?adminPmsChosen=seeON';
                    break;
                    case "seeOFF":  
                    location.href = '?adminPmsChosen=seeOFF';
                    break;
                }
            } 


            var id = document.getElementById("adminPms_field");
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
   
            //畫面初始布置
            window.onload=init;
            function init(){

                var edit_adminPms = document.getElementsByClassName("edit_adminPms"); 
                for (i = 0; i < edit_adminPms.length; i++) {
                  edit_adminPms[i].style.display = "none";
                }

                // $(this).parent().parent().parent()
                // .children('td')[9].style.display='none';
                // $NAME("adminPms_edit",i).style.display = "none"  
            }   

            //radio按鈕初始布置
            radioValue = document.getElementsByClassName("radioValue");
            for(i=0;i<radioValue.length;i++){ 
                init=parseInt(radioValue[i].value); 
                switch (init){
                    case 0:
                        radiobtn = document.getElementsByClassName("caseOFF")[i];
                        radiobtn.checked="true"; 
                        break;
                       
                    case 1:                        
                        radiobtn = document.getElementsByClassName("caseON")[i];
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

            var adminPms = document.getElementsByClassName('adminPms')
            var edit_adminPms = document.getElementsByClassName('edit_adminPms')
 
                    if(EditAllFlag==0){
                        for(i=0;i<adminPms.length;i++){
                          adminPms[i].style.display ="none"; 
                          edit_adminPms[i].style.display =""; 
                          // edit_adminPms[i].style.width='100px'; 
                          edit_adminPms[i].style.background='rgba(170, 221, 221, .8)'; 
                          // edit_adminPms[i].style.padding='0px 0px'; 
                          // edit_adminPms[i].style.marginRight="1000px"
                          EditAllFlag=1
                       }
                    }
                    else{
                        for(i=0;i<adminPms.length;i++){ 
                        adminPms[i].style.display ="" 
                        edit_adminPms[i].style.display ="none" 
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
                var adminNo=$(context).siblings('.adminNo').val();
                var checked=$(context).closest('td').parent().find('.edit_adminPms').find('.caseON').is(':checked') ;
      
                var adminPms =
                $(context).parent().parent().parent()
                .children('td')[5];

                var edit_adminPms =
                $(context).parent().parent().parent()
                .children('td')[6];

                
                    if(adminPms.style.display!='none') { 
                        adminPms.style.display='none';
                        edit_adminPms.style.display=''; 
                        edit_adminPms.style.width='100px';                     
                        edit_adminPms.style.background='rgba(170, 221, 221, .8)'; 
                        edit_adminPms.style.padding='0px 0px'; 
                    }else{ 
                        adminPms.style.display='';
                        edit_adminPms.style.display='none';  
                           //儲存修改
                           saveCheck(adminNo,checked); 
                    } 
                
            }

            //儲存修改
            function saveCheck(adminNo,adminPms_checked){ 
                // var radio_caseON = document.getElementsByClassName("caseON")
                //alert(radio_caseON.length)
                // alert(adminNo)
                // alert(adminPms_checked)

                // for(i=0 ; i< radio_caseON.length ;i++){ 
                //     console.log(radio_caseON[i].checked)
                //     // if(radio_caseON[i].checked!=true){
                //     //     alert(55);
                //     //     // radio_caseON[i].checked == true?$status=0:$status=1;
                //     //     var status = 1;
                //     //     console.log("at rank :"+i+"found checked / status: "+status);
                //     // }
                // }
                      
                      adminPms_checked==true ? adminPms_checked=1 : adminPms_checked=0;
                      // alert(adminNo)
                      // alert(adminPms_checked)

                      var xhr = new XMLHttpRequest();
                      xhr.open("Post", "info_server(update).php", true);
                      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                      var UPDATE_info_server = {
                        adminNo  :adminNo,
                        adminPms :adminPms_checked, 
                      }
                      
                      xhr.send("UPDATE_info_server="+ JSON.stringify(UPDATE_info_server)); 
                        // // console.log(document.getElementById('_adminName').value);
                        // console.log($id("phone").value);
                        // console.log($id("email").value);
                        console.log(JSON.stringify(UPDATE_info_server)); 


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
                 //      xhr.open("Post", "UpdateadminInfo.php", true);
                 //      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                 //      var adminInfo = {
                 //        adminAvatar  :$fileName,
                 //        adminName :$id("_adminName").value,
                 //        phone   :$id("phone").value,
                 //        email   :$id("email").value,
                 //        sex     :$sex,
                 //        birthDate :$id("birthDate").value
                 //      }
                      
                 //      xhr.send("adminInfo="+ JSON.stringify(adminInfo)); 
                 //        console.log(document.getElementById('_adminName').value);

                 //        console.log($id("phone").value);
                 //        console.log($id("email").value);
                 //        console.log(JSON.stringify(adminInfo));

                 //        //刷新頁面->讀取新會員資料
                 //        //(若只單獨改文字資料 未上傳圖檔)
                 //        if(file==null)
                 //        location.reload()
                        
                 //    }//sendForm  






                   // if(adminPms.style.display!='none') { 
                    //     adminPms.style.display='none';
                    //     adminPms_edit.style.display=''; 
                    //     adminPms_edit.style.width='100px';                     
                    //     adminPms_edit.style.background='rgba(170, 221, 221, .8)'; 
                    // }else{
                    //     adminPms.style.display='';
                    //     adminPms_edit.style.display='none'; 
                    //     saveCheck();
                    // } 

               

                // $("form.formParent").children(".td")[2].css("display", "none");
                // $("formParent").children(".adminPms_edit").css("display", "block");


                // $("formParent").children(".adminPms").css("display", "none");
                // $("formParent").children(".adminPms_edit").css("display", "block");

                //  //狀態                
                // var adminPms =
                // $("adminPms").parent().parent().parent()
                // .children('td')[8];

                // var adminPms_edit =
                // $("adminPms").parent().parent().parent()
                // .children('td')[9];
 
                // for(i=0;i<adminPms.length-1;i++){

                //     if(adminPms.style.display!='none') { 
                //         adminPms.style.display='none';
                //         adminPms_edit.style.display=''; 
                //         adminPms_edit.style.width='100px';                     
                //         adminPms_edit.style.background='rgba(170, 221, 221, .8)'; 
                //     }else{
                //         adminPms.style.display='';
                //         adminPms_edit.style.display='none'; 
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
                    
             //          xhr.open("Post", "UpdateadminInfo.php", true);
             //          xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
             //          var adminInfo = {
             //            adminAvatar  :$fileName,
             //            adminName :$id("_adminName").value,
             //            phone   :$id("phone").value,
             //            email   :$id("email").value,
             //            sex     :$sex,
             //            birthDate :$id("birthDate").value
             //          }
                      
             //          xhr.send("adminInfo="+ JSON.stringify(adminInfo)); 
             //            console.log(document.getElementById('_adminName').value);

             //            console.log($id("phone").value);
             //            console.log($id("email").value);
             //            console.log(JSON.stringify(adminInfo));

             //            //刷新頁面->讀取新會員資料
             //            //(若只單獨改文字資料 未上傳圖檔)
             //            if(file==null)
             //            location.reload()
                        
             //        }//sendForm  
             //        //-- -- -- -- -- -- -- -- -- -- -- -- 

           
 





            // console.log(<?php //echo $adminRow["sex"];?>);



        //-- -- -- -- --    
        //@@會員性別修改
        //-- -- -- -- --    

        // $sex = '';
        // $adminRow["sex"] == 1 ? $sex='男':$sex='女';
        //預設原會員性別
        // sexNum = <?php //echo $adminRow["sex"];?>;
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