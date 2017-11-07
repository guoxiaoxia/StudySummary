<?php
include('../system/inc.php');
include('cms_check.php');
if (isset($_POST['execute'])) {
	null_back($_POST['id'],'请至少选中一项！');
	$s = '';
	$id = '';
	foreach( $_POST['id'] as $value ){
		$id .= $s.$value;
		$s = ',';
	}
	switch ($_POST['execute_method']){
		case 'sok':
			$sql = 'update cms_feedback set f_ok = 1 where id in ('.$id.')';
			break;
		case 'cok':
			$sql = 'update cms_feedback set f_ok = 0 where id in ('.$id.')';
			break;
		case 'delete':
			$sql = 'delete from cms_feedback where id in ('.$id.')';
			break;
		default:
			alert_back('请选择要执行的操作');
	}
	mysql_query($sql);
	alert_href('执行成功!','cms_feedback.php');
};
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
				<div class="hd-1">管理留言</div>
				<div class="bd-1">
					<form method="post" class="form-auto">
						<table class="table table-bordered">
							<tr>
								<th>选择</th>
								<th>状态</th>
								<th>留言人</th>
								<th>联系电话</th>
								<th>公司名称</th>
								<th>联系地址</th>
								<th>留言日期</th>
								<th>回复</th>
							</tr>
							<?php
							$sql = 'select * from cms_feedback';
							$pager = page_handle('page',10,mysql_num_rows(mysql_query($sql)));
							$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							while($row = mysql_fetch_array($result)){
							?>
							<tr>
								<td><input type="checkbox" name="id[]" value="<?php echo $row['id'] ?>" /></td>
								<td><?php echo ($row['f_ok'] == 0 ? '<span style="color:red">未审</span>' : '已审'); ?></td>
								<td><?php echo $row['f_name'] ?></td>
								<td><?php echo $row['f_tel']?></td>
								<td><?php echo $row['f_cname'] ?></td>
								<td><?php echo $row['f_address']?></td>
								<td><?php echo date('Y-m-d H:i:s',$row['f_date']) ?></td>
								<td><a class="btn bg-main" href="cms_feedback_answer.php?id=<?php echo $row['id']?>">回复</a></td>
							</tr>
							<?php
							}
							?>
							<tr>
								<td><span class="btn bg-main btn-small" onclick="check_all('id[]')">选</span></td>
								<td colspan="7">
									<div class="form-group">
										<div class="field">
											<select id="execute_method" class="input" data-validate="required:必须选择一项" name="execute_method">
												<option value="">请选择操作</option>
												<option value="sok">审核留言</option>
												<option value="cok">取消审核</option>
												<option value="delete">删除选中</option>
											</select>
											<input type="submit" id="execute" class="btn bg-sub" name="execute" onclick="return confirm('确定要执行吗')" value="执行" />
										</div>
									</div>
								</td>
							</tr>
						</table>
					</form>
					<div class="page_show"><?php echo page_show($pager[2],$pager[3],'page',2);?> </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('inc_footer.php') ?></body>
</html>