<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php echo $system_name.'-'.$system_seoname?></title>
<?php include('inc_head.php');?>
</head>
<body>
<?php include ('inc_header.php');?>
<div class="container">
	<div id="current_location">当前位置：<a href="index.php">首页</a> > 网站地图</div>
	<div class="l10">
		<?php
		$result = mysql_query('select * from cms_channel where c_parent = 0 order by c_order asc , id asc ');
		while ($row = mysql_fetch_array($result)){
			echo '<div class="x12"><a class="btn bg-dot mb10" href="'.c_url($row['id']).'">'.$row['c_name'].'</a></div>';
			$results = mysql_query('select * from cms_channel where c_parent = '.$row['id'].' order by c_order asc , id asc ');
			while ($rows = mysql_fetch_array($results)){
				echo '<div class="xx15"><a class="btn mb10 btn-block" href="'.c_url($rows['id']).'">'.$rows['c_name'].'</a></div>';
			}
		}
		?>
	</div>
</div>
<?php include ('inc_footer.php');?>
</body>
</html>
