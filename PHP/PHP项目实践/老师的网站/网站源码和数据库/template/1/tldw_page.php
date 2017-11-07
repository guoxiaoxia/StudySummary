<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		<div class="line-big">
			<div class="x12">
            <div class="container_j">
				<?php echo $c_content?>
			</div> </div>
		</div>
	</div>
</div>
<?php include ('inc_footer.php');?>
</body>
</html>
