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
				<input type="text" name="name" placeholder="请输入名称" autocomplete="off" class="layui-input"
				       lay-verify="required" value="">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">栏目</label>
			<div class="layui-input-block">
				<select name="col_id" lay-filter="col_id">
					<?php foreach ($data_column_list as $v): ?>
						<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">影片类型</label>
			<div class="layui-input-block">
				<select name="col_type" id="col_type">
					<option value="0">无设置</option>
				</select>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">导演</label>
			<div class="layui-input-block">
				<input type="text" name="director" placeholder="请输入导演" autocomplete="off" class="layui-input" lay-verify="required" value="">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">演员</label>
			<div class="layui-input-block">
				<input type="text" name="actor" placeholder="请输入演员" autocomplete="off" class="layui-input" lay-verify="required" value="">
			</div>
		</div>


		<div class="layui-form-item">
			<label class="layui-form-label">上映日期</label>
			<div class="layui-input-block">
				<input type="text" name="up_time" placeholder="请输入上映日期" autocomplete="off" class="layui-input" lay-verify="required" value="2019">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">图片地址</label>
			<div class="layui-input-block">
				<input type="text" name="image_path" placeholder="请输入图片地址"  class="layui-input" value="">
			</div>
		</div>

		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">内容简介</label>
			<div class="layui-input-block">
				<textarea name="intro" placeholder="请输入内容简介" class="layui-textarea" lay-verify="required" ></textarea>
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
	let $ = layui.jquery;
	let form = layui.form;
	let okUtils = layui.okUtils;
	let okLayer = layui.okLayer;
	okUtils.isFrontendBackendSeparate = false;
	okLoading.close();

	form.on('select(col_id)', function(data){
		okUtils.ajax("/admincolumntype/ajaxGetListByPid", "post", {'pid':data.value}, true)
		.done(function (response) {
			let list_data = response.data;
			$('#col_type').html('');
			var txt = "<option value='0'>无设置</option>";
			$('#col_type').append(txt);
			if (typeof list_data != 'undefined'){
				for (var i = 0; i < list_data.length; i++) {
					var txt = "<option value='"+list_data[i]['id']+"'>"+list_data[i]['name']+"</option>";
					$('#col_type').append(txt);
				}
			}
			form.render('select');
		}).fail(function (error) {
			// console.log(error)
		});
	});


	form.on("submit(add)", function (data) {
		okUtils.ajax("/adminvideo/ajaxAdd", "post", data.field, true).done(function (response) {
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
