<?php session_start();
include('./class/Utils.class.php');

unset($_SESSION['isLogin']);
unset($_SESSION['id']);

$U = new Utils();
$U::Location('/login.php');