<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>日志列表</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/assets/css/oksub.css?v=<?php echo $version; ?>">
	<script type="text/javascript" src="/assets/lib/loading/okLoading.js?v=<?php echo $version; ?>"></script>
</head>
<body>
<div class="ok-body">
	<!--数据表格-->
	<table class="layui-hide" id="tableId" lay-filter="tableFilter"></table>
</div>
<!--js逻辑-->
<script src="/assets/lib/layui/layui.js?v=<?php echo $version; ?>"></script>
<script>
layui.use(["table", "form", "laydate", "okLayer", "okUtils", "okMock"], function () {
	var $ = layui.jquery;
	let table = layui.table;
	let form = layui.form;
	let util = layui.util;
	let laydate = layui.laydate;
	let okLayer = layui.okLayer;
	let okUtils = layui.okUtils;
	let okMock = layui.okMock;
	okLoading.close();
	util.fixbar({});

	laydate.render({elem: "#startTime", type: "datetime"});
	laydate.render({elem: "#endTime", type: "datetime"});


	let cTable = table.render({
		elem: "#tableId",
		url: "/adminserver/lists",
		limit: 10,
		page: true,
		even: true,
		toolbar: "#toolbarTpl",
		size: "sm",
		cols: [[
			{type: "checkbox", fixed: "left"},
			{field: "id", title: "ID", width: 70, sort: true},
			{field: "addr", title: "地址", width: 100},
			{field: "status", title: "状态", width: 80, templet: "#statusTpl"},
			{field: "updated_time", title: "更新时间", width: 150},
			{field: "created_time", title: "创建时间", width: 150},
			{title: "操作", width: 100, align: "center", fixed: "right", templet: "#operationTpl"}
		]],
		done: function (res, curr, count) {
			// console.log(res, curr, count)
		}
	});

	form.on("submit(search)", function (data) {
		cTable.reload({
			where: data.field,
			page: {curr: 1}
		});
		return false;
	});

	table.on("toolbar(tableFilter)", function (obj) {
		switch (obj.event) {
			case "add":
				add();
				break;
		}
	});

	table.on("tool(tableFilter)", function (obj) {
		let data = obj.data;
		switch (obj.event) {
			case "updateById":
				updateById(data.id);
				break;
			case "deleteById":
				deleteById(data.id);
				break;
			case "triggerStatus":
				triggerStatus(data.id);
				break;
		}
	});


	function triggerStatus(id){
		okUtils.isFrontendBackendSeparate = false;
		okUtils.ajax("/adminserver/ajaxTriggerStatus", "get", {id: id}, true)
		.done(function (response) {
			okUtils.tableSuccessMsg(response.msg);
			cTable.reload();
		}).fail(function (error) {
			// console.log(error);
		});
	}


	function deleteById(id) {
		okLayer.confirm("确定要删除吗？", function () {
			okUtils.isFrontendBackendSeparate = false;
			okUtils.ajax("/adminserver/ajaxDelete", "get", {id: id}, true)
			.done(function (response) {
				okUtils.tableSuccessMsg(response.msg);
			}).fail(function (error) {
				// console.log(error);
			});
		});
	}

	function updateById(id) {
		okLayer.open("编辑", "/adminserver/add.html?id=" + id, "60%", "70%", null, function () {
			cTable.reload();
		});
	}

	function add() {
		okLayer.open("添加", "/adminserver/add.html", "60%", "80%", null, function () {
			cTable.reload();
		});
	}
});

</script>

<!-- 头工具栏模板 -->
<script type="text/html" id="toolbarTpl">
	<div class="layui-btn-container">
		<button class="layui-btn layui-btn-sm" lay-event="add">添加</button>
	</div>

</script>


<!-- 类型模板 -->
<script type="text/html" id="typeTpl">
	{{#  if(d.type == 1){ }}
	<span  class="layui-btn layui-btn-normal layui-btn-xs">外链</span>
	{{#  } else if(d.type == 0) { }}
	<span class="layui-btn layui-btn-warm layui-btn-xs layui-status">基本</span>
	{{#  } }}
</script>

<!-- 状态模板 -->
<script type="text/html" id="statusTpl">
	{{#  if(d.status == 1){ }}
	<span lay-event="triggerStatus" class="layui-btn layui-btn-normal layui-btn-xs">已启用</span>
	{{#  } else if(d.status == 0) { }}
	<span lay-event="triggerStatus" class="layui-btn layui-btn-warm layui-btn-xs layui-status">未启用</span>
	{{#  } }}
</script>


<!-- 行工具栏模板 -->
<script type="text/html" id="operationTpl">
	<a href="javascript:" title="编辑" lay-event="updateById"><i class="layui-icon">&#xe642;</i></a>
	<a href="javascript:" title="删除" lay-event="deleteById"><i class="layui-icon">&#xe640;</i></a>
</script>

</body>
</html>
