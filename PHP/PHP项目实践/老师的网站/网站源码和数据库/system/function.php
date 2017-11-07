<?php
if(!defined('PCMUKIT')) exit('Request Error!');
//获取频道下拉列表
function channel_select_list($t0,$t1,$t2,$t3){
	$tmp = '';
	$s = '';
	$level = $t1;
	$main = '';
	for ( $i=0; $i < $level; $i++ ){
		$s =$s . '　' ;
	}
	$main = ( $t0 == 0 ) ? '' : '├' ;
	$level = $level +1;
	$sql = 'select * from cms_channel where c_parent = '.$t0.' and id <> '.$t3.' order by c_order asc , id asc';
	$result = mysql_query($sql);
	while( $row = mysql_fetch_array($result)){
		$select = ($row['id'] == $t2 ? 'selected="selected"' : '');
		$tmp .='<option value="'.$row['id'].'" '.$select.'>'.$s.$main.$row['c_name'].'</option>'.channel_select_list($row['id'],$level,$t2,$t3);
	}
	return $tmp;
}
//获取频道层级
function get_channel_level($t0,$t1=1){
	$level = $t1;
	$sql = 'select * from cms_channel where id ='.$t0.'';
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row['c_parent'] == 0){
		return $level;
	} else {
		return get_channel_level($row['c_parent'],$level + 1);
	}
}
//获取所有频道的ID
function get_channel_sub($t0,$t1){
	$tmp = '';
	$s = ',';
	$sql = 'select * from cms_channel where c_parent = '.$t0.' order by c_order asc , id asc ';
	$result = mysql_query($sql);
	while(!!$row = mysql_fetch_array($result)){
		$tmp .= $s.$row['id'].get_channel_sub($row['id'],'');
	};
	return $t1.$tmp;
}

//获取指定频道的最上级频道
function get_channel_main($parent){
	$sql = 'select * from cms_channel where id ='.$parent.'';
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row['c_parent'] == 0){
		return $row['id'];
	}else{
		return get_channel_main($row['c_parent']);
	}
}

//获取指定频道是否有子频道
function get_channel_ifsub($id){
	$result = mysql_query('select * from cms_channel where c_parent = '.$id.' ');
	if (mysql_fetch_array($result)){
		return 1;
	}else{
		return 0;
	}
}
//更新所有频道
function update_channel(){
	$sql = 'select * from cms_channel order by id asc';
	$result = mysql_query($sql);
	while (!!$row = mysql_fetch_array($result)){
		$sql2 = 'update cms_channel set c_sub="'.get_channel_sub($row['id'],$row['id']).'",c_ifsub='.get_channel_ifsub($row['id']).',c_main='.get_channel_main($row['id']).',c_level='.get_channel_level($row['id']).' where id = '.$row['id'].' ';
		mysql_query($sql2);
	};
}

//频道管理列表
function channel_manage($t0,$t1){
	$tmp = '';
	$level = $t1;
	$s = '';
	$result = mysql_query('select * from cms_channel where c_parent = '.$t0.' order by c_order asc , id asc ');
	for ($i = 0; $i < $level; $i++){
		$s = $s . '　';
	};
	$main = ( $t0 == 0 ) ? '' : '├' ;
	$level = $level + 1;
	while (!!$row = mysql_fetch_array($result)){
		$tmp .='<tr>
					<td>'.$row['id'].'</td>
					<td>'.$row['c_order'].'</td>
					<td>'.$s.$main.'<a href="../'.c_url($row['id']).'" target="_blank">'.$row['c_name'].'</a></td>
					<td><span class="badge">'.get_model_name($row['c_cmodel']).'</span></td>
					<td><span class="badge">'.get_model_name($row['c_dmodel']).'</span></td>
					<td><a class="btn bg-sub" href="cms_detail_add.php?cid='.$row['id'].'"><span class="icon-plus-square"> 添加</span></a>&nbsp<a class="btn bg-main" href="cms_detail.php?cid='.$row['id'].'"><span class="icon-bars"> 管理</span></a></td>
					<td><a class="btn bg-gray" href="cms_channel_edit.php?id='.$row['id'].'"><span class="icon-edit"> 修改</span></a>&nbsp<a class="btn bg-dot" href="cms_channel.php?del='.$row['id'].'" onclick="return confirm(\'确定要删除吗？\')"><span class="icon-times"> 删除</span></a></td>
				</tr>'.channel_manage($row['id'],$level);
	}
	return $tmp;
};
//通过id获取频道名称
function get_channel_name($t0){
	$result = mysql_query('select * from cms_channel where id='.$t0.'');
	if (!!$row = mysql_fetch_array($result)){
		return $row['c_name'];
	}else{
		return '';
	};
}
//获取模型名称
function get_model_name($t0){
	$result = mysql_query('select * from cms_model where m_value="'.$t0.'"');
	if (!!$row = mysql_fetch_array($result)){
		return $row['m_name'];
	}else{
		return '自定义';
	};
}

function model_select_list($t0,$t1){
	$tmp = '';
	$result = mysql_query('select * from cms_model where m_type = '.$t0.' order by id asc');
	while($row = mysql_fetch_array($result)){
		$select =($row['m_value'] == $t1 ? 'selected="selected"' :'');
		$tmp .= '<option value="'.$row['m_value'].'" '.$select.'>'.$row['m_name'].'</option>';
	}
	return $tmp;
}
?>