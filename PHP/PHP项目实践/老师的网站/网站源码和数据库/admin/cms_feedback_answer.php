<?php
include('../system/inc.php');
include('cms_check.php');
if(isset($_POST['submit'])){
	$_data['f_answer'] = $_POST['f_answer'];
	$_data['f_adate'] = time();
	$_data['f_ok'] = 1;
	$sql = 'update cms_feedback set '.arrtoupdate($_data).' where id = '.$_GET['id'].'';
	if(mysql_query($sql)){
		alert_href('修改成功!','cms_feedback.php');
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
	K.create('#f_answer');
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
				<div class="hd-1">回复留言</div>
				<div class="bd-1">
					<?php
					$result = mysql_query('select * from cms_feedback where id = '.$_GET['id'].'');
					if($row = mysql_fetch_array($result)){
					?>
					<form method="post" class="form-auto">
						<table class="table table-bordered">
							<tr>
								<td width="120" align="right">留言人</td>
								<td><?php echo $row['f_name']?></td>
							</tr>
							<tr>
								<td align="right">联系电话</td>
								<td><?php echo $row['f_tel']?></td>
							</tr>
							<tr>
								<td align="right">QQ</td>
								<td><?php echo $row['f_qq']?></td>
							</tr>
							<tr>
								<td align="right">电子邮件</td>
								<td><?php echo $row['f_email']?></td>
							</tr>
							<tr>
								<td align="right">公司名称</td>
								<td><?php echo $row['f_cname']?></td>
							</tr>
							<tr>
								<td align="right">联系地址</td>
								<td><?php echo $row['f_address']?></td>
							</tr>
							<tr>
								<td align="right">留言内容</td>
								<td><?php echo $row['f_content']?></td>
							</tr>
							<tr>
								<td align="right">留言日期</td>
								<td><?php echo date('Y-m-d H:i:s',$row['f_date'])?></td>
							</tr>
							<tr>
								<td align="right">回复内容</td>
								<td><textarea name="f_answer" class="input" id="f_answer"><?php echo htmlspecialchars($row['f_answer'])?></textarea></td>
							</tr>
							<tr>
								<td align="right">回复日期</td>
								<td><?php echo date('Y-m-d H:i:s',$row['f_adate'])?></td>
							</tr>
							<tr>
								<td align="right"></td>
								<td><input type="submit" name="submit" value="保存" class="btn bg-dot"/></td>
							</tr>
						</table>
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