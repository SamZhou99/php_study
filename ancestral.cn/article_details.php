<?php session_start();
require_once('./class/PHPMysql.class.php');
require_once('./class/PHPnew.class.php');
require_once('./class/Config.class.php');
require_once('./class/Utils.class.php');

$Config = new Config();
$Utils = new Utils();
$Mysql = new PHPMysql($Config::$DB);

$Utils::CheckLoginLocation('/login.php');

$templateName = 'article_details';
$title = '文章详情';

// 会员查询
$memberId = $_SESSION['id'];
$member = $Mysql
    ->field(array('*'))
    ->where(array('id' => $memberId))
    ->limit(1)
    ->select('member');
$member = $member[0];


// 文章详情
$articleDetails = $Mysql->where(array('id' => $_GET['id']))->select('article')[0];


// 模板引擎实例
$PHPnew = new PHPnew();
$PHPnew->templates_dir = './template/default/';
$PHPnew->templates_var = 'ASSIGN';
$PHPnew->assign('SERVER', $_SERVER);
$PHPnew->assign('SESSION', $_SESSION);
$PHPnew->assign('siteInfo', $Config::$SITE_INFO);
// $PHPnew->assign('templateName', $templateName);
$PHPnew->assign('article', $articleDetails);
$PHPnew->assign('title', $title);
$PHPnew->assign('member', $member);
// $PHPnew->display('index');
$PHPnew->display($templateName);
