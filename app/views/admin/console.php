<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="/assets/css/oksub.css?v=<?php echo $version; ?>" media="all"/>
	<script type="text/javascript" src="/assets/lib/loading/okLoading.js?v=<?php echo $version; ?>"></script>
	<script type="text/javascript" src="/assets/lib/echarts/echarts.min.js?v=<?php echo $version; ?>"></script>
	<script type="text/javascript" src="/assets/lib/echarts/echarts.theme.js?v=<?php echo $version; ?>"></script>
	<script type="text/javascript" src="/assets/lib/echarts/world/js/china.js?v=<?php echo $version; ?>"></script>
</head>
<body class="ok-body-scroll console">
<div class="ok-body home">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="/assets/images/home-01.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text c-logs-num">0</div>
						<div class="stat-heading">日志</div>
					</div>
				</div>
			</div>
		</div>

		<div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card ">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="/assets/images/home-02.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text c-message-num">0</div>
						<div class="stat-heading">留言</div>
					</div>
				</div>
			</div>
		</div>

		<div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="/assets/images/home-03.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text c-video-num">0</div>
						<div class="stat-heading">视频资源</div>
					</div>
				</div>
			</div>
		</div>

		<div class="layui-col-xs6 layui-col-md3">
			<div class="layui-card">
				<div class="ok-card-body">
					<div class="img-box" ok-pc-in-show>
						<img src="/assets/images/home-04.png" alt="none"/>
					</div>
					<div class="cart-r">
						<div class="stat-text c-user-num">0</div>
						<div class="stat-heading">用户</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="layui-card">
				<div class="layui-card-header">
					<div class="ok-card-title">最近日志</div>
				</div>

				<div class="ok-card-body ">
					<table id="userData" lay-filter="userdata"></table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="/assets/lib/layui/layui.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript" src="/assets/js/console.js?v=?v=<?php echo $version; ?>"></script>