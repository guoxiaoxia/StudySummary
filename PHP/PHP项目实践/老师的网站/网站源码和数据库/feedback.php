<?php
require_once('system/inc.php');
require_once('system/safe.php');
$c_main = 0;
if(isset($_POST['save'])){
	if($system_feedback == 0){
		alert_back('留言系统已关闭，不允许留言!');
	}
	null_back($_POST['f_content'],'留言内容不能为空！');
	$_data['f_ok'] = $system_feedback = 1 ? 0 : 1;
	$_data['f_name'] = clear_html($_POST['f_name']);
	$_data['f_tel'] = clear_html($_POST['f_tel']);
	$_data['f_qq'] = clear_html($_POST['f_qq']);
	$_data['f_email'] = clear_html($_POST['f_email']);
	$_data['f_cname'] = clear_html($_POST['f_cname']);
	$_data['f_address'] = clear_html($_POST['f_address']);
	$_data['f_content'] = clear_html($_POST['f_content']);
	$_data['f_date'] = time();
	$str = arrtoinsert($_data);
	$sql = 'insert into cms_feedback ('.$str[0].') values ('.$str[1].')';
	if(mysql_query($sql)){
		alert_href('留言成功!','feedback.php');
	}else{
		alert_back('留言失败!');
	}
}
include($t_path.'feedback.php');
?>