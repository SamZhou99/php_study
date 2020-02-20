<?php session_start();
include('./class/PHPMysql.class.php');
include('./class/PHPnew.class.php');
include('./class/Config.class.php');
include('./class/Utils.class.php');

// 配置
$Config = new Config();

$Utils = new Utils();

if ($_SESSION['isLogin'] !== $Config::$IsLogin) {
	$Utils::Location('/login.php');
}

$mysql = new PHPMysql($Config::$DB);
$memberRow = $mysql->field(array('*'))->where(array('id' => $_SESSION['id']))->limit(1)->select('member');
$member = $memberRow[0];

if ($member['status'] === 0) {
	$message = urldecode($member['account'] . ' 账号已禁用!');
	$Utils::Location('/login.php?message=' . $message);
}

if ($member['type'] < 9) {
	$message = urldecode($member['account'] . ' 权限不够!');
	$Utils::Location('/login.php?message=' . $message);
}

// 模板引擎实例
$PHPnew = new PHPnew();
$PHPnew->templates_dir = './template/default/';
$PHPnew->templates_var = 'ASSIGN';
$PHPnew->assign('siteInfo', $Config::$SITE_INFO);
$PHPnew->assign('session', $_SESSION);
$PHPnew->assign('member', $member);
$PHPnew->display('index');
