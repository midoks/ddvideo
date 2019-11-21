<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加视频</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/assets/css/oksub.css?v=<?php echo $version; ?>">
	<script type="text/javascript" src="/assets/lib/loading/okLoading.js?v=<?php echo $version; ?>"></script>
</head>
<body>
<div class="ok-body">
	<!--form表单-->
	<form class="layui-form layui-form-pane ok-form">
		<div class="layui-form-item">
			<label class="layui-form-label">视频名</label>
			<div class="layui-input-block">
				<input type="text" name="name" placeholder="请输入视频名" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $name; ?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">栏目</label>
			<div class="layui-input-block">
				<select name="col_id" lay-filter="col_id">
					<?php foreach ($data_column_list as $v): ?>
						<option value="<?php echo $v['id']; ?>"
							<?php if ($v['id'] == $col_id): ?>
							selected="selected"
							<?php endif;?>
						><?php echo $v['name']; ?></option>
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
				<input type="text" name="director" placeholder="请输入导演名称" class="layui-input" lay-verify="required" value="<?php echo $director; ?>">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">演员</label>
			<div class="layui-input-block">
				<input type="text" name="actor" placeholder="请输入演员,用,分割" class="layui-input" lay-verify="required" value="<?php echo $actor; ?>">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">上映日期</label>
			<div class="layui-input-block">
				<input type="text" name="up_time" placeholder="请输入上映日期" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $up_time; ?>">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">图片地址</label>
			<div class="layui-input-block">
				<input type="text" name="image_path" placeholder="请输入图片地址"  class="layui-input" value="<?php echo $image_path; ?>">
			</div>
		</div>

		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">内容简介</label>
			<div class="layui-input-block">
				<textarea name="intro" placeholder="请输入文章简介" class="layui-textarea" lay-verify="required" ><?php echo $intro; ?></textarea>
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
	let $ = layui.jquery;
	let form = layui.form;
	let okUtils = layui.okUtils;
	let okLayer = layui.okLayer;
	okUtils.isFrontendBackendSeparate = false;
	okLoading.close();


	renderPid('<?php echo $col_id ?>','<?php echo $col_type; ?>');
	function renderPid(pid, selectId){
		// console.log(pid, selectId);
		okUtils.ajax("/admincolumntype/ajaxGetListByPid", "post", {'pid':pid}, true)
		.done(function (response) {
			let list_data = response.data;
			$('#col_type').html('');
			var txt = "<option value='0'>无设置</option>";
			$('#col_type').append(txt);
			if (typeof list_data != 'undefined'){
				for (var i = 0; i < list_data.length; i++) {
					var txt = '';
					if ( list_data[i]['id'] == selectId ){
						txt = "<option value='"+list_data[i]['id']+"' selected='selected'>"+list_data[i]['name']+"</option>";
					} else {
						txt = "<option value='"+list_data[i]['id']+"'>"+list_data[i]['name']+"</option>";
					}
					$('#col_type').append(txt);
				}
			}
			form.render('select');
		}).fail(function (error) {
			// console.log(error)
		});
	}


	form.on('select(col_id)', function(data){
		// console.log(data);
		renderPid(data.value);
	});

	form.on("submit(add)", function (data) {
		console.log(data);
		okUtils.ajax("/adminvideo/ajaxadd", "post", data.field, true).done(function (response) {
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
