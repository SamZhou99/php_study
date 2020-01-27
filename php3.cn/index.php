<?php session_start();
include('./class/PHPMysql.class.php');
include('./class/PHPnew.class.php');
include('./class/Config.class.php');

$Config = new Config();
$mysql = new PHPMysql($Config::$DB);
$category = $mysql->field(array('*'))->where(array('status' => 1))->order(array('sort' => 'desc'))->limit(100)->select('category');
for ($i = 0; $i < count($category); $i++) {
	$d = $mysql->where(array('category' => $category[$i]['id']))->order(array('sort' => 'desc'))->select('links');
	$category[$i]['data'] = $d;
}

// 模板引擎实例
$PHPnew = new PHPnew();
$PHPnew->templates_dir = './template/default/';
$PHPnew->templates_var = 'ASSIGN';
$PHPnew->assign('isAdmin', $_SESSION['isAdmin']);
$PHPnew->assign('siteInfo', $Config::$SITE_INFO);
$PHPnew->assign('category', $category);
$PHPnew->display('index');
