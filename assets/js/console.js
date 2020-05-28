"use strict";
layui.use(["okUtils", "table", "okCountUp", "okMock"], function () {
    var countUp = layui.okCountUp;
    var table = layui.table;
    var okUtils = layui.okUtils;
    var okMock = layui.okMock;
    var $ = layui.jquery;
    okLoading.close();
    /**
     * 总数统计
     */
    function statText() {
        okUtils.isFrontendBackendSeparate = false;
        okUtils.ajax("/admin/ajaxConsole", "get", {}, true)
        .done(function (response) {
            $(".c-logs-num").text(response.data['logs_num']);
            $(".c-message-num").text(response.data['message_num']);
            $(".c-video-num").text(response.data['video_num']);
            $(".c-user-num").text(response.data['user_num']);
            okUtils.tableSuccessMsg(response.msg);
        }).fail(function (error) {
            console.log(error);
        });
    }

    /**
     * 所有用户
     */
    function logsList() {
        table.render({
            method: "get",
            url: "/adminlogs/lists",
            elem: '#userData',
            height: 280,
            page: true,
            limit: 5,
            cols: [[
                {field: "id", title: "ID", width: 100},
                {field: "type", title: "类型", width: 100},
                {field: "msg", title: "内容", width: 500},
                {field: "created_time", title: "创建时间", width: 180}
            ]]
        });
    }

    statText();
    logsList();
});


