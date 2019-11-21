
<div class="container" id="crumb">
    <ol class="breadcrumb">
      <li>当前位置</li>
      <li><a href="#" target="_self"><?php echo $data_column['name']; ?></a></li>
    </ol>
</div>

<div class="container" style="padding-top: 10px;">
  <div class="table-responsive">
    <table id="table-video-list" class="table table-bordered table-striped">
      <colgroup>
        <col class="col-xs-8">
        <col class="col-xs-2">
        <col class="col-xs-2">
      </colgroup>
      <thead>
      	<tr>
      		<th>影片名</th>
      		<th>影片类型</th>
      		<th>更新时间</th>
      	</tr>
      </thead>
      <tbody>
	  	<?php foreach ($data_video_list as $v): ?>
	  	<tr>
	      <td><a href="/video/i/<?php echo $v['id']; ?>.html" target="_blank"><?php echo $v['name']; ?></a>  </td>
	      <td><?php echo $v['col_type_name']; ?></td>
	      <td><?php echo $v['updated_time']; ?></td>
	    </tr>
	    <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>


<div class="container" style="text-align: center;">
  <nav aria-label="">
      <ul class="pagination" style="margin-top: 0px;margin-bottom: 0px;">
        <?php echo $data_page_nav; ?>
      </ul>
    </nav>
</div>

