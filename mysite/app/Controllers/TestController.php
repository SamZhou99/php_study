<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\ApiController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TestModel;

class TestController extends ApiController
{
    // 列表页
    public function index()
    {
        $perPage = $this->request->getGet('size') ?? 10;
        $page = $this->request->getGet('page') ?? 1;

        $testModel = new TestModel();
        $list      = $testModel->getList((int)$perPage, (int)$page);
        $total     = $testModel->getListCount(false); // 获取总记录数，第二个参数为 false 表示不重置查询构建器
        return $this->paginate($list, $total, $page, $perPage, '获取成功');
    }

    // 详情
    public function show($id = null)
    {
        $testModel = new TestModel();
        $data      = $testModel->getOne($id);

        return $this->success($data, '获取成功');
    }

    // 添加
    public function create()
    {
        $testModel = new TestModel();

        $data = [
            'user_name' => $this->request->getPost('user_name'),
            'age' => $this->request->getPost('age'),
            'sex' => $this->request->getPost('sex'),
        ];

        $testModel->save($data);

        return redirect()->to('/user');
    }

    // 更新
    public function update($id)
    {
        $testModel = new TestModel();

        $data = [
            'user_name' => $this->request->getPost('user_name'),
            'age' => $this->request->getPost('age'),
            'sex' => $this->request->getPost('sex'),
        ];

        $testModel->update((int)$id, $data);

        return $this->response->setJSON(['code' => 0]);
    }

    // 删除（软删除）
    public function delete($id)
    {
        $testModel = new TestModel();
        $testModel->delete((int)$id); // 软删除

        return $this->response->setJSON(['code' => 0]);
    }
}
