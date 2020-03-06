<?php session_start();
require_once('../class/PHPMysql.class.php');
require_once('../class/PHPnew.class.php');
require_once('../class/Config.class.php');
require_once('../class/Utils.class.php');


$Utils = new Utils();
$Utils::CheckLoginJson();


$Config = new Config();
$Mysql = new PHPMysql($Config::$DB);


$act = isset($_POST['act']) ? $_POST['act'] : '';


// 添加
if ('add' === $act) {
    $form = array(
        'name' => $_POST['name'],
        'star' => $_POST['star'],
        'address' => $_POST['address'],
        'city_id' => $_POST['city_id'],
    );
    $member = $_POST['member'];
    $result = $Mysql->insert('ancestral', $form);
    $lastInsertId = $Mysql->lastInsertId();
    for ($i = 0; $i < count($member); $i++) {
        $memberRelation = $Mysql->insert('ancestral_member_relations', array('ancestral_id' => $lastInsertId, 'member_id' => $member[$i]['id']));
    }
    exit(json_encode(array(
        'act' => 'add',
        'data' => $form,
        'result' => $result,
        'lastInsertId' => $lastInsertId
    )));
}


// 更新
if ('edit' === $act) {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $form = array(
        'name' => $_POST['name'],
        'star' => $_POST['star'],
        'address' => $_POST['address'],
        'city_id' => $_POST['city_id'],
    );
    // 更新礼堂数据
    $result = $Mysql->where(array('id' => $id))->update('ancestral', $form);
    // 更新会员关系
    $member = $_POST['member'];
    $memberRelation = $Mysql->where(array('ancestral_id' => $id))->delete('ancestral_member_relations');
    for ($i = 0; $i < count($member); $i++) {
        $memberRelation = $Mysql->insert('ancestral_member_relations', array('ancestral_id' => $id, 'member_id' => $member[$i]['id']));
    }
    exit(json_encode(array(
        'act' => 'edit',
        'id' => $id,
        'member' => $member,
        'data' => $form,
    )));
}


// 删除
if ('del' === $act) {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
    $result = $Mysql->where(array('id' => $id))->delete('ancestral');
    $memberRelation = $Mysql->where(array('ancestral_id' => $id))->delete('ancestral_member_relations');
    exit(json_encode(array(
        'act' => 'del',
        'id' => $id,
        'data' => $result
    )));
}


$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$pageNum = ((int) $page - 1) * $limit;


$total = $Mysql->field('COUNT(0) AS total')->select('ancestral')[0]['total'];
$list = $Mysql->doSql("SELECT ancestral.*, city.id AS city_id, city.name AS city_name  FROM ancestral LEFT JOIN city ON city.id=ancestral.city_id ORDER BY ancestral.id DESC LIMIT $pageNum,$limit");


for ($i = 0; $i < count($list); $i++) {
    $id = $list[$i]['id'];
    $member = $Mysql->doSql("SELECT member.id,name,phone,position FROM member LEFT JOIN ancestral_member_relations AS amr ON amr.member_id=member.id WHERE amr.ancestral_id=$id");
    $list[$i]['member'] = $member;
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
