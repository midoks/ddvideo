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
				<input type="text" name="name" placeholder="请输入名称" class="layui-input" lay-verify="required" value="">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">播放地址</label>
			<div class="layui-input-block">
				<input type="text" name="play_addr" placeholder="请输入播放地址" class="layui-input" lay-verify="required" value="">
			</div>
		</div>


		<div class="layui-form-item">
			<label class="layui-form-label">资源来源</label>
			<div class="layui-input-block">
				<select name="sid">
					<option value="0">无设置</option>
					<?php foreach ($source_list as $v): ?>
					<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">排序</label>
			<div class="layui-input-block">
				<input type="text" name="sort" placeholder="请输入排序" class="layui-input" lay-verify="required" value="99">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">视频ID</label>
			<div class="layui-input-block">
				<input type="text" name="vid" placeholder="请输入视频ID"
					class="layui-input layui-disabled"
					lay-verify="required"
					value="<?php echo $data_vid; ?>">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">播放类型</label>
			<div class="layui-input-block">
				<select name="type">
					<option value="0">普通播放[m3u8]</option>
					<option value="1">分布式查询[m3u8]</option>
				</select>
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
<script src="/assets/lib/layui/layui.js?v=<?php echo $version; ?>"></script>
<script>
layui.use(["form", "okUtils", "okLayer"], function () {
	let form = layui.form;
	let okUtils = layui.okUtils;
	let okLayer = layui.okLayer;
	okLoading.close();

	form.on("submit(add)", function (data) {
		okUtils.isFrontendBackendSeparate = false;
		okUtils.ajax("/adminvideolist/ajaxAdd", "post", data.field, true).done(function (response) {
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
