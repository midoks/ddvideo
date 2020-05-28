
<link rel="stylesheet" href="/assets/css/oksub.css?v=<?php echo $version; ?>">
<script src="/assets/lib/layui/layui.js?v=<?php echo $version; ?>"></script>

<div class="container">
	<!--form表单-->
	<form class="layui-form layui-form-pane ok-form">
		<div class="layui-form-item layui-form-text">
			<label class="layui-form-label">请输入留言:</label>
			<div class="layui-input-block">
			<textarea name="msg" placeholder="请输入留言信息" class="layui-textarea" lay-verify="required"></textarea>
			</div>
		</div>
		<div class="layui-form-item">
			<button class="layui-btn" lay-submit lay-filter="add">留言</button>
		</div>
	</form>
</div>

<div class="container"><table class="layui-hide" id="tableId" lay-filter="tableFilter"></table></div>
<script>
layui.use(["table", "form", "laydate", "okLayer", "okUtils", "okMock"], function () {
	let table = layui.table;
	let form = layui.form;
	let util = layui.util;
	let laydate = layui.laydate;
	let okLayer = layui.okLayer;
	let okUtils = layui.okUtils;
	util.fixbar({});

	let msgTable = table.render({
		elem: "#tableId",
		url: "/message/lists",
		limit: 10,
		page: true,
		even: true,
		toolbar: "#toolbarTpl",
		size: "sm",
		cols: [[
			{field: "msg", title: "留言信息", width: 350},
			{field: "reply", title: "回复", width: 350},
			{field: "status", title: "状态", width: 80, align: "center", templet: "#statusTpl"},
			{field: "created_time", title: "留言时间", width: 150}
		]],
		done: function (res, curr, count) {
			// console.log(res, curr, count);
		}
	});


	form.on("submit(add)", function (data) {
		okUtils.isFrontendBackendSeparate = false;
		okUtils.ajax("/message/add", "post", data.field, true)
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


<!-- 状态-->
<script type="text/html" id="statusTpl">
	{{#  if(d.status == 1){ }}
	<span lay-event="triggerStatus" class="layui-btn layui-btn-normal layui-btn-xs">已处理</span>
	{{#  } else if(d.status == 0) { }}
	<span lay-event="triggerStatus" class="layui-btn layui-btn-warm layui-btn-xs">未处理</span>
	{{#  } }}
</script>
