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
		let articleTable = table.render({
			elem: "#tableId",
			url: "/adminlogs/lists",
			limit: 10,
			page: true,
			even: true,
			toolbar: "#toolbarTpl",
			size: "sm",
			cols: [[
				{type: "checkbox", fixed: "left"},
				{field: "id", title: "ID", width: 70, sort: true},
				{field: "type", title: "类型", width: 100},
				{field: "msg", title: "内容", width: 400},
				{field: "created_time", title: "记录时间", width: 150},
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
			}
		});

		function batchDelete() {
			okLayer.confirm("确定要批量删除吗？", function (index) {
				layer.close(index);
				okUtils.isFrontendBackendSeparate = false;
				let idsStr = okUtils.tableBatchCheck(table);
				if (idsStr) {
					okUtils.ajax("/adminlogs/ajaxBatchDelete", "get", {ids: idsStr}, true)
					.done(function (response) {
						okUtils.tableSuccessMsg(response.msg);
					}).fail(function (error) {
						// console.log(error);
					});
				}
			});
		}

		function deleteById(id) {
			okLayer.confirm("确定要删除吗？", function () {
				okUtils.isFrontendBackendSeparate = false;
				okUtils.ajax("/adminlogs/ajaxDelete", "get", {id: id}, true)
				.done(function (response) {
					okUtils.tableSuccessMsg(response.msg);
				}).fail(function (error) {
					// console.log(error);
				});
			});
		}
	});
</script>

<!-- 头工具栏模板 -->
<script type="text/html" id="toolbarTpl">
	<div class="layui-btn-container">
		<div class="layui-inline" lay-event="batchDelete"><i class="layui-icon">&#xe640;</i></div>
	</div>
</script>
<!-- 行工具栏模板 -->
<script type="text/html" id="operationTpl">
	<a href="javascript:" title="删除" lay-event="deleteById"><i class="layui-icon">&#xe640;</i></a>
</script>

</body>
</html>
