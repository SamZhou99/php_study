<?php

$data = array();

if (!isset($_FILES['file'])) {
    $data['error'] = '缺少参数 code:1';
    exit(json_encode($data));
}

$allowedExts = array("gif", "jpeg", "jpg", "png");
$fileType = array('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png');
$fileSize = 1024 * 1024;
$extension = end(explode(".", $_FILES["file"]["name"]));

if (!in_array($extension, $allowedExts)) {
    $data['error'] = '非法文件 code:1';
    exit(json_encode($data));
}

if (!in_array($_FILES["file"]["type"], $fileType)) {
    $data['error'] = '非法文件 code:2';
    exit(json_encode($data));
}

if ($_FILES["file"]["size"] > $fileSize) {
    $data['error'] = '文件超过大小 code:1';
    exit(json_encode($data));
}

if ($_FILES["file"]["error"] > 0) {
    $data['error'] = $_FILES["file"]["error"];
    exit(json_encode($data));
}


move_uploaded_file($_FILES['file']['tmp_name'], '../upload/' . $_FILES['file']['name']);


$data['url'] = '/upload/' . $_FILES['file']['name'];
$data['fileName'] = $_FILES["file"]["name"];
$data['fileType'] = $_FILES["file"]["type"];
$data['fileSize'] = ($_FILES["file"]["size"] / 1024) . 'kB';
echo (json_encode($data));
