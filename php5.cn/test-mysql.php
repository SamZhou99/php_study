<?php

$host = '127.0.0.1';
$user = 'root';
$password = 'root';
$dbName = 'link_url';
$link = new mysqli($host, $user, $password, $dbName);
if ($link->connect_error) {
    die("连接失败：" . $link->connect_error);
}
mysqli_set_charset($link, "utf8");
$sql = "SELECT * FROM `category` LIMIT 100";
$res = $link->query($sql);
echo ('<meta charset="utf-8">');

// $data = $res->fetch_all();
// var_dump($data);

while ($row = mysqli_fetch_object($res)) {
    echo ('<p>');
    echo ($row->name);
    echo ('</p>');
}
