<?php session_start();
require_once('../class/PHPMysql.class.php');
require_once('../class/PHPnew.class.php');
require_once('../class/Config.class.php');
require_once('../class/Utils.class.php');


$Utils = new Utils();
$Utils::CheckLoginJson();


$Config = new Config();
$Mysql = new PHPMysql($Config::$DB);


$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$pageNum = ((int) $page - 1) * $limit;
$field = ($act === 'all') ? '*' : 'id,name,phone,position';
$timestamp = date("Y-m-d H:i:s");


if ($act === 'add') {
    $form = array(
        'name' => $_POST['name'],
        'account' => $_POST['account'],
        'password' => $_POST['password'],
        'phone' => $_POST['phone'],
        'position' => $_POST['position'],
        'type' => $_POST['type'],
        'sort' => $_POST['sort'],
        'status' => $_POST['status'],
        'created' => $timestamp,
        'updated' => $timestamp,
    );
    $result = $Mysql->insert('member', $form);
    exit(json_encode(array(
        'act' => 'add',
        'form' => $form,
        'result' => $result,
    )));
} else if ($act === 'edit') {
    $id = $_POST['id'];
    $form = array(
        'name' => $_POST['name'],
        'account' => $_POST['account'],
        'password' => $_POST['password'],
        'phone' => $_POST['phone'],
        'position' => $_POST['position'],
        'type' => $_POST['type'],
        'sort' => $_POST['sort'],
        'status' => $_POST['status'],
        'updated' => $timestamp,
    );
    $result = $Mysql->where(array('id' => $id))->update('member', $form);
    exit(json_encode(array(
        'act' => 'add',
        'form' => $form,
        'result' => $result,
    )));
} else if ($act === 'delete') {
    $id = $_POST['id'];
    $result = $Mysql->where(array('id' => $id))->delete('member');
    exit(json_encode(array(
        'act' => 'delete',
        'result' => $result,
    )));
}



$total = $Mysql->field('COUNT(0) AS total')->select('member')[0]['total'];
$list = $Mysql->field($field)->order(array('id' => 'desc'))->limit($page, $limit)->select('member');


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
