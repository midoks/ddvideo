<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/p2p-dplayer@latest/dist/DPlayer.min.css">
<script src="//cdn.bootcss.com/hls.js/0.8.5/hls.js"></script>

<!-- <script src="/assets/dplayer/DPlayer.min.js"></script> -->
<!-- <script src="//cdn.jsdelivr.net/npm/dplayer/dist/DPlayer.min.js"></script> -->

<script src="//cdn.jsdelivr.net/npm/cdnbye@latest"></script>
<script src="//cdn.jsdelivr.net/npm/p2p-dplayer@latest"></script>


<div class="container" id="crumb">
    <ol class="breadcrumb">
      <li>当前位置</li>
      <li><a href="#" target="_self"><?php echo $data_column['name']; ?></a></li>
      <li><a href="#" target="_self"><?php echo $data_video['name']; ?></a></li>
      <li><a href="#" target="_self"><?php echo $data_video_seleced['name']; ?></a></li>
    </ol>
</div>


<div class="container" style="padding-top: 5px;">
    <div id="dplayer"></div>
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


<script type="text/javascript">


const dp = new DPlayer({
    container: document.getElementById('dplayer'),
    autoplay: true,
    preload:'auto',
});

function createPlayer(url){

    dp.switchVideo({
        url: url,
        type: 'auto',
    });
    // dp.play();

    dp.on('loadeddata', function(){
    });

    dp.on('loadedmetadata', function(){
    });

    dp.on('error', function(){
       console.log(this);
    });

    dp.on('ended', function() {
        console.log('player ended');
    });
}


function createVideo(value, type){
if (type == "1"){
    $.post('/api/search',{v:value}, function(data){
        if (data.code==0){
            createPlayer(data.data['url']);
        } else {
            console.log(data);
        }
    });
    return;
}
createPlayer(value);
}

$(document).ready(function(){
    createVideo('<?php echo $data_video_select['play_addr']; ?>',
        '<?php echo $data_video_select['type']; ?>');
});

</script>
