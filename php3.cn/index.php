<?php
// 测试 flutter 加载json数据

$name = isset($_GET['name']) ? $_GET['name'] : 'xxx';
$email = isset($_GET['email']) ? $_GET['email'] : 'xxx@xxx.com';

$data = array(
    'name' => $name,
    'email' => $email
);

echo (json_encode($data));
