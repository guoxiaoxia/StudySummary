<?php
include('../system/inc.php');
include('cms_check.php');
if (isset($_POST['save'])){
	null_back($_POST['c_name'],'请填写频道名称');
	null_back($_POST['c_parent'],'请选择上级频道');
	null_back($_POST['c_cmodel'],'请选择或填写频道模型');
	non_numeric_back($_POST['c_page'],'分页条数必须是数字');
	non_numeric_back($_POST['c_order'],'排序必须是数字');
	$_data['c_name'] = $_POST['c_name'];
	$_data['c_parent'] = $_POST['c_parent'];
	$_data['c_cmodel'] = $_POST['c_cmodel'];
	$_data['c_dmodel'] = 'd_simple.php';
	$_data['c_mcmodel'] = 'c_marticle.php';
	$_data['c_mdmodel'] = 'd_msimple.php';
	$_data['c_content'] = $_POST['c_content'];
	$_data['c_scontent'] = $_POST['c_scontent'];
	$_data['c_mcontent'] = $_POST['c_content'];
	$_data['c_mscontent'] = $_POST['c_scontent'];
	$_data['c_page'] = $_POST['c_page'];
	$_data['c_seoname'] = $_POST['c_seoname'];
	$_data['c_keywords'] = $_POST['c_keywords'];
	$_data['c_description'] = $_POST['c_description'];
	$_data['c_nav'] = $_POST['c_nav'];
	$_data['c_nname'] = ($_POST['c_nname'] == '' ? $_POST['c_name'] : $_POST['c_nname'] );
	$_data['c_link'] = $_POST['c_link'];
	$_data['c_sname'] = $_POST['c_sname'];
	$_data['c_aname'] = $_POST['c_aname'];
	$_data['c_cover'] = $_POST['c_cover'];
	$_data['c_target'] = $_POST['c_target'];
	$_data['c_safe'] = $_POST['c_safe'];
	$_data['c_order'] = $_POST['c_order'];
	$str = arrtoinsert($_data);
	$sql = 'insert into cms_channel ('.$str[0].') values ('.$str[1].')';
	if (mysql_query($sql)) {
		$order = mysql_insert_id();
		if ( $_POST['c_order'] == 0 ) {
			mysql_query('update cms_channel set c_order = '.$order.' where id = '.$order);
		}
		update_channel();
		alert_href('频道添加成功!','cms_channel.php');
	} else {
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
	K.create('#c_content');
	K.create('#c_scontent');
	var editor = K.editor();
	K('#cover_upload').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#c_cover').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#c_cover').val(url);
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
				<div class="hd-1">添加频道</div>
				<div class="bd-1">
					<form method="post">
						<div class="line-big">
							<div class="form-group x3">
								<div class="label"><label for="c_name">频道名称 <span class="badge bg-dot">必填</span></label></div>
								<div class="field">
									<input id="c_name" class="input" name="c_name" type="text" size="60" data-validate="required:请输入频道名称" value="" />
									<div class="input-note">请输入频道名称</div>
								</div>
							</div>
							<div class="form-group x4">
								<div class="label"><label for="c_parent">上级频道</label></div>
								<div class="field">
									<select id="c_parent" class="input" name="c_parent">
										<option value="0">作为主频道</option>
										<?php echo channel_select_list(0,0,0,0);?>
									</select>
									<div class="input-note">请选择要添加频道的上级频道</div>
								</div>
							</div>
							<div class="form-group x5 form-auto">
								<div class="label"><label for="c_nname">导航名称</label></div>
								<div class="field">
									<input id="c_nname" class="input" name="c_nname" type="text" size="30" value="" />
									<select class="input" name="c_nav" >
										<option value="1">显示</option>
										<option value="0">隐藏</option>
									</select>
									<div class="input-note">可以隐藏</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="form-group form-auto x6">
								<div class="label"><label for="c_cmodel">频道模型 <span class="badge bg-dot">必填</span></label></div>
								<div class="field">
									<input id="c_cmodel" class="input" name="c_cmodel" type="text" size="40" data-validate="required:请选择或输入频道模型" value="c_article.php" />
									<select class="input" onChange="c_cmodel.value=this.value;c_cmodel.focus();c_cmodel.blur();">
										<option value="">选择或填写</option>
										<option value="c_spage.php" >单页</option>
										<option value="c_article.php" selected="selected">文章</option>
										<option value="c_picture.php" >图片</option>
									</select>
									<div class="input-note">请选择或输入频道模型</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="form-group x6">
								<div class="label"><label for="c_content">详细内容</label></div>
								<div class="field">
									<textarea id="c_content" class="input" name="c_content" row="5" /></textarea>
									<div class="input-note">请输入详细内容</div>
								</div>
							</div>
							<div class="form-group x6">
								<div class="label"><label for="c_scontent">简短内容</label></div>
								<div class="field">
									<textarea id="c_scontent" class="input" name="c_scontent" row="5" /></textarea>
									<div class="input-note">请输入简短内容</div>
								</div>
							</div>
							<div class="form-group x4">
								<div class="label"><label for="c_seoname">优化标题</label></div>
								<div class="field">
									<input id="c_seoname" class="input" name="c_seoname" type="text" size="60" value="" />
									<div class="input-note">请输入优化标题</div>
								</div>
							</div>
							<div class="form-group x4">
								<div class="label"><label for="c_keywords">关键字</label></div>
								<div class="field">
									<input id="c_keywords" class="input" name="c_keywords" type="text" size="60" value="" />
									<div class="input-note">请输入关键字</div>
								</div>
							</div>
							<div class="form-group x4">
								<div class="label"><label for="c_description">关键描述</label></div>
								<div class="field">
									<input id="c_description" class="input" name="c_description" type="text" size="60" value="" />
									<div class="input-note">请输入关键描述</div>
								</div>
							</div>
							<div class="form-group x2">
								<div class="label"><label for="c_aname">别名</label></div>
								<div class="field">
									<input id="c_aname" class="input" name="c_aname" type="text" size="60" value="" />
									<div class="input-note">请输入别名</div>
								</div>
							</div>
							<div class="form-group x2">
								<div class="label"><label for="c_sname">短名</label></div>
								<div class="field">
									<input id="c_sname" class="input" name="c_sname" type="text" size="60" value="" />
									<div class="input-note">请输入短名</div>
								</div>
							</div>
							<div class="form-group x2">
								<div class="label"><label for="c_page">分页</label></div>
								<div class="field">
									<input id="c_page" class="input" name="c_page" type="text" size="60" data-validate="required:必填,plusinteger:请输入合法的分页数字" value="20" />
									<div class="input-note">请输入分页数字</div>
								</div>
							</div>
							<div class="form-group x2">
								<div class="label"><label for="c_order">排序</label></div>
								<div class="field">
									<input id="c_order" class="input" name="c_order" type="text" size="60" data-validate="required:必填,plusinteger:请输入合法的排序数字" value="0" />
									<div class="input-note">填写0自动识别为ID</div>
								</div>
							</div>
							<div class="form-group x4">
								<div class="label"><label for="c_link">链接</label></div>
								<div class="field">
									<input id="c_link" class="input" name="c_link" type="text" size="60" value="" />
									<div class="input-note">外部地址请用http://开始</div>
								</div>
							</div>
							<div class="form-group form-auto x6">
								<div class="label"><label for="c_cover">封面</label></div>
								<div class="field">
									<input id="c_cover" class="input" name="c_cover" type="text" size="60" value="" />
									<span class="btn bg-sub" id="cover_upload" >上传</span></a>
									<div class="input-note">请上传封面</div>
								</div>
							</div>

							<div class="form-group x3">
								<div class="label"><label for="c_target">打开方式</label></div>
								<div class="field">
									<label class="btn"><input id="c_target" name="c_target" type="radio" value="_self" checked="checked"/>原窗口</label>
									<label class="btn"><input name="c_target" type="radio" value="_blank" />新窗口</label>
									<div class="input-note">请选择打开方式</div>
								</div>
							</div>
							<div class="form-group x3">
								<div class="label"><label for="c_safe">保护</label></div>
								<div class="field">
									<label class="btn"><input id="c_safe" name="c_safe" type="radio" value="0" checked="checked"/>不保护</label>
									<label class="btn"><input name="c_safe" type="radio" value="1" />保护</label>
									<div class="input-note">开启安全保护后，能有效防止误操作删除。</div>
								</div>
							</div>
							<div class="form-group x12">
								<div class="label"><label></label></div>
								<div class="field">
									<input id="save" class="btn bg-dot btn-block" name="save" type="submit" value="保存" />
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
<?php include('inc_footer.php') ?>
</body>
</html>