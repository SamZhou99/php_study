<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $utc = date('Y-m-d H:i:s');
        
        return view('welcome_message', [
            'messageData' => '服务器端消息',
            'date' => $utc,
        ]);
    }
}
