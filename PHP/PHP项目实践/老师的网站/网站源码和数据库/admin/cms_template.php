<?php
include('../system/inc.php');
include('cms_check.php');
if(isset($_GET['del'])){
	$sql = 'delete from cms_template where id = '.$_GET['del'].'';
	if(mysql_query($sql)){
		alert_back('删除成功！');
	}else{
		alert_back('删除失败！');
	}
}

if (isset($_GET['path'])){
	mysql_query('update cms_system set s_template = "'.$_GET['path'].'"');
	alert_href('设置成功，刷新网站前台查看效果','cms_template.php');
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
				<div class="hd-1">模版管理</div>
				<div class="bd-1">
					<table class="table table-bordered">
						<tr>
							<th>名称</th>
							<th>路径</th>
							<th>操作</th>
						</tr>
						<?php
						$result = mysql_query('select * from cms_template');
						while($row = mysql_fetch_array($result)){
						?>
						<tr>
							<td><?php echo $row['t_name']?></td>
							<td><?php echo $row['t_path']?></td>
							<td>
							<?php
							if ($system_template == $row['t_path']){
								echo '<span class="badge bg-dot">正在使用</span>';
							}else{
								echo '<a class="btn bg-main" href="cms_template.php?path='.$row['t_path'].'">应用</a> <a class="btn bg-dot" href="cms_template.php?del='.$row['id'].'" onclick="return confirm(\'确定要删除吗？\')"><span class="icon-times"> 删除</span></a>';
							}
							?>
							<a class="btn bg-sub" href="cms_template_edit.php?id=<?php echo $row['id'];?>"><span class="icon-edit"> 修改</span></a>
							</td>
						</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('inc_footer.php') ?>
</body>
</html>