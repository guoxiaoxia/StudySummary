<?php
require_once('system/inc.php');
require_once('system/safe.php');
if (isset($_GET['key'])){
	null_back($_GET['key'],'请输入要查找的关键字');
	$key = $_GET['key'];
}
//读取模板文件
$c_main = 0;
include($t_path.'search.php');
?>