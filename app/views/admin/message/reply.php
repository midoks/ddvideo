<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>回复</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/assets/css/oksub.css?v=<?php echo $version; ?>">
	<script type="text/javascript" src="/assets/lib/loading/okLoading.js?v=<?php echo $version; ?>"></script>
</head>
<body>
<div class="ok-body">
	<!--form表单-->
	<form class="layui-form layui-form-pane ok-form">
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">回复</label>
			<div class="layui-input-block">
				<textarea name="reply" placeholder="请输入文章内容" class="layui-textarea" lay-verify="required">已处理</textarea>
			</div>
		</div>
		<input type="hidden" name="id" value="{id}">
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit lay-filter="reply">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</form>
</div>
<!--js逻辑-->
<script src="/assets/lib/layui/layui.js?v=<?php echo $version; ?>"></script>
<script>
layui.use(["form", "okUtils", "okLayer"], function () {
	let form = layui.form;
	let okUtils = layui.okUtils;
	let okLayer = layui.okLayer;
	okLoading.close();
	form.on("submit(reply)", function (data) {
		okUtils.isFrontendBackendSeparate = false;
		okUtils.ajax("/adminmessage/ajaxReply", "post", data.field, true)
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
