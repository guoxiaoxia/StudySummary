<?php
include('../system/inc.php');
include('cms_check.php');
if(isset($_GET['del']) == 1){
	alert_back('默认账户不能删除！');
}else{
	if(isset($_GET['del'])){
		$sql = 'delete from cms_admin where id = '.$_GET['del'].'';
		if(mysql_query($sql)){
			alert_href('删除成功!','cms_admin.php');
		}else{
			alert_back('删除失败！');
		}
	}
}
if(isset($_POST['save'])){
	null_back($_POST['a_name'],'请填写登录帐号');
	null_back($_POST['a_password'],'请填写登录密码');
	null_back($_POST['a_cpassword'],'请重复输入登录密码');
	if ($_POST['a_password'] != $_POST['a_cpassword']) {
		alert_back('两次输入的密码不一致');
	}
	$result = mysql_query('select * from cms_admin where a_name = "'.$_POST['a_name'].'"');
	if(mysql_fetch_array($result)){
		alert_back('登录帐号重复，请更换登录帐号。');
	}
	$_data['a_name'] = $_POST['a_name'];
	$_data['a_tname'] = $_POST['a_tname'];
	$_data['a_password'] = md5($_POST['a_password']);
	$str = arrtoinsert($_data);
	$sql = 'insert into cms_admin ('.$str[0].') values ('.$str[1].')';
	if (mysql_query($sql)) {
		alert_href('管理员添加成功!','cms_admin.php');
	} else {
		alert_back('添加失败!');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('inc_head.php') ?>
</head>
<body>
<?php include('inc_header.php') ?>
<div id="content">
	<div class="container">
		<div class="line-big">
			<?php include('inc_left.php') ?>
			<div class="xx105">
				<div class="hd-1">添加管理员</div>
				<div class="bd-1">
					<form method="post">
						<div class="form-group">
							<div class="label"><label for="a_name">登录帐号 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="a_name" class="input" name="a_name" type="text" size="60" data-validate="required:请填写登录帐号" value="" />
								<div class="input-note">请填写登录帐号</div>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="a_password">登录密码 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="a_password" class="input" name="a_password" type="password" size="60" data-validate="required:请填写登录密码" value="" />
								<div class="input-note">请填写登录密码</div>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="a_cpassword">确认密码 <span class="badge bg-dot">必填</span></label></div>
							<div class="field">
								<input id="a_cpassword" class="input" name="a_cpassword" type="password" size="60" data-validate="required:请填写确认密码,repeat#a_password:两次输入的密码不一致" value="" />
								<div class="input-note">请重复输入登录密码</div>
							</div>
						</div>
						<div class="form-group">
							<div class="label"><label for="a_tname">真实姓名</label></div>
							<div class="field">
								<input id="a_tname" class="input" name="a_tname" type="text" size="60" value="" />
								<div class="input-note">请填写真实姓名</div>
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
				<div class="hd-1">现有管理员</div>
				<div class="bd-1">
					<table class="table table-bordered">
						<tr>
							<th>登录帐号</th>
							<th>真实姓名</th>
							<th>操作</th>
						</tr>
						<?php
							$result = mysql_query('select * from cms_admin');
							while($row = mysql_fetch_array($result)){
						?>
						<tr>
							<td><?php echo $row['a_name']?></td>
							<td><?php echo $row['a_tname']?></td>
							<td><a class="btn bg-sub btn-small" href="cms_admin_edit.php?id=<?php echo $row['id']?>"><span class="icon-edit"> 修改</span></a>&nbsp<a class="btn bg-dot btn-small" href="cms_admin.php?del=<?php echo $row['id']?>" onclick="return confirm('确认要删除吗？')"><span class="icon-times"> 删除</span></a></td>
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
<?php include('inc_footer.php') ?>
</body>
</html>