<?php
require_once('system/inc.php');
require_once('system/safe.php');
non_numeric_back($_GET['id'],'非法字符');
//获取详情字段
$result = mysql_query('select * from cms_detail where id = '.$_GET['id'].' ');
if (!!$row = mysql_fetch_array($result)) {
	$d_id = $row['id'];
	$d_name = $row['d_name'];
	$d_picture = $row['d_picture'];
	$d_parent = $row['d_parent'];
	$d_rec = $row['d_rec'];
	$d_hot = $row['d_hot'];
	$d_slideshow = $row['d_slideshow'];
	$d_video = $row['d_video'];
	$d_file = $row['d_file'];
	$d_content = $row['d_content'];
	$d_scontent = $row['d_scontent'];
	$d_mcontent = $row['d_mcontent'];
	$d_mscontent = $row['d_mscontent'];
	$d_author = $row['d_author'];
	$d_source = $row['d_source'];
	$d_seoname = $row['d_seoname'];
	$d_keywords = $row['d_keywords'];
	$d_description = $row['d_description'];
	$d_link = $row['d_link'];
	$d_date = $row['d_date'];
	$d_order = $row['d_order'];
	$d_hits = $row['d_hits'];
	$d_title = ($d_seoname == '') ? $d_name .' - '.$system_name : $d_seoname.' - '.$d_name.' - '.$system_name ;
} else {
	die ('您访问的详情不存在');
}
mysql_query('update cms_detail set d_hits = d_hits + 1 where id = '.$_GET['id'].'');

//获取上级频道字段
$result = mysql_query('select * from cms_channel where id = '.$d_parent.'');
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
}

$channel_list = channel_list(($c_ifsub == 1 ? $c_id : $c_parent),$c_id);
$current_location = current_location($c_id,$c_id);

$result = mysql_query('select * from cms_detail where d_parent in ('.$c_sub.') and id < '.$d_id.' limit 0,1 ');
if ( $row = mysql_fetch_array($result) ) {
	$d_previous = '<a href="'.d_url($row['id']).'">'.cut_str($row['d_name'],50).'</a>';
} else {
	$d_previous = '暂无';
}

$result = mysql_query('select * from cms_detail where d_parent in ('.$c_sub.') and id > '.$d_id.' limit 0,1 ');
if ( $row = mysql_fetch_array($result) ) {
	$d_next = '<a href="'.d_url($row['id']).'">'.cut_str($row['d_name'],50).'</a>';
} else {
	$d_next = '暂无';
}

//读取指定的频道模型
	include($t_path.$c_dmodel);
?>