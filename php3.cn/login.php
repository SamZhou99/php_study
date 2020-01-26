<?php session_start();

$_SESSION['isAdmin'] = 9999;

Header("HTTP/1.1 303 See Other");
Header("Location: /");

exit;
