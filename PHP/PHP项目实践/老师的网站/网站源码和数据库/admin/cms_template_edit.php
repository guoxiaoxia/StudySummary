<?php
include('../system/inc.php');
include('cms_check.php');

if(isset($_POST['save'])){
	null_back($_POST['t_logo'],'请上传logo');
	$_data['t_logo'] = $_POST['t_logo'];
	$sql = 'update cms_template set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('模板修改成功!','cms_template.php');
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
	K('#logo').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#t_logo').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#t_logo').val(url);
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
				<div class="hd-1">修改模版</div>
				<div class="bd-1">
					<?php
					$result = mysql_query('select * from cms_template where id = '.$_GET['id'].'');
					if ($row = mysql_fetch_array($result)){
					?>
					<form method="post">
						<div class="form-group form-auto">
							<div class="label"><label for="t_logo">Logo <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="t_logo" class="input" name="t_logo" type="text" size="60" data-validate="required:请上传logo" value="<?php echo $row['t_logo'];?>" />
								<span class="btn bg-dot" id="logo">上传</span>
								<div class="input-note">请上传logo</div>
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
<?php include('inc_footer.php') ?>
</body>
</html>