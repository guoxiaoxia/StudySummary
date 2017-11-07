<?php
	if(!isset($_COOKIE['admin_name'])){
		alert_href('非法登录','cms_login.php');
	};
?>