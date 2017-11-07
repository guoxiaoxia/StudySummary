<?php
require_once('../system/inc.php');
require_once('../system/safe.php');
if(isset($_POST['submit'])){
	if ($_SESSION['verifycode'] != $_POST['verifycode']) {
		alert_href('验证码错误','cms_login.php');
	}
	null_back($_POST['a_name'],'请输入用户名');
	null_back($_POST['a_password'],'请输入密码');
	null_back($_POST['verifycode'],'请输入验证码');
	$a_name = $_POST['a_name'];
	$a_password = $_POST['a_password'];
	$sql = 'select * from cms_admin where a_name = "'.$a_name.'" and a_password = "'.md5($a_password).'"';
	$result = mysql_query($sql);
	if(!! $row = mysql_fetch_array($result)){
		setcookie('admin_name',$row['a_name']);
		header('location:cms_welcome.php');
	}else{
		alert_href('用户名或密码错误','cms_login.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('inc_head.php') ?>
</head>
<body>
<div style="background-color: #030; padding: 120px 0;">
	<div class="container">
		<p style="font-size: 50px; color: #FFF; text-align: center;">简美网站管理后台</p>
	</div>
</div>
<div class="container">
	<div style="width: 360px; margin: 50px auto;">
		<form method="post">
			<div class="form-group">
				<div class="label"><label for="a_name">用户名/USER NAME</label></div>
				<div class="field">
					<input id="a_name" class="input" name="a_name" type="text" data-validate="required:请输入用户名" value="" />
				</div>
			</div>
			<div class="form-group">
				<div class="label"><label for="a_password">密码/PASSWORD</label></div>
				<div class="field">
					<input id="a_password" class="input" name="a_password" type="password" data-validate="required:请输入密码" value="" />
				</div>
			</div>
			<div class="form-group form-auto">
				<div class="label"><label for="verifycode">验证码</label></div>
				<div class="field">
					<input id="verifycode" class="input" name="verifycode" type="text" size="10" data-validate="required:请输入验证码" value="" />
					<img src="../system/verifycode.php" onclick="javascript:this.src='../system/verifycode.php?'+Math.random()" style="cursor:pointer;" alt="点击更换" title="点击更换" />
				</div>
			</div>
			<div class="form-group">
				<div class="label"><label></label></div>
				<div class="field">
					<input id="login_submit" class="btn btn-block bg-green" name="submit" type="submit" value="登录后台" />
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>