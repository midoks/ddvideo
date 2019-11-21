<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon"/>
<title><?php if (isset($__title)): echo $__title;endif;?></title>
<meta name="keywords" content="<?php if (isset($__keyword)): echo $__keyword;endif;?>"/>
<meta name="description" content="<?php if (isset($__desc)): echo $__desc;endif;?>"/>
<link href="/assets/css/bootstrap.min.css?v=<?php echo $version; ?>" rel="stylesheet">
<link href="/assets/css/bootstrap-theme.min.css?v=<?php echo $version; ?>" rel="stylesheet">
<link href="/assets/css/main.css?v=<?php echo $version; ?>" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js?v=<?php echo $version; ?>"></script>
<!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
<!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
<!--[if lt IE 9]>
  <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
<![endif]-->

<?php if (isset($__statis)): echo $__statis;endif;?>
</head>
<body>


<div class="container" style="padding-top: 10px;">
    <div class="col-md-2 col-lg-2" style="text-align: center;">
        <img style="width: 60px; height: 60px; text-align: center;" src="/assets/images/logo.png" />
    </div>

    <div class="col-md-9 col-lg-9" style="padding-top: 18px;">
      <form class="ddvideo-sform" method="GET">
        <div class="input-group" id="search">
          <input  type="text" class="form-control x-kw"
          placeholder="搜索影片"
          value="<?php if (isset($__search_word)): echo $__search_word;endif;?>">
          <span class="input-group-btn">
            <input class="btn btn-default" type="submit" value="搜索"></input>
          </span>
        </div>
      </form>
    </div>


    <div class="col-md-1 hidden-sm hidden-xs" style="padding-top: 12px; font-size:12px;text-align: right;">
        <div class="row">今日更新:<?php echo $_statis_today; ?></div>
        <div class="row">影片总共有:<?php echo $_statis_all; ?></div>
        <div class="row"><a href="/message/receive.html">留言求片</a></div>
    </div>

</div>

<nav class="navbar navbar-default navbar-static-top" style="margin-top: 10px;">
    <div class="container">
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/"  target="_self">首页</a></li>
            <?php foreach ($_column_list as $key => $v): ?>
              <?php if ($v['type'] == '0'): ?>
              <li><a href="/column/i/<?php echo $v['id']; ?>.html" target="_self"><?php echo $v['name']; ?></a></li>
              <?php elseif ($v['type'] == '1'): ?>
              <li><a href="<?php echo $v['value']; ?>" target="_blank"><?php echo $v['name']; ?></a></li>
              <?php endif;?>
            <?php endforeach;?>
          </ul>
          <ul class="nav navbar-nav navbar-right hidden-xs">
            <li><a href="/about/us.html">关于</a></li>
          </ul>
        </div>
    </div>
</nav>

