
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Examples</title>
<style type="text/css">
#imgPreview {
	width:200px;
}
#upFile {
	display:none;
}	
</style>
</head>
<body>

<form action="fileUpload.php" method="post" enctype="multipart/form-data">
	<!-- <input type="hidden" name="MAX_FILE_SIZE" value="2048"> -->
帳號 <input type="text" name="memId"><br>

姓名<input type="text" name="memName"><br>	

<label>
<input type="file" name="upFile" id="upFile"><br>	
<img id="imgPreview" src="images/camera.png">
</label>

<input type="submit" value="OK">
</form>    


<script type="text/javascript">
function $id(id){
	return document.getElementById(id);
}	

function init(){
  // $id("upFile").onchange = function(e){
  	// var file = e.target.files[0];
  	// var reader = new FileReader();
  	// reader.onload = function(){
  	// 	$id("imgPreview").src = reader.result;
  	// }
  	// reader.readAsDataURL(file); 
  // }
}	
window.addEventListener("load", init, false);	
</script>
</body>
</html>