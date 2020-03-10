<?php session_start();
include_once('./class/PHPMysql.class.php');
include_once('./class/PHPnew.class.php');
include_once('./class/Config.class.php');
include_once('./class/Utils.class.php');

// 配置
$Config = new Config();
// Utils工具
$Utils = new Utils();

$Utils::CheckLogin('/login.php');

$Utils::Location('/list.php');
