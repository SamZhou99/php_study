<?php

class Utils
{
    static $DB = array(
        'host' => '127.0.0.1',
        'port' => '3306',
        'user' => 'root',
        'passwd' => 'root',
        'dbname' => 'ancestral_hall'
    );

    static public function Location($url = '/')
    {
        Header("HTTP/1.1 303 See Other");
        Header("Location: $url");
        exit();
    }
}
