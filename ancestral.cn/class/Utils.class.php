<?php

class Utils
{

    /**
     * 跳转 重定向
     */
    static public function Location($url = '/')
    {
        Header("HTTP/1.1 303 See Other");
        Header("Location: $url");
        exit();
    }

    /**
     * 检查 登录
     */
    static public function CheckLogin()
    {
        $Config = new Config();
        return ($_SESSION['isLogin'] === $Config::$IsLogin) ? TRUE : FALSE;
    }

    /**
     * 检查 登录 并 跳转
     */
    static public function CheckLoginLocation($url = '/')
    {
        if (!self::CheckLogin()) {
            self::Location($url);
        }
    }

    /**
     * 检查 登录 返回 json
     */
    static public function CheckLoginJson()
    {
        if (!self::CheckLogin()) {
            exit(json_encode(array('message' => '未登录')));
        }
    }
}
