
<div class="container" style="width: 800px;padding-top: 100px;">

	<div class="panel panel-default">
	  <div class="panel-heading" style="text-align: center;">欢迎使用DD视频管理系统</div>
	  <p class="text-center" style="color:red;margin: 0px;">
	  	<?php if (isset($error)): echo $error;endif;?>
	  </p>

	  <div>
	    <ol class="breadcrumb">
	      <li>第一步</li>
	      <li><a href="#">数据库配置</a></li>
	    </ol>
	  </div>
	  <form action="" method="post">
	  <div class="panel-body">
	    <div class="form-horizontal">
		  <div class="form-group">
		    <label class="col-sm-2 control-label">数据库地址：</label>
		    <div class="col-sm-10">
		      <input type="text" name="db_host" class="form-control" value="<?php if (!empty($db_host)): echo $db_host;else:echo '127.0.0.1';endif;?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label class="col-sm-2 control-label">数据名：</label>
		    <div class="col-sm-10">
		      <input type="db_name" name="db_name"  class="form-control" value="<?php if (!empty($db_name)): echo $db_name;else:echo 'dd';endif;?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label class="col-sm-2 control-label">表前缀：</label>
		    <div class="col-sm-10">
		      <input type="db_pre" name="db_pre" class="form-control" value="<?php if (!empty($db_pre)): echo $db_pre;else:echo 'dd_';endif;?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label class="col-sm-2 control-label">用户名：</label>
		    <div class="col-sm-10">
		      <input type="db_user" name="db_user" class="form-control" value="<?php if (!empty($db_user)): echo $db_user;else:echo 'root';endif;?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">密  码：</label>
		    <div class="col-sm-10">
		      <input type="db_pwd" name="db_pwd" class="form-control" value="<?php if (!empty($db_pwd)): echo $db_pwd;else:echo 'root';endif;?>">
		    </div>
		  </div>
		</div>
	  </div>

	  <div>
	    <ol class="breadcrumb">
	      <li>第二步</li>
	      <li><a href="#">管理员配置</a></li>
	    </ol>
	  </div>
	  <div class="panel-body">

	    <div class="form-horizontal">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">账户名：</label>
		    <div class="col-sm-10">
		      <input type="text" name="username" class="form-control" value="<?php if (!empty($username)): echo $username;else:echo 'admin';endif;?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">密  码：</label>
		    <div class="col-sm-10">
		      <input type="text" name="password" class="form-control" value="<?php if (!empty($password)): echo $password;else:echo 'admin123';endif;?>">
		    </div>
		  </div>
		</div>
	  </div>
	  <input type="hidden" name="install" value="true">
	  <div class="panel-body">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default">安装</button>
	  	</div>
	  </div>
	  </form>

	</div>
</div>