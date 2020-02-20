<?php

$filename = '报表';
$list = array(
    array('id' => 1, 'username' => '张三'),
    array('id' => 2, 'username' => '李四'),
    array('id' => 3, 'username' => '王五'),
);

header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=" . $filename . ".xls");

$strexport = "编号\t姓名\t性别\t年龄\r";
foreach ($list as $row) {
    $strexport .= $row['id'] . "\t";
    $strexport .= $row['username'] . "\t";
    $strexport .= $row['sex'] . "\t";
    $strexport .= $row['age'] . "\r";
}
// $strexport = iconv('UTF-8', "GB2312//IGNORE", $strexport);
exit($strexport);
