
<link rel="stylesheet" type="text/css" href="../../layui/css/layui.css">
<script type="text/javascript" src="../../layui/layui.js"></script>

<form id="form1" class="layui-form" method="post" action="" style="width:460px; margin-top: 20px;">
<div class="layui-form-item">
 <label class="layui-form-label">ID</label>
 <div class="layui-input-block">
   <input type="text" name="museumID" lay-verify="title"autocomplete="off" placeholder="请输入博物馆编号" class="layui-input">
 </div>
</div>
<div class="layui-form-item">
 <label class="layui-form-label">博物馆名称</label>
 <div class="layui-input-block">
   <input type="text" name="museumName" autocomplete="off" placeholder="请输入博物馆名称" class="layui-input">
 </div>
</div>
<div class="layui-form-item">
 <label class="layui-form-label">地址</label>
 <div class="layui-input-block">
   <input type="text" name="address"  lay-verify="title" autocomplete="off" placeholder="请输入博物馆地址" class="layui-input">
 </div>
</div>
<div class="layui-form-item">
 <label class="layui-form-label">电话&传真</label>
 <div class="layui-input-block">
   <input type="text" name="consultationTelephone" lay-verify="title" autocomplete="off" placeholder="请输入电话&传真" class="layui-input">
 </div>
</div>
<div class="layui-form-item">
 <label class="layui-form-label">介绍链接</label>
 <div class="layui-input-block">
   <input type="text" name="publicityVideoLink" lay-verify="title" autocomplete="off" placeholder="请输入网址" class="layui-input">
 </div>
</div>
</form>
<script>
function formData(){
	if($('#musuemID').val()==''){
		layer.tips('拉拉');
		$("#musuemID").focus();
		return ;
}
	var o={};
	var a=$('#form1').serializeArray();
	var _this=$('#form1').serialize();
	$.each(a,function(){
		if(o[this.museumID]!=undefined){
			if(!o[this.museumID].push){
				o[this.museumID]=[o[this.museumID]];
			}
			o[this.museumID].push(this.museumName || '');
		}else{
			o[this.museumID]=this.museumName || '';
}
	});
	o.type="ok";
	o.i=_this;
	return o;
}
</script>