<?php
ob_start();
session_start(); 

$shelfchosen = isset($_GET["shelfchosen"])?$_GET["shelfchosen"]:"";
 

// $errMsg = ""; 
try {
    require_once("../Star_Way_Database.php");


    if($shelfchosen!=""){
   // echo $_GET["shelfchosen"];
     
    switch ($shelfchosen) {
        case 'seeAll': 
         $sql_1="select * from info_album  
          order by albumNo asc";   
            break;
        case 'seeON': 
         $sql_1="select * from info_album 
          where shelfStatus = 1
          order by albumNo asc";  
            break;
        case 'seeOFF': 
         $sql_1="select * from info_album 
          where shelfStatus = 0
          order by albumNo asc";            
            break;        
        default:
         $sql_1="select * from info_album  
          order by albumNo asc";    
            break;
    }
 }else{
     $sql_1="select * from info_album 
          where shelfStatus = 1
          order by albumNo asc";   
 }

    //全筆數查詢 
    $order_albumAll = $pdo->query($sql_1); 

    //取得全部有幾筆
    $totalData = $order_albumAll->rowCount(); 
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

if($shelfchosen!=""){
     switch ($shelfchosen) {
        case 'seeAll':  
         $sql_2="select * from info_album  
          order by albumNo asc limit $start,$PerPage";
            break;
        case 'seeON':  
         $sql_2="select * from info_album 
          where shelfStatus = 1 
          order by albumNo asc limit $start,$PerPage"; 
            break;
        case 'seeOFF':  
         $sql_2="select * from info_album 
          where shelfStatus = 0 
          order by albumNo asc limit $start,$PerPage";            
            break;        
        default: 
         $sql_2="select * from info_album  
          order by albumNo asc limit $start,$PerPage";
            break;
    }
 }else{ 
         $sql_2="select * from info_album 
          where shelfStatus = 1 
          order by albumNo asc limit $start,$PerPage";  
 }

    //分頁筆數查詢 
    $info_album = $pdo->query($sql_2); 

    $albumRow = "";
   
 

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
.data_table td {
    text-align: center;
    padding-top: 1%;
    padding-bottom: 1%;
    padding-right: 10px;
    padding-left: 10px;
    width: 50px;
    font-size: 14px;
}

td.albumDescript{
    width: 20vh;
    padding-right: 5%;
    padding-left: 5%;
}

 
.edit_albumDescript textarea{
    width: 300px;
    height: 150px;
}

.edit_diskPrice input,.edit_albumName input {
    width: 50px; 
}

.data_table img {
    width: 150px;
    padding-bottom: 10px;
}

.playButton{ 
    text-decoration: none;
    display: inline-block;
    padding: 8px 40px; 
    margin-top: 20px; 
    background-color: rgba(245, 1, 62, 0.3);
    border: 1px solid rgba(2245, 1, 62, 0.3);
    border-radius: 28px;
    color: rgba(255, 255, 255, 0.9);
    text-align: center;
    transition: 0.3s;
}

.playButton:hover{
      background-color: rgba(245, 1, 62, 0.6);
      border: 1px solid rgba(245, 1, 62, 0.6);
      cursor: pointer;
      color: rgba(255, 255, 255, 1);
}

img.skin_upFileLink{
    padding-top: 20px;
    margin-left: 10px;
    width:50px;
}
.data_table .edit_albumLink{
    padding: 0px 10px;
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
                 document.getElementsByClassName("_albumsell")[0].id="menu_now";
                });
            </script> 
        </div>
        <!--menu-->
        <div id="content_wrap">
            <div id="container">
                <div id="content_topic">
                    <!--標題-->
                    <div id="topic">專輯資訊</div>
                </div>
                <label>
                    <input type="button" name="" class="main_edit" onclick="allEditMode()"> 
                </label>
                <div id="add">
                    <div id="addgap">
                        <form action="#"> 
                            <select id="shelfStatus_field">
                                <option  value="seeAll">全部</option>
                                <option  value="seeON" >上架</option><!-- selected="selected" -->
                                <option  value="seeOFF">下架</option>
                            </select> 
                        </form> 
                    </div>
                </div>

                 <script type="text/javascript"> 
                  let shelfchosen = "<?php echo $shelfchosen ?>"; 
                  let Index;
                  switch(shelfchosen){
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
                 document.getElementById("shelfStatus_field").selectedIndex = Index;
                </script>

                <!--新增按鈕-->
                <div id="content_table">
                    <!--表格內容-->
                    <table border="0" class="data_table">
                        <form action="#" method="post">
                            <thead>                                 
                                <th>功能列</th>        
                                <th>專輯<br>編號</th>
                                <th>專輯<br>名稱</th>
                                <th>專輯<br>封面圖片</th>
                                <th>專輯<br>歌手</th>
                                <th>專輯<br>描述內容</th>
                                <th>音源<br>連結</th>
                                <th>黑膠<br>唱片單價</th>
                                <th>購買<br>次數</th>
                                <th>上下架<br>狀態</th>                   
                            </thead>

                            <!-- php開始 -->
                            <tbody id="L_CDWallSell_back">
                                <input type="hidden" value="" id="checkItem">
 
        <?php 
        while($albumRow = $info_album->fetch(PDO::FETCH_ASSOC)){  
        ?>     
            <tr> 
                <td>
                <label> 
                    <input type="hidden" name="" class="albumNo" value="<?php echo $albumRow['albumNo'] ?>">
                    <input type="button" name="" class="sub_edit_allEdit" style="display: none"
                    onclick="
                    document.getElementById('checkItem').value='allEditMode';
                    editRowMode(this);">
                    <input type="button" name="" class="sub_edit" 

                    onmousedown="
                    document.getElementById('checkItem').value='rowEditMode';
                    editRowMode(this);
                    "

                    onclick=" 
                    editMode(this); 
                    " 
                    > 
                </label>
                </td>

                
                <td><?php echo $albumRow['albumNo'] ?></td>

                
                <td class="albumName" ondblclick="
                    document.getElementById('checkItem').value='albumName';
                    $(this).parent().find('.sub_edit').click();">
                    <?php echo $albumRow['albumName'] ?>
                </td>
                <td class="edit_albumName" ondblclick="
                    document.getElementById('checkItem').value='albumName';
                    $(this).parent().find('.sub_edit').click();">
                    <input type="text" name="" value="<?php echo $albumRow['albumName'] ?>"> 
                </td>
                


                

                 
                 <td  class="albumCover" ondblclick="
                      document.getElementById('checkItem').value='albumCover';
                      $(this).parent().find('.sub_edit').click();">
                    <img class="albumCoverImg" 
                    src="../images/CDWall/records/<?php echo $albumRow['albumCover'] ?>">
                 </td>
                 <td class="edit_albumCover"  
                     ondblclick="
                     if($(this).find('.newCoverName').val()!='<?php echo $albumRow['albumCover'] ?>'){ 
                        // alert($(this).find('.newCoverName').val());
                         document.getElementById('checkItem').value='albumCover';
                         $(this).parent().find('.sub_edit').click(); 
                     }
                     ">
                    <div class="showCoverName"><?php echo $albumRow['albumCover'] ?></div>    
                    <br> 
                    <input type="hidden" class="prevCoverName" name="" 
                    value="<?php echo $albumRow['albumCover'] ?>">
                    <input type="hidden" class="newCoverName" name="" 
                    value="<?php echo $albumRow['albumCover'] ?>">
                    <form class="formAlbumName"> 
                        <!-- <?php //echo $albumRow['albumCover'] ?> -->
                        <!-- / 不明原因 前面要先放一個form才能動-->
                    </form> 
               
                    <!-- ajax 上傳 -->
                    <input  type="file" style="display: none"   class="upFile"  onclick="initCover(this)" >
                    <img class="albumCoverPre" src="../images/CDWall/records/<?php echo $albumRow['albumCover'] ?>" onclick="$(this).siblings('input').trigger('click');" style="cursor: pointer;"> 
                    <button  class="submitPic" style="display: none" onclick="

                    let file_data = $(this).siblings('.upFile').prop('files')[0];   //取得上傳檔案屬性
                    let form_data = new FormData();  //建構new FormData()
                    form_data.append('upFile', file_data);  //吧物件加到file後面
                                                  
                        $.ajax({
                                    url: 'CDwall_sell_back(coverUploadAjax).php',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,     //data只能指定單一物件                 
                                    type: 'post',
                                   success: function(data){ 
                                    }
                         });

                    ">Upload</button>   

                      
                </td> 

                <td>
                    <?php echo $albumRow['albumSinger'] ?>
                </td>

                
                <td class="albumDescript" ondblclick="
                    document.getElementById('checkItem').value='albumDescript';
                    $(this).parent().find('.sub_edit').click(); ">
                    <?php echo $albumRow['albumDescript'] ?>                    
                </td> 
                <td class="edit_albumDescript" ondblclick=" 
                    document.getElementById('checkItem').value='albumDescript';
                    $(this).parent().find('.sub_edit').click(); ">
                    <textarea value="<?php echo $albumRow['albumDescript'] ?>"><?php echo $albumRow['albumDescript'] ?></textarea>         
                </td>
                
 

                
                 <td  class="albumLink" ondblclick="
                      document.getElementById('checkItem').value='albumLink';
                      $(this).parent().find('.sub_edit').click();">
                    <!-- <img class="albumCoverImg" 
                    src="../images/CDWall/records/<?php //echo $albumRow['albumCover'] ?>"> -->
                    <!-- <?php //echo $albumRow['albumLink'] ?> -->
                     <!-- 音源檔名 -->
                    <div class="showLinkName"><?php echo $albumRow['albumLink'] ?></div>
                    <!-- 播放按鈕 --> 
                    <audio class="linkAudioNormal"  
                           src="../images/CDWall/records/<?php echo $albumRow['albumLink'] ?>"
                           style="display: none" 
                           width="80"
                           onplay="pauseAllNormal('<?php echo $albumRow['albumLink']?>')"
                           ><?php echo $albumRow['albumLink'] ?></audio><button class="playButton" onclick="playOrPause(this)">Play</button>
                 </td>
                 <td class="edit_albumLink"  
                     ondblclick="
                     // alert($(this).find('.newLinkName').val()); 
                     // alert('<?php //echo $albumRow['albumLink'] ?>');
                     if($(this).find('.newLinkName').val()!='<?php echo $albumRow['albumLink'] ?>'){ 
                        alert($(this).find('.newLinkName').val());
                         document.getElementById('checkItem').value='albumLink';
                         $(this).parent().find('.sub_edit').click(); 
                     }
                     ">

                    <!-- 音源檔名 -->
                    <div class="showLinkName"><?php echo $albumRow['albumLink'] ?></div>
                    <!-- 播放按鈕 --> 
                    <audio class="linkAudioEdit"  
                           src="../images/CDWall/records/<?php echo $albumRow['albumLink'] ?>" style="display: none" 
                           width="80" 
                           onplay="pauseAllEdit('<?php echo $albumRow['albumLink'] ?>')"
                           ><?php echo $albumRow['albumLink'] ?></audio><button class="playButton" onclick="playOrPause(this)">Play</button>
                    <br> 
                    <input type="hidden" class="prevLinkName" name="" 
                    value="<?php echo $albumRow['albumLink'] ?>">
                    <input type="hidden" class="newLinkName" name="" 
                    value="<?php echo $albumRow['albumLink'] ?>"> 
                    <!-- ajax 上傳 -->
                    <img class="skin_upFileLink" src="../images/StarWay_Backend/musicFile.png"   onclick="$(this).siblings('.upFileLink').trigger('click');">
                    <input  type="file"  style="display: none"  class="upFileLink"  onclick="initLink(this)" >
              <!--       <img class="albumLinkPre" src="../images/CDWall/records/<?php //echo $albumRow['albumLink'] ?>" onclick="$(this).siblings('input').trigger('click');" style="cursor: pointer;">  -->
                    <button  class="submitLink" style="display: none" onclick="

                    let file_data = $(this).siblings('.upFileLink').prop('files')[0];   //取得上傳檔案屬性
                    let form_data = new FormData();  //建構new FormData()
                    form_data.append('upFileLink', file_data);  //吧物件加到file後面
                                                  
                        $.ajax({
                                    url: 'CDwall_sell_back(linkUploadAjax).php',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: form_data,     //data只能指定單一物件                 
                                    type: 'post',
                                   success: function(data){
                                        // $('#ajsxboxdhow').html(data);
                                        // alert('HELLO');
                                    }
                         });

                    ">Upload</button>    
                </td>


                <script type="text/javascript">
                   

                    function playOrPause(context){

                      let linkAudio = $(context).parent().find('audio')[0];
                      let playButton = $(context)[0]; 
 
                        if(!linkAudio.paused && !linkAudio.ended){  //影片正在跑的時候, 按按鈕會暫停 
                            linkAudio.currentTime = 0 
                            linkAudio.pause();
                            playButton.innerText = 'PLAY';  
 

                        }else{
                            linkAudio.play();
                            playButton.innerText = 'STOP' 
                        }
                    } 

                    //-- -- -- -- --    
                    //@@音樂專輯播放-停下其他 
                    //-- -- -- -- --    

                    let audios_normal = document.getElementsByClassName("linkAudioNormal");
                    function pauseAllNormal(innerHTML) {  
                         let self = innerHTML;
                        [].forEach.call(audios_normal, function (i) {
                             // 将audios中其他的audio全部暂停
                            if(i.innerHTML == self ){
                                i.play();   
                                i.nextSibling.innerText = 'STOP'; 
                            }else{
                                i.pause(); 
                                 i.nextSibling.innerText = 'PLAY'; 

                            }
                        })
                    } 

                    
                    let audios_edit = document.getElementsByClassName("linkAudioEdit");
                    function pauseAllEdit(innerHTML) {  
                         let self = innerHTML;
                        [].forEach.call(audios_edit, function (i) {
                             // 将audios中其他的audio全部暂停
                            if(i.innerHTML == self ){
                                i.play();   
                                i.nextSibling.innerText = 'STOP'; 
                            }else{
                                i.pause(); 
                                 i.nextSibling.innerText = 'PLAY'; 

                            }
                        })
                    }  

                </script> 

                
                <td  class="diskPrice" ondblclick="
                    document.getElementById('checkItem').value='diskPrice';
                    $(this).parent().find('.sub_edit').click();">
                    <?php echo $albumRow['diskPrice'] ?>                        
                </td>       
                <td class="edit_diskPrice" ondblclick=" 
                    document.getElementById('checkItem').value='diskPrice';
                    $(this).parent().find('.sub_edit').click();">
                    <input type="text" name="" value="<?php echo $albumRow['diskPrice'] ?>">
                    <!-- <?php //echo $albumRow['diskPrice'] ?>                         -->
                </td>
                

                <td><?php echo $albumRow['saleCount'] ?></td> 

                <!-- <td><?php //echo $albumRow['shelfStatus'] ?></td> -->
                <td class="shelfStatus"
                ondblclick="
                document.getElementById('checkItem').value='shelfStatus';
                $(this).parent().find('.sub_edit').click();  "><!-- 8 -->
                    <strong><?php
                    switch ($albumRow['shelfStatus']) {
                        case 0:
                            echo "下架";
                            break;
                        case 1:
                            echo "上架";//成功
                            break;
                    } 
                    ?></strong>                
                </td>
                <td class="edit_shelfStatus"
                    ondblclick="
                    document.getElementById('checkItem').value='shelfStatus';
                    $(this).parent().find('.sub_edit').click();  "> 
                    <input type="hidden" class="radioValue"   value="<?php echo $albumRow['shelfStatus'] ?>">
                    <div >
                    <input type="radio" class="caseON" name="<?php echo $albumRow['albumNo'] ?>" ng-model= "shelfStatus" ng-value="1"> 上架 
                    </div>
                    <div>
                    <input type="radio" class="caseOFF" name="<?php echo $albumRow['albumNo'] ?>" ng-model= "shelfStatus" ng-value="0" > 下架
                    </div>  
                </td>   
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
        echo "<a href='?pageNo=1&shelfchosen=$shelfchosen'> <<< </a>&nbsp";
        for($i=1; $i <= $TotalPage;$i++){
          if($i==$pageNo)
            echo "<a href='?pageNo=$i&shelfchosen=$shelfchosen' style='color:deepPink'>",$i,"</a>&nbsp&nbsp";
          else
            echo "<a href='?pageNo=$i&shelfchosen=$shelfchosen'>",$i,"</a>&nbsp&nbsp";
        }
        echo "<a href='?pageNo=$TotalPage&shelfchosen=$shelfchosen'> >>> </a>&nbsp";

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


        <form action="CDwall_sell_back.php" style="display: none">
            <input type="hidden" name="psn" id="seeWhat" value=""> 
        <tr>
            <td><?php echo $prodRow["psn"];?></td> 
            <td><input type="submit" value="放入購物車" id=""></td>
        </tr>
        </form>

   

</body>

</html>


<script type="text/javascript">

            //畫面初始布置
            window.onload=init;
            function init(){
                let edit_albumName = document.getElementsByClassName("edit_albumName");  
                let edit_albumCover = document.getElementsByClassName("edit_albumCover");  
                let edit_albumDescript = document.getElementsByClassName("edit_albumDescript");
                let edit_albumLink = document.getElementsByClassName("edit_albumLink");
                let edit_diskPrice = document.getElementsByClassName("edit_diskPrice");  
                let edit_shelfStatus = document.getElementsByClassName("edit_shelfStatus");  

                for (i = 0; i < edit_shelfStatus.length; i++) {
                  edit_albumName[i].style.display = "none";
                  edit_albumCover[i].style.display = "none";
                  edit_albumDescript[i].style.display = "none";                  
                  edit_albumLink[i].style.display = "none";
                  edit_diskPrice[i].style.display = "none";
                  edit_shelfStatus[i].style.display = "none";
                }
 
            }   

            //radio按鈕初始布置
            radioValue = document.getElementsByClassName("radioValue");
            for(i=0;i<radioValue.length;i++){ 
            // alert(radioValue[i].value);
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
            let EditAllFlag=0;
            function allEditMode(){ 

            let sub_edit = document.getElementsByClassName("sub_edit"); 
            for (i = 0; i < sub_edit.length; i++) { 
              sub_edit[i].style.backgroundImage = "url(../images/StarWay_Backend/ok.png)";
            } 

            let albumName = document.getElementsByClassName('albumName')
            let edit_albumName = document.getElementsByClassName('edit_albumName')

            let albumCover = document.getElementsByClassName('albumCover')
            let edit_albumCover = document.getElementsByClassName('edit_albumCover')

            let albumDescript = document.getElementsByClassName('albumDescript')
            let edit_albumDescript = document.getElementsByClassName('edit_albumDescript')

            let albumLink = document.getElementsByClassName('albumLink')
            let edit_albumLink = document.getElementsByClassName('edit_albumLink')

            let diskPrice = document.getElementsByClassName('diskPrice')
            let edit_diskPrice = document.getElementsByClassName('edit_diskPrice') 

            let shelfStatus = document.getElementsByClassName('shelfStatus')
            let edit_shelfStatus = document.getElementsByClassName('edit_shelfStatus')

            let sub_edit_allEdit = document.getElementsByClassName("sub_edit_allEdit"); 
            
            //判斷要全開修改，還是部分修改，來加快效能
            let count;
            for(i = 0; i < sub_edit_allEdit.length; i++){
                if(
                   albumName[i].style.display=="" ||
                   albumCover[i].style.display=="" ||
                   albumDescript[i].style.display=="" ||
                   albumLink[i].style.display=="" ||
                   diskPrice[i].style.display=="" ||
                   shelfStatus[i].style.display=="" 
                   ){
                    count++;
                }
            }
            if(count<sub_edit_allEdit.length){
                for (i = 0; i < sub_edit_allEdit.length; i++) {
                   if(
                      edit_albumName[i].style.display=="" ||
                      edit_albumCover[i].style.display=="" ||
                      edit_albumDescript[i].style.display=='' || 
                      edit_albumLink[i].style.display=="" ||
                      edit_diskPrice[i].style.display=='' ||
                      edit_shelfStatus[i].style.display=='' 
                     ){
                       sub_edit_allEdit[i].click();
                      }
                }
            }else{
                for (i = 0; i < sub_edit_allEdit.length; i++) {
                    
                       sub_edit_allEdit[i].click(); 
                }

            }
 
            }





            //開啟特定全列修改模式
            function editRowMode(context){
           $(context).css("background-image","url(../images/StarWay_Backend/ok.png)"); 

                //狀態                
                let albumName =
                $(context).parent().parent().parent()
                .children('td')[2];

                let edit_albumName =
                $(context).parent().parent().parent()
                .children('td')[3];


                //狀態                
                let albumCover =
                $(context).parent().parent().parent()
                .children('td')[4];

                let edit_albumCover =
                $(context).parent().parent().parent()
                .children('td')[5];


                //狀態                
                let albumDescript =
                $(context).parent().parent().parent()
                .children('td')[7];

                let edit_albumDescript =
                $(context).parent().parent().parent()
                .children('td')[8];


                //狀態                
                let albumLink =
                $(context).parent().parent().parent()
                .children('td')[9];

                let edit_albumLink =
                $(context).parent().parent().parent()
                .children('td')[10];

                //狀態                
                let diskPrice =
                $(context).parent().parent().parent()
                .children('td')[11];

                let edit_diskPrice =
                $(context).parent().parent().parent()
                .children('td')[12];

                //狀態                
                let shelfStatus =
                $(context).parent().parent().parent()
                .children('td')[14];

                let edit_shelfStatus =
                $(context).parent().parent().parent()
                .children('td')[15];
 

                if(
                      edit_albumName.style.display=="none" ||
                      edit_albumCover.style.display=="none" ||
                      edit_albumDescript.style.display=='none' || 
                      edit_albumLink.style.display=="none" ||
                      edit_diskPrice.style.display=='none' ||
                      edit_shelfStatus.style.display=='none' 
                  ){

                    albumName.style.display='';
                    edit_albumName.style.display=''; 

                    albumCover.style.display='';
                    edit_albumCover.style.display='';                    
                    edit_albumCover.style.width='100px';                     
                    edit_albumCover.style.background='rgba(170, 221, 221, .8)'; 
                    edit_albumCover.style.padding='0px 30px'; 
 

                    shelfStatus.style.display='';
                    edit_shelfStatus.style.display=''; 
                    edit_shelfStatus.style.width='100px';                     
                    edit_shelfStatus.style.background='rgba(170, 221, 221, .8)'; 
                    edit_shelfStatus.style.padding='0px 10px'; 

                    diskPrice.style.display='';
                    edit_diskPrice.style.display=''; 

                    albumDescript.style.display='';
                    edit_albumDescript.style.display=''; 
 
                    albumLink.style.display='';
                    edit_albumLink.style.display='';  
                }



                let albumNo=$(context).siblings('.albumNo').val();

                // -- -- 專輯名稱 -- -- -- -- -- -- -- -- -- -- -- -- -- 

                let name=$(context).closest('td').parent().find('.edit_albumName').find('input').val(); 

                 if(albumName.style.display!='none') {
                    albumName.style.display='none';
                    edit_albumName.style.display='';  
                }else{
                    albumName.style.display='';
                    edit_albumName.style.display ="none"; 
                     saveName(albumNo,name); 
                }


                // -- -- 專輯封面 -- -- -- -- -- -- -- -- -- -- -- -- -- 

                // let cover=$(context).closest('td').parent().find('.edit_albumCover').children('input').val(); 

                //設定新封面名稱__操控用隱藏標籤 
                let cover= $(context).parent().parent().parent().find(".newCoverName").val();



                 //設定新封面名稱__顯示給使用者看 

                 if(albumCover.style.display!='none') {
                    albumCover.style.display='none';
                    edit_albumCover.style.display=''; 
                    edit_albumCover.style.width='100px';                     
                    edit_albumCover.style.background='rgba(170, 221, 221, .8)'; 
                    edit_albumCover.style.padding='0px 30px'; 
                }else{
                    albumCover.style.display='';
                    edit_albumCover.style.display ="none"; 
 
                let pervCover= $(context).parent().parent().parent().find(".prevCoverName").val(); 
                   if(cover!=pervCover){ 
                     saveCover(albumNo,cover,context);
                   }
                }
 



                // -- -- 上下架狀態 -- -- -- -- -- -- -- -- -- -- -- -- -- 
                
                let checked=$(context).closest('td').parent().find('.edit_shelfStatus').find('.caseON').is(':checked'); 
 
                if(shelfStatus.style.display!='none') {
                    shelfStatus.style.display='none';
                    edit_shelfStatus.style.display=''; 
                    edit_shelfStatus.style.width='100px';                     
                    edit_shelfStatus.style.background='rgba(170, 221, 221, .8)'; 
                    edit_shelfStatus.style.padding='0px 10px'; 
                }else{
                    shelfStatus.style.display='';
                    edit_shelfStatus.style.display='none'; 
                    saveCheck(albumNo,checked);
                }


                 // -- -- 黑膠唱片單價 -- -- -- -- -- -- -- -- -- -- -- -- -- 

                let price=$(context).closest('td').parent().find('.edit_diskPrice')
                              .find('input').val(); 

                 if(diskPrice.style.display!='none') {
                    diskPrice.style.display='none';
                    edit_diskPrice.style.display='';  
                }else{
                    diskPrice.style.display='';
                    edit_diskPrice.style.display ="none"; 
                     savePrice(albumNo,price);
                    // saveCheck(albumNo,checked);
                }


                // -- -- 專輯描述內容 -- -- -- -- -- -- -- -- -- -- -- -- -- 

                let descript=$(context).closest('td').parent().find('.edit_albumDescript').find('textarea').val(); 

                 if(albumDescript.style.display!='none') {
                    albumDescript.style.display='none';
                    edit_albumDescript.style.display='';  
                }else{
                    albumDescript.style.display='';
                    edit_albumDescript.style.display ="none";
                     saveDescript(albumNo,descript); 
                } 
 

             // -- -- 音源連結 -- -- -- -- -- -- -- -- -- -- -- -- -- 
 
                //設定新封面名稱__操控用隱藏標籤 
                let link= $(context).parent().parent().parent().find(".newLinkName").val();



                 //設定新封面名稱__顯示給使用者看 

                 if(albumLink.style.display!='none') {
                    albumLink.style.display='none';
                    edit_albumLink.style.display=''; 
                    edit_albumLink.style.width='100px';                     
                    edit_albumLink.style.background='rgba(170, 221, 221, .8)'; 
                }else{
                    albumLink.style.display='';
                    edit_albumLink.style.display ="none";  
                let pervLink= $(context).parent().parent().parent().find(".prevLinkName").val();
  
                   if(link!=pervLink){ 
                     saveLink(albumNo,link,context);
                   }
                }
 
            } 

            //點擊範圍外部儲存
            let editMode_using
            let clickcount = 0
            $(document).on('click', function(e){ 

            let NowEditkArea
            item = document.getElementById('checkItem').value;  
            switch(item){
                case "albumName":
                NowEditkArea = "[object HTMLInputElement]"
                break;
                case "albumDescript":
                NowEditkArea = "[object HTMLTextAreaElement]"
                break;
                case "diskPrice":
                NowEditkArea = "[object HTMLInputElement]"
                break;
                case "shelfStatus":
                NowEditkArea = "[object HTMLTableCellElement]"
                break; 
            }
 
            if(editMode_using!=undefined){
                clickcount++ 
                if(clickcount>1){ 

                if(item=="albumName"){
                let child=  NowEditkArea
                    if(e.target != child){
                        editMode(editMode_using)
                        clickcount = 0; 
                    }                   
                } 
 
                if(item=="albumDescript"){
                let child=  NowEditkArea
                    if(e.target != child){
                        editMode(editMode_using)
                        clickcount = 0;
                    }                   
                } 

                if(item=="diskPrice"){
                let child= NowEditkArea
                    if(e.target != child){
                        editMode(editMode_using)
                        clickcount = 0; 
                    }                   
                } 

                if(item=="shelfStatus"){
                let child= NowEditkArea
                    if(e.target != child &&e.target!="[object HTMLInputElement]"){
                        editMode(editMode_using)
                        clickcount = 0;  
                    }                   
                } 

            }

   
        }
  
            }); 




            let Item;

            //開啟特定單項目修改模式
            function editMode(context){
           
            editMode_using = context;
           
           $(context).css("background-image","url(../images/StarWay_Backend/ok.png)"); 

            item = document.getElementById('checkItem').value; 
        

            let albumNo=$(context).siblings('.albumNo').val();



             // -- -- 專輯名稱 -- -- -- -- -- -- -- -- -- -- -- -- --  


             //狀態                
            let albumName =
            $(context).parent().parent().parent()
            .children('td')[2];

            let edit_albumName =
            $(context).parent().parent().parent()
            .children('td')[3];


                if(item == 'albumName'){
                    let name=$(context).closest('td').parent().find('.edit_albumName').find('input').val();  

                     if(albumName.style.display!='none') {
                        albumName.style.display='none';
                        edit_albumName.style.display='';  
                    }else{
                        albumName.style.display='';
                        edit_albumName.style.display ="none"; 
                        saveName(albumNo,name);
                    }
 
            } 


            // -- -- 專輯封面 -- -- -- -- -- -- -- -- -- -- -- -- --  


             //狀態                
            let albumCover =
            $(context).parent().parent().parent()
            .children('td')[4];

            let edit_albumCover =
            $(context).parent().parent().parent()
            .children('td')[5];


                if(item == 'albumCover'){
                //設定新封面名稱__操控用隱藏標籤
                let cover= $(context).parent().parent().parent().find(".newCoverName").val(); 
                     if(albumCover.style.display!='none') {
                        albumCover.style.display='none';
                        edit_albumCover.style.display=''; 
                        edit_albumCover.style.width='100px';                     
                        edit_albumCover.style.background='rgba(170, 221, 221, .8)'; 
                        edit_albumCover.style.padding='0px 0px'; 
                    }else{
                        albumCover.style.display='';
                        edit_albumCover.style.display ="none";  
                        $(context).parent().parent().parent().children('td').find('.submitPic').trigger('click');
 
                        saveCover(albumNo,cover,context); 
                    }
 

            } 




            // -- -- 音源連結 -- -- -- -- -- -- -- -- -- -- -- -- --  


             //狀態                
            let albumLink =
            $(context).parent().parent().parent()
            .children('td')[9];

            let edit_albumLink =
            $(context).parent().parent().parent()
            .children('td')[10];


                if(item == 'albumLink'){
                //設定新封面名稱__操控用隱藏標籤
                let link= $(context).parent().parent().parent().find(".newLinkName").val(); 
                     if(albumLink.style.display!='none') {
                        albumLink.style.display='none';
                        edit_albumLink.style.display=''; 
                        edit_albumLink.style.width='100px';                     
                        edit_albumLink.style.background='rgba(170, 221, 221, .8)'; 
                    }else{
                        albumLink.style.display='';
                        edit_albumLink.style.display ="none";  
                        $(context).parent().parent().parent().children('td').find('.submitLink').trigger('click');
 
                        saveLink(albumNo,link,context); 
                    }
 

            } 
 

             // -- -- 上下架狀態 -- -- -- -- -- -- -- -- -- -- -- -- -- 

            //狀態                
            let shelfStatus = 
            $(context).parent().parent().parent()
            .children('td')[14];

            let edit_shelfStatus = 
            $(context).parent().parent().parent()
            .children('td')[15];

                if(item == 'shelfStatus'){
                    let checked=$(context).closest('td').parent().find('.edit_shelfStatus').find('.caseON').is(':checked') ; 
 

                if(shelfStatus.style.display!='none') {
                    shelfStatus.style.display='none';
                    edit_shelfStatus.style.display=''; 
                    edit_shelfStatus.style.width='100px';                     
                    edit_shelfStatus.style.background='rgba(170, 221, 221, .8)'; 
                    edit_shelfStatus.style.padding='0px 10px'; 
                }else{
                    shelfStatus.style.display='';
                    edit_shelfStatus.style.display='none'; 
                    saveCheck(albumNo,checked);
                }

            } 



             // -- -- 黑膠唱片單價 -- -- -- -- -- -- -- -- -- -- -- -- --  


             //狀態                
            let diskPrice =
            $(context).parent().parent().parent()
            .children('td')[11];

            let edit_diskPrice =
            $(context).parent().parent().parent()
            .children('td')[12];


                if(item == 'diskPrice'){
                    let price=$(context).closest('td').parent().find('.edit_diskPrice').find('input').val();  

                     if(diskPrice.style.display!='none') {
                        diskPrice.style.display='none';
                        edit_diskPrice.style.display='';  
                    }else{
                        diskPrice.style.display='';
                        edit_diskPrice.style.display ="none"; 
                        savePrice(albumNo,price);
                    }
 

            } 
 

             // -- -- 專輯描述內容 -- -- -- -- -- -- -- -- -- -- -- -- --  


             //狀態                
            let albumDescript =
            $(context).parent().parent().parent()
            .children('td')[7];

            let edit_albumDescript =
            $(context).parent().parent().parent()
            .children('td')[8];


                if(item == 'albumDescript'){
                    let descript=$(context).closest('td').parent().find('.edit_albumDescript').find('textarea').val();  
 

                     if(albumDescript.style.display!='none') {
                        albumDescript.style.display='none';
                        edit_albumDescript.style.display='';  
                    }else{
                        albumDescript.style.display='';
                        edit_albumDescript.style.display ="none"; 
                        saveDescript(albumNo,descript);
                    }
 

            } 

            }

            function saveName(albumNo,albumName_name){
 
                let xhr = new XMLHttpRequest();
                xhr.open("Post", "CDwall_sell_back(albumName).php", true);
                xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                let UPDATE_albumName = {
                  albumNo      :albumNo,
                  albumName    :albumName_name
                }              
                xhr.send("UPDATE_albumName="+ JSON.stringify(UPDATE_albumName)); 
 
                xhr.onload = function(){ 
                    console.log(xhr.responseText) 
                    location.reload();   
                  if( xhr.status == 200){ 
                  }else{ 
                  }
                }

            }



            //儲存修改
            function saveCheck(albumNo,shelfStatus_checked){   
                shelfStatus_checked==true ? shelfStatus_checked=1 : shelfStatus_checked=0;
 
                let xhr = new XMLHttpRequest();
                xhr.open("Post", "CDwall_sell_back(shelfStatus).php", true);
                xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                let UPDATE_shelfStatus = {
                  albumNo      :albumNo,
                  shelfStatus :shelfStatus_checked
                }              
                xhr.send("UPDATE_shelfStatus="+ JSON.stringify(UPDATE_shelfStatus)); 
 
                xhr.onload = function(){ 
                    console.log(xhr.responseText) 
                    location.reload();   
                }
                
 
            }
                      
            function saveCover(albumNo,albumCover_cover,context){
 
                    let xhr = new XMLHttpRequest();
                    xhr.open("Post", "CDwall_sell_back(albumCover).php", true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    let UPDATE_albumCover = {
                      albumNo      :albumNo,
                      albumCover  :albumCover_cover
                    }              
                    xhr.send("UPDATE_albumCover="+ JSON.stringify(UPDATE_albumCover)); 
        
                    xhr.onload = function(){ 

                        let cover= $(context).parent().parent().parent().find(".newCoverName").val(); 

                        console.log(xhr.responseText)  
                        $(context).parent().parent().parent().children('td').find('.submitPic').trigger('click'); 
                      if( xhr.status == 200){ 
                      }else{ 
                      }
                    } 
            } 

             function saveLink(albumNo,albumLink_link,context){ 

                    let xhr = new XMLHttpRequest();
                    xhr.open("Post", "CDwall_sell_back(albumLink).php", true);
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    let UPDATE_albumLink = {
                      albumNo      :albumNo,
                      albumLink  :albumLink_link
                    }              
                    xhr.send("UPDATE_albumLink="+ JSON.stringify(UPDATE_albumLink)); 
        
                    xhr.onload = function(){ 

                        let link= $(context).parent().parent().parent().find(".newLinkName").val(); 

                        console.log(xhr.responseText)  
                        $(context).parent().parent().parent().children('td').find('.submitLink').trigger('click');

                         
                      if( xhr.status == 200){ 
                      }else{ 
                      }
                    }  
            } 

            function saveDescript(albumNo,albumDescript_descript){ 
                let xhr = new XMLHttpRequest();
                xhr.open("Post", "CDwall_sell_back(albumDescript).php", true);
                xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                let UPDATE_albumDescript = {
                  albumNo      :albumNo,
                  albumDescript  :albumDescript_descript
                }              
                xhr.send("UPDATE_albumDescript="+ JSON.stringify(UPDATE_albumDescript)); 
 
                xhr.onload = function(){ 
                    console.log(xhr.responseText) 
                    location.reload();   
                  if( xhr.status == 200){ 
                  }else{ 
                  }
                } 
            }


             function savePrice(albumNo,diskPrice_price){ 
                let xhr = new XMLHttpRequest();
                xhr.open("Post", "CDwall_sell_back(diskPrice).php", true);
                xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                let UPDATE_diskPrice = {
                  albumNo      :albumNo,
                  diskPrice    :diskPrice_price
                }              
                xhr.send("UPDATE_diskPrice="+ JSON.stringify(UPDATE_diskPrice)); 
 
                xhr.onload = function(){ 
                    console.log(xhr.responseText) 
                    location.reload();   
                  if( xhr.status == 200){ 
                  }else{ 
                  }
                } 
            }

 
    
</script>

<script type="text/javascript">
    
    let selectfield=document.getElementById("shelfStatus_field")
      selectfield.onchange=function(){ //run some code when "onchange" event fires
      let c_option=this.options[this.selectedIndex] //this refers to "selectfield"
 
        switch (c_option.value) {            
            case "seeAll":  
            location.href = '?shelfchosen=seeAll'; 
            break;
            case "seeON":              
            location.href = '?shelfchosen=seeON';
            break;
            case "seeOFF":  
            location.href = '?shelfchosen=seeOFF';
            break;
        }
    }   

        // 改變條件查詢顯示
        function showSelect(){ 
        }

 
        let id = document.getElementById("shelfStatus_field");
            id.addEventListener('change',function(){ 
            });//单一添加下拉改变事件
            id.onmousedown = function(){//当按下鼠标按钮的时候
                this.sindex = this.selectedIndex;//把当前选中的值得索引赋给下拉选中的索引
                this.selectedIndex = -1;//把下拉选中的索引改变为-1,也就是没有!
            }
            id.onmouseout = function(){//当鼠标移开的时候
                let index = id.selectedIndex;//获取下拉选中的索引
                if(index == -1){//如果为-1,就是根本没有选
                    this.selectedIndex = this.sindex;//就把下拉选中的索引改变成之前选中的值得索引,就默认选择的是之前选中的值
                } 
            } 

         function seeAll(){ 
         }
 
</script>


<script type="text/javascript">

    function $id(id){
        return document.getElementById(id);
    }   

     function $class(getclass){
        return document.getElementsByClassName(getclass);
    }  
 
    function initCover(context){ 
            $(context).change(function(e){  
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onload = function(){ 

                    //設定新封面名稱__操控用隱藏標籤 
                    $(context).parent().find(".newCoverName").val(file.name); 
                    

                     //設定新封面名稱__顯示給使用者看 
                    $(context).parent().find(".showCoverName").html(file.name); 
                    
                    //展示選擇圖片
                    $(context).siblings("img").attr("src",reader.result);
                     
                }
                reader.readAsDataURL(file);
 
           });  
    }   
    window.addEventListener("load", initCover, false);    


    function initLink(context){ 
            $(context).change(function(e){  
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onload = function(){ 

                    //設定新封面名稱__操控用隱藏標籤 
                    $(context).parent().find(".newLinkName").val(file.name); 
                     //設定新封面名稱__顯示給使用者看 
                    $(context).parent().find(".showLinkName").html(file.name); 
                }
                reader.readAsDataURL(file);  
           });  
    }   
    window.addEventListener("load", initLink, false);  

</script>