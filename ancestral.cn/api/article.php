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
$ancestral_id = isset($_REQUEST['ancestral_id']) ? (int) $_REQUEST['ancestral_id'] : 0;
$id = isset($_REQUEST['id']) ? (int) $_REQUEST['id'] : 0;


if ($act === 'add') {
    $form = array(
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'category_id' => $_POST['category_id'],
        'ancestral_id' => $ancestral_id,
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
        'ancestral_id' => $ancestral_id,
        'updated' => $timestamp,
    );
    // var_dump($form);
    // exit();
    // $form['content'] = str_ireplace("'", "'''", $form['content']);
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


if ($id) {
    $item = $Mysql->doSql("SELECT article.*,ancestral.name AS ancestral_name FROM article JOIN ancestral ON ancestral.id=article.ancestral_id WHERE article.id=$id");
    if (count($item) > 0) {
        exit(json_encode(array('data' => $item[0])));
    }
    exit(json_encode(array('id' => $id)));
}


if ($ancestral_id) {
    $total = $Mysql->field('COUNT(0) AS total')->where(array('ancestral_id' => $ancestral_id))->select('article')[0]['total'];
    $list = $Mysql->doSql("SELECT article.*,ancestral.name AS ancestral_name FROM article JOIN ancestral ON ancestral.id=article.ancestral_id WHERE ancestral.id=$ancestral_id");
} else {
    $total = $Mysql->field('COUNT(0) AS total')->select('article')[0]['total'];
    $list = $Mysql->doSql("SELECT article.*,ancestral.name AS ancestral_name FROM article JOIN ancestral ON ancestral.id=article.ancestral_id");
}


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
