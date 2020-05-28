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
    <form class="layui-form layui-form-pane ok-form">

        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="username"
                class="layui-input layui-disabled"
                lay-verify="required"
                value="<?php echo $_userinfo['username']; ?>">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">昵称</label>
            <div class="layui-input-block">
                <input type="text" name="nick" placeholder="请输入文章标签" class="layui-input" lay-verify="required"
                value="<?php echo $_userinfo['nick']; ?>">
            </div>
        </div>

        <input type="hidden" name="id" value="<?php echo $_userinfo['id']; ?>">
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
    okLoading.close();

    form.on("submit(add)", function (data) {
        okUtils.isFrontendBackendSeparate = false;
        okUtils.ajax("/adminuser/ajaxUpdate", "post", data.field, true)
        .done(function (response) {
            okLayer.greenTickMsg(response.msg, function () {
                parent.layer.close(parent.layer.getFrameIndex(window.name));
                parent.location.reload();
            });
        }).fail(function (error) {
            console.log(error)
        });
        return false;
    });
});
</script>
</body>
</html>
