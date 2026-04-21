<?php

namespace App\Libraries;

class ResultFormat
{
    // 返回成功结果
    public function Success($data)
    {
        $data = [
            'code' => 0,
            'msg' => 'ok',
            'time' => date('Y-m-d H:i:s'),
            'data' => $data,
        ];
        return $data;
    }

    // 返回失败结果
    public function Failed($msg)
    {
        $data = [
            'code' => -1,
            'msg' => $msg,
            'time' => date('Y-m-d H:i:s'),
            'data' => [],
        ];
        return $data;
    }
}