<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>列表</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/assets/css/oksub.css?v=<?php echo $version; ?>">
	<script type="text/javascript" src="/assets/lib/loading/okLoading.js?v=<?php echo $version; ?>"></script>
</head>
<body>
<div class="ok-body">

<hr />
<table class="layui-hide" id="tableId" lay-filter="tableFilter"></table>
</div>
<!--js逻辑-->
<script src="/assets/lib/layui/layui.js"></script>
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

	let videoTable = table.render({
		elem: "#tableId",
		url: "/adminvideolist/lists?vid={vid}",
		limit: 10,
		page: true,
		even: true,
		toolbar: "#toolbarTpl",
		size: "sm",
		cols: [[
			{type: "checkbox", fixed: "left"},
			{field: "id", title: "ID", width: 60, sort: true},
			{field: "name", title: "名字", width: 110},
			{field: "type", title: "播放类型", width: 140,  templet: "#typeTpl"},
			{field: "play_addr", title: "播放地址", width: 200},
			{field: "updated_time", title: "更新时间", width: 150},
			{field: "created_time", title: "创建时间", width: 150},
			{title: "操作", width: 100, align: "center", fixed: "right", templet: "#operationTpl"}
		]],
		done: function (res, curr, count) {
			// console.log(res, curr, count)
		}
	});

	form.on("submit(search)", function (data) {
		articleTable.reload({
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
		}
	});

	function batchDelete() {
		okLayer.confirm("确定要批量删除吗？", function (index) {
			layer.close(index);
			let idsStr = okUtils.tableBatchCheck(table);
			if (idsStr) {
				okUtils.isFrontendBackendSeparate = false;
				okUtils.ajax("/adminvideolist/ajaxBatchDelete", "get", {ids: idsStr}, true)
				.done(function (response) {
					okUtils.tableSuccessMsg(response.msg);
				}).fail(function (error) {
					// console.log(error);
				});
			}
		});
	}

	function updateById(id) {
		okLayer.open("编辑视频", "/adminvideolist/add.html?id=" + id, "90%", "90%", null, function () {
			videoTable.reload();
		})
	}

	function deleteById(id) {
		okLayer.confirm("确定要删除吗？", function () {
			okUtils.isFrontendBackendSeparate = false;
			okUtils.ajax("/adminvideolist/ajaxDelete", "get", {id: id}, true)
			.done(function (response) {
				okUtils.tableSuccessMsg(response.msg);
			}).fail(function (error) {
				// console.log(error);
			});
		})
	}

	function add() {
		okLayer.open("添加", "/adminvideolist/add.html?vid={vid}", "90%", "90%", null, function () {
			videoTable.reload();
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
<!-- 行工具栏模板 -->

<!-- 行工具栏模板 -->
<script type="text/html" id="operationTpl">
	<a href="javascript:" title="编辑" lay-event="updateById"><i class="layui-icon">&#xe642;</i></a>
	<a href="javascript:" title="删除" lay-event="deleteById"><i class="layui-icon">&#xe640;</i></a>
</script>

<!-- 类型模板 -->
<script type="text/html" id="typeTpl">
	{{#  if(d.type == 1){ }}
	<span class="layui-btn layui-btn-normal layui-btn-xs">分布式查询[m3u8]</span>
	{{#  } else if(d.type == 0) { }}
	<span class="layui-btn layui-btn-warm layui-btn-xs">普通播放[m3u8]</span>
	{{#  } }}
</script>

<script type="text/html" id="operationTpl">
	<a href="javascript:" title="编辑" lay-event="updateById"><i class="layui-icon">&#xe642;</i></a>
	<a href="javascript:" title="删除" lay-event="deleteById"><i class="layui-icon">&#xe640;</i></a>
</script>

</body>
</html>
