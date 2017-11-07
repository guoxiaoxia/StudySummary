<?php
require_once('system/inc.php');
require_once('system/safe.php');
non_numeric_back($_GET['id'],'非法字符');
$sql = 'select * from cms_channel where id = '.$_GET['id'].' ';
$result = mysql_query($sql);
if (!!$row = mysql_fetch_array($result)) {
	$c_id = $row['id'];
	$c_name = $row['c_name'];
	$c_parent = $row['c_parent'];
	$c_main = $row['c_main'];
	$c_level = $row['c_level'];
	$c_ifsub = $row['c_ifsub'];
	$c_sub = $row['c_sub'];
	$c_cover = $row['c_cover'];
	$c_content = $row['c_content'];
	$c_scontent = $row['c_scontent'];
	$c_mcontent = $row['c_mcontent'];
	$c_mscontent = $row['c_mscontent'];
	$c_sname = $row['c_sname'];
	$c_cmodel = $row['c_cmodel'];
	$c_dmodel = $row['c_dmodel'];
	$c_mcmodel = $row['c_mcmodel'];
	$c_mdmodel = $row['c_mdmodel'];
	$c_page = $row['c_page'];
	$c_seoname = $row['c_seoname'];
	$c_keywords = $row['c_keywords'];
	$c_description = $row['c_description'];
	$c_nav = $row['c_nav'];
	$c_nname = $row['c_nname'];
	$c_link = $row['c_link'];
	$c_aname = $row['c_aname'];
	$c_target = $row['c_target'];
	$c_order = $row['c_order'];
	$c_safe = $row['c_safe'];
} else {
	die ('不存在此频道');
}
$c_title = ($c_seoname == '') ? $c_name .' - '.$system_name : $c_seoname.' - '.$c_name.' - '.$system_name ;
//获取此频道的上级频道
if ($c_parent != 0) {
	$sql = 'select * from cms_channel where id = '.$c_parent.'';
} else {
	$sql = 'select * from cms_channel where id = '.$c_id.'';
}
$result = mysql_query($sql);
if (!!$row = mysql_fetch_array($result)) {
	$cp_id = $row['id'];
	$cp_name = $row['c_name'];
	$cp_parent = $row['c_parent'];
	$cp_main = $row['c_main'];
	$cp_level = $row['c_level'];
	$cp_ifsub = $row['c_ifsub'];
	$cp_sub = $row['c_sub'];
	$cp_cover = $row['c_cover'];
	$cp_content = $row['c_content'];
	$cp_scontent = $row['c_scontent'];
	$cp_mcontent = $row['c_mcontent'];
	$cp_mscontent = $row['c_mscontent'];
	$cp_sname = $row['c_sname'];
	$cp_cmodel = $row['c_cmodel'];
	$cp_dmodel = $row['c_dmodel'];
	$cp_mcmodel = $row['c_mcmodel'];
	$cp_mdmodel = $row['c_mdmodel'];
	$cp_page = $row['c_page'];
	$cp_seoname = $row['c_seoname'];
	$cp_keywords = $row['c_keywords'];
	$cp_description = $row['c_description'];
	$cp_nav = $row['c_nav'];
	$cp_nname = $row['c_nname'];
	$cp_link = $row['c_link'];
	$cp_aname = $row['c_aname'];
	$cp_target = $row['c_target'];
	$cp_order = $row['c_order'];
	$cp_safe = $row['c_safe'];
}

$channel_list = channel_list(($c_ifsub == 1 ? $c_id : $c_parent),$c_id);
$current_location = current_location($c_id,$c_id);
$page = substr($_SERVER['REQUEST_URI'],0,(strrpos($_SERVER['REQUEST_URI'],'-') + 1));
//读取指定的频道模型
	include($t_path.$c_cmodel);

?>