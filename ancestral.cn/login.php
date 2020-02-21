<?php session_start();
include('./class/PHPMysql.class.php');
include('./class/PHPnew.class.php');
include('./class/Config.class.php');
include('./class/Utils.class.php');

// 表单变量
$account = isset($_POST['account']) ? $_POST['account'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';
$form = array(
	'account' => $account,
	'password' => $password
);

// 网站配置
$Config = new Config();

if ($account && $password) {
	// 数据库
	$mysql = new PHPMysql($Config::$DB);

	$member = $mysql
		->field(array('*'))
		->where($form)
		->select('member');
		
	if (count($member) > 0) {
		$_SESSION['isLogin'] = $Config::$IsLogin;
		$_SESSION['id'] = $member[0]['id'];
		$Utils = new Utils();
		$Utils::Location('/');
	}
}


// 模板引擎实例
$PHPnew = new PHPnew();
$PHPnew->templates_dir = './template/default/';
$PHPnew->templates_var = 'ASSIGN';
$PHPnew->assign('siteInfo', $Config::$SITE_INFO);
$PHPnew->assign('message', $message);
$PHPnew->display('login');
