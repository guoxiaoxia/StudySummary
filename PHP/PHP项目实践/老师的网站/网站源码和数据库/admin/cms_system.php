<?php
include('../system/inc.php');
include('cms_check.php');
if(isset($_POST['save'])){
	$_data['s_domain'] = $_POST['s_domain'];
	$_data['s_name'] = $_POST['s_name'];
	$_data['s_mode'] = 1;
	$_data['s_seoname'] = $_POST['s_seoname'];
	$_data['s_keywords'] = $_POST['s_keywords'];
	$_data['s_description'] = $_POST['s_description'];
	$_data['s_copyright'] = $_POST['s_copyright'];
	$_data['s_hotkeywords'] = $_POST['s_hotkeywords'];
	$_data['s_feedback'] = $_POST['s_feedback'];
	$sql = 'update cms_system set '.arrtoupdate($_data).' where id = 1';
	if(mysql_query($sql)){
		alert_href('系统设置修改成功!','cms_system.php');
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
	K.create('#s_copyright');
	var editor = K.editor();
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
				<div class="hd-1">系统设置</div>
				<div class="bd-1">
					<?php
					$result = mysql_query('select * from cms_system where id = 1');
					if( $row = mysql_fetch_array($result)){
					?>
					<form method="post">
						<div class="line-big">
							<div class="x6">
								<div class="form-group">
									<div class="label"><label for="s_name">网站名称</label></div>
									<div class="field">
										<input id="s_name" class="input" name="s_name" type="text" size="60" value="<?php echo $row['s_name'];?>" />
										<div class="input-note">请填写网站名称</div>
									</div>
								</div>
							</div>
							<div class="x6">
								<div class="form-group">
									<div class="label"><label for="s_domain">域名</label></div>
									<div class="field">
										<input id="s_domain" class="input" name="s_domain" type="text" size="60" value="<?php echo $row['s_domain'];?>" />
										<div class="input-note">请填写域名</div>
									</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="x4">
								<div class="form-group">
									<div class="label"><label for="s_seoname">优化标题</label></div>
									<div class="field">
										<input id="s_seoname" class="input" name="s_seoname" type="text" size="60" value="<?php echo $row['s_seoname'];?>" />
										<div class="input-note">请填写优化标题</div>
									</div>
								</div>
							</div>
							<div class="x4">
								<div class="form-group">
									<div class="label"><label for="s_keywords">关键字</label></div>
									<div class="field">
										<input id="s_keywords" class="input" name="s_keywords" type="text" size="60" value="<?php echo $row['s_keywords'];?>" />
										<div class="input-note">请填写关键字</div>
									</div>
								</div>
							</div>
							<div class="x4">
								<div class="form-group">
									<div class="label"><label for="s_description">关键描述</label></div>
									<div class="field">
										<input id="s_description" class="input" name="s_description" type="text" size="60" value="<?php echo $row['s_description'];?>" />
										<div class="input-note">请填写关键描述</div>
									</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="fc"></div>
							<div class="x12">
								<div class="form-group">
									<div class="label"><label for="s_hotkeywords">热门关键词</label></div>
									<div class="field">
										<input id="s_hotkeywords" class="input" name="s_hotkeywords" type="text" size="60" value="<?php echo $row['s_hotkeywords'];?>" />
										<div class="input-note">每个词之间用“|”分割</div>
									</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="x12">
								<div class="form-group">
									<div class="label"><label for="s_copyright">版权信息</label></div>
									<div class="field">
										<textarea id="s_copyright" class="input" name="s_copyright" /><?php echo htmlspecialchars($row['s_copyright'])?></textarea>
										<div class="input-note">请填写版权信息</div>
									</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="x4">
								<div class="form-group">
									<div class="label"><label for="s_feedback">留言控制</label></div>
									<div class="field">
										<label class="btn"><input id="s_feedback" name="s_feedback" type="radio" value="0" <?php echo ( $row['s_feedback'] == 0 ) ? 'checked="checked"' : '' ; ?>/>禁止留言</label>
										<label class="btn"><input name="s_feedback" type="radio" value="1" <?php echo ( $row['s_feedback'] == 1 ) ? 'checked="checked"' : '' ; ?>/>需要审核</label>
										<label class="btn"><input name="s_feedback" type="radio" value="2" <?php echo ( $row['s_feedback'] == 2 ) ? 'checked="checked"' : '' ; ?>/>不需审核</label>
										<div class="input-note">选择留言模式</div>
									</div>
								</div>
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