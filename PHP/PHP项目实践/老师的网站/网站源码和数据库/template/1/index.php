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
<title><?php echo $system_name.'-'.$system_seoname?></title>
<meta name="keywords" content="<?php echo $system_keywords;?>" />
<meta name="description" content="<?php echo $system_description;?>" />
<?php include('inc_head.php');?>
<script type="text/javascript">
$(function(){
	$('.home a').addClass('current');
});
</script>
</head>
<body>
<?php include ('inc_header.php');?>
<div id="slideshow">
	<div class="bd">
		<ul>
		<?php
		$result = mysql_query('select * from cms_slideshow where s_parent = 1 order by s_order asc , id asc');
		while ($row = mysql_fetch_array($result)){
			echo '
			<li style="background: url('.$row['s_picture'].') center no-repeat;">
				<div class="url">
					<a href="'.$row['s_url'].'" title="'.$row['s_name'].'"></a>
				</div>
			</li>
			';
		}
		?>
		</ul>
	</div>
	<div class="hd">
		<ul>
		</ul>
	</div>
</div>
<div id="index_products">
	<div class="container">
		<div class="line-big">
			<div class="x12">
				<div class="l10 plist">
					<?php
					$result = mysql_query('select * from cms_detail where d_parent in ('.get_channel(3,'c_sub').') order by d_order desc , id desc limit 0, 8');
					while($row = mysql_fetch_array($result)){
					?>
					<div class="x3">
						<div class="wrap mb10">
							<a href="<?php echo d_url($row['id'])?>" target="_blank"><img src="<?php echo $row['d_picture'];?>" title="<?php echo $row['d_name'];?>" alt="<?php echo $row['d_name'];?>"/></a>
							<div class="title"><a href="<?php echo d_url($row['id'])?>" target="_blank" title="<?php echo $row['d_name'];?>"><?php echo cut_str($row['d_name'],12);?></a></div>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('inc_footer.php');?>
</body>
</html>
