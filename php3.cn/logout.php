<?php session_start();

unset($_SESSION['isAdmin']);
// $_SESSION['isAdmin'] = 9999;

Header("HTTP/1.1 303 See Other");
Header("Location: /");

exit;
