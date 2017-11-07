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
<title><?php echo $c_title;?></title>
<meta name="keywords" content="<?php echo $c_keywords;?>" />
<meta name="description" content="<?php echo $c_description;?>" />
<?php include('inc_head.php');?>
<link rel="stylesheet" type="text/css" href="../../ui/jianmei.css"/>
</head>
<body>
<?php include ('inc_header.php'); ?>
<div id="content">
	<div class="container">
   		 <div class="title">
                <h1><?php echo $c_name; ?></h1>
            </div>
		<div class="line-big">
			<div class="x12">
				<div class="line-big plist">
					<?php
					$sql = 'select * from cms_detail where d_parent in ('.$c_sub.') order by d_order desc , id desc';
					$pager = page_handle('page',$c_page,mysql_num_rows(mysql_query($sql)));
					$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
					while($row = mysql_fetch_array($result)){
					?>
					<div class="x3">
						<div class="wrap mb20">
							<a href="<?php echo d_url($row['id'])?>" target="_blank"><img src="<?php echo $row['d_picture'];?>" title="<?php echo $row['d_name'];?>" alt="<?php echo $row['d_name'];?>"/></a>
							<div class="title"><a href="<?php echo d_url($row['id'])?>" target="_blank" title="<?php echo $row['d_name'];?>"><?php echo cut_str($row['d_name'],12);?></a></div>
						</div>
					</div>
					<?php
					}
					?>
				</div>
				<div class="page_show"><?php echo (($system_mode == 2 ) ? page_shows($pager[2],$pager[3],$page,2) : page_show($pager[2],$pager[3],$pager[4],2));?> </div>
			</div>
		</div>
	</div>
</div>
<?php include ('inc_footer.php');?>
</body>
</html>
