<?php
ob_start();
session_start();


$memPmsChosen = isset($_GET["memPmsChosen"])?$_GET["memPmsChosen"]:"";

try {
    require_once("../Star_Way_Database.php");  

    if($memPmsChosen!=""){
   // echo $_GET["memPmsChosen"];
     
    switch ($memPmsChosen) {
        case 'seeAll': 
         $sql_1="select * from info_member  
          order by memNo asc";   
            break;
        case 'seeON': 
         $sql_1="select * from info_member 
          where memPms = 1
          order by memNo asc";  
            break;
        case 'seeOFF': 
         $sql_1="select * from info_member 
          where memPms = 0
          order by memNo asc";            
            break;        
        default:
         $sql_1="select * from info_member  
          order by memNo asc";    
            break;
    }
 }else{
     $sql_1="select * from info_member 
          order by memNo asc";   

          // where memPms = 1
 }


    //全筆數查詢
    // $sql="select * from info_member 
    //       order by memNo DESC";          
    $info_memberAll = $pdo->query($sql_1); 

    //取得全部有幾筆
    $totalData = $info_memberAll->rowCount(); 
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



if($memPmsChosen!=""){
     switch ($memPmsChosen) {
        case 'seeAll':  
         $sql_2="select * from info_member  
          order by memNo asc limit $start,$PerPage";
            break;
        case 'seeON':  
         $sql_2="select * from info_member 
          where memPms = 1 
          order by memNo asc limit $start,$PerPage"; 
            break;
        case 'seeOFF':  
         $sql_2="select * from info_member 
          where memPms = 0 
          order by memNo asc limit $start,$PerPage";            
            break;        
        default: 
         $sql_2="select * from info_member  
          order by memNo asc limit $start,$PerPage";
            break;
    }
 }else{ 
         $sql_2="select * from info_member 
          order by memNo asc limit $start,$PerPage";

          // where memPms = 1   
 }

    //分頁筆數查詢
    // $sql =  "select * from info_member 
    //          order by memNo limit $start,$PerPage";
    $info_member = $pdo->query($sql_2); 

    $info_memberRow = ""; 



    // $sql="SELECT * FROM info_member";
    // $sql="UPDATE  info_member set memPms='0'";

    // $info_member = $pdo->query($sql);  //gearlist 是 PDOStatement物件
    // $memRow = $info_member->fetchAll(PDO::FETCH_ASSOC);
 
    // exit();
    // foreach($memRow as $data){
        /*?> 
           <!--  <tr>
                <td><?php //echo $data['memNo'] ?></td>
                <td><?php //echo $data['memName'] ?></td>
                <td><?php //echo $data['memId'] ?></td>
                <td><?php //echo $data['memPsw'] ?></td>
                <td><?php //echo $data['memAvatar'] ?></td>
                <td><?php //echo $data['sex'] ?></td>
                <td><?php //echo $data['birthDate'] ?></td>
                <td><?php //echo $data['rgsDate'] ?></td>
                <td><?php //echo $data['phone'] ?></td>
                <td><?php //echo $data['email'] ?></td>
                <td><?php //echo $data['memPms'] ?></td>
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

<!-- 開專輯 -->
<script src="js/CDwall_openCD.js"></script>

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
        width: 100px;
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
                 document.getElementsByClassName("_member")[0].id="menu_now";
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
                            <select id="memPms_field">
                                <option value="seeAll">全部</option>
                                <option value="seeON" selected="selected">正常</option>
                                <option value="seeOFF">停權</option>
                            </select>
                            <!-- <input type="text" name="data" />
                            <input type="submit" value="搜尋" /> -->
                        </form>
                    </div>
                </div>
                <script type="text/javascript"> 
                  var memPmsChosen = "<?php echo $memPmsChosen ?>"; 
                  var Index;
                  switch(memPmsChosen){
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
                 document.getElementById("memPms_field").selectedIndex = Index;
                </script>
                <!--新增按鈕-->
                <div id="content_table">
                    <!--表格內容-->
                    <table border="0" class="data_table">
                        <!-- <form action="#" method="post"> -->
                            <thead>
                                <th>功能列</th>
                                <th>會員編號</th>
                                <th>會員名稱</th>
                                <th>會員帳號</th>
                                <th>會員密碼</th>
                                <th>會員圖片</th>
                                <th>性別</th>
                                <th>出生年月日</th>
                                <th>註冊日期</th>
                                <th>電話</th>
                                <th>信箱</th>
                                <th>折價券</th>      
                                <th>會員停權</th>                  
                            </thead>
                            <tbody id="info_member">
        <?php  
         while($info_memberRow = $info_member->fetch(PDO::FETCH_ASSOC)){ 
        ?>
        <tr>
      <!--   <form class="formParent" action="info_member.php" method="get">  -->
            <td><!-- 0 -->           
            <label> 
                <input type="hidden" name="" class="memNo" value="<?php echo $info_memberRow['memNo'] ?>">
                <input type="button" name="" class="sub_edit" onclick=" 
                // var checked=$(this).closest('.formParent').find('td.edit_memPms').html();
                // console.log(checked);

                editMode(this)"> 
            </label>
            </td>
                <td><?php echo $info_memberRow['memNo'] ?></td>
                <td><?php echo $info_memberRow['memName'] ?></td>
                <td><?php echo $info_memberRow['memId'] ?></td>
                <td><?php echo $info_memberRow['memPsw'] ?></td>
                <td>
                    <img src="../images/user/memAvatar/<?php echo $info_memberRow['memAvatar'] ?>">
                </td>
                <td><?php $info_memberRow['sex']==1?($sex ='男'):($sex ='女'); echo $sex; ?></td>
                <td><?php echo $info_memberRow['birthDate'] ?></td>
                <td><?php echo $info_memberRow['rgsDate'] ?></td>
                <td><?php echo $info_memberRow['phone'] ?></td>
                <td><?php echo $info_memberRow['email'] ?></td>
                <td><?php echo $info_memberRow['couponNo'] ?></td> 
            <td class=memPms ondblclick=" $(this).parent().find('.sub_edit').click() ">
                <strong><?php
                switch ($info_memberRow['memPms']) {
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
            <td class=edit_memPms
                ondblclick="$(this).parent().find('.sub_edit').click()"><!-- 9 -->
                <!-- 隱藏變數 -->
                <input type="hidden" class="radioValue"   value="<?php echo $info_memberRow['memPms'] ?>">
                <div>
                <input type="radio" class="caseON" name="<?php echo $info_memberRow['memNo'] ?>" ng-model="memPms" ng-value="1"  > 正常  
                </div>
                <div>
                <input type="radio" class="caseOFF" name="<?php echo $info_memberRow['memNo'] ?>" ng-model="memPms" ng-value="0"  > 停權
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
        echo "<a href='?pageNo=1&memPmsChosen=$memPmsChosen'> <<< </a>&nbsp";
        for($i=1; $i <= $TotalPage;$i++){
          if($i==$pageNo)
            echo "<a href='?pageNo=$i&memPmsChosen=$memPmsChosen' style='color:deepPink'>",$i,"</a>&nbsp&nbsp";
          else
            echo "<a href='?pageNo=$i&memPmsChosen=$memPmsChosen'>",$i,"</a>&nbsp&nbsp";
        }
        echo "<a href='?pageNo=$TotalPage&memPmsChosen=$memPmsChosen'> >>> </a>&nbsp";

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
              var selectfield=document.getElementById("memPms_field")
              selectfield.onchange=function(){ //run some code when "onchange" event fires
              var c_option=this.options[this.selectedIndex] //this refers to "selectfield"
         
                switch (c_option.value) {            
                    case "seeAll":  
                    location.href = '?memPmsChosen=seeAll'; 
                    break;
                    case "seeON":              
                    location.href = '?memPmsChosen=seeON';
                    break;
                    case "seeOFF":  
                    location.href = '?memPmsChosen=seeOFF';
                    break;
                }
            } 


            var id = document.getElementById("memPms_field");
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

                var edit_memPms = document.getElementsByClassName("edit_memPms"); 
                for (i = 0; i < edit_memPms.length; i++) {
                  edit_memPms[i].style.display = "none";
                }

                // $(this).parent().parent().parent()
                // .children('td')[9].style.display='none';
                // $NAME("memPms_edit",i).style.display = "none"  
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

            var memPms = document.getElementsByClassName('memPms')
            var edit_memPms = document.getElementsByClassName('edit_memPms')
 
                    if(EditAllFlag==0){
                        for(i=0;i<memPms.length;i++){
                          memPms[i].style.display ="none"; 
                          edit_memPms[i].style.display =""; 
                          edit_memPms[i].style.width='100px'; 
                          edit_memPms[i].style.background='rgba(170, 221, 221, .8)'; 
                          edit_memPms[i].style.borderBottom='4px solid red';
                          edit_memPms[i].style.padding='0px 0px'; 
                          EditAllFlag=1
                       }
                    }
                    else{
                        for(i=0;i<memPms.length;i++){ 
                        memPms[i].style.display ="" 
                        edit_memPms[i].style.display ="none" 
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
                var memNo=$(context).siblings('.memNo').val();
                var checked=$(context).closest('td').parent().find('.edit_memPms').find('.caseON').is(':checked') ;
      
                var memPms =
                $(context).parent().parent().parent()
                .children('td')[12];

                var edit_memPms =
                $(context).parent().parent().parent()
                .children('td')[13];

                
                    if(memPms.style.display!='none') { 
                        memPms.style.display='none';
                        edit_memPms.style.display=''; 
                        edit_memPms.style.width='100px';                     
                        edit_memPms.style.background='rgba(170, 221, 221, .8)'; 
                        edit_memPms.style.borderBottom='4px solid red';
                        edit_memPms.style.padding='0px 0px'; 
                    }else{ 
                        memPms.style.display='';
                        edit_memPms.style.display='none';  
                           //儲存修改
                           saveCheck(memNo,checked); 
                    } 
                
            }

            //儲存修改
            function saveCheck(memNo,memPms_checked){ 
                // var radio_caseON = document.getElementsByClassName("caseON")
                //alert(radio_caseON.length)
                // alert(memNo)
                // alert(memPms_checked)

                // for(i=0 ; i< radio_caseON.length ;i++){ 
                //     console.log(radio_caseON[i].checked)
                //     // if(radio_caseON[i].checked!=true){
                //     //     alert(55);
                //     //     // radio_caseON[i].checked == true?$status=0:$status=1;
                //     //     var status = 1;
                //     //     console.log("at rank :"+i+"found checked / status: "+status);
                //     // }
                // }
                      
                      memPms_checked==true ? memPms_checked=1 : memPms_checked=0;
                      // alert(memNo)
                      // alert(memPms_checked)

                      var xhr = new XMLHttpRequest();
                      xhr.open("Post", "info_member(update).php", true);
                      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                      var UPDATE_info_member = {
                        memNo  :memNo,
                        memPms :memPms_checked, 
                      }
                      
                      xhr.send("UPDATE_info_member="+ JSON.stringify(UPDATE_info_member)); 
                        // // console.log(document.getElementById('_memName').value);
                        // console.log($id("phone").value);
                        // console.log($id("email").value);
                        console.log(JSON.stringify(UPDATE_info_member)); 


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






                   // if(memPms.style.display!='none') { 
                    //     memPms.style.display='none';
                    //     memPms_edit.style.display=''; 
                    //     memPms_edit.style.width='100px';                     
                    //     memPms_edit.style.background='rgba(170, 221, 221, .8)'; 
                    //     memPms_edit.style.borderBottom='4px solid red';
                    // }else{
                    //     memPms.style.display='';
                    //     memPms_edit.style.display='none'; 
                    //     saveCheck();
                    // } 

               

                // $("form.formParent").children(".td")[2].css("display", "none");
                // $("formParent").children(".memPms_edit").css("display", "block");


                // $("formParent").children(".memPms").css("display", "none");
                // $("formParent").children(".memPms_edit").css("display", "block");

                //  //狀態                
                // var memPms =
                // $("memPms").parent().parent().parent()
                // .children('td')[8];

                // var memPms_edit =
                // $("memPms").parent().parent().parent()
                // .children('td')[9];
 
                // for(i=0;i<memPms.length-1;i++){

                //     if(memPms.style.display!='none') { 
                //         memPms.style.display='none';
                //         memPms_edit.style.display=''; 
                //         memPms_edit.style.width='100px';                     
                //         memPms_edit.style.background='rgba(170, 221, 221, .8)'; 
                //         memPms_edit.style.borderBottom='4px solid red';
                //     }else{
                //         memPms.style.display='';
                //         memPms_edit.style.display='none'; 
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