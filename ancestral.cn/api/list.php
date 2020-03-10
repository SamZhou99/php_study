<?php session_start();
require_once('../class/PHPMysql.class.php');
require_once('../class/PHPnew.class.php');
require_once('../class/Config.class.php');
require_once('../class/Utils.class.php');


$Utils = new Utils();
$Utils::CheckLoginJson();


$Config = new Config();
$Mysql = new PHPMysql($Config::$DB);


$act = isset($_GET['act']) ? $_GET['act'] : '';
$key = isset($_GET['key']) ? $_GET['key'] : '';
$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$pageNum = ((int) $page - 1) * $limit;
$form = array('act' => $act, 'key' => $key);


// 获取相关会员
function getMembers($ancestralId)
{
    global $Mysql;
    $members = $Mysql->where(array('ancestral_id' => $ancestralId))->select('ancestral_member_relations');
    $memberIds = array();
    for ($j = 0; $j < count($members); $j++) {
        $memberIds[] = $members[$j]['member_id'];
    }
    $memberIds = count($memberIds) > 0 ? implode(',', $memberIds) : '0';
    $member = $Mysql->doSql("SELECT id,type,name,account,phone,position FROM member WHERE id IN ($memberIds)");
    return $member;
}
// 获取相关文章
function getArticle($ancestralId)
{
    global $Mysql;
    $list = $Mysql->where(array('ancestral_id' => $ancestralId))->select('article');
    return $list;
}
// 合并列表数据
function listMerge(&$list)
{
    for ($i = 0; $i < count($list); $i++) {
        $ancestralId = $list[$i]['id'];
        $list[$i]['member'] = getMembers($ancestralId);
        $list[$i]['article'] = getArticle($ancestralId);
    }
}


if ('1' === $act) {
    // 1礼堂名称
    $total = $Mysql->doSql("SELECT COUNT(0) AS total FROM ancestral WHERE ancestral.name LIKE '%$key%' ")[0]['total'];
    $list = $Mysql->doSql("SELECT ancestral.*, city.id AS city_id, city.name AS city_name, city.parent AS city_parent FROM ancestral LEFT JOIN city ON city.id=ancestral.city_id WHERE ancestral.name LIKE '%$key%' ORDER BY ancestral.id DESC LIMIT $pageNum, $limit");
    listMerge($list);
} else if ('2' === $act) {
    // 2地区名称
    $total = $Mysql->doSql("SELECT COUNT(0) AS total FROM ancestral LEFT JOIN city ON city.id=ancestral.city_id WHERE city.name LIKE '%$key%' ")[0]['total'];
    $list = $Mysql->doSql("SELECT ancestral.*, city.id AS city_id, city.name AS city_name, city.parent AS city_parent FROM ancestral LEFT JOIN city ON city.id=ancestral.city_id WHERE ancestral.address LIKE '%$key%' ORDER BY ancestral.id DESC LIMIT $pageNum, $limit");
    listMerge($list);
} else if ('3' === $act) {
    // 3人员名称
    $total = $Mysql->doSql("SELECT COUNT(0) AS total FROM ancestral JOIN ancestral_member_relations ON ancestral_member_relations.ancestral_id=ancestral.id JOIN member ON member.id=ancestral_member_relations.member_id WHERE member.name LIKE '%$key%' ")[0]['total'];
    $list = $Mysql->doSql("SELECT ancestral.* FROM ancestral JOIN ancestral_member_relations ON ancestral_member_relations.ancestral_id=ancestral.id JOIN member ON member.id=ancestral_member_relations.member_id WHERE member.name LIKE '%$key%' ORDER BY ancestral.id DESC ");
    listMerge($list);
} else if ('4' === $act) {
    // 4人员电话
    $total = $Mysql->doSql("SELECT COUNT(0) AS total FROM ancestral JOIN ancestral_member_relations ON ancestral_member_relations.ancestral_id=ancestral.id JOIN member ON member.id=ancestral_member_relations.member_id WHERE member.phone LIKE '%$key%' ")[0]['total'];
    $list = $Mysql->doSql("SELECT ancestral.* FROM ancestral JOIN ancestral_member_relations ON ancestral_member_relations.ancestral_id=ancestral.id JOIN member ON member.id=ancestral_member_relations.member_id WHERE member.phone LIKE '%$key%' ORDER BY ancestral.id DESC ");
    $list = array_values(array_unique($list, SORT_REGULAR));
    listMerge($list);
} else if ('5' === $act) {
    // 5创建时间
    $total = $Mysql->doSql("SELECT COUNT(0) AS total FROM ancestral WHERE ancestral.name LIKE '%$key%' ")[0]['total'];
    $list = $Mysql->doSql("SELECT ancestral.*, city.id AS city_id, city.name AS city_name, city.parent AS city_parent FROM ancestral LEFT JOIN city ON city.id=ancestral.city_id WHERE ancestral.name LIKE '%$key%' LIMIT $pageNum, $limit");
    listMerge($list);
} else if ('6' === $act) {
    // 6礼堂星级
    $total = $Mysql->doSql("SELECT COUNT(0) AS total FROM ancestral WHERE ancestral.star='$key' ")[0]['total'];
    $list = $Mysql->doSql("SELECT ancestral.*, city.id AS city_id, city.name AS city_name, city.parent AS city_parent FROM ancestral LEFT JOIN city ON city.id=ancestral.city_id WHERE ancestral.star='$key' LIMIT $pageNum, $limit");
    listMerge($list);
} else if ('7' === $act) {
    // 7文章标题
    // 
} else if ('8' === $act) {
    // 8文章内容
    // 
} else {
    // 
}

exit(json_encode(array(
    'form' => $form,
    'list' => $list,
    'page' => array(
        'total' => $total,
        'limit' => $limit,
        'page' => $page,
        'page_count' => ceil($total / $limit)
    )
)));








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
