<?php session_start();
require_once('../class/PHPMysql.class.php');
require_once('../class/PHPnew.class.php');
require_once('../class/Config.class.php');
require_once('../class/Utils.class.php');


$Utils = new Utils();
$Utils::CheckLoginJson();


$Config = new Config();
$Mysql = new PHPMysql($Config::$DB);




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



$starArr = array();
for ($i = 1; $i <= 5; $i++) {
    $starArr[$i] = $Mysql
        ->field('COUNT(0) AS total')
        ->where(array('star' => $i))
        ->select('ancestral')[0];
}


$data = array(
    'star' => $starArr
);


echo (json_encode($data));
