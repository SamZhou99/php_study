<?php session_start();
include_once('./class/PHPMysql.class.php');
include_once('./class/PHPnew.class.php');
include_once('./class/Config.class.php');
include_once('./class/Utils.class.php');

$Config = new Config();
$mysql = new PHPMysql($Config::$DB);

function location($url = '/')
{
    Header("HTTP/1.1 303 See Other");
    Header("Location: $url");
    exit();
}

function writeHtml()
{
    global $Config;
    $html = file_get_contents($Config::$SITE_INFO['index_page']);
    $fp = fopen('./index.html', 'w');
    fwrite($fp, $html);
    fclose($fp);
}

if ($_SESSION['isAdmin'] !== 9999) {
    location();
}

// 编辑表单
$act = isset($_POST['act']) ? $_POST['act'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
if ($act === 'edit') {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $sort = isset($_POST['sort']) ? (int) $_POST['sort'] : 0;
    $status = isset($_POST['status']) ? (int) $_POST['status'] : 0;
    if ($type === 'category') {
        // 分类 数据更新
        $s = $mysql->where(array('id' => $id))->update('category', array('name' => $name, 'sort' => $sort, 'status' => $status));
    }
    if ($_POST['type'] === 'links') {
        // 链接 数据更新
        $url = isset($_POST['url']) ? $_POST['url'] : '';
        $hot = isset($_POST['hot']) ? (int) $_POST['hot'] : 0;
        $s = $mysql->where(array('id' => $id))->update('links', array('name' => $name, 'sort' => $sort, 'url' => $url, 'hot' => $hot, 'status' => $status));
    }
    writeHtml();
    location('/index.php');
    exit("$id, $name, $sort");
}


// 查询表单
$type = isset($_GET['type']) ? $_GET['type'] : '';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$item = $mysql->field(array('*'))->where(array('id' => $id))->select($type);
if (!count($item)) {
    exit(json_encode(array()));
}

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
