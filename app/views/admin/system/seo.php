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
<div class="ok-body ">
	<!--form表单-->
	<form class="layui-form layui-form-pane ok-form col-xs-12 col-md-6 col-sm-6">


		<div class="layui-form-item">
			<label class="layui-form-label">网站标题</label>
			<div class="layui-input-inline">
				<input type="text" name="__title" class="layui-input" lay-verify="required" placeholder="DD视频管理系统" value="<?php if (isset($__title)): echo $__title;endif;?>">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">网站关键字</label>
			<div class="layui-input-block">
				<input type="text" name="__keyword" class="layui-input" lay-verify="required" placeholder="DD视频管理系统" value="<?php if (isset($__keyword)): echo $__keyword;endif;?>">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">网站描述</label>
			<div class="layui-input-block">
				<input type="text" name="__desc" class="layui-input" lay-verify="required" placeholder="DD视频管理系统" value="<?php if (isset($__desc)): echo $__desc;endif;?>">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">统计代码</label>
			<div class="layui-input-block">
				<textarea name="__statis" placeholder="统计代码" class="layui-textarea"><?php if (isset($__statis)): echo $__statis;endif;?></textarea>
			</div>
		</div>

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
		okUtils.ajax("/adminsystem/ajaxAdd", "post", data.field, true)
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
