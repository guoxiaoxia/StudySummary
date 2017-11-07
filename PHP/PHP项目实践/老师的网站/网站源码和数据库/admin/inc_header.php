<script type="text/javascript">
$(function(){
	$('.main_nav').mouseover(function(){
		$(this).find('ul').show();
	});
	$('.main_nav').mouseleave(function(){
		$(this).find('ul').hide();
	});
});
</script>

<div id="header">
	<div class="container">
		<div class="line">
			<div class="x6 name" >网站管理系统</div>
			<div class="x6 ar menu" >
				<a class="btn bg-dot" href="cms_welcome.php" ><span class="icon-home"> 后台首页</span></a>
				<a class="btn bg-dot" href="exit.php" onClick="return confirm('确定要退出吗？')"><span class="icon-sign-out"> 安全退出</span></a>
				<a class="btn bg-dot" href="../" target="_blank"><span class="icon-eye"> 预览网站</span></a>
			</div>
		</div>
	</div>
</div>
