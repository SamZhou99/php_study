<?php session_start();
require_once('../class/PHPMysql.class.php');
require_once('../class/PHPnew.class.php');
require_once('../class/Config.class.php');
require_once('../class/Utils.class.php');


$Utils = new Utils();
$Utils::CheckLoginJson();


$Config = new Config();
$Mysql = new PHPMysql($Config::$DB);
$list = $Mysql->doSql("SELECT * FROM article");


$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$pageNum = ((int) $page - 1) * $limit;
$field = '*';
$timestamp = date("Y-m-d H:i:s");


if ($act === 'add') {
    $form = array(
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'category_id' => $_POST['category_id'],
        'created' => $timestamp,
        'updated' => $timestamp,
    );
    $result = $Mysql->insert('article', $form);
    exit(json_encode(array(
        'act' => 'add',
        'form' => $form,
        'result' => $result,
    )));
} else if ($act === 'edit') {
    $id = $_POST['id'];
    $form = array(
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'category_id' => $_POST['category_id'],
        'updated' => $timestamp,
    );
    $result = $Mysql->where(array('id' => $id))->update('article', $form);
    exit(json_encode(array(
        'act' => 'edit',
        'form' => $form,
        'result' => $result,
    )));
} else if ($act === 'delete') {
    $id = $_POST['id'];
    $result = $Mysql->where(array('id' => $id))->delete('article');
    exit(json_encode(array(
        'act' => 'delete',
        'result' => $result,
    )));
}


$total = $Mysql->field('COUNT(0) AS total')->select('article')[0]['total'];
$list = $Mysql->field($field)->order(array('id' => 'desc'))->limit($page, $limit)->select('article');
// for ($i = 0; $i < count($list); $i++) {
//     $list[$i]['parent_name'] = $Mysql->where(array('id' => $list[$i]['parent']))->select('city')[0]['name'];
// }


$data = array(
    'list' => $list,
    'page' => array(
        'total' => $total,
        'limit' => $limit,
        'page' => $page,
        'page_count' => ceil($total / $limit)
    )
);


echo (json_encode($data));
