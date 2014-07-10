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
		<td>传染病名称:</td>
		<td>传染病英文名称:</td>
		<td></td>
	</tr>
	<tr>
		<td><input type="text" name="diseasename"></td>
		<td><input type="text" name="ename"></td>
		<td></td>
	</tr>
	<tr>
		<td>病原体名称:</td>
		<td>病原体英文名称:</td>
		<td>分类学地位:</td>
	</tr>
	<tr>
		<td><input type="text" name="pathogen"></td>
		<td><input type="text" name="epathogen"></td>
		<td><input type="text" name="group"></td>
	</tr>
	<tr>
		<td>传染源:</td>
		<td>易感人群:</td>
		<td>传染途径:</td>
	</tr>
	<tr>
		<td><input type="text" name="source"></td>
		<td><input type="text" name="easyinfection"></td>
		<td><input type="text" name="pathway"></td>
	</tr>
	<tr>
		<td colspan="3">诊断标准:</td>
	</tr>
	<tr>
		<td><textarea id="criteria"></textarea></td>
	</tr>
	<tr>
		<td>预防措施</td>
	</tr>
	<tr>
		<td><textarea id="precautions"></textarea></td>
	</tr>
	<tr>
		<td>治疗措施</td>
	</tr>
	<tr>
		<td><textarea id="treatment"></textarea></td>
	</tr>
</table>
<input type="button" value="提交" id="submit">
<input type="button" value="重置">
</body>
</html>
<script type="text/javascript">
	$("#submit").click(function(){
		var diseasename = $("input[name=diseasename]").val();
		var ename = $("input[name=ename]").val();
		var pathogen = $("input[name=pathogen]").val();
		var epathogen = $("input[name=epathogen]").val();
		var group = $("input[name=group]").val();
		var source = $("input[name=source]").val();
		var easyinfection = $("input[name=easyinfection]").val();
		var pathway = $("input[name=pathway]").val();
		var criteria = $("#criteria").val();
		var precautions = $("#precautions").val();
		var treatment = $("#treatment").val();

		if(!diseasename){
			alert("请输入疾病名称");
			return false;
		}
		$.post("/Home/diseaseMap/addDiseaselist",
			{diseasename:diseasename,ename:ename,pathogen:pathogen,epathogen:epathogen,group:group,source:source,easyinfection:easyinfection,pathway:pathway,criteria:criteria,
				precautions:precautions,treatment:treatment},
			function(res){
				alert(res.msg);
				if(res.code == 1){
					$("input[type=text]").val("");
					$("textarea").val("");
				}

			}
			);
		
	});
</script>