// 登入 start
// <script>
   //******** 黑膠唱片旋轉 ********
   TweenMax.to("#memberImg img",10,
        {
            rotation:360,
            ease:Linear.easeInOut,
            repeat:-1,
      });

  	function $id(id){
		return document.getElementById(id);
	}	
	function $id(id){
		  return document.getElementById(id);
		}
	function showLoginForm(){
		//檢查登入bar面版上 spanLogin 的字是登入或登出
		//如果是登入，就顯示登入用的燈箱(memLoginShow)
		//如果是登出
		//將登入bar面版上，登入者資料清空 
		//spanLogin的字改成登入
		//將頁面上的使用者資料清掉
		if($id('spanLogin').innerText == "登入"){
		$id('memLoginShow').style.display = 'block';
		}else{  //登出
		// var xhr = new XMLHttpRequest();
		// xhr.open("get","memLogout.php",true);
		// xhr.send(null);

		xhr.onload = function(){
			// if( xhr.status == 200){
			// $id('memName').innerHTML = '&nbsp';
			// $id('spanLogin').innerHTML = '登入'; 
			// // memNo = 0; 
			// location.reload();           
			// }else{
			// alert( xhr.status);
			// }
			
		};

		}

	}//showLoginForm
	function sendStopRight(){
		//=====使用Ajax 回server端,取回登入者姓名, 放到頁面上    
		var xhr = new XMLHttpRequest();
		xhr.open("Post", "memStopRight.php", true);
		xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
		var data_info = "memId=" + document.getElementById("memId").value 
					+ "&memPsw="+ document.getElementById("memPsw").value;
		xhr.send(data_info);

		xhr.onload = function(){
			if( xhr.status == 200){  
				if(xhr.responseText=='0'){
					// alert(xhr.responseText);
					alert('查無此人');
				}else if(xhr.responseText=='1'){
					// alert(xhr.responseText);
					alert('您被停權了');
				}else{
					// alert(xhr.responseText);
					sendForm();
				}
			}else{
				alert(xhr.status);
			}
		}

	}
	
function sendForm(){
  //=====使用Ajax 回server端,取回登入者姓名, 放到頁面上
  var xhr = new XMLHttpRequest();
  xhr.open("post", "memLogin.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // xhr.setRequestHeader("Content-type","application/json");//很怪，把表頭改成JSON格式，反而送不過去
  var loginInfo = {
    memId :$id("memId").value,
    memPsw:$id("memPsw").value
  };
  console.log("loginInfo="+JSON.stringify(loginInfo));
  xhr.send("loginInfo="+JSON.stringify(loginInfo));

  xhr.onload = function(){
  	console.log(xhr);
    // var loginInfo = JSON.parse(xhr.responseText);
    // if( loginInfo.memName ){
    //   $id("memName").innerHTML = loginInfo.memName;

    //   //將登入表單上的資料清空，並隱藏起來
    //   $id('lightBox').style.display = 'none';
    //   $id('memId').value = '';
    //   $id('memPsw').value = '';
    //   $id('spanLogin').innerHTML = "登出";
    // }else{
    //   alert("帳密錯誤，請重新輸入");
    // }
  };
}


	function cancelLogin(){
		//將登入表單上的資料清空，並將燈箱隱藏起來
		$id('memLoginShow').style.display = 'none';
		$id('memId').value = '';
		$id('memPsw').value = '';
	}

	function init(){
		//===設定spanLogin.onclick 事件處理程序是 showLoginForm

		$id('spanLogin').onclick = showLoginForm;

		//===設定btnLogin.onclick 事件處理程序是 sendForm
		$id('btnLogin').onclick = sendForm;

		//===設定btnLoginCancel.onclick 事件處理程序是 cancelLogin
		// $id('btnLoginCancel').onclick = cancelLogin;

		//檢查是否已登入
		var xhr = new XMLHttpRequest();
		// xhr.open("get", "getMemLoginInfo.php", true);
		// xhr.send(null);
		
		xhr.onload = function(){
		if(xhr.status == 200){
			if( xhr.responseText !=""){ //己登入
			document.getElementById("memName").innerHTML = xhr.responseText;
			document.getElementById("spanLogin").innerHTML = "登出";  
			}
			
		}else{
			alert( xhr.status);
		}
		}
	}; //window.onload

	window.addEventListener('load',init,false);
	
// </script>
// 登入 end
	
	
// 跳窗 start
// <script>
	// Get the memberArea
	var modal = document.getElementById("memLoginShow");

	// When the user clicks anywhere outside of the modalJump, close it
	window.onclick = function(event) {
		if (event.target == modal) {
		modal.style.display = "none";
		}
	};