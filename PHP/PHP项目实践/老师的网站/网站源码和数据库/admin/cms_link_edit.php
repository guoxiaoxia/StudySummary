<?php
include('../system/inc.php');
include('cms_check.php');
if(isset($_POST['save'])){
	null_back($_POST['l_name'],'请填写链接名称');
	non_numeric_back($_POST['l_order'],'排序必须是数字!');
	$data['l_name'] = $_POST['l_name'];
	$data['l_picture'] = $_POST['l_picture'];
	$data['l_url'] = $_POST['l_url'];
	$data['l_order'] = $_POST['l_order'];
	$sql = 'update cms_link set '.arrtoupdate($data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('链接修改成功!','cms_link.php');
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
				<div class="hd-1">修改链接</div>
				<div class="b">
					<?php
					$result = mysql_query('select * from cms_link where id = '.$_GET['id'].'');
					if($row = mysql_fetch_array($result)){
					?>
					<form method="post">
						<div class="form-group">
							<div class="label"><label for="l_name">名称 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="l_name" class="input" name="l_name" type="text" size="60" data-validate="required:请填写链接名称" value="<?php echo $row['l_name'];?>" />
								<div class="input-note">请填写链接名称</div>
							</div>
						</div>
						<div class="form-group form-auto">
							<div class="label"><label for="l_picture">图片</label></div>
							<div class="field">
								<input id="l_picture" class="input" name="l_picture" type="text" size="60" value="<?php echo $row['l_picture'];?>" />
								<span class="btn bg-dot" id="picture">上传</span>
								<div class="input-note">请填写或上传图片</div>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="l_url">地址 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="l_url" class="input" name="l_url" type="text" size="60" data-validate="required:请填写链接地址" value="<?php echo $row['l_url'];?>" />
								<div class="input-note">请填写链接地址</div>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="l_order">排序</label></div>
							<div class="field">
								<input id="l_order" class="input" name="l_order" type="text" size="60" data-validate="required:必填,plusinteger:请填写排序数字" value="<?php echo $row['l_order'];?>" />
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
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('inc_footer.php') ?>
</body>
</html>