<hr />

<div class="container">
	<div class="footer" style="text-align: center;padding: 0px;margin: 0px;">
		<p><a href="/about/us.html">关于我们</a>&nbsp; | &nbsp; <a href="" target="_self">注高清影视大全</a>&nbsp;</p>
		<p>本站所有内容均来自互联网，如果本站部分内容侵犯您的版权请告知，在必要证明文件下我们第一时间撤除</p>
		<p>Copyright ©2020-2021  All Rights Reserved</p>
	</div>
</div>



<script src="/assets/js/bootstrap.min.js?v=<?php echo $version; ?>"></script>
<script src="/assets/js/ddvideo.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript">
$('.ddvideo-sform').submit(function(e){
    e.preventDefault();
    var kw = $('.x-kw').val();
    if(!kw){
        $('.x-kw').focus();
        return false;
    }

    var url = '/search/w/' + encodeURIComponent(kw) + '.html';
    window.location = url;
    return false;
});
</script>
</body>
</html>