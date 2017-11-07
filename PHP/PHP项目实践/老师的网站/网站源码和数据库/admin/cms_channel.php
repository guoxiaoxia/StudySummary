<?php
include('../system/inc.php');
include('cms_check.php');
if (isset($_GET['del'])){
	$sql = 'select * from cms_channel where id = '.$_GET['del'].'';
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row['c_ifsub'] == 0 && $row['c_safe']==0)	{
		mysql_query('delete from cms_channel where id = '.$_GET['del'].'');
		mysql_query('delete from cms_detail where d_parent = '.$_GET['del'].'');
		update_channel();
		alert_href('删除成功！','cms_channel.php');
	}else{
		alert_back('此频道存在下级或已受保护，无法删除！');
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('inc_head.php') ?>
</head>
<body>
<?php include('inc_header.php') ?>
<div id="content">
	<div class="container">
		<div class="line-big">
			<?php include('inc_left.php') ?>
			<div class="xx105">
				<div class="hd-1">管理频道</div>
				<div class="bd-1">
					<form method="post" class="form-auto">
						<table class="table table-bordered">
							<tr>
								<th>ID</th>
								<th>排序</th>
								<th>频道名称</th>
								<th>频道模型</th>
								<th>内容模型</th>
								<th>内容操作</th>
								<th>频道操作</th>
							</tr>
							<?php echo channel_manage(0,0); ?>
						</table>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>
<?php include('inc_footer.php') ?>
</body>
</html>