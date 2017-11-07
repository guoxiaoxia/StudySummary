<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">

<meta name="apple-mobile-web-app-capable" content="yes">

<meta name="apple-mobile-web-app-status-bar-style" content="black">

<meta name="format-detection" content="telephone=no">
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php echo $d_title?></title>
<meta name="keywords" content="<?php echo $d_keywords;?>" />
<meta name="description" content="<?php echo $d_description;?>" />
<?php include('inc_head.php');?>
</head>
<body>
<?php include ('inc_header.php');?>
<div id="content">
	<div class="container">
		<div class="line-big">
			<div class="x12">
				<h1 id="detail_name"><?php echo $d_name?></h1>
				<div id="detail_intro" class="quote">来源：<?php echo $d_source?> 作者：<?php echo $d_author?> 发布日期：<?php echo date('Y-m-d',$d_date)?> 访问次数：<?php echo $d_hits?></div>
				<?php if($d_picture != '' && $d_slideshow == ''){ ?>
				<div id="detail_picture"><a href="<?php echo $d_picture ?>" target="_blank"><img src="<?php echo $d_picture?>" alt="<?php echo $d_name?>" title="<?php echo $d_name?>"></a></div>
				<?php } ?>
				<?php if($d_slideshow != ''){ ?>
				<div id="detail_slideshow">
					<script type="text/javascript">
					$(function(){
						$('#detail_slideshow').slide({
							trigger : 'click',
							effect : 'fade'
						});
					});
					</script>
					<ul class="bd">
					<?php
					$arr_slideshow = explode('|',$d_slideshow);
					foreach($arr_slideshow as $value){
						echo '<li><img src="'.$value.'"></li>';
					}
					?>
					</ul>
					<ul class="hd line-small">
					<?php
					foreach($arr_slideshow as $value){
						echo '<li class="x2"><img src="'.$value.'"></li>';
					}
					?>
					</ul>
				</div>
				<?php } ?>
				<?php if ($d_video != '' ){ ?>
				<div id="detail_video"><?php echo $d_video ?></div>
				<?php }?>
				<div id="detail_content"><?php echo $d_content;?></div>
				<?php if ( $d_file != '' ) { ?>
				<div id="detail_attachment"><a class="btn bg-main" href="<?php echo $d_file ?>">点击下载</a></div>
				<?php } ?>
				<div id="detail_around" class="quote">
					<p>上一<?php echo $c_sname?>：<?php echo $d_previous?></p>
					<p>下一<?php echo $c_sname?>：<?php echo $d_next?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('inc_footer.php');?>
</body>
</html>
