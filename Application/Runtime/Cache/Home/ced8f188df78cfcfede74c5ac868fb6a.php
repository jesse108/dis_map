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
var mapObj;
var diseaseObj = eval('{<?php echo ($disease); ?>}');	
var  opt = { 
		level:3//初始地图视野级别 
}

//信息窗口样式
function adddian (marker,obj) {
	var infoWindow = new MMap.InfoWindow({
					isCustom:true,
					content:"<table border='0' cellpadding='0' cellspacing='0' style='font-family:verdana;font-size:80%'><tr><td style='border-bottom:1px solid #000;'><b>"+obj.city+"</b></td></tr><tr><td >疾病 ："+obj.title+"</td></tr><tr><td>疾病时间 : "+obj.starttime+"-"+obj.endtime+"</td></tr><tr><td>疾病描述 : "+obj.comment+"</td></tr></table>",
					size:new MMap.Size(300,0),
					
				});
			infoWindow.open(mapObj,marker.getPosition());

			mapObj.bind(marker,"mouseout",function(e){
				mapObj.clearInfoWindow();	
			});
			mapObj.bind(marker,"mouseover",function(e){
				infoWindow.open(mapObj,marker.getPosition());	
			});

			mapObj.setCenter(marker.getPosition());
}
function eidtMarker(diseaseObj){
	var count = diseaseObj.length;
	if(count>0){
		for (var i=0; i <count; i++) {
			var obj = diseaseObj[i];
			var coordinate = obj.coordinate.split(':');
			var marker_id = 'A'+obj.id;
			var marker=new MMap.Marker({
				id:	marker_id,				  
				icon:"http://code.mapabc.com/images/lan_1.png",
				position:new MMap.LngLat(coordinate[0],coordinate[1]),
				
			});
			mapObj.addOverlays(marker);
			mapObj.setFitView([marker]);
			adddian(marker,obj);
			marker.setDraggable(false);
		}
	}
}
//打开信息窗口
$(function(){
	mapObj = new MMap.Map("iCenter",opt);


	eidtMarker(diseaseObj);
mapObj.clearInfoWindow();
		

});
	
	


//清除信息窗口
function clearInfoWindow(){
	mapObj.clearInfoWindow();
}
</script>

<table width='100%'  border="0" cellpadding="0" cellspacing="2" height='100%'>
	<tr>
		<td  style="width:77%;height:100%;"><div id="iCenter" style="height:100%; width:100%"></div></td>
		<td style="width:23%;border-left:1px solid #666;" valign="top" >
		<form action="" method="get">
				<table style="padding:5px 0px 0px 5px;font-size:12px;height:500px">
					<tr>
						<td>城市:<input type="text" name="cname" value="<?php echo ($cname); ?>"></td>
					</tr>
					<tr>
						<td>疾病名称<input type="text" name="dname" value="$dname}"></td>
			
					</tr>
					<tr>
						<td><input type="submit" id="submit" value='提交'></td>

					</tr>
				</table>
				</form>
		</td>
	</tr>
</table>
</body>
</html>