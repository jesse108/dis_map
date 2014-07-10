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

<script type="text/javascript">
var  country = <?php echo ($country); ?>;
var marker;
var lng=lat=0;
var  opt = { 
		level:3//初始地图视野级别 
}
$(function(){
	mapObj = new MMap.Map("iCenter",opt);
	chengcountry(1);
	$("#delta").change(function(){
		chengcountry($(this).val());
	});
	addContentMenu();

	$("#submit").click(function(){
		if (lng ==0 || lat==0 ) {
			alert('请选择城市地点');
			return false;
		};
		var lng = marker.getPosition().lng;
		var lat = marker.getPosition().lat;

		var cityname	= $("input[name='cityname']").val();
		var country     = $("#country").val();
		var comment		= $("#comment").val();
		if(!cityname){
			alert("请填写城市名称");
			return false;
		}
		if(!country){
			alert("请选择国家");
			return false;
		}
		$.post("/Home/city/addCity",
				{cityname:cityname,country:country,comment:comment,lng:lng,lat:lat},
				function(res){
					alert(res.msg);
					if(res.code ==1){
						$("input[name='cityname']").val("");
						$("#comment").val("");
					 setTimeout(function(){	location.reload(); },2000);
					}
				}
			);
	});

});
function chengcountry(index){
	var optionHtml = "";
	if(country[index]){
		var count =country[index].length;
		
		for (var i = 0; i <count; i++) {
			optionHtml +="<option value="+country[index][i].id+">"+country[index][i].cityname+"</option>";
		};
		
	}
	$("#country").html(optionHtml);
}
function addContentMenu(){
	//构造 ContextMenu 新实例
	var contextMenu = new MMap.ContextMenu({
		isCustom:false,
		width:180,
		
	});
	//绑定右键单击事件，打开右键菜单
	mapObj.bind(mapObj,"rightclick",fun5=function(e){
		 lng =e.lnglat.lng;
		 lat =e.lnglat.lat;
		var arr= new Array();
		marker=new MMap.Marker({
			id:"marker",						  
			icon:"http://code.mapabc.com/images/lan_1.png",
			position:new MMap.LngLat(lng,lat)
			});
		arr.push(marker);
		mapObj.addOverlays(arr);
	});
}
</script>
<h2>港口传染病地图</h2>
<table width="900">
	<tr>
		<td>地点名称</td>
		<td>洲际</td>
		<td>国家</td>
	</tr>
	<tr>
		<td><input type="text" name="cityname" value=""></td>
		<td>
			<select name="delta" id="delta">
				<?php if(is_array($delta)): foreach($delta as $key=>$one): ?><option value="<?php echo ($one["id"]); ?>"><?php echo ($one["cityname"]); ?></option><?php endforeach; endif; ?>
			</select>
		</td>
		<td>
			<select name="country" id="country">
				
			</select>
		</td>
	</tr>
</table>
<table width="900" heght="900">
	<tr>
		<td>
			<div id="iCenter" style="height:500px; width:500px;"></div>
		</td>
	</tr>
</table>

<table width="900" heght="300">
	<tr>
		<td>
			地点描述:<br>
			<textarea style="height:100px; width:300px;" id="comment"></textarea>
		</td>
	</tr>
	<tr>
		<td>
		<input type="button" value="完成" id="submit">	
		<input type="button" value="重置" id="reset">
		</td>
	</tr>
</table>
</body>
</html>