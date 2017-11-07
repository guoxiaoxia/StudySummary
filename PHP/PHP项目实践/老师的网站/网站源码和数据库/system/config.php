<?php
if(!defined('PCMUKIT')) exit('Request Error!');
$s_path = '/';
$result = mysql_query('select * from cms_system where id = 1');
$row = mysql_fetch_array($result);
$system_template = $row['s_template'];
$system_domain = $row['s_domain'];
$system_name = $row['s_name'];
$system_seoname = $row['s_seoname'];
$system_keywords = $row['s_keywords'];
$system_description = $row['s_description'];
$system_copyright = $row['s_copyright'].'程序开发：<a href="http://www.mukit.net" target="_blank">金智科技</a>';
$system_mcopyright = $row['s_mcopyright'];
$system_hotkeywords = $row['s_hotkeywords'];
$system_feedback = $row['s_feedback'];
$system_phone = $row['s_phone'];
$system_qq = $row['s_qq'];
$system_qrcode = $row['s_qrcode'];
$system_mlogo = $row['s_mlogo'];
$system_mode = $row['s_mode'];
$t_path = 'template/'.$system_template.'/';
$t_mpath = 'template/m/';
$result = mysql_query('select * from cms_template where t_path = "'.$system_template.'" ');
if ($row = mysql_fetch_array($result)){
	$system_logo = $row['t_logo'];
}

//频道链接地址
function c_url($t0){
	return 'channel.php?id='.$t0.'';
}
//详情链接地址
function d_url($t0){
	return 'detail.php?id='.$t0.'';
}


//频道列表
function channel_list($t0,$t1){
	$tmp = '';
	$result = mysql_query('select * from cms_channel where c_parent = '.$t0.' order by c_order asc , id asc ');
	while ($row = mysql_fetch_array($result)){
		$tmp .= '<li><a '.($row['id'] == $t1 ? ' class="current"' : '').' href="'.c_url($row['id']).'" target="'.$row['c_target'].'">'.$row['c_name'].'</a></li>';
	}
	return $tmp;
}



//频道和内容页的当前位置
function current_location($t0,$t1){
	$tmp = '';
	$result = mysql_query('select * from cms_channel where id = '.$t0.'');
	while($row = mysql_fetch_array($result)){
		$current = ($row['id'] == $t1 ? 'class ="current"' :'');
		$tmp = '<a '.$current.' href="'.c_url($row['id']).'">'.$row['c_name'].'</a>';
		if($row['c_parent'] <> 0){
			$tmp = current_location($row['c_parent'],$t1).' > '.$tmp;
		}
	}
	return $tmp;
}

//获取频道字段
function get_channel($t0,$t1){
	$result = mysql_query('select * from cms_channel where id='.$t0.'');
	if (!!$row = mysql_fetch_array($result)){
		return $row[$t1];
	}else{
		return '不存在';
	};
}



?>