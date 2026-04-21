<?php

namespace App\Controllers;
use App\Libraries\ResultFormat;

class About extends BaseController
{
    private $RF;

    public function __construct()
    {
        $this->RF = new ResultFormat();
    }

    public function index()
    {
        // $db = \Config\Database::connect(); // 连接数据库
        $db = db_connect();
        $size = $this->request->getGet('size') ?? 5;
        $page = $this->request->getGet('page') ?? 1;
        $count = $db->query('SELECT COUNT(*) AS count FROM test_table WHERE deleted_at IS NULL')->getRow()->count;

        $userRes = $db->table('test_table')
            ->select("id, user_name, age, sex, creater_at, update_at")
            ->where('deleted_at', null)
            ->orderBy('id', 'DESC')
            ->limit($size, ($page - 1) * $size)
            ->get();
        $userArr = $userRes->getResult();
        
        $data = $this->RF->Success(['page'=>$page, 'size'=>$size, 'count'=>$count, 'users'=>$userArr]);
        return $this->response->setJSON($data);
    }

    public function add(){
        $db = db_connect();
        $data = [
            'user_name' => 'name_' . time() . '_' . rand(1000, 9999),
            'age' => rand(10, 90),
            'sex' => rand(0, 1) ? '男' : '女',
        ];
        $db->table('test_table')->insert($data);
        return $this->index();
    }

    public function delete(){
        $db = db_connect();
        $id = $this->request->getGet('id');
        if(empty($id)){
            $data = $this->RF->Failed('id不能为空');
            return $this->response->setJSON($data);
        }
        // $db->table('test_table')->where('id', $id)->delete();
        $db->table('test_table')
            ->where('id', $id)
            ->update(['deleted_at' => date('Y-m-d H:i:s')]);
        return $this->index();
    }

    public function update(){
        $db = db_connect();
        $id = $this->request->getGet('id');
        if(empty($id)){
            $data = $this->RF->Failed('id不能为空');
            return $this->response->setJSON($data);
        }
        $db->table('test_table')
            ->where('id', $id)
            ->update(['deleted_at' => null]);
        return $this->index();
    }

}
