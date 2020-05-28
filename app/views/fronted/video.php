<div class="container" id="crumb">
    <ol class="breadcrumb">
      <li>当前位置</li>
      <li><a href="#" target="_self"><?php echo $data_column['name']; ?></a></li>
      <li><a href="#" target="_self"><?php echo $data_video['name']; ?></a></li>
    </ol>
</div>


<div class="container" style="padding-top: 5px;">

  <div class="table-responsive">
    <table class="table">
      <colgroup>
        <col class="col-xs-2 col-md-1">
        <col class="col-xs-10 col-md-11">
        <col class="col-xs-12 hidden-xs">
      </colgroup>
      <tbody>
        <tr>
          <td>
            <a href="/video/i/.html" target="_blank">
              <img style="width: 135px;height: 189px;" class="lazy" src="<?php echo $data_video['image_path']; ?>">
            </a>
            </td>
          <td>
            <div><h2 style="padding-top:0px;margin-top:0px;">
              <?php echo $data_video['name']; ?></h2>
            </div>
            <div>导演:<?php echo $data_video['director']; ?></div>
            <div>演员:<?php echo $data_video['actor']; ?></div>
            <div>上映日期:<?php echo $data_video['up_time']; ?></div>
            <div>内容简介:<?php echo $data_video['intro']; ?></div>
          </td>
          <td class="hidden-xs">
            <!-- <img src="//placehold.it/100x100"> -->
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="container" style="padding-top: 15px;">

    <?php if (count($data_video_list) > 1): ?>
        <?php foreach ($data_video_list as $v): ?>
        <div class="panel panel-default">
          <div class="panel-heading">播放资源@<?php echo $v['source_name']; ?></div>
          <div class="panel-body">

            <?php foreach ($v['list'] as $vv): ?>
            <div style="float:left;margin-right:10px;padding:8px;border: 1px solid #ccc;">
               <a href="/video/ii/<?php echo $vv['id']; ?>.html"><?php echo $vv['name']; ?></a>
            </div>
            <?php endforeach;?>

          </div>
        </div>
        <?php endforeach;?>
    <?php elseif (count($data_video_list) == 1): ?>
        <?php foreach ($data_video_list as $v): ?>
        <div class="panel panel-default">
          <div class="panel-heading">播放资源</div>
          <div class="panel-body">
            <?php foreach ($v['list'] as $vv): ?>
            <div style="float:left;margin-right:10px;padding:8px;border: 1px solid #ccc;">
                <a href="/video/ii/<?php echo $vv['id']; ?>.html"><?php echo $vv['name']; ?></a>
            </div>
            <?php endforeach;?>
          </div>
        </div>
        <?php endforeach;?>
    <?php endif;?>

</div>

