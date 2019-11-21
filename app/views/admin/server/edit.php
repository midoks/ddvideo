<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/assets/css/oksub.css?v=<?php echo $version; ?>">
	<script type="text/javascript" src="/assets/lib/loading/okLoading.js?v=<?php echo $version; ?>"></script>
</head>
<body>
<div class="ok-body">
	<!--form表单-->
	<form class="layui-form layui-form-pane ok-form">

		<div class="layui-form-item">
			<label class="layui-form-label">服务器地址</label>
			<div class="layui-input-block">
				<input type="text"
				name="addr"
				class="layui-input"
				lay-verify="required"
				placeholder="请输入服务器地址,如http://127.0.0.1:8081"
				value="<?php echo $addr; ?>">
			</div>
		</div>
		<input type="hidden" name="id" value="<?php echo $id; ?>">

		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit lay-filter="add">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</form>
</div>
<!--js逻辑-->
<script src="/assets/lib/layui/layui.js"></script>
<script>
layui.use(["form", "okUtils", "okLayer"], function () {
	let form = layui.form;
	let okUtils = layui.okUtils;
	let okLayer = layui.okLayer;
	okUtils.isFrontendBackendSeparate = false;
	okLoading.close();
	form.on("submit(add)", function (data) {
		okUtils.ajax("/adminserver/ajaxAdd", "post", data.field, true)
		.done(function (response) {
			okLayer.greenTickMsg(response.msg, function () {
				parent.layer.close(parent.layer.getFrameIndex(window.name));
			});
		}).fail(function (error) {
			// console.log(error)
		});
		return false;
	});
});
</script>
</body>
</html>
