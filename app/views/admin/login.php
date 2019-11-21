<!DOCTYPE html>
<html lang="en" class="page-fill">
<head>
    <meta charset="UTF-8">
    <title>DDVideo v1.0 | 很赞的视频点播管理系统 - 登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="DDVideo v1.0 | 很赞的视频点播管理系统">
    <meta name="description" content="DDVideo v1.0 | 很赞的视频点播管理系统">
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="/assets/css/oksub.css?v=<?php echo $version; ?>"/>
</head>
<body class="page-fill">
<div class="page-fill" id="login">
    <form class="layui-form">
        <div class="login_face"><img src="/assets/images/logo.png"></div>
        <div class="layui-form-item input-item">
            <label for="username">用户名</label>
            <input type="text" lay-verify="required" name="username" placeholder="请输入账号" autocomplete="off" id="username" class="layui-input">
        </div>
        <div class="layui-form-item input-item">
            <label for="password">密码</label>
            <input type="password" lay-verify="required|password" name="password" placeholder="请输入密码" autocomplete="off" id="password" class="layui-input">
        </div>
        <div class="layui-form-item input-item captcha-box">
            <label for="captcha">验证码</label>
            <input type="text" lay-verify="required|captcha" name="captcha" placeholder="请输入验证码" autocomplete="off" id="captcha" maxlength="4" class="layui-input">
            <div class="img ok-none-select" id="captchaImg"></div>
        </div>
        <div class="layui-form-item">
            <button class="layui-btn layui-block" lay-filter="login" lay-submit="">登录</button>
        </div>
    </form>
</div>
<!--js逻辑-->
<script src="/assets/lib/layui/layui.js"></script>
<script>
layui.use(["form", "okGVerify", "okUtils", "okLayer"], function () {
    let form = layui.form;
    let $ = layui.jquery;
    let okGVerify = layui.okGVerify;
    let okUtils = layui.okUtils;
    let okLayer = layui.okLayer;

    /**
     * 初始化验证码
     */
    let verifyCode = new okGVerify("#captchaImg");

    /**
     * 数据校验
     */
    form.verify({
        password: [/^[\S]{6,12}$/, "密码必须6到12位，且不能出现空格"],
        captcha: function (val) {
            if (verifyCode.validate(val) != "true") {
                return verifyCode.validate(val)
            }
        }
    });

     /**
     * 表单input组件单击时
     */
    $("#login .input-item .layui-input").click(function (e) {
        e.stopPropagation();
        $(this).addClass("layui-input-focus").find(".layui-input").focus();
    });

    /**
     * 表单input组件获取焦点时
     */
    $("#login .layui-form-item .layui-input").focus(function () {
        $(this).parent().addClass("layui-input-focus");
    });

    /**
     * 表单input组件失去焦点时
     */
    $("#login .layui-form-item .layui-input").blur(function () {
        $(this).parent().removeClass("layui-input-focus");
        if ($(this).val() != "") {
            $(this).parent().addClass("layui-input-active");
        } else {
            $(this).parent().removeClass("layui-input-active");
        }
    });

    /**
     * 表单提交
     */
    form.on("submit(login)", function (data) {
        okUtils.isFrontendBackendSeparate = false;
        okUtils.ajax("/adminlogin/index.html", "post", data.field, true)
        .done(function (response) {
            okLayer.greenTickMsg(response.msg, function () {
                window.location = "/admin/index.html";
            })
        }).fail(function (error) {
            console.log(error)
        });
        return false;
    });

});
</script>
</body>
</html>
