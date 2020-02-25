<?php session_start();
require_once('../class/PHPMysql.class.php');
require_once('../class/PHPnew.class.php');
require_once('../class/Config.class.php');
require_once('../class/Utils.class.php');


$Utils = new Utils();
$Utils::CheckLoginJson();


$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$pageNum = ((int) $page - 1) * $limit;


$Config = new Config();
$Mysql = new PHPMysql($Config::$DB);
$total = $Mysql->doSql("SELECT COUNT(0) AS total FROM ancestral")[0]['total'];
$list = $Mysql->doSql("SELECT ancestral.*, city.name AS city_name  FROM ancestral LEFT JOIN city ON city.id=ancestral.city_id ORDER BY ancestral.id DESC LIMIT $pageNum,$limit");


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
