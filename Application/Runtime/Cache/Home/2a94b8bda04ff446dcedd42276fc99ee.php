<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo ($title); ?></title>
<script language="javascript" src="http://app.mapabc.com/apis?t=javascriptmap&v=3&key=b0a7db0b3a30f944a21c3682064dc70ef5b738b062f6479a5eca39725798b1ee300bd8d5de3a4ae3"></script>
<script type="text/javascript" src="/Public/static/js/jquery_8.1.js"></script>
<script type="text/javascript" src="/Public/static/js/WdatePicker.js"></script>
</head>
<body>


<table>
  <tr>
    <td><input type="text" id="keyword" value=""></td>  
    <td><input type="button" value="搜疾病" class="serach"></td>
     <td><input type="button" value="搜城市" class="serach"></td>
    <td></td>
  </tr>
</table>

</body>
</html>
<script type="text/javascript">
$(".serach").click(function(){
	var keyword = $("#keyword").val();
	if(!keyword){
		return false;
	}
	if($(this).val=='搜疾病'){
		location.href="http://diseasemap.com/Home/diseaseMap/searchDisease?keyword="+keyword;
	}else{
		location.href="http://diseasemap.com/Home/city/searchcity?keyword="+keyword;

	}
	
});
</script>