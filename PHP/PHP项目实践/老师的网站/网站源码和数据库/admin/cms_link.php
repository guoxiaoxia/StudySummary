<?php
include('../system/inc.php');
include('cms_check.php');
if(isset($_GET['del'])){
	$sql = 'delete from cms_link where id = '.$_GET['del'].'';
	if(mysql_query($sql)){
		alert_href('删除成功!','cms_link.php');
	}else{
		alert_back('删除失败！');
	}
}
if(isset($_POST['save'])){
	null_back($_POST['l_name'],'请填写链接名称');
	non_numeric_back($_POST['l_order'],'排序必须是数字!');
	$data['l_name'] = $_POST['l_name'];
	$data['l_picture'] = $_POST['l_picture'];
	$data['l_url'] = $_POST['l_url'];
	$data['l_order'] = $_POST['l_order'];
	$str = arrtoinsert($data);
	$sql = 'insert into cms_link ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		$order = mysql_insert_id();
		if ( $_POST['l_order'] == 0 ) {
			mysql_query('update cms_link set l_order = '.$order.' where id = '.$order);
		}
		alert_href('链接添加成功!','cms_link.php');
	}else{
		alert_back('添加失败!');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('inc_head.php') ?>
<script type="text/javascript">
KindEditor.ready(function(K) {
	var editor = K.editor();
	K('#picture').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#l_picture').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#l_picture').val(url);
				editor.hideDialog();
				}
			});
		});
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
				<div class="hd-1">添加链接</div>
				<div class="bd-1">
					<form method="post">
						<div class="form-group">
							<div class="label"><label for="l_name">名称 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="l_name" class="input" name="l_name" type="text" size="60" data-validate="required:请填写链接名称" value="" />
								<div class="input-note">请填写链接名称</div>
							</div>
						</div>
						<div class="form-group form-auto">
							<div class="label"><label for="l_picture">图片</label></div>
							<div class="field">
								<input id="l_picture" class="input" name="l_picture" type="text" size="60" value="" />
								<span class="btn bg-dot" id="picture">上传</span>
								<div class="input-note">请填写或上传图片</div>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="l_url">地址 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="l_url" class="input" name="l_url" type="text" size="60" data-validate="required:请填写链接地址" value="http://" />
								<div class="input-note">请填写链接地址</div>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="l_order">排序</label></div>
							<div class="field">
								<input id="l_order" class="input" name="l_order" type="text" size="60" data-validate="required:必填,plusinteger:请填写排序数字" value="0" />
								<div class="input-note">请填写排序数字</div>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label></label></div>
							<div class="field">
								<input id="save" class="btn bg-dot btn-block" name="save" type="submit" value="保存" />
							</div>
						</div>
					</form>
				</div>
				<div class="hd-1">链接管理</div>
				<div class="bd-1">
					<table class="table table-bordered">
						<tr>
							<th>排序</th>
							<th>链接图片</th>
							<th>链接名称</th>
							<th>链接地址</th>
							<th>操作</th>
						</tr>
						<?php
						$result = mysql_query('select * from cms_link');
						while($row = mysql_fetch_array($result)){
						?>
						<tr>
							<td><?php echo $row['l_order']?></td>
							<td>
								<?php if ($row['l_picture'] != '') { ?>
								<a href="<?php echo $row['l_picture']?>" target="_blank"><img src="<?php echo $row['l_picture']?>" width="120" height="30" /></a>
								<?php } ?>
							</td>
							<td><?php echo $row['l_name']?></td>
							<td><?php echo $row['l_url']?></td>
							<td><a class="btn bg-sub btn-small" href="cms_link_edit.php?id=<?php echo $row['id']?>"><span class="icon-edit"> 修改</span></a>&nbsp<a class="btn bg-dot btn-small" href="cms_link.php?del=<?php echo $row['id']?>" onclick="return confirm('确认要删除吗？')"><span class="icon-times"> 删除</span></a></td>
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
<?php include('inc_footer.php') ?></body>
</html>