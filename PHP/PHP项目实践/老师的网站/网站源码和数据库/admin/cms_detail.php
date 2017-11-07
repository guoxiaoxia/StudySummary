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
		case 'srec':
			$sql = 'update cms_detail set d_rec = 1 where id in ('.$id.')';
			break;
		case 'crec':
			$sql = 'update cms_detail set d_rec = 0 where id in ('.$id.')';
			break;
		case 'shot':
			$sql = 'update cms_detail set d_hot = 1 where id in ('.$id.')';
			break;
		case 'chot':
			$sql = 'update cms_detail set d_hot = 0 where id in ('.$id.')';
			break;
		case 'delete':
			$sql = 'delete from cms_detail where id in ('.$id.')';
			break;
		default:
			alert_back('请选择要执行的操作');
	}
	mysql_query($sql);
	alert_href('执行成功!','cms_detail.php?cid=0');
};
if ( isset($_POST['shift']) ) {
	null_back($_POST['id'],'请至少选中一项！');
	$s = '';
	$id = '';
	foreach( $_POST['id'] as $value ){
		$id .= $s.$value;
		$s = ',';
	}
	null_back($_POST['shift_target'],'请选择要转移到的频道');
	mysql_query('update cms_detail set d_parent = '.$_POST['shift_target'].' where id in ('.$id.')');
	alert_href('转移成功!','cms_detail.php?cid=0');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('inc_head.php') ?>
<script type="text/javascript">
	$(function(){
		//操作执行验证
		$('#execute').click(function(){
			if ($('#execute_method').val() == ''){
				alert('请选择一项要执行的操作！');
				return false;
			};
			if ($('input[name="id[]"]').val() = ''){
				alert('请至少选择一项！');
				return false;
			};
		});
		//频道转移验证
		$('#shift').click(function(){
			if ($('#shift_target').val() == ''){
				alert('请选择要转移到的频道！');
				return false;
			};
			if ($('input[name="id[]"]').val() = ''){
				alert('请至少选择一项！');
				return false;
			};
		});
		//搜索验证
		$('#search').click(function(){
			if ($('#key').val() == ''){
				alert('请输入要查找的关键字');
				$('#key').focus();
				return false;
			};
		});
	});
</script>
</head>
<body>
<?php include('inc_header.php') ?>
<div id="content">
	<div class="container">
		<div class="line-big">
			<?php include('inc_left.php') ?>
			<div class="xx105">
				<div class="hd-1">管理内容</div>
				<div class="bd-1">
					<form method="get" class="form-auto oh mb10" >
						<div class="fr" >
							按名称查找：
							<input id="key" class="input" type="text" name="key"/>
							<input type="submit" id="search" class="btn bg-sub" name="search" value="查找" />
						</div>
						<div class="fl">
							按频道筛选：
							<select class="input" onchange="location.href='cms_detail.php?cid='+this.options[this.selectedIndex].value;">
								<option value="0">全部</option>
								<?php
								echo channel_select_list(0,0,$_GET['cid'],0);
								if(isset($_GET['key'])){
									echo '<option selected="selected" >搜索结果</option>';
								}
								?>
							</select>
						</div>
					</form>
					<form method="post" class="form-auto">
						<table class="table table-bordered">
							<tr>
								<th>选择</th>
								<th>排序</th>
								<th width="500">内容名称</th>
								<th>所属频道</th>
								<th>属性</th>
								<th>日期</th>
								<th>修改</th>
							</tr>
							<?php
							if (isset($_GET['cid'])) {
								if ($_GET['cid'] != 0){
									$sql = 'select * from cms_detail where d_parent in ('.get_channel($_GET['cid'],'c_sub').') order by d_order desc , id desc';
									$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
									$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
								}else{
									$sql = 'select * from cms_detail order by d_order desc , id desc';
									$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
									$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
								}
							}
							if (isset($_GET['key'])) {
								$sql = 'select * from cms_detail where d_name like "%'.$_GET['key'].'%" order by d_order desc , id desc';
								$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
								$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
							}
							while($row= mysql_fetch_array($result)){
							?>
							<tr>
								<td><input type="checkbox" name="id[]" value="<?php echo $row['id'] ?>" /></td>
								<td><?php echo $row['d_order'] ?></td>
								<td><?php echo '<a href="../detail.php?id='.$row['id'].'" target="_blank">'.$row['d_name'].'</a>' ?></td>
								<td><?php echo get_channel_name($row['d_parent'])?></td>
								<td>
									<?php
									echo ($row['d_rec'] == 1 ? '<span class="badge bg-main">荐</span> ':'');
									echo ($row['d_hot'] == 1 ? '<span class="badge bg-dot">热</span> ':'');
									echo ($row['d_picture'] != '' ? '<span class="badge">图</span>':'');
									?>
								</td>
								<td><?php echo date('Y-m-d',$row['d_date']) ?></td>
								<td><a class="btn bg-sub" href="cms_detail_edit.php?id=<?php echo $row['id']?>"><span class="icon-edit"> 修改</span></a></td>
							</tr>
							<?php } ?>
							<tr>
								<td><span class="btn bg-main btn-small" onclick="check_all('id[]')">选</span></td>
								<td colspan="2">
									<select id="execute_method" class="input" name="execute_method">
										<option value="">请选择操作</option>
										<option value="srec">设为推荐</option>
										<option value="crec">取消推荐</option>
										<option value="shot">设为热门</option>
										<option value="chot">取消热门</option>
										<option value="delete">删除选中</option>
									</select>
									<input type="submit" id="execute" class="btn bg-sub" name="execute" onclick="return confirm('确定要执行吗')" value="执行" /></td>
								<td colspan="4">
									<select id="shift_target" class="input" name="shift_target">
										<option value="">请选择目标频道</option>
										<?php echo channel_select_list(0,0,0,0);?>
									</select>
									<input type="submit" id="shift" class="btn bg-sub" name="shift" onclick="return confirm('确定要转移吗')" value="转移" />
								</td>
							</tr>
						</table>
					</form>
					<div class="page_show"><?php echo page_show($pager[2],$pager[3],$pager[4],2);?> </div>
				</div>

			</div>
		</div>
	</div>
</div>
<?php include('inc_footer.php') ?>
</body>
</html>