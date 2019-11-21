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
			<label class="layui-form-label">名称</label>
			<div class="layui-input-block">
				<input type="text" name="name"
					value="<?php echo $name; ?>"
					placeholder="请输入栏目名"
					class="layui-input"
			       lay-verify="required">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">父级</label>
			<div class="layui-input-block">
				<select name="pid">
					<?php foreach ($data_column_list as $v): ?>
						<option value="<?php echo $v['id']; ?>"
							<?php if ($v['id'] == $pid): ?>
							selected="selected"
							<?php endif;?>
						><?php echo $v['name']; ?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">排序</label>
			<div class="layui-input-block">
				<input type="text" name="sort"
				class="layui-input"
				lay-verify="required"
				value="<?php echo $sort; ?>">
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
		okUtils.ajax("/admincolumntype/ajaxAdd", "post", data.field, true)
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
