<?php if (!defined('THINK_PATH')) exit();?><title>添加地图疾病</title>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
var mapObj;
var lng=0;
var lat=0;
var marker;
//删除点
var arrOverlays=new Array();
var  opt = { 
		level:3//初始地图视野级别 
}
arrOverlays.push('marker');



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

$(function(){
	mapObj = new MMap.Map("iCenter",opt);
	addContentMenu();
//提交设置
	$("#submit").click(function(){
		
		if (lng ==0 || lat==0 ) {
			alert('请选择城市');
			return false;
		};
		lng = marker.getPosition().lng;
		lat = marker.getPosition().lat;
		var cityname	= $("input[name='city']").val();
		var	diseasename	= $("input[name='title']").val();
		var start		= $("input[name='start']").val();
		var end			= $("input[name='end']").val();
		var mnum		= $("input[name='mnum']").val();
		var ratio		= $("input[name='ratio']").val();
		var comment		= $("#diseasecom").val();
		if(!cityname){
			alert('请输入城市名称');
			return false;
		}
		if(!diseasename){
			alert('请输入疾病名称');
			return false;
		}
		if(!start){
			alert('请输入起始时间');
			return false;
		}
		if(!end){
			alert('请输入结束时间');
			return false;
		}
		if(!end){
			alert('请输入结束时间');
			return false;
		}
		if(!mnum){
			alert('请输入发病人数');
			return false;
		}
		if(!comment){
			alert('请输入描述');
			return false;
		}
		$.post("/Home/diseaseMap/addInfo",
			{ cityname: cityname, diseasename: diseasename ,start: start,end: end,mnum: mnum,ratio: ratio, comment:comment,lng:lng,lat:lat},
   					function(data){
    				//var data = eval("("+data+")");
    				if(data.code ==1){
    					lng=0;
						lat=0;
						$("input[type!='button']").val('');
						$("#diseasecom").val('');
						mapObj.removeOverlays(arrOverlays);
    				}
    				alert(data.msg);
   		});
	});	
});
	
</script>

<table width='100%'  border="0" cellpadding="0" cellspacing="2" height='100%'>
	<tr>
		<td  style="width:77%;height:100%;"><div id="iCenter" style="height:100%; width:100%"></div></td>
		<td>
			<table>
				<tr>
					<td>城市：</td>
					<td><input type="text" name='city'></td>
				</tr>
				<tr>
					<td>疾病名称</td>
					<td><input type="text" name='title'></td>
				</tr>
				<tr>
					<td>发病起始于</td>
					<td><input type="text" name='start' class="Wdate" id="d122" onFocus="WdatePicker({isShowWeek:true,onpicked:function() {$dp.$('d122_1').value=$dp.cal.getP('W','W');$dp.$('d122_2').value=$dp.cal.getP('W','WW');}})"></td>
				</tr>
				<tr>
					<td>结束于</td>
					<td><input type="text" name='end'  class="Wdate" id="d123" onFocus="WdatePicker({isShowWeek:true,onpicked:function() {$dp.$('d122_1').value=$dp.cal.getP('W','W');$dp.$('d122_2').value=$dp.cal.getP('W','WW');}})"></td>
				</tr>
				<tr>
					<td>发病人数</td>
					<td><input type="text" name='mnum'></td>
				</tr>
				<tr>
					<td>发病率</td>
					<td><input type="text" name='ratio'></td>
				</tr>
				<tr>
					<td colspan="2">备注：</td>
				</tr>
				<tr>
					<td colspan="2"><textarea name="comment" id="diseasecom"></textarea></td>
				</tr>
			</table>
			<input type="button" id="submit" value="提交">
		</td>
	</tr>
</table>

</body>
</html>