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
	$_data['s_order'] = $_POST['s_order'];
	$sql = 'update cms_slideshow set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('幻灯修改成功!','cms_slideshow.php');
	}else{
		alert_back('修改失败!');
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
				<div class="hd-1">修改幻灯</div>
				<div class="bd-1">
					<?php
					$result = mysql_query('select * from cms_slideshow where id = '.$_GET['id'].' ');
					if ($row = mysql_fetch_array($result)){
					?>
					<form method="post">
						<div class="form-group">
							<div class="label"><label for="s_name">名称</label></div>
							<div class="field">
								<input id="s_name" class="input" name="s_name" type="text" size="60" value="<?php echo $row['s_name'];?>" />
							</div>
						</div>

						<div class="form-group form-auto">
							<div class="label"><label for="s_picture">图片 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="s_picture" class="input" name="s_picture" type="text" size="60" data-validate="required:请输入或上传图片" value="<?php echo $row['s_picture'];?>" />
								<span id="picture" class="btn bg-dot">上传</span>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="s_url">链接</label></div>
							<div class="field">
								<input id="s_url" class="input" name="s_url" type="text" size="60" value="<?php echo $row['s_url'];?>" />
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="s_order">排序 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="s_order" class="input" name="s_order" type="text" size="60" data-validate="required:必填,plusinteger:请输入排序数字" value="<?php echo $row['s_order'];?>" />
							</div>
						</div>

						<div class="form-group">
							<div class="label"><label></label></div>
							<div class="field">
								<input id="save" class="btn bg-dot btn-block" name="save" type="submit" value="保存" />
							</div>
						</div>
					</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('inc_footer.php') ?></body>
</html>