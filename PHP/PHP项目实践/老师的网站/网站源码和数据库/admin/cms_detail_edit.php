<?php
include('../system/inc.php');
include('cms_check.php');
if ( isset($_POST['save']) ) {
	null_back($_POST['d_name'],'请填写详情名称');
	non_numeric_back($_POST['d_order'],'请填写合法的排序数字');
	$_data['d_name'] = $_POST['d_name'];
	$_data['d_picture'] = $_POST['d_picture'];
	$_data['d_parent'] = $_POST['d_parent'];
	$_data['d_rec'] = $_POST['d_rec'];
	$_data['d_hot'] = $_POST['d_hot'];
	$_data['d_content'] = $_POST['d_content'];
	$_data['d_scontent'] = ($_POST['d_scontent'] == '') ? cut_str(clear_html($_POST['d_content']),100) : $_POST['d_scontent'];
	$_data['d_slideshow'] = $_POST['d_slideshow'];
	$_data['d_video'] = $_POST['d_video'];
	$_data['d_keywords'] = $_POST['d_keywords'];
	$_data['d_description'] = $_POST['d_description'];
	$_data['d_seoname'] = $_POST['d_seoname'];
	$_data['d_file'] = $_POST['d_file'];
	$_data['d_link'] = $_POST['d_link'];
	$_data['d_order'] = $_POST['d_order'];
	$_data['d_author'] = $_POST['d_author'];
	$_data['d_source'] = $_POST['d_source'];
	$sql = 'update cms_detail set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if (mysql_query($sql)) {
		alert_href('详情修改成功!', 'cms_detail.php?cid=0');
	} else {
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
	K.create('#d_content');
	var editor = K.editor();
	K('#picture').click(function() {
		editor.loadPlugin('image', function() {
			editor.plugin.imageDialog({
			imageUrl : K('#d_picture').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#d_picture').val(url);
				editor.hideDialog();
				}
			});
		});
	});
	K('#slideshow').click(function() {
		editor.loadPlugin('multiimage', function() {
			editor.plugin.multiImageDialog({
				clickFn : function(urlList) {
					var tem_val = '';
					var tem_s = '';
					K.each(urlList, function(i, data) {
						tem_val = tem_val + tem_s + data.url;
						tem_s = '|';
					});
					K('#d_slideshow').val(tem_val);
					editor.hideDialog();
				}
			});
		});
	});
	K('#file').click(function() {
		editor.loadPlugin('insertfile', function() {
			editor.plugin.fileDialog({
				fileUrl : K('#d_file').val(),
				clickFn : function(url, title) {
					K('#d_file').val(url);
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
				<div class="hd-1">修改详情</div>
				<div class="bd-1">
					<?php
					$result = mysql_query('select * from cms_detail where id = '.$_GET['id'].'');
					if ($row = mysql_fetch_array($result)){
					?>
					<form method="post">
						<div class="line-big">
							<div class="form-group x6">
								<div class="label"><label for="d_name">详情名称 <span class="badge bg-dot">必填</span></label></div>
								<div class="field">
									<input id="d_name" class="input" name="d_name" type="text" size="60" data-validate="required:请输入详情名称" value="<?php echo $row['d_name'];?>" />
									<div class="input-note">请输入详情名称</div>
								</div>
							</div>
							<div class="form-group x6 form-auto">
								<div class="label"><label for="d_picture">图片标题</label></div>
								<div class="field">
									<input id="d_picture" class="input" name="d_picture" type="text" size="60" value="<?php echo $row['d_picture'];?>" />
									<span class="btn bg-dot" id="picture">上传</span>
									<div class="input-note">图片列表显示的缩略图</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="form-group x6">
								<div class="label"><label for="d_parent">所属频道 <span class="badge bg-dot">必选</span></label></div>
								<div class="field">
									<select id="d_parent" class="input" name="d_parent">
										<?php echo channel_select_list(0,0,$row['d_parent'],0); ?>
									</select>
									<div class="input-note">请选择详情属于哪个频道</div>
								</div>
							</div>
							<div class="form-group x3">
								<div class="label"><label for="d_rec">推荐</label></div>
								<div class="field">
									<label class="btn"><input id="d_rec" name="d_rec" type="radio" value="0" <?php echo ($row['d_rec'] == 0 ? 'checked="checked"' : '')?>/>否</label>
									<label class="btn"><input name="d_rec" type="radio" value="1" <?php echo ($row['d_rec'] == 1 ? 'checked="checked"' : '')?>/>是</label>
									<div class="input-note">选择是否推荐</div>
								</div>
							</div>
							<div class="form-group x3">
								<div class="label"><label for="d_hot">热门</label></div>
								<div class="field">
									<label class="btn"><input id="d_hot" name="d_hot" type="radio" value="0" <?php echo ($row['d_rec'] == 0 ? 'checked="checked"' : '')?>/>否</label>
									<label class="btn"><input name="d_hot" type="radio" value="1" <?php echo ($row['d_rec'] == 1 ? 'checked="checked"' : '')?>/>是</label>
									<div class="input-note">选择是否热门</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="form-group x12">
								<div class="label"><label for="d_scontent">简短内容</label></div>
								<div class="field">
									<textarea id="d_scontent" class="input" name="d_scontent" row="5" /><?php echo $row['d_scontent'];?></textarea>
									<div class="input-note">一般用于内容摘要</div>
								</div>
							</div>

							<div class="fc"></div>
							<div class="form-group x12">
								<div class="label"><label for="d_content">详细内容</label></div>
								<div class="field">
									<textarea id="d_content" class="input" name="d_content" /><?php echo $row['d_content'];?><?php echo htmlspecialchars($row['d_content']);?></textarea>
									<div class="input-note">支持图文混排等</div>
								</div>
							</div>

							<div class="fc"></div>
							<div class="form-group x6">
								<div class="label"><span class="btn btn-small bg-dot fr" id="slideshow">上传</span><label for="d_slideshow">组图</label></div>
								<div class="field">
									<textarea id="d_slideshow" class="input" name="d_slideshow" row="5" /><?php echo $row['d_slideshow'];?></textarea>
									<div class="input-note">图片地址用"|"分割</div>
								</div>
							</div>
							<div class="form-group x6">
								<div class="label"><label for="d_video">视频</label></div>
								<div class="field">
									<textarea id="d_video" class="input" name="d_video" row="5" /><?php echo $row['d_video'];?></textarea>
									<div class="input-note">请输入优酷、土豆等网站的视频代码</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="form-group x4">
								<div class="label"><label for="d_keywords">关键字</label></div>
								<div class="field">
									<input id="d_keywords" class="input" name="d_keywords" type="text" size="60" placeholder="请输入关键字" value="<?php echo $row['d_keywords'];?>" />
									<div class="input-note">请输入关键字</div>
								</div>
							</div>
							<div class="form-group x4">
								<div class="label"><label for="d_description">关键描述</label></div>
								<div class="field">
									<input id="d_description" class="input" name="d_description" type="text" size="60" value="<?php echo $row['d_description'];?>" />
									<div class="input-note">请输入关键描述</div>
								</div>
							</div>
							<div class="form-group x4">
								<div class="label"><label for="d_seoname">优化标题</label></div>
								<div class="field">
									<input id="d_seoname" class="input" name="d_seoname" type="text" size="60" value="<?php echo $row['d_seoname'];?>" />
									<div class="input-note">请输入优化标题</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="form-group form-auto x4">
								<div class="label"><label for="d_file">附件下载</label></div>
								<div class="field">
									<input id="d_file" class="input" name="d_file" type="text" size="30" value="<?php echo $row['d_file'];?>" />
									<span class="btn bg-dot" id="file">上传</span>
									<div class="input-note">请上传或填写附件地址</div>
								</div>
							</div>
							<div class="form-group x3">
								<div class="label"><label for="d_link">链接</label></div>
								<div class="field">
									<input id="d_link" class="input" name="d_link" type="text" size="60" value="<?php echo $row['d_link'];?>" />
									<div class="input-note">外部用http://开头</div>
								</div>
							</div>
							<div class="form-group x2">
								<div class="label"><label for="d_order">排序 <span class="badge bg-dot">必填</span></label></div>
								<div class="field">
									<input id="d_order" class="input" name="d_order" type="text" size="60" data-validate="required:必填,plusinteger:请输入排序数字" value="<?php echo $row['d_order'];?>" />
									<div class="input-note">0识别为详情ID</div>
								</div>
							</div>
							<div class="form-group form-auto x3">
								<div class="label"><label for="d_author">作者/来源</label></div>
								<div class="field">
									<input id="d_author" class="input" name="d_author" type="text" size="12" value="<?php echo $row['d_author'];?>" />
									<input id="d_source" class="input" name="d_source" type="text" size="12" value="<?php echo $row['d_source'];?>" />
									<div class="input-note">请输入作者/来源</div>
								</div>
							</div>
							<div class="fc"></div>
							<div class="form-group x12">
								<div class="label"><label></label></div>
								<div class="field">
									<input id="save" class="btn bg-dot btn-block" name="save" type="submit" value="保存" />
								</div>
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