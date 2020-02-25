<?php session_start();
include_once('./class/PHPMysql.class.php');
include_once('./class/PHPnew.class.php');
include_once('./class/Config.class.php');
include_once('./class/Utils.class.php');


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
$Utils = new Utils();

if ($account && $password) {
	// 数据库
	$mysql = new PHPMysql($Config::$DB);

	$member = $mysql
		->field(array('*'))
		->where($form)
		->limit(1)
		->select('member');
		
	if (count($member) > 0) {

		$member = $member[0];

		// 检查状态
		if ($member['status'] === 0) {
			$message = urldecode($member['account'] . ' 账号已禁用!');
			$Utils::Location('/login.php?message=' . $message);
		}
		
		// 检查类型
		if ($member['type'] < 9) {
			$message = urldecode($member['account'] . ' 权限不够!');
			$Utils::Location('/login.php?message=' . $message);
		}

		$_SESSION['isLogin'] = $Config::$IsLogin;
		$_SESSION['id'] = $member['id'];
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
