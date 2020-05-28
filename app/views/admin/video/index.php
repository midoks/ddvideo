<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>留言列表</title>
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

	// okMock.api.listMessage
	let vTable = table.render({
		elem: "#tableId",
		url: "/adminvideo/lists",
		limit: 10,
		page: true,
		even: true,
		toolbar: "#toolbarTpl",
		size: "sm",
		cols: [[
			{type: "checkbox", fixed: "left"},
			{field: "id", title: "ID", width: 60, sort: true},
			{field: "name", title: "名字", width: 110},
			{field: "director", title: "导演", width: 100},
			{field: "up_time", title: "上映时间", width: 80},
			{field: "intro", title: "介绍", width: 100},
			{field: "status", title: "状态", width: 80, align: "center", templet: "#statusTpl"},
			{field: "updated_time", title: "更新时间", width: 150},
			{field: "created_time", title: "留言时间", width: 150},
			{title: "操作", width: 100, align: "center", fixed: "right", templet: "#operationTpl"}
		]],
		done: function (res, curr, count) {
			// console.log(res, curr, count)
		}
	});

	form.on("submit(search)", function (data) {
		vTable.reload({
			where: data.field,
			page: {curr: 1}
		});
		return false;
	});

	table.on("toolbar(tableFilter)", function (obj) {
		switch (obj.event) {
			case "batchDelete":
				batchDelete();
				break;
			case "add":
				add();
				break;
			case "addVideoById":
				addVideoById(data.id);
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
			case "add":
				add();
				break;
			case "addVideoById":
				addVideoById(data.id);
				break;
			case "triggerStatus":
				triggerStatus(data.id);
				break;
		}
	});

	function triggerStatus(id){
		okUtils.isFrontendBackendSeparate = false;
		okUtils.ajax("/adminvideo/ajaxTriggerStatus", "get", {id: id}, true)
		.done(function (response) {
			okUtils.tableSuccessMsg(response.msg);
			vTable.reload();
		}).fail(function (error) {
			// console.log(error);
		});
	}


	function batchDelete() {
		okLayer.confirm("确定要批量删除吗？", function (index) {
			layer.close(index);
			okUtils.isFrontendBackendSeparate = false;
			let idsStr = okUtils.tableBatchCheck(table);
			if (idsStr) {
				okUtils.ajax("/adminvideo/ajaxBatchDelete", "get", {ids: idsStr}, true)
				.done(function (response) {
					okUtils.tableSuccessMsg(response.msg);
				}).fail(function (error) {
					// console.log(error);
				});
			}
		});
	}

	function updateById(id) {
		okLayer.open("编辑", "/adminvideo/add.html?id=" + id, "90%", "90%", null, function () {
			vTable.reload();
		});
	}

	function addVideoById(id) {
		okLayer.open("资源列表", "/adminvideo/addPlay.html?id=" + id, "100%", "100%", null, function () {
			vTable.reload();
		});
	}

	function deleteById(id) {
		okLayer.confirm("确定要删除吗？", function () {
			okUtils.isFrontendBackendSeparate = false;
			okUtils.ajax("/adminvideo/ajaxDelete", "get", {id: id}, true)
			.done(function (response) {
				okUtils.tableSuccessMsg(response.msg);
			}).fail(function (error) {
				// console.log(error);
			});
		})
	}

	function add() {
		okLayer.open("添加", "/adminvideo/add.html", "90%", "90%", null, function () {
			vTable.reload();
		});
	}
});
</script>
<!-- 头工具栏模板 -->
<script type="text/html" id="toolbarTpl">
	<div class="layui-btn-container">
		<button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="batchDelete">删除</button>
		<button class="layui-btn layui-btn-sm" lay-event="add">添加</button>
	</div>
</script>
<!-- 行工具栏模板 -->
<script type="text/html" id="operationTpl">
	<a href="javascript:" title="资源" lay-event="addVideoById"><i class="layui-icon">&#xe665;</i></a>
	<a href="javascript:" title="编辑" lay-event="updateById"><i class="layui-icon">&#xe642;</i></a>
	<a href="javascript:" title="删除" lay-event="deleteById"><i class="layui-icon">&#xe640;</i></a>
</script>

<!-- 状态-->
<script type="text/html" id="statusTpl">
	{{#  if(d.status == 1){ }}
	<span lay-event="triggerStatus" class="layui-btn layui-btn-normal layui-btn-xs">已启用</span>
	{{#  } else if(d.status == 0) { }}
	<span lay-event="triggerStatus" class="layui-btn layui-btn-warm layui-btn-xs">未启用</span>
	{{#  } }}
</script>
</body>
</html>
