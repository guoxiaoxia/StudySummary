<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>留言反馈</title>
<?php include('inc_head.php');?>
</head>
<body>
<?php include ('inc_header.php'); ?>
<div id="content">
	<div class="container">
		<div id="current_location">当前位置：<a href="index.php">首页</a> > 留言反馈</div>
		<div class="line-big">
			<div class="x4">
				<form method="post">
					<div class="form-group">
						<div class="label"><label for="f_content">留言内容/Content <span class="badge bg-dot">必填</span></label></div>
						<div class="field">
							<textarea id="f_content" class="input" name="f_content" row="5" data-validate="required:请填写留言内容" /></textarea>
							<div class="input-note">请填写留言内容</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="f_name">您的姓名/Your name</label></div>
						<div class="field">
							<input id="f_name" class="input" name="f_name" type="text" size="60" value="匿名" />
							<div class="input-note">请填写您的姓名</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="f_tel">联系电话/Tel</label></div>
						<div class="field">
							<input id="f_tel" class="input" name="f_tel" type="text" size="60" value="" />
							<div class="input-note">请填写联系电话</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="f_qq">腾讯QQ/QQ</label></div>
						<div class="field">
							<input id="f_qq" class="input" name="f_qq" type="text" size="60" value="" />
							<div class="input-note">请填写腾讯QQ</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="f_email">电子邮件/Email</label></div>
						<div class="field">
							<input id="f_email" class="input" name="f_email" type="text" size="60" value="" />
							<div class="input-note">请填写电子邮件</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="f_cname">公司名称/Company</label></div>
						<div class="field">
							<input id="f_cname" class="input" name="f_cname" type="text" size="60" value="" />
							<div class="input-note">请填写公司名称</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label for="f_address">联系地址/Address</label></div>
						<div class="field">
							<input id="f_address" class="input" name="f_address" type="text" size="60" value="" />
							<div class="input-note">请填写联系地址</div>
						</div>
					</div>
					<div class="form-group">
						<div class="label"><label></label></div>
						<div class="field">
							<input id="save" class="btn bg-dot btn-block" name="save" type="submit" value="提交留言" />
						</div>
					</div>
				</form>
			</div>
			<div class="x8">
				<?php
				$sql = 'select * from cms_feedback where f_ok = 1 order by id desc';
				$pager = page_handle('page',20,mysql_num_rows(mysql_query($sql)));
				$result = mysql_query($sql.' limit '.$pager[0].','.$pager[1].'');
				while($row = mysql_fetch_array($result)){
				?>
				<div class="flist">
					<div class="username"><span class="icon-user"> <?php echo $row['f_name'];?></span> <span class="badge"><?php echo date('Y-m-d',$row['f_date']);?></span></div>
					<div class="content">
						<?php echo $row['f_content'];?>
						<?php
						if ($row['f_answer'] != '') {
						?>
						<div class="answer">
							<div><span class="badge bg-dot">站长回复</span> <span class="badge"><?php echo date('Y-m-d',$row['f_adate']);?></span></div>
							<?php echo $row['f_answer'];?>
						</div>
						<?php
						}
						?>
					</div>
				</div>
				<?php
				};
				echo page_show($pager[2],$pager[3],$pager[4],2);
				?>
			</div>
		</div>
	</div>
</div>
<?php include ('inc_footer.php');?>
</body>
</html>
