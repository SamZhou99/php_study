<?php
include('./Config.class.php');

class Utils
{

    static public function Location($url = '/')
    {
        Header("HTTP/1.1 303 See Other");
        Header("Location: $url");
        exit();
    }

    static public function CheckLogin($url = '/')
    {
        // 配置
        $Config = new Config();

        if ($_SESSION['isLogin'] !== $Config::$IsLogin) {
            self::Location($url);
        }
    }
}
