<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DDVideo v<?php echo $version; ?> | 视频点播管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="DDVideo v<?php echo $version; ?> - 视频点播管理系统">
    <meta name="description" content="DDVideo v<?php echo $version; ?> - 视频点播管理系统">
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="/assets/css/okadmin.css?v=<?php echo $version; ?>">
</head>

<body class="layui-layout-body">

<!-- 更换主体 Eg:orange_theme|blue_theme -->
<div class="layui-layout layui-layout-admin okadmin blue_theme">
    <!--头部导航-->
    <div class="layui-header okadmin-header">
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item">
                <a class="ok-menu ok-show-menu" href="javascript:" title="菜单切换">
                    <i class="layui-icon layui-icon-shrink-right"></i>
                </a>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a class="ok-refresh" href="javascript:" title="刷新">
                    <i class="layui-icon layui-icon-refresh-3"></i>
                </a>
            </li>

              <!-- 全屏 -->
            <li class="layui-nav-item layui-hide-xs">
                <a id="fullScreen" class=" pr10 pl10" href="javascript:">
                    <i class="layui-icon layui-icon-screen-full"></i>
                </a>
            </li>

            <li class="no-line layui-nav-item">
                <a href="javascript:"><img src="/assets/images/avatar.png" class="layui-nav-img">用户</a>
                <dl id="userInfo" class="layui-nav-child">
                    <dd><a lay-id="u-2" href="javascript:" id="reUserInfo">基本资料</a></dd>
                    <dd><a lay-id="u-4" href="javascript:" id="rePwd">修改密码</a></dd>
                    <dd><hr/></dd>
                    <dd><a href="javascript:void(0)" id="logout">退出登录</a></dd>
                </dl>
            </li>
        </ul>
    </div>
    <!--遮罩层-->
    <div class="ok-make"></div>
    <!--左侧导航区域-->
    <div class="layui-side layui-side-menu okadmin-bg-20222A ok-left">
        <div class="layui-side-scroll okadmin-side">
            <div class="okadmin-logo">DDVideo v<?php echo $version; ?></div>
            <div class="user-photo">
                <a class="img" title="我的头像">
                    <img src="/assets/images/avatar.png" class="userAvatar">
                </a>
                <p>你好！<span class="userName"><?php echo $_userinfo['nick']; ?></span>, 欢迎登录</p>
            </div>
            <!--左侧导航菜单-->
            <ul id="navBar" class="layui-nav okadmin-nav okadmin-bg-20222A layui-nav-tree">
                <li class="layui-nav-item layui-this">
                    <a href="javascript:" lay-id="1" data-url="/admin/console.html">
                        <i is-close=false class="ok-icon">&#xe654;</i>控制台
                    </a>
                </li>
            </ul>
        </div>
    </div>