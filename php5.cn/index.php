<?php
include('./class/PHPMysql.class.php');
include('./class/PHPnew.class.php');
include('./class/Config.class.php');

$Config = new Config();
$mysql = new PHPMysql($Config::$DB);
$category = $mysql->field(array('*'))->limit(100)->select('category');
for ($i = 0; $i < count($category); $i++) {
	$d = $mysql->where(array('category' => $category[$i]['id']))->order(array('sort' => 'desc'))->select('links');
	$category[$i]['data'] = $d;
}

// 模板引擎实例
$PHPnew = new PHPnew();
$PHPnew->templates_dir = './template/navigation/';
$PHPnew->templates_var = 'ASSIGN';
$PHPnew->assign('category', $category);
$PHPnew->display('index');
