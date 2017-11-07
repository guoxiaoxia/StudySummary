<?php
include('../system/inc.php');
include('cms_check.php');
if ( isset($_POST['save']) ) {
	null_back($_POST['s_picture'],'请输入或上传图片');
	non_numeric_back($_POST['s_order'],'请输入排序数字');
	$_data['s_name'] = $_POST['s_name'];
	$_data['s_parent'] = 1;
	$_data['s_picture'] = $_POST['s_picture'];
	$_data['s_url'] = $_POST['s_url'];
	$_data['s_order'] = $_POST['s_order'];
	$str = arrtoinsert($_data);
	$sql = 'insert into cms_slideshow ('.$str[0].') values ('.$str[1].')';
	if (mysql_query($sql)) {
		$order = mysql_insert_id();
		if ( $_POST['s_order'] == 0 ) {
			mysql_query('update cms_slideshow set s_order = '.$order.' where id = '.$order);
		}
		alert_href('幻灯添加成功!','cms_slideshow.php');
	} else {
		alert_back('添加失败!');
	}
}
if(isset($_GET['del'])){
	$sql = 'delete from cms_slideshow where id = '.$_GET['del'].'';
	if(mysql_query($sql)){
		alert_href('删除成功!','cms_slideshow.php');
	}else{
		alert_back('删除失败！');
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
			imageUrl : K('#s_picture').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#s_picture').val(url);
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
				<div class="hd-1">添加幻灯</div>
				<div class="bd-1">
					<form method="post">
						<div class="form-group">
							<div class="label"><label for="s_name">名称</label></div>
							<div class="field">
								<input id="s_name" class="input" name="s_name" type="text" size="60" value="" />
							</div>
						</div>
						<div class="form-group form-auto">
							<div class="label"><label for="s_picture">图片 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="s_picture" class="input" name="s_picture" type="text" size="60" data-validate="required:请输入或上传图片" value="" />
								<span id="picture" class="btn bg-dot">上传</span>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="s_url">链接</label></div>
							<div class="field">
								<input id="s_url" class="input" name="s_url" type="text" size="60" value="" />
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="s_order">排序 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="s_order" class="input" name="s_order" type="text" size="60" data-validate="required:必填,plusinteger:请输入排序数字" value="0" />
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

				<div class="hd-1">幻灯管理</div>
				<div class="bd-1">
					<table class="table table-bordered">
						<tr>
							<th>排序</th>
							<th>图片</th>
							<th>名称</th>
							<th>链接地址</th>
							<th>操作</th>
						</tr>
						<?php
						$result = mysql_query('select * from cms_slideshow');
						while($row = mysql_fetch_array($result)){
						?>
						<tr>
							<td><?php echo $row['s_order']?></td>
							<td><a href="<?php echo $row['s_picture']?>" target="_blank">点击查看</a></td>
							<td><?php echo $row['s_name']?></td>
							<td><?php echo $row['s_url']?></td>
							<td><a class="btn bg-sub btn-small" href="cms_slideshow_edit.php?id=<?php echo $row['id']?>"><span class="icon-edit"> 修改</span></a> <a class="btn bg-dot btn-small" href="cms_slideshow.php?del=<?php echo $row['id']?>" onclick="return confirm('确认要删除吗？')"><span class="icon-times"> 删除</span></a></td>
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