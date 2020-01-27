<?php session_start();
include('./class/PHPMysql.class.php');
include('./class/PHPnew.class.php');
include('./class/Config.class.php');

$Config = new Config();
$mysql = new PHPMysql($Config::$DB);

function location()
{
    Header("HTTP/1.1 303 See Other");
    Header("Location: /");
    exit();
}

if ($_SESSION['isAdmin'] !== 9999) {
    location();
}

$act = isset($_POST['act']) ? $_POST['act'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
if ($act === 'edit') {
    if ($type === 'category') {
        // 
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $sort = isset($_POST['sort']) ? (int) $_POST['sort'] : 0;
        $s = $mysql->where(array('id' => $id))->update('category', array('name' => $name, 'sort' => $sort));
    }
    if ($_POST['type'] === 'links') {
        //
    }
    location();
    exit("$id, $name, $sort");
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$item = $mysql->field(array('*'))->where(array('id' => $id))->select($type);
if (!count($item)) {
    exit(json_encode(array()));
}
// var_dump($item);

// 模板引擎实例
$PHPnew = new PHPnew();
$PHPnew->templates_dir = './template/default/';
$PHPnew->templates_var = 'ASSIGN';
$PHPnew->assign('isAdmin', $_SESSION['isAdmin']);
$PHPnew->assign('siteInfo', $Config::$SITE_INFO);
$PHPnew->assign('queryString', $_SERVER["QUERY_STRING"]);
$PHPnew->assign('type', $type);
$PHPnew->assign('item', $item[0]);
$PHPnew->display('edit');
